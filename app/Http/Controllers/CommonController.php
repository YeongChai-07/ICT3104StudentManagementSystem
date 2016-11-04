<?php
namespace App\Http\Controllers;
ini_set('max_execution_time', 300);
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Admin;
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
use Mail;

// this controller is for the functions shared by all users
use Illuminate\Support\Facades\Artisan;

class CommonController extends Controller {

	public function logout(Request $request)
    {
		 $role = $request->session()->get('role');
		 
		 if ($role == 'admin'){
			 auth()->guard('admin')->logout();
			 
		 }
		 else if ($role == 'lecturer'){
			 auth()->guard('lecturer')->logout();
			 
		 }
		 else if ($role == 'hod'){
			 auth()->guard('hod')->logout();
			 
		 }
		 else {
			 auth()->guard('student')->logout();
			 
		 }
        $request->session()->flush();
        return redirect('common/login');
    }
	public function displayLogin()
	{
		//$users = User::all();
		//return view('common.login')->with(['users' => $users  ]);
		return view('common.login');
	}

	public function login(Request $request)
	{

		
		$data = $request->only(['email', 'password']);
        $validator = validator($request->all(),[
        'email' => 'required|min:3|max:100',
        'password' => 'required|min:3|max:100',

        ]);
		
		$email = $data['email'];
		$password = $data['password'];

        //Validate inputs
        if ($validator -> fails())
        {
            Session::set('error_message', "Invalid credentials");
            return redirect('common/login');
        }
	
		// checks if user with email exists
		if (Admin::where('adminemail', '=',$data['email'])->exists()) {
			// user found
			$staff = DB::table('admin')
            ->where('adminemail',$data['email'])->first();
	
			//check for matching passwords
			return $this->ifPasswordMatch($email, $password, $staff->password, 'admin');
			
		}
		else if (Hod::where('hodemail', '=' ,$data['email'])->exists()) {
			
			// user found
			$staff = DB::table('hod')
            ->where('hodemail',$data['email'])->first();
			
			//check for locked account and expired password
			$checkLock = $this->checkLock(2,$data['email']);
        	if($checkLock ==1)
        	{
        		Session::set('error_message', "Account Locked. Contact Admin");
            	return redirect('common/login');
        	}
        	else
        	{
        		$checkExpiry = $this->checkExpiry(2,$data['email']);
        		if($checkExpiry == 1)
        		{
        			Session::set('error_message', "Account Locked. Contact Admin");
            		return redirect('common/login');        			
        		}
        		else if($checkExpiry == 2)
        		{
					Session::set('error_message', "Password has expired. Please update your password");
        		}
        	}
			//--
			
			return $this->ifPasswordMatch($data['email'], $data['password'], $staff->password, 'hod');

		}
		else if (Lecturer::where('lectureremail', '=' ,$data['email'])->exists()) {
			// user found
			$staff = DB::table('lecturer')
            ->where('lectureremail',$data['email'])->first();
			
			//check for locked account and expired password
			$checkLock = $this->checkLock(1,$data['email']);
        	if($checkLock ==1)
        	{
        		Session::set('error_message', "Account Locked. Contact Admin");
            	return redirect('common/login');
        	}
        	else
        	{
        		$checkExpiry = $this->checkExpiry(1,$data['email']);
        		if($checkExpiry == 1)
        		{
        			Session::set('error_message', "Account Locked. Contact Admin");
            		return redirect('common/login');        			
        		}
        		else if($checkExpiry == 2)
        		{
					Session::set('error_message', "Password has expired. Please update your password");
        		}
        	}
			//--
		  
			return $this->ifPasswordMatch($data['email'], $data['password'], $staff->password, 'lecturer');
			

		}
		else if (auth()->guard('student')->attempt(['studentemail' => $data['email'], 'password' => $data['password']])){
			//check for locked account and expired password
			$checkLock = $this->checkLock(3,$data['email']);
        	if($checkLock ==1)
        	{
        		Session::set('error_message', "Account Locked. Contact Admin");
            	return redirect('common/login');
        	}
        	else
        	{
        		$checkExpiry = $this->checkExpiry(3,$data['email']);
        		if($checkExpiry == 1)
        		{
        			Session::set('error_message', "Account Locked. Contact Admin");
            		return redirect('common/login');        			
        		}
        		elseif($checkExpiry == 2)
        		{
					Session::set('error_message', "Password has expired. Please update your password");
        		}
        	}
			//--
			
			session(['role' => 'student']);
			return redirect('student/index');
		}
		else{
			Session::set('error_message', "User with email does not exist");
			return redirect('common/login');
		}
	
	}
	

	//check for matching password & call function for verifying user
	public function ifPasswordMatch($email, $passwordInput, $DBpswd, $role)
	{
		if (Hash::check($passwordInput, $DBpswd)){
				session(['role' => $role]);
				return $this->verifyUserView($email, $passwordInput);	
		}
		else {
			Session::set('error_message', "Incorrect Password.");
			return redirect('common/login');
		}
	}
	//send token to user's email
	public function verifyUserView($email, $password)
	{
		$title = '2FA - School Management System';
		$token = str_random(10);
		
		// insert token into column
		$this->updateDBToken($email, $token, 1); //set token in db
		
		$data = array('token'=>$token);
		$mailTemplate = 'common/mail';
		$this->sendMail($email, $title, $data, $mailTemplate);
		
		return view('common.verifyuser', ['email' => $email, 'password'=>$password]);
		
	}
	public function sendMail($recipientMail, $title, $data, $mailTemplate)
	{
		Mail::send($mailTemplate, $data, function ($message)use ($recipientMail, $title) {

			$message->to($recipientMail)->subject($title);

		});
		Session::set('success_message', "Login Token is sent to your email");

	}

	// update token value in DB table 'token' column
	public function updateDBToken($email, $token, $action){
		$role = Session::get('role');
		
		$tableName = '';
		$emailColName= '';
		$idColName = 'token';
		
		if ($role == 'admin'){
			
			$tableName = 'admin';
			$emailColName= 'adminemail';
			
		}
		
		else if ($role == 'lecturer'){
			
			$tableName = 'lecturer';
			$emailColName= 'lectureremail';
		}
		else {
			
			$tableName = 'hod';
			$emailColName= 'hodemail';
			
		}
		//action 1 = update token. action 2 = delete token;
		
		if ($action == 1){
			DB::table($tableName)
                ->where($emailColName, $email)
                ->update(['token' => $token]); 
		}
		else{
			DB::table($tableName)
                ->where($emailColName, $email)
                ->update(['token' => '']);
		}
		//remove sesh
		          
	}
	
	
	
	//checks if the token input and token in DB matches for 2FA
	public function verifyUser(Request $request)
	{
		$input = $request->all();
		$token= $input['token'];
		$email =$input['email']; 
		$password =$input['password']; 
		
		$role = Session::get('role');
		
		$tableName = '';
		$emailColName= '';
		$idColName = 'token';
		
		if ($role == 'admin'){
			
			$tableName = 'admin';
			$emailColName= 'adminemail';
			
		}
		
		else if ($role == 'lecturer'){
			
			$tableName = 'lecturer';
			$emailColName= 'lectureremail';
		}
		else {
			
			$tableName = 'hod';
			$emailColName= 'hodemail';
			
		}
		
		$matchThese = [$emailColName => $email, 'token' => $token];
		$staff = DB::table($tableName)->where($matchThese)                              
                                ->get();
		if (!empty($staff)){
			if( auth()->guard('lecturer')->attempt(['lectureremail' => $email, 'password' => $password]))
			{
				session(['role' => 'lecturer']);
				Session::set('success_message', "Welcome!");				
				return redirect('grade/index');
			}
			else if (auth()->guard('hod')->attempt(['hodemail' => $email, 'password' => $password])){
				session(['role' => 'hod']);		
				Session::set('success_message', "Welcome!");	
				return redirect('grade/index');
			}
			else if (auth()->guard('admin')->attempt(['adminemail' => $email, 'password' => $password])){
				session(['role' => 'admin']);	
				Session::set('success_message', "Welcome!");					
				return redirect('studentinfo/viewAllStudents');
			}
		}
		else{
			Session::set('error_message', "Invalid Password/Token");
			return redirect('common/login');
		}
		
		
		return redirect('common/verifyuser');
		
	}
  
    public function displayPassword()
    {


       return view('common.change');
    }

    public function updatePassword(Request $request)
    {   
		$role = $request->session()->get('role');
		$input= $request->all();
		
		$checker = '/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/';

		$validator = validator($request->all(),[
        'old-password' => 'required',
        'password' => 'required|min:3|confirmed',
        'password_confirmation' => 'required|min:3'

        ]);
		
		
		if ($validator -> fails())
        {
            Session::set('error_message', "Password don't match");
            return redirect()->back(); 
        }
		
		$user = '';
		if ($role == 'admin'){
			$user = auth()->guard('admin')->user();
		}
		else if ($role == 'lecturer'){
			$user = auth()->guard('lecturer')->user();
			
		}
		else if ($role == 'hod'){
			$user = auth()->guard('hod')->user();
		}
		else {
			$user = auth()->guard('student')->user();
		}
		
		 if (Hash::check($input['old-password'], $user->password)) 
		 {
		 	if(preg_match($checker,$input['password']))
		 	{


				$hash = Hash::make($input['password']);
				$user->password = $hash;
				$user->save();

				Session::set('success_message', "Password updated sucessfully.");
			}
			else
			{
				Session::set('error_message', "New Password don't conform to the standard.");
			}	
		}
		else 
		{
			Session::set('error_message', "Old Password is wrong.");
		}
            
		return redirect()->back();
    }

    public function displayDetails(Request $request)
    { $role = $request->session()->get('role');
		
		
		if ($role == 'admin'){
			$id = auth()->guard('admin')->user()->adminid;		
			$users = DB::table('admin')
            ->where('adminid',$id)->first();  

           return view('common.editdetails',
		   [
		   'id' => $id,
		   'email' => $users->adminemail, 
		   'name' => $users->adminname,
		   'contact' => $users->contact,
		   'address' => $users->address
		   ]);
		}
	    else if ($role == 'student'){
			$id = auth()->guard('student')->user()->studentid;
			
			$users = DB::table('students')
            ->where('studentid',$id)->first(); 
			
			return view('common.editdetails',
		   [
		   'id' => $id,
		   'email' => $users->studentemail, 
		   'name' => $users->studentname,
		   'contact' => $users->contact,
		   'address' => $users->address
		   ]);
		}
		else if ($role == 'lecturer'){
			$id = auth()->guard('lecturer')->user()->lecturerid;
			
			$users = DB::table('lecturer')
            ->where('lecturerid',$id)->first();
			
			
			return view('common.editdetails',
		   [
		   'id' => $id,
		   'email' => $users->lectureremail, 
		   'name' => $users->lecturername,
		   'contact' => $users->contact,
		   'address' => $users->address
		   ]);
			
		
		}
		else {
			$id = auth()->guard('hod')->user()->hodid;
			
			$users = DB::table('hod')
            ->where('hodid',$id)->first(); 
			
			
			return view('common.editdetails',
		   [
		   'id' => $id,
		   'email' => $users->hodemail, 
		   'name' => $users->hodname,
		   'contact' => $users->contact,
		   'address' => $users->address
		   ]);
			

		}
}


    public function updateDetails(Request $request)
    {
		$role = $request->session()->get('role');
		$input= $request->all();
		$id = 0;
		$tableName = '';
		$idColName = '';
		
		if ($role == 'admin'){
			$id = auth()->guard('admin')->user()->adminid;	
			$tableName = 'admin';
			$idColName = 'adminid';
			
		}
		else if ($role == 'student'){
			$id = auth()->guard('student')->user()->studentid;
			$tableName = 'students';
			$idColName = 'studentid';
			 
		}
		else if ($role == 'lecturer'){
			$id = auth()->guard('lecturer')->user()->lecturerid;
			$tableName = 'lecturer';
			$idColName = 'lecturerid';
		}
		else {
			$id = auth()->guard('hod')->user()->hodid;
			$tableName = 'hod';
			$idColName = 'hodid';
			
		}
		DB::table($tableName)
                ->where($idColName, $id)
                ->update(['contact' => $input['contact'],'address' => $input['address']]);           
                Session::set('success_message', "Profile updated sucessfully."); 
               return redirect()->back();
		/**
		// add role check
        $userid  = auth()->guard('web')->user()->id;
        $input= $request->all();
       DB::table('users')
                ->where('id', $userid)
                ->update(['contact' => $input['contact'],'address' => $input['address']]);           
                Session::set('success_message', "Profile updated sucessfully."); 
               return redirect()->back();*/
    }


    public function showDetailsFunction(Request $request) // added
    {
		$role = $request->session()->get('role');
		
		
		if ($role == 'admin'){
			$id = auth()->guard('admin')->user()->adminid;		
			$users = DB::table('admin')
            ->where('adminid',$id)->first();  

           return view('common.showdetail',
		   [
		   'id' => $id,
		   'email' => $users->adminemail, 
		   'name' => $users->adminname,
		   'contact' => $users->contact,
		   'address' => $users->address
		   ]);
		}
	    else if ($role == 'student'){
			$id = auth()->guard('student')->user()->studentid;
			
			$users = DB::table('students')
            ->where('studentid',$id)->first(); 
			
			return view('common.showdetail',
		   [
		   'id' => $id,
		   'email' => $users->studentemail, 
		   'name' => $users->studentname,
		   'contact' => $users->contact,
		   'address' => $users->address
		   ]);
		}
		else if ($role == 'lecturer'){
			$id = auth()->guard('lecturer')->user()->lecturerid;
			
			$users = DB::table('lecturer')
            ->where('lecturerid',$id)->first();
			
			
			return view('common.showdetail',
		   [
		   'id' => $id,
		   'email' => $users->lectureremail, 
		   'name' => $users->lecturername,
		   'contact' => $users->contact,
		   'address' => $users->address
		   ]);
			

		}
		else {
			$id = auth()->guard('hod')->user()->hodid;
			
			$users = DB::table('hod')
            ->where('hodid',$id)->first(); 
			
			
			return view('common.showdetail',
		   [
		   'id' => $id,
		   'email' => $users->hodemail, 
		   'name' => $users->hodname,
		   'contact' => $users->contact,
		   'address' => $users->address
		   ]);
			

		}

    }
	
	// check if password is expired
	public function checkExpiry($type,$email)
	{
		if($type == 1)
		{
        	$user = DB::table('lecturer')
            ->where('lectureremail',$email)->first();
		}
		elseif($type ==2)
		{
        	$user = DB::table('hod')
            ->where('hodemail',$email)->first();
		}
		elseif($type == 3)
		{
        	$user = DB::table('students')
            ->where('studentemail',$email)->first();
		}
		$today = (new DateTime())->format('Y-m-d');

		if($today >= $user->expirydate)
		{
			$graceperiod = date('Y-m-d', strtotime($user->expirydate. ' + 10 days'));
			if($today > $graceperiod)
			{
				if($type == 1)
				{
		        	$user = DB::table('lecturer')
		            ->where('lectureremail',$email)
		            ->update(['lockacc' => 1]);   
				}
				elseif($type ==2)
				{
		        	$user = DB::table('hod')
		            ->where('hodemail',$email)
		            ->update(['lockacc' => 1]);  
				}
				elseif($type == 3)
				{
		        	$user = DB::table('students')
		            ->where('studentemail',$email)
		            ->update(['lockacc' => 1]);  
				}
				return 1;
			}
			else
			{
				return 2;
			}
		}
		else
		{
			return 0;
		}
	}

	//check if account is locked
	public function checkLock($type,$email)
	{
		if($type == 1)
		{
        	$user =  DB::table('lecturer')
            ->where('lectureremail',$email)->first();
		}
		elseif($type ==2)
		{
        	$user =  DB::table('hod')
            ->where('hodemail',$email)->first();
		}
		elseif($type == 3)
		{
        	$user =  DB::table('students')
            ->where('studentemail',$email)->first();
		}
		return $user->lockacc;
	}


	
}