<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Hod;
use App\Module;
use App\Grade;
use App\Recommendation;
use Auth;
use Hash;
use DB;
use Session;
use DateTime;
class GradeController extends Controller {

    public function index(Request $request)
    {
 		$role = $request->session()->get('role');

		if ($role == 'lecturer'){
			$userid = auth()->guard('lecturer')->user()->lecturerid;

		    $modules = DB::table('module')
            ->where('module.lecturerid', $userid)->paginate(5);  
			
		}
		else if ($role == 'hod'){
			$userid = auth()->guard('hod')->user()->hodid;

			$modules = DB::table('module')
            ->where('module.hodid', $userid)->paginate(5);  
		}
		else
		{
			return redirect('common/logout');
		}
        
        $today = (new DateTime())->format('Y-m-d'); 
        return view('grade.index')->with([
            'modules' => $modules,
            'today' =>$today,
            'role' => $role
            ]);  
    }

	
	    public function showManageGrade(Request $request, $id){
	        
	        $role = $request->session()->get('role');
    	
   			if ($role != 'lecturer' and $role != 'hod')
   			{
			
				return redirect('common/logout');
			
			}

            $moduleid = $id;
     
            $module = Module::findorFail($id);


            $grades = DB::table('module')
            ->join('grades', 'grades.moduleid', '=', 'module.id')
            ->join('students','students.studentid', '=', 'grades.studentid')
            ->select('module.*','grades.*','students.*')
            ->where('grades.moduleid', $moduleid)->paginate(5);    

           
        return view('grade.managegrade')->with([
            'grades' => $grades,
            'module' => $module
            ]); 
    }






    public function showAddGrade(Request $request, $moduleid,$gradeid)
    {
        $role = $request->session()->get('role');
	
		if ($role != 'lecturer' and $role != 'hod')
		{
	
		return redirect('common/logout');
	
		}        
        return view('grade.addgrade')->with([
            'moduleid' => $moduleid,
            'gradeid' => $gradeid
            ]); 
    }

    public function addGrade(Request $request, $moduleid,$gradeid)
    {

        $role = $request->session()->get('role');
	
		if ($role != 'lecturer' and $role != 'hod')
		{
	
		return redirect('common/logout');
	
		}  

        $input= $request->all();
        $student = Grade::findorFail($gradeid);
        $recommendation = $request->only(['recommendation']);

        DB::table('grades')
                ->where('id', $gradeid)
                ->update(['grade' => $input['grade']]);          
          

            //if recommendation is empty dont run this insert into recommendation table
            //else then run this code
            // use isset
            if (empty($input['recommendation']) != 1)
            {

	            if($input['moderation'] != 0.0)
	            {	
		            $recommendationid = DB::table('recommendation')->insertGetId([
		            'recommendation' => $input['recommendation'], 
		            'studentid' =>  $student->studentid,
		            'lecturerid' => $student->lecturerid,
		            'hodid' => $student->hodid,
		            'moduleid' => $moduleid,
		            'moderation'=>$input['moderation']
		            ]);

	            }
	            else
	            {
	            	Session::set('error_message', "Please select recommendation."); 
	            	return redirect()->back();
	            }
            }    

	    Session::set('success_message', "Student Grade added sucessfully."); 
	    return redirect()->route('manage_grade', $moduleid);
    }

    public function showEditGrade(Request $request, $moduleid,$gradeid)
    {
        $role = $request->session()->get('role');
	
		if ($role != 'lecturer' and $role != 'hod')
		{
	
		return redirect('common/logout');
	
		}

		$grades = Grade::findorFail($gradeid);
		$recommendations = DB::table('recommendation')
            				->where('studentid', $grades->studentid)
            				->where('moduleid', $grades->moduleid)
            				->first();

        return view('grade.editgrade')->with([
            'grades' => $grades,
            'recommendations' => $recommendations,
            'moduleid' => $moduleid,
            'gradeid' => $gradeid
            ]);     	
    }


    public function editGrade(Request $request, $moduleid,$gradeid)
    {
        $role = $request->session()->get('role');
	
		if ($role != 'lecturer' and $role != 'hod')
		{
	
		return redirect('common/logout');
	
		}  

        $input= $request->all();
   
        $student = Grade::findorFail($gradeid);
		$recommendation = DB::table('recommendation')
            				->where('studentid', $student->studentid)
            				->where('moduleid', $student->moduleid)
            				->first(); 

        DB::table('grades')
                ->where('id', $gradeid)
                ->update(['grade' => $input['grade']]);          
          
    if (empty($input['recommendation']) != 1)
    {            
        if(isset($recommendation->recommendation))
        {
       		if($input['moderation'] != 0.0)
       		{
        		DB::table('recommendation')
                	->where('id', $recommendation->id)
                	->update([
                		'recommendation' => $input['recommendation'],
                		'moderation' =>$input['moderation']
                			]); 
       		}
       		else
       		{
       			Session::set('error_message', "Please select recommendation."); 
	    		return redirect()->back();
       		}
 

        }
        else
        {
		        if($input['moderation'] != 0.0)
		       	{
		            $recommendationid = DB::table('recommendation')->insertGetId([
		            'recommendation' => $input['recommendation'], 
		            'studentid' =>  $student->studentid,
		            'lecturerid' => $student->lecturerid,
		            'hodid' => $student->hodid,
		            'moduleid' => $moduleid,
		            'moderation'=>$input['moderation']
		            ]);
		        }
		        else
		        {
		       			Session::set('error_message', "Please select recommendation."); 
			    		return redirect()->back();      	
		        }
		}         
    }
    

	    Session::set('success_message', "Student Grade added sucessfully."); 
	    return redirect()->route('manage_grade', $moduleid);    	
    }


    public function showRecommendation(Request $request, $moduleid)
    {
        $role = $request->session()->get('role');
	
		if ($role != 'lecturer' and $role != 'hod')
		{
	
		return redirect('common/logout');
	
		}

		$module = Module::findorFail($moduleid);

		$recommendations = DB::table('recommendation')
            ->join('students','students.studentid', '=', 'recommendation.studentid')
            ->select('recommendation.*','students.studentname')
            ->where('recommendation.moduleid', $moduleid)
            ->where('recommendation.status', 0)->paginate(5);  

	        return view('grade.recommendation')->with([
	            'module' => $module,
	            'recommendations' => $recommendations
	            ]); 
    }

    public function approveRec(Request $request, $moduleid,$recommendationid)
    {
        $role = $request->session()->get('role');
	
		if ($role != 'lecturer' and $role != 'hod')
		{
	
		return redirect('common/logout');
	
		}

        DB::table('recommendation')
                ->where('id', $recommendationid)
                ->update(['status' => 1]);   

	    Session::set('success_message', "Student Recommendation approved.");
	    return redirect()->back();
    }

    public function rejectRec(Request $request, $moduleid,$recommendationid)
    {
        $role = $request->session()->get('role');
	
		if ($role != 'lecturer' and $role != 'hod')
		{
	
		return redirect('common/logout');
	
		}

        DB::table('recommendation')
                ->where('id', $recommendationid)
                ->update(['status' => 2]);   

	    Session::set('success_message', "Student Recommendation rejected.");
	    return redirect()->back();
    }      

	//TODO
	// @param: marks (decimal)
	// @return: grade (text/varchar)
	public function calculateIndivGrade($marks)
    {
        //TODO: this function converts the marks into grades (alphabets) and store into grades table
		if ($marks >= 75){
			//A
		}
		elseif ($marks >= 60 && $marks < 75){
			//B
		}
		elseif ($marks>= 50  && $marks < 60){
			//C
		}
		else{
			//fail
		}
    } 

	//TODO
	// @param: studentid(int)
	// @return: grade (text/varchar)
	public function calculateCgpa($studentid)
    {
		// this function should be called when marks are released to students
		
        //TODO: this function calculates the average marks of the student and converts to grades for cgpa
		$allEnrolledMods = DB::table('grades') 
				->where('studentid', $sID) 
				->get(); 
				
		
		$modCount = 0;
		$totalGpa = 0.0;		
		foreach ($allEnrolledMods as $studMod) {
			$modCount +=1;
			$totalGpa+=$studMod->marks;
		}
		//check if the formula to calc cgpa is correct
		$cgpa = $totalGpa/$modCount;
		
		//update student cgpa in student table
		DB::table('students')
                ->where('studentid', $studentID)
                ->update([
				'cgpa' => $cgpa
							
				]);     
		
    } 	
}