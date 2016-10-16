<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Lecturer;
use App\Module;
use App\Grade;
use Auth;
use Hash;
use DB;
use Session;

class LecturerController extends Controller {




    public function index()
    {
        $lecturerId = auth()->guard('lecturer')->user()->lecturerid;

        // $grades = DB::table('grades')
        //         ->where('studentid',$studentId)->paginate(5);


        $modules = DB::table('module')
            ->where('module.lecturerid', $lecturerId)->paginate(5);    


        return view('lecturer.index')->with([
            'modules' => $modules
            ]);  
    }




    public function showManageGrade(Request $request, $id){

            $moduleid = $id;

            $module = Module::findorFail($id);


            $grades = DB::table('module')
            ->join('grades', 'grades.moduleid', '=', 'module.id')
            ->join('students','students.studentid', '=', 'grades.studentid')
            ->select('module.*','grades.*','students.*')
            ->where('grades.moduleid', $moduleid)->paginate(5);    

           
        return view('lecturer.managegrade')->with([
            'grades' => $grades,
            'module' => $module
            ]); 
    }

    public function showAddGrade(Request $request, $moduleid,$gradeid)
    {
        
        return view('lecturer.addgrade')->with([
            'moduleid' => $moduleid,
            'gradeid' => $gradeid
            ]); 
    }

    public function addGrade(Request $request, $moduleid,$gradeid)
    {
        $input= $request->all();
        $student = Grade::findorFail($gradeid);
       
        DB::table('grades')
                ->where('id', $gradeid)
                ->update(['grade' => $input['grade']]);          
          


            $recommendationid = DB::table('recommendation')->insertGetId([
            'recommendation' => $input['recommendation'], 
            'studentid' =>  $student->studentid,
            'lecturerid' => $student->lecturerid,
            'hodid' => $student->hodid,
            'moduleid' => $moduleid
            ]);  

            Session::set('success_message', "Student Grade added sucessfully."); 
            return redirect()->route('manage_grade', $moduleid);

    }



}