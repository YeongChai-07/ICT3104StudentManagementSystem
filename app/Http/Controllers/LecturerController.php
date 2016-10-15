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


	public function displayLogin()
	{
		return view('lecturer.login');
	}
	
	public function login(Request $request)
	{

		$data = $request->only(['email', 'password']);
        $validator = validator($request->all(),[
        'email' => 'required|min:3|max:100',
        'password' => 'required|min:3|max:100',

        ]);

        //Validate inputs
        if ($validator -> fails())
        {
            Session::set('error_message', "Invalid Login");
            return redirect('lecturer/login');
        }


        //Check for inputs with users table
        if( auth()->guard('lecturer')->attempt(['lectureremail' => $data['email'], 'password' => $data['password']]))
        {
            //return auth()->guard('lecturer')->user();
            Session::forget('error_message');

            return redirect('lecturer/index');
        }
        else
        {
            Session::set('error_message', "Invalid Login");
            return redirect('lecturer/login');
            
        }
	}

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


    public function logout(Request $request)
    {
        auth()->guard('lecturer')->logout();
        $request->session()->flush();
        return redirect('lecturer/login');
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


    public function displayDetails()
    {

            $lecturerId = auth()->guard('lecturer')->user()->lecturerid;

            $lecturer = Lecturer::where('lecturerid',$lecturerId)                              
                                ->first();       
            return view('lecturer.editdetails',['lecturer' => $lecturer]);
    }


    public function updateDetails(Request $request)
    {
             $lecturerId = auth()->guard('lecturer')->user()->lecturerid;

            $input= $request->all();
            DB::table('lecturer')
                ->where('lecturerid', $lecturerId)
                ->update(['contact' => $input['contact'],'address' => $input['address']]);          
          
                Session::set('success_message', "Profile updated sucessfully."); 
               return redirect()->back();
    
    }

    public function displayPassword()
    {


       return view('lecturer.change');
    }

    public function updatePassword(Request $request)
    {   
        $input= $request->all();
        $user = auth()->guard('lecturer')->user();
    
        $validator = validator($request->all(),[
        'old-password' => 'required',
        'password' => 'required|min:3|confirmed',
        'password_confirmation' => 'required|min:3'

        ]);
        //Validate inputs
        if ($validator -> fails())
        {
            Session::set('error_message', "Password don't match");
            return redirect()->back(); 
        }
        
    
        if (Hash::check($input['old-password'], $user->password)) {
            $hash = Hash::make($input['password']);
            $user->password = $hash;
            $user->save();

            Session::set('success_message', "Password updated sucessfully.");
            } else {
                Session::set('error_message', "Old Password is wrong.");
            }
            
        return redirect()->back();
    }


    public function showDetailsFunction() // added
    {

             $lecturerId = auth()->guard('lecturer')->user()->lecturerid;

            $lecturer = Lecturer::where('lecturerid',$lecturerId)                              
                                ->first();       
            return view('lecturer.showdetails',['lecturer' => $lecturer]);
    }

}