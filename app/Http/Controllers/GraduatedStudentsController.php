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

class GraduatedStudentsController extends Controller {


	//jerlyn
	public function viewAllGradStudents(){
           
			
            $allGradStudentInfo = DB::table('graduatedstudents')-> paginate(5);      

           
        return view('graduatedStudents.viewAllGradStudents')->with([
            'allGradStudentInfo' => $allGradStudentInfo
         
            ]); 
    }
	
	//jerlyn
	public function viewMetaInfo(Request $request, $studentID){
			$sID = $studentID;
			
			$gradstudent = DB::table('graduatedstudents')->where('gradstudentid',$sID)                              
                                ->first();  
			$metainfo = DB::table('gradstudentsmetainfo')-> paginate(5);  
			
            //$allStudentInfo = DB::table('graduatedstudents')-> paginate(5);      
			
		//$arrayobj = new ArrayObject();

		//does grad student's grade
       $modules = DB::table('gradstudentsmetainfo')
            ->join('module','module.id', '=', 'gradstudentsmetainfo.moduleid')
            ->join('grades', 'grades.moduleid','=','gradstudentsmetainfo.moduleid')         
            ->select('module.*','grades.*', 'gradstudentsmetainfo.*')
            ->where('gradstudentsmetainfo.gradstudentid', $sID) 
            ->paginate(5);

        $student = DB::table('graduatedstudents')
                    ->where('gradstudentid' , $sID)
                    ->first();
			
           
        return view('graduatedStudents.viewGradStudentsMetaInfo')->with([
           'modules' => $modules,
            'student' => $student
            ]); 
    }
	
	
	
}