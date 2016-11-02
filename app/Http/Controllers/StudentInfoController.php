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
use DateTime;
class StudentInfoController extends Controller {


	//jerlyn
	public function viewAllStudents(){
           
			
            $allStudentInfo = DB::table('students')-> paginate(5);      

        // $student =   DB::table('students')->where('studentid',1)->first();
        // $today = (new DateTime())->format('Y-m-d');
        // $today = date('Y-m-d', strtotime($today. ' + 90 days'));
        // return $today; 
        // if($today > $student->expirydate)
        // {
        // 	return 'Lock acc';
        // }
        // else
        // {
        // 	return 'Still safe';
        // }
    
            


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
	        $today = (new DateTime())->format('Y-m-d');
	        $expirydate = date('Y-m-d', strtotime($today. ' + 90 days'));
            $password = substr(md5(uniqid(mt_rand(), true)) , 0, 6);
            //$password = $this->generatePassword(8);
            $password = 'demo123';
            $hash = Hash::make($password);

            $studentid = DB::table('students')->insertGetId([
            'studentname' => $input['name'], 
            'studentemail' =>  $input['email'],
            'metric' => $input['metric'],
            'contact'=> $input['contact'],
            'address'=> $input['address'],
            'password' => $hash,
            'enrolyear' => date("Y"),
            'expirydate' => $expirydate
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
	//public function deleteStudent(Request $request, $studentID){
	public function archiveStudent(Request $request, $studentID){	
			
			$sID = $studentID;

            $student = DB::table('students')->where('studentid',$sID)                              
                                ->first(); 
			
			$gradyear = $student->enrolyear + 3;
			
			
			//insert into graduatedstudents table
			DB::table('graduatedstudents')->insert(array(
				'gradstudentid' => $student->studentid, 
				'gradstudentname' => $student->studentname,
				'gradstudentemail' => $student->studentemail,
				'metric' => $student->metric,
				'contact' => $student->contact,
				'address' => $student->address,
				'enrolyear' => $student->enrolyear,
				'gradyear' => $gradyear,
				'cgpa' => $student->cgpa
			
			));   
			
			//insert into meta info
			$allEnrolledMods = DB::table('grades') 
				->where('studentid', $sID) 
				-> select('studentid', 'moduleid', 'grade', 'marks')
				->get(); 
			
			foreach ($allEnrolledMods as $studMod) {
				DB::table('gradstudentsmetainfo')->insert(array(
				'gradstudentid' => $studMod->studentid, 
				'moduleid' => $studMod->moduleid,
				'grade' => $studMod->grade,
				'marks' => $studMod->marks
			));   			
			}
			
			
			//delete student from students table
            $student = DB::table('students')->where('studentid',$sID)->delete(); 
			
			//delete student from grades table
            $student = DB::table('grades')->where('studentid',$sID)->delete(); 
			

			Session::set('success_message', "Archived sucessfully."); 			
			//Session::set('success_message', "Deleted sucessfully."); 
            return redirect('studentinfo/viewAllStudents');
    }

	public function generatePassword($_len) {

	    $_alphaSmall = 'abcdefghijklmnopqrstuvwxyz';            // small letters
	    $_alphaCaps  = strtoupper($_alphaSmall);                // CAPITAL LETTERS
	    $_numerics   = '1234567890';                            // numerics
	    $_specialChars = '`~!@#$%^&*()-_=+]}[{;:,<.>/?\'"\|';   // Special Characters

	    $_container = $_alphaSmall.$_alphaCaps.$_numerics.$_specialChars;   // Contains all characters
	    $password = '';         // will contain the desired pass

	    for($i = 0; $i < $_len; $i++) {                                 // Loop till the length mentioned
	        $_rand = rand(0, strlen($_container) - 1);                  // Get Randomized Length
	        $password .= substr($_container, $_rand, 1);                // returns part of the string [ high tensile strength ;) ] 
	    }

	    return $password;       // Returns the generated Pass
	}
}