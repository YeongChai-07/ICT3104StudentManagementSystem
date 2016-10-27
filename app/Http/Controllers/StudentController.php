<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Student;

use Auth;
use Hash;
use DB;
use Session;

class StudentController extends Controller {


	public function displayLogin()
	{
		return view('student.login');
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
            return redirect('student/login');
        }


        //Check for inputs with users table
        if( auth()->guard('student')->attempt(['studentemail' => $data['email'], 'password' => $data['password']]))
        {
            //return auth()->guard('student')->user();
            Session::forget('error_message');

            return redirect('student/grade');
        }
        else
        {
            Session::set('error_message', "Invalid Login");
            return redirect('student/login');
            
        }
	}

    public function index()
    {
        $studentId = auth()->guard('student')->user()->studentid;

        // $grades = DB::table('grades')
        //         ->where('studentid',$studentId)->paginate(5);


        $grades = DB::table('module')
            ->join('grades', 'grades.moduleid', '=', 'module.id')
            ->select('module.*','grades.*')
            ->where('grades.publish', 1)
            ->where('grades.studentid', $studentId)->paginate(5);    


        return view('student.index')->with([
            'grades' => $grades
            ]);      
    }



    public function logout(Request $request)
    {
        auth()->guard('student')->logout();
        $request->session()->flush();
        return redirect('student/login');
    }

     public function viewGrade(){
         $studentId = auth()->guard('student')->user()->studentid;

        $grades = DB::table('module')
            ->join('grades', 'grades.moduleid', '=', 'module.id')
            ->select('module.*','grades.*')
            ->where('grades.publish', 1)
            ->where('grades.studentid', $studentId)->paginate(5);    


        return view('student.grade')->with([
            'grades' => $grades
            ]);

     }

    public function recommendation()
    {
        $studentId = auth()->guard('student')->user()->studentid;

        // $grades = DB::table('grades')
        //         ->where('studentid',$studentId)->paginate(5);


        $recommendation = DB::table('module')
            ->join('recommendation', 'recommendation.moduleid', '=', 'module.id')
            ->select('module.*','recommendation.*')
            ->where('recommendation.studentid', $studentId)->paginate(5);    

            
        return view('student.recommendation')->with([
            'recommendations' => $recommendation
            ]);      
    }

    public function displayDetails()
    {

            $id = auth()->guard('student')->user()->studentid;

            $student = Student::where('studentid',$id)                              
                                ->first();  
        
            
            
            return view('student.editdetails',['student' => $student]);
    }


    public function showDetailsFunction() // added
    {
           $studentId = auth()->guard('student')->user()->studentid;

            $students = DB::table('students')
            ->where('studentid',$studentId)->first();  
            return view('student.showdetails',['students' => $students]);
    }


    public function updateDetails(Request $request)
    {
        $id = auth()->guard('student')->user()->studentid;
        $input= $request->all();
       DB::table('students')
                ->where('studentid', $id)
                ->update(['contact' => $input['contact'],'address' => $input['address']]);          
          
                Session::set('success_message', "Profile updated sucessfully."); 
               return redirect()->back();
    }

    public function displayPassword()
    {


       return view('student.change');
    }

    public function updatePassword(Request $request)
    {   
        $input= $request->all();
        $user = auth()->guard('student')->user();
    
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



    public function showModule(){
    
    $studentId = auth()->guard('student')->user()->studentid;


       $modules = DB::table('module')
            ->join('lecturer','lecturer.lecturerid', '=', 'module.lecturerid')
            ->join('enroll','enroll.moduleid', '=', 'module.id')
            ->join('students', 'students.studentid', '=', 'enroll.studentid')         
            ->select('module.*','lecturer.*','students.*')
            ->where('enroll.studentid', $studentId) 
            ->paginate(5);
            return view('student.module')->with([
            'modules' => $modules
            ]);
    }



}

