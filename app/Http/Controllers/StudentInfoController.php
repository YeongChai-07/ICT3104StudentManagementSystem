<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Lecturer;
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
            return $this->viewAllStudents() ;
    }
}