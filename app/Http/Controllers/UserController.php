<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Lecturer;
use App\Student;
use App\Hod;
use App\Module;
use App\Enroll;
use Auth;
use Hash;
use DB;
use Session;
use DateTime;

//Importing the Artisan Facade
use Illuminate\Support\Facades\Artisan;

class UserController extends Controller {


	public function displayLogin()
	{
		$users = User::all();
		return view('user.login')->with([
            'users' => $users
            ]);
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
            return redirect('user/login');
        }


        //Check for inputs with users table
        if( auth()->guard('web')->attempt(['email' => $data['email'], 'password' => $data['password']]))
        {
            //return auth()->guard('web')->user();
            Session::forget('error_message');

            return redirect('user/index');
        }
        else
        {
            Session::set('error_message', "Invalid Login");
            return redirect('user/login');
          
        }
	}
	
    public function index()
    {
        $adminId = auth()->guard('web')->user()->id;

        $students = DB::table('students')->paginate(5);
        return view('user.index')->with([
            'students' => $students
            ]);
    }

    public function showHod()
    {
        $adminId = auth()->guard('web')->user()->id;

        $hods = DB::table('hod')->paginate(5);
        return view('user.hod')->with([
            'hods' => $hods
            ]);
    }

    public function showLecturer()
    {
        $adminId = auth()->guard('web')->user()->id;

        $lecturers = DB::table('lecturer')->paginate(5);
        return view('user.lecturer')->with([
            'lecturers' => $lecturers
            ]);
    }


    public function logout(Request $request)
    {
        auth()->guard('web')->logout();
        $request->session()->flush();
        return redirect('user/login');
    }


    public function showAddLecturer(){
        return view('user.addlecturer');
    }

    public function addLecturer(Request $request)
    {
        $input = $request->all();
        $emailcheck = Lecturer::where('lectureremail', $input['email'])
                    ->first();

        $id = $emailcheck['lecturerid'];
        if(!$id)
        {
            $password = substr(md5(uniqid(mt_rand(), true)) , 0, 6);
            $password = 'demo123';
            $hash = Hash::make($password);

            $lecturerid = DB::table('lecturer')->insertGetId([
            'lecturername' => $input['name'], 
            'lectureremail' =>  $input['email'],
            'password' => $hash
            ]);


            // //set gmail email and password in .env to work             
            // $data = array( 'name' => $input['name'], 'email' =>  trim($input['email']), 'password' => $password );
            // Mail::send('email.register', $data,  function ($message) use ($data) {
            
            // //Uncomment to work like intedashboard;
            // $message->to(trim($data['email']))->subject('You are registered to Inteplayer');
            //  //$message->to($input[email])->subject('You are registered to Inteplayer');
            // });
                         
        }
        else
        {
            Session::set('error_message', "Lecturer Exists");
            return redirect()->back();             
        }


            Session::set('success_message', "Lecturer Created Successfully");
            return redirect()->back(); 
    }


        public function editLecturer($id)
    {
    
            $lecturer = Lecturer::where('lecturerid',$id)                              
                                ->first();  
        
            
            
            return view('user.editlecturer',['lecturer' => $lecturer]);
    }

    /**
     * Update Teacher Details based on inputs
     *
     * @param  $id
     * @return View User editteacher 
     */
    public function updateLecturer($id, Request $request) 
    {
          
        $lecturer = Lecturer::findorFail($id);
                  
        
       $input= $request->all();
       //check if duplicate email
       if(trim($lecturer->lectureremail) == trim($input['email']))
       {
           $emailvalidation = 'required|email';
       }
       else
       {
           $emailvalidation = 'required|email|unique:lecturer,lectureremail';
       }

        $validator= validator($request->all(), [
                'name' => 'required',
                'email' => $emailvalidation,
                /*' studentemail' => 'required|email|unique:m_student,studentemail,'.$id,  */
        ]);

   
        //Validate inputs
        if ($validator -> fails())
        {
            Session::set('error_message', "Email already exists");
            return redirect()->back();
        }     
        
       
       DB::table('lecturer')
                ->where('lecturerid', $id)
                ->update(['lecturername' => $input['name'],'lectureremail' => $input['email']]);          
          
                Session::set('success_message', "Profile updated sucessfully."); 
               return redirect()->back();
          
    }

    public function deleteLecturer($id){
        
           DB::table('lecturer')->where('lecturerid', $id)->delete();
                                       
        Session::set('success_message', "Lecturer deleted Successfully");  
        return redirect()->back();
    }


    public function showAddStudent(){
        return view('user.addstudent');
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
            'password' => $hash
            ]);


            // //set gmail email and password in .env to work             
            // $data = array( 'name' => $input['name'], 'email' =>  trim($input['email']), 'password' => $password );
            // Mail::send('email.register', $data,  function ($message) use ($data) {
            
            // //Uncomment to work like intedashboard;
            // $message->to(trim($data['email']))->subject('You are registered to Inteplayer');
            //  //$message->to($input[email])->subject('You are registered to Inteplayer');
            // });
                         
        }
        else
        {
            Session::set('error_message', "Student Exists");
            return redirect()->back();             
        }


            Session::set('success_message', "Student Created Successfully");
            return redirect()->back(); 
    }

        public function editStudent($id)
    {
    
            $student = Student::where('studentid',$id)                              
                                ->first();  
        
            
            
            return view('user.editstudent',['student' => $student]);
    }

    /**
     * Update Teacher Details based on inputs
     *
     * @param  $id
     * @return View User editteacher 
     */
    public function updateStudent($id, Request $request) 
    {
          
        $student = Student::findorFail($id);
                  
        
       $input= $request->all();
       //check if duplicate email
       if(trim($student->studentemail) == trim($input['email']))
       {
           $emailvalidation = 'required|email';
       }
       else
       {
           $emailvalidation = 'required|email|unique:students,studentemail';
       }

        $validator= validator($request->all(), [
                'name' => 'required',
                'email' => $emailvalidation,
                /*' studentemail' => 'required|email|unique:m_student,studentemail,'.$id,  */
        ]);

   
        //Validate inputs
        if ($validator -> fails())
        {
            Session::set('error_message', "Email already exists");
            return redirect()->back();
        }     
        
       
       DB::table('students')
                ->where('studentid', $id)
                ->update(['studentname' => $input['name'],'studentemail' => $input['email']]);          
          
                Session::set('success_message', "Profile updated sucessfully."); 
               return redirect()->back();
          
    }

    public function deleteStudent($id){
        
           DB::table('students')->where('studentid', $id)->delete();
                                       
        Session::set('success_message', "Student deleted Successfully");  
        return redirect()->back();
    } 

    public function showAddHod(){
        return view('user.addhod');
    }

    public function addHod(Request $request)
    {
        $input = $request->all();
        $emailcheck = Hod::where('hodemail', $input['email'])
                    ->first();

        $id = $emailcheck['hodid'];
        if(!$id)
        {
            $password = substr(md5(uniqid(mt_rand(), true)) , 0, 6);
            $password = 'demo123';
            $hash = Hash::make($password);

            $studentid = DB::table('hod')->insertGetId([
            'hodname' => $input['name'], 
            'hodemail' =>  $input['email'],
            'password' => $hash
            ]);


            // //set gmail email and password in .env to work             
            // $data = array( 'name' => $input['name'], 'email' =>  trim($input['email']), 'password' => $password );
            // Mail::send('email.register', $data,  function ($message) use ($data) {
            
            // //Uncomment to work like intedashboard;
            // $message->to(trim($data['email']))->subject('You are registered to Inteplayer');
            //  //$message->to($input[email])->subject('You are registered to Inteplayer');
            // });
                         
        }
        else
        {
            Session::set('error_message', "Hod Exists");
            return redirect()->back();             
        }


            Session::set('success_message', "Hod Created Successfully");
            return redirect()->back(); 
    }

        public function editHod($id)
    {
    
            $hod = hod::where('hodid',$id)                              
                                ->first();  
        
            
            
            return view('user.edithod',['hod' => $hod]);
    }

    /**
     * Update Teacher Details based on inputs
     *
     * @param  $id
     * @return View User editteacher 
     */
    public function updateHod($id, Request $request) 
    {
          
        $hod = Hod::findorFail($id);
                  
        
       $input= $request->all();
       //check if duplicate email
       if(trim($hod->hodemail) == trim($input['email']))
       {
           $emailvalidation = 'required|email';
       }
       else
       {
           $emailvalidation = 'required|email|unique:hod,hodemail';
       }

        $validator= validator($request->all(), [
                'name' => 'required',
                'email' => $emailvalidation,
                /*' studentemail' => 'required|email|unique:m_student,studentemail,'.$id,  */
        ]);

   
        //Validate inputs
        if ($validator -> fails())
        {
            Session::set('error_message', "Email already exists");
            return redirect()->back();
        }     
        
       
       DB::table('hod')
                ->where('hodid', $id)
                ->update(['hodname' => $input['name'],'hodemail' => $input['email']]);          
          
                Session::set('success_message', "Profile updated sucessfully."); 
               return redirect()->back();
          
    }

    public function deleteHod($id){
        
           DB::table('hod')->where('hodid', $id)->delete();
                                       
        Session::set('success_message', "Hod deleted Successfully");  
        return redirect()->back();
    }


    public function showModule(){


        $modules = DB::table('module')
            ->join('lecturer','lecturer.lecturerid', '=', 'module.lecturerid')
            ->join('hod','hod.hodid', '=','module.hodid')
            ->select('module.*','hod.*','lecturer.*')->paginate(5);


        return view('user.module')->with([
            'modules' => $modules
            ]);


    }


        public function showAddModule(){

            $lecturers = Lecturer::all();
            $hods = Hod::all();

            return view('user.addmodule')->with([
            'lecturers' => $lecturers,
            'hods' => $hods
            ]);

    }
        public function addModule(Request $request)
    {
        //To be used later when comparing dates
        //$today = (new DateTime())->format('Y-m-d');

        $input = $request->all();

        if(!isset($input['editdate']) || !isset($input['freezedate']))
        {
            Session::set('error_message', "Please Enter Dates");
            return redirect()->back();  
        }   

        $editdata = $request->only(['editdate']);
        $freezedata = $request->only(['freezedate']);


        $editDateString = implode(';', $editdata);
        $editdate = (new DateTime($editDateString))->format('Y-m-d');

        
        $freezeDateString = implode(';', $freezedata);
        $freezedate = (new DateTime($freezeDateString))->format('Y-m-d');

        $modulecheck = Module::where('modulename', $input['name'])
                    ->first();

        if($editdate >= $freezedate)
        {

            Session::set('error_message', "Edit Date must be before Freeze Date");
            return redirect()->back();    
        }

        $id = $modulecheck['id'];
        if(!$id)
        {        
            $moduleid = DB::table('module')->insertGetId([
            'modulename' => $input['name'], 
            'description' =>  $input['description'],
            'lecturerid' => $input['lecturer'],
            'hodid' => $input['hod'],
            'editdate' => $editdate,
            'freezedate' => $freezedate
            ]);

        }
        else
        {

            Session::set('error_message', "Module Exists");
            return redirect()->back();             
        }


            Session::set('success_message', "Module Created Successfully");
            return redirect()->back(); 
    }

        public function editModule($id)
    {
    
            $module = Module::where('id',$id)                              
                                ->first();  
        
            $lecturers = Lecturer::all();
            $hods = Hod::all();

            return view('user.editmodule')->with([
            'lecturers' => $lecturers,
            'hods' => $hods,
            'module' => $module
            ]);
            
    }

    public function updateModule($id, Request $request) 
    {
          
        $module = Module::findorFail($id);
                  
        
       $input= $request->all();

        $editdata = $request->only(['editdate']);
        $freezedata = $request->only(['freezedate']);


        $editDateString = implode(';', $editdata);
        $editdate = (new DateTime($editDateString))->format('Y-m-d');

        
        $freezeDateString = implode(';', $freezedata);
        $freezedate = (new DateTime($freezeDateString))->format('Y-m-d');

        $modulecheck = Module::where('modulename', $input['name'])
                    ->first();

        if($editdate >= $freezedate)
        {

            Session::set('error_message', "Edit Date must be before Freeze Date");
            return redirect()->back();    
        }        
       
       DB::table('module')
                ->where('id', $id)
                ->update(['modulename' => $input['name'],'description' => $input['description'],'lecturerid' => $input['lecturer'],'hodid' => $input['hod'],'editdate' => $editdate, 'freezedate' => $freezedate]);          
          
                Session::set('success_message', "Module updated sucessfully."); 
               return redirect()->back();
          
    }

    public function deleteModule($id){
        
           DB::table('module')->where('id', $id)->delete();
           DB::table('grades')->where('moduleid',$id)->delete();
           DB::table('recommendation')->where('moduleid',$id)->delete();

        Session::set('success_message', "Module deleted Successfully");  
        return redirect()->back();
    }

    public function displayStudent($id)
    {

        $students = DB::select('select * from students WHERE NOT EXISTS (SELECT * FROM enroll WHERE students.studentid = enroll.studentid and enroll.moduleid = ?)', [$id]);

        return view('user.enrollstudent')->with([
            'students' => $students,
            'id'   => $id
            ]);
    }



    public function enrollStudent(Request $request,$id)
    {
         $input= $request->all();

        if(!isset($input['chkid']))
        {
            Session::set('error_message', "Please Check at least one");
            return redirect()->back();  
        }

         $enroll = $input['chkid'];



         for($i=0;$i<count($enroll);$i++)
         {
            $enrollid = DB::table('enroll')->insertGetId([
            'moduleid' => $id, 
            'studentid' =>  $enroll[$i]
            ]);
         }
         
        Session::set('success_message', "Student enrolled Successfully");  
        return redirect()->back();
    }
	
	public function backupSystem()
	{
		return view('user.backupsystem');
	}
	
	public function processSystemBackup()
	{
		$artisanCall_Result = Artisan::call('backup:run', []);
	}


    public function displayPassword()
    {


       return view('user.change');
    }

    public function updatePassword(Request $request)
    {   
        $input= $request->all();
        $user = auth()->guard('web')->user();
    
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

    public function displayDetails()
    {

            $userid = auth()->guard('web')->user()->id; 

              $user = User::where('id',$userid)                              
                                ->first();  

            return view('user.editdetails',['user' => $user]);
    
}


    public function updateDetails(Request $request)
    {
        $userid  = auth()->guard('web')->user()->id;
        $input= $request->all();
       DB::table('users')
                ->where('id', $userid)
                ->update(['contact' => $input['contact'],'address' => $input['address']]);           
                Session::set('success_message', "Profile updated sucessfully."); 
               return redirect()->back();
    }


    public function showDetailsFunction() // added
    {
           $id = auth()->guard('web')->user()->id;

            $users = DB::table('users')
            ->where('id',$id)->first();  
            return view('user.showdetail',['users' => $users]);
    }

	
}