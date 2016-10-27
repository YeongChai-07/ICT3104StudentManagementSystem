<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Lecturer;
use App\Student;
use App\Module;
use App\Grade;

use Hash;
use DB;
use Session;

class StudentInfoController extends Controller {


	//jerlyn
	public function viewAllStudents(){
           
			
            $allStudentInfo = DB::table('students')-> paginate(5);      

           
        return view('studentinfo.viewAllStudents')->with([
            'allStudentInfo' => $allStudentInfo
         
            ]); 
    }
	
	//jerlyn
	public function editStudentInfoView(Request $request, $studentID){
            $sID = $studentID;

            $student = DB::table('students')->where('studentid',$sID)                              
                                ->first();  

            return view('studentinfo.editStudentInfoView',['student' => $student]);
    }
	
	public function showAddStudent(){
        return view('studentinfo.addStudentView');
    }

    public function addStudent(Request $request)
    {
        $input = $request->all();
        $emailcheck = Student::where('studentemail', $input['email'])
                    ->first();

        $id = $emailcheck['studentid'];
        if(!$id)
        {
            $password = substr(md5(uniqid(mt_rand(), true)) , 0, 6);
            $password = 'demo123';
            $hash = Hash::make($password);

            $studentid = DB::table('students')->insertGetId([
            'studentname' => $input['name'], 
            'studentemail' =>  $input['email'],
            'metric' => $input['metric'],
            'contact'=> $input['contact'],
            'address'=> $input['address'],
            'password' => $hash
            ]);

                         
        }
        else
        {
            Session::set('error_message', "Student Exists");
            return redirect()->back();             
        }


            Session::set('success_message', "Student Created Successfully");
			
			//$role = $request->session()->get('role');
			
			return redirect('studentinfo/viewAllStudents');
            //return redirect()->back(); 
    }
	//jerlyn
	public function updateStudentInfo(Request $request, $studentID){
		$input= $request->all();
	
		
		DB::table('students')
                ->where('studentid', $studentID)
                ->update([
				'metric' => $input['metric'],
				'studentname' => $input['name'],
				'studentemail' => $input['email'],
				'address' => $input['address'],
				'contact' => $input['contact']				
				]);          
          
                Session::set('success_message', "Profile updated sucessfully."); 
               return redirect()->back();
    }
	
	//jerlyn
	public function deleteStudentView(Request $request, $studentID){
            $sID = $studentID;

            $student = DB::table('students')->where('studentid',$sID)                              
                                ->first(); 
										

            return view('studentinfo.deleteStudentView', ['student' => $student]);
    }
	
	//jerlyn
	public function deleteStudent(Request $request, $studentID){
		
			$input= $request->all();
			
            //update table if the category selected == graduated
			//remove student from table
			if ($input['reason']== "graduate"){
				// put in new table
				return $input;				
			}
			$sID = $studentID;

            $student = DB::table('students')->where('studentid',$sID)->delete(); 
									
			Session::set('success_message', "Deleted sucessfully."); 
            return redirect('studentinfo/viewAllStudents');
    }
}