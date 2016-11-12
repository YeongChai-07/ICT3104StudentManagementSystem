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
            ->where('module.lecturerid', $userid)
            ->where('publish',0)
            ->paginate(5);  
			
		}
		else if ($role == 'hod'){
			$userid = auth()->guard('hod')->user()->hodid;

			$modules = DB::table('module')
            ->where('module.hodid', $userid)
			->where('publish',0)
            ->paginate(5); 
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
        $gradeScore = $this->calculateIndivGrade($input['grade']);
   		$encryptedGrade = encrypt($input['grade']);
   		// $decrypted = decrypt($encryptedValue);
   		// return $decrypted;
        DB::table('grades')
                ->where('id', $gradeid)
                ->update(['grade' => $gradeScore,'marks' => $encryptedGrade]);          
          

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
   		$gradeScore = $this->calculateIndivGrade($input['grade']);
   		$encryptedGrade = encrypt($input['grade']);
        $student = Grade::findorFail($gradeid);
		$recommendation = DB::table('recommendation')
            				->where('studentid', $student->studentid)
            				->where('moduleid', $student->moduleid)
            				->first(); 

        DB::table('grades')
                ->where('id', $gradeid)
                ->update(['grade' => $gradeScore,'marks' => $encryptedGrade]);           
          
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
    else
    {
    	if(isset($recommendation->recommendation))
    	{
    		DB::table('recommendation')
    		->where('id', $recommendation->id)
    		->delete();
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
            ->leftjoin('students','students.studentid', '=', 'recommendation.studentid')
            ->leftjoin('grades','grades.studentid', '=', 'recommendation.studentid')
            ->select('recommendation.*','students.studentname','grades.marks')
            ->where('recommendation.moduleid', $moduleid)
            ->where('grades.moduleid',$moduleid)
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
		if ($marks >= 80)
		{
			$gradeScore = 'A';
		}
		elseif ($marks >= 75  && $marks < 80)
		{
			$gradeScore = 'B+';
		}
		elseif ($marks>= 70  && $marks < 75)
		{
			$gradeScore = 'B';
		}
		elseif ($marks>= 60  && $marks < 70)
		{
			$gradeScore = 'C';
		}
		elseif ($marks>= 50  && $marks < 60)
		{
			$gradeScore = 'D';
		}
		else
		{
			$gradeScore = 'Fail';
		}

		return $gradeScore;
    } 

	//TODO
	// @param: studentid(int)
	// @return: grade (text/varchar)
	public function calculateCgpa($studentid)
    {
		// this function should be called when marks are released to students
		
        //TODO: this function calculates the average marks of the student and converts to grades for cgpa
		$allEnrolledMods = DB::table('grades') 
				->join('module','module.id','=','grades.moduleid')
				->select('module.credit','grades.*')
				->where('grades.studentid', $studentid)
				->where('grades.publish', 1)
				->get(); 

		
		
		$creditCount = 0;
		$totalGpa = 0.0;		
		foreach ($allEnrolledMods as $studMod) {
			$creditCount +=$studMod->credit;
			$gradeScore = $this->convertGPA($studMod->grade);
			$gradeScore = $gradeScore * $studMod->credit;
			$totalGpa+=$gradeScore;
		}

		//check if the formula to calc cgpa is correct
		$cgpa = $totalGpa/$creditCount;
		
		//update student cgpa in student table
		//TODO: NEED TO ENCRPYT
		DB::table('students')
                ->where('studentid', $studentid)
                ->update([
				'cgpa' => encrypt($cgpa)
							
				]);     
		return $cgpa;
    }

	public function convertGPA($grade)
    {
        //TODO: this function converts the marks into grades (alphabets) and store into grades table
		if (strcmp($grade,'A') == 0)
		{
			$gradeScore = '4.0';
		}
		elseif (strcmp($grade,'B+') == 0)
		{
			$gradeScore = '3.5';
		}
		elseif (strcmp($grade,'B') == 0)
		{
			$gradeScore = '3.0';
		}
		elseif (strcmp($grade,'C') == 0)
		{
			$gradeScore = '2.5';
		}
		elseif (strcmp($grade,'D') == 0)
		{
			$gradeScore = '2.0';
		}
		elseif(strcmp($grade,'Fail') == 0)
		{
			$gradeScore = '1.0';
		}

		return $gradeScore;
    } 

    public function endEdit(Request $request, $moduleid)
    {
        $role = $request->session()->get('role');
	
		if ($role != 'lecturer' and $role != 'hod')
		{
	
		return redirect('common/logout');
	
		}

        DB::table('module')
                ->where('id', $moduleid)
                ->update(['endedit' => 1]);   

	    Session::set('success_message', "Edit grades has been ended");
	    return redirect()->back();
    }

    public function endFreeze(Request $request, $moduleid)
    {
        $role = $request->session()->get('role');
	
		if ($role != 'lecturer' and $role != 'hod')
		{
	
		return redirect('common/logout');
	
		}

        DB::table('module')
                ->where('id', $moduleid)
                ->update(['endfreeze' => 1]);   

	    Session::set('success_message', "Freeze grades has been ended");
	    return redirect()->back();
    }

    public function publish(Request $request, $moduleid)
    {
    	
    	$role = $request->session()->get('role');
	
		if ($role != 'lecturer' and $role != 'hod')
		{
	
		return redirect('common/logout');
	
		}

        DB::table('module')
                ->where('id', $moduleid)
                ->update(['publish' => 1]);

        DB::table('grades')
                ->where('moduleid', $moduleid)
                ->update(['publish' => 1]); 

		$students =  DB::table('grades')
						->where('moduleid', $moduleid)
						->get();
		
		foreach($students as $student)
		{
			$cgpa = $this->calculateCgpa($student->studentid);
		}
		Session::set('success_message', "Module Grades Published");
		return redirect()->back();				
    }   	
}