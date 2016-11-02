<?php
namespace App\Http\Controllers;

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

        //Validate inputs
        if ($validator -> fails())
        {
            Session::set('error_message', "Invalid credentials");
            return redirect('common/login');
        }


		

		//check if user exists in any of the user tables
		if( auth()->guard('lecturer')->attempt(['lectureremail' => $data['email'], 'password' => $data['password']]))
        {	

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
        		elseif($checkExpiry == 2)
        		{
					Session::set('error_message', "Password has expired. Please update your password");
        		}
        	}

			session(['role' => 'lecturer']);	
			return redirect('grade/index');
        }
		else if (auth()->guard('hod')->attempt(['hodemail' => $data['email'], 'password' => $data['password']])){

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
        		elseif($checkExpiry == 2)
        		{
					Session::set('error_message', "Password has expired. Please update your password");
        		}
        	}

			session(['role' => 'hod']);		
			return redirect('grade/index');
		}
		else if (auth()->guard('student')->attempt(['studentemail' => $data['email'], 'password' => $data['password']])){
	       
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
        	
			session(['role' => 'student']);
			return redirect('student/index');
		}
		else if (auth()->guard('admin')->attempt(['adminemail' => $data['email'], 'password' => $data['password']])){
			session(['role' => 'admin']);
			return redirect('studentinfo/viewAllStudents');
		}
        else
        {
            Session::set('error_message', "Invalid Login");
            return redirect('common/login');
          
        }
	}
	
  
    public function displayPassword()
    {


       return view('common.change');
    }

    public function updatePassword(Request $request)
    {   
		$role = $request->session()->get('role');
		$input= $request->all();
		
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