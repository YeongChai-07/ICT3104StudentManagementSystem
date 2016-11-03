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
use App\Recommendation;
use App\Grade;
use Auth;
use Hash;
use DB;
use Session;
use DateTime;
use ZipArchive;
use File;
use Mail;
//Importing the Artisan Facade
use Illuminate\Support\Facades\Artisan;

class AdminController extends Controller {


	/**
    public function index()
    {
        $adminId = auth()->guard('admin')->user()->id;

        $students = DB::table('students')->paginate(5);
        return view('admin.index')->with([
            'students' => $students
            ]);
    }

*/

	/** --- LECTURER CONTROL ---*/
    public function showLecturer()
    {
        $adminId = auth()->guard('admin')->user()->id;

        $lecturers = DB::table('lecturer')->paginate(5);
        return view('admin.lecturer')->with([
            'lecturers' => $lecturers
            ]);
    }


    public function showAddLecturer(){
        return view('admin.addlecturer');
    }

    public function addLecturer(Request $request)
    {
        $input = $request->all();
        $emailcheck = Lecturer::where('lectureremail', $input['email'])
                    ->first();

        $id = $emailcheck['lecturerid'];
        if(!$id)
        {
            $today = (new DateTime())->format('Y-m-d');
            $expirydate = date('Y-m-d', strtotime($today. ' + 90 days'));
            // $password = substr(md5(uniqid(mt_rand(), true)) , 0, 6);
            // $password = 'demo123';

            $password = $this->generatePassword(8);
            $hash = Hash::make($password);

            $lecturerid = DB::table('lecturer')->insertGetId([
            'lecturername' => $input['name'],
            'metric' => $input['metric'], 
            'lectureremail' =>  $input['email'],
			'contact' =>  $input['contact'],
            'address' => $input['address'],
            'password' => $hash,
            'expirydate' => $expirydate
            ]);


            $lecturer = DB::table('lecturer')->where('lecturerid',$lecturerid)->first();
            //set gmail email and password in .env to work
            $data = array( 'name' => $lecturer->lecturername,'email' =>  $lecturer->lectureremail, 'password' => $password);
            Mail::send('email.register', $data,  function ($message) use ($data) {
            //Uncomment to work;
            $message->to(trim($data['email']))->subject('Registration to SMS');
            });    
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
        
            
            
            return view('admin.editlecturer',['lecturer' => $lecturer]);
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
                'email' => $emailvalidation
        ]);

   
        //Validate inputs
        if ($validator -> fails())
        {
            Session::set('error_message', "Email already exists");
            return redirect()->back();
        }     
        
       
       DB::table('lecturer')
                ->where('lecturerid', $id)
                ->update(['lecturername' => $input['name'],'metric' => $input['metric'],'lectureremail' => $input['email'], 'contact' =>  $input['contact'],'address' => $input['address']]);          
          
                Session::set('success_message', "Profile updated sucessfully."); 
               return redirect()->back();
          
    }

    public function deleteLecturer($id){
        
           DB::table('lecturer')->where('lecturerid', $id)->delete();
                                       
        Session::set('success_message', "Lecturer deleted Successfully");  
        return redirect()->back();
    }


	
	/** --- HOD CONTROL ---*/
	public function showHod()
    {
        $adminId = auth()->guard('admin')->user()->id;

        $hods = DB::table('hod')->paginate(5);
        return view('admin.hod')->with([
            'hods' => $hods
            ]);
    }
    public function showAddHod(){
        return view('admin.addhod');
    }

    public function addHod(Request $request)
    {
        $input = $request->all();
        $emailcheck = Hod::where('hodemail', $input['email'])
                    ->first();

        $id = $emailcheck['hodid'];
        if(!$id)
        {
            $today = (new DateTime())->format('Y-m-d');
            $expirydate = date('Y-m-d', strtotime($today. ' + 90 days'));
            // $password = substr(md5(uniqid(mt_rand(), true)) , 0, 6);
            // $password = 'demo123';

            $password = $this->generatePassword(8);
            $hash = Hash::make($password);

            $hodid = DB::table('hod')->insertGetId([
            'hodname' => $input['name'],
            'metric' => $input['metric'],
            'hodemail' =>  $input['email'],
			'contact' =>  $input['contact'],
            'address' => $input['address'],
            'password' => $hash,
            'expirydate' => $expirydate
            ]);

        $hod = DB::table('hod')->where('hodid',$hodid)->first();
        //set gmail email and password in .env to work
        $data = array( 'name' => $hod->hodname,'email' =>  $hod->hodemail, 'password' => $password);
        Mail::send('email.register', $data,  function ($message) use ($data) {
        //Uncomment to work;
        $message->to(trim($data['email']))->subject('Registration to SMS');
        });
                         
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
        
            
            
            return view('admin.edithod',['hod' => $hod]);
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
        ]);

   
        //Validate inputs
        if ($validator -> fails())
        {
            Session::set('error_message', "Email already exists");
            return redirect()->back();
        }     
        
       
       DB::table('hod')
                ->where('hodid', $id)
                ->update(['hodname' => $input['name'],'metric' => $input['metric'],'hodemail' => $input['email'], 'contact' =>  $input['contact'],'address' => $input['address']]);          
          
                Session::set('success_message', "Profile updated sucessfully."); 
               return redirect()->back();
          
    }

    public function deleteHod($id){
        
           DB::table('hod')->where('hodid', $id)->delete();
                                       
        Session::set('success_message', "Hod deleted Successfully");  
        return redirect()->back();
    }

	
	/** --- ADMIN CONTROL --- */
	
	public function showAdmin()
    {
        $adminId = auth()->guard('admin')->user()->id;

        $admins = DB::table('admin')->paginate(5);
        return view('admin.admin')->with([
            'admins' => $admins
            ]);
    }

    public function showAddAdmin(){
        return view('admin.addadmin');
    }

    public function addAdmin(Request $request)
    {
        $input = $request->all();
        $emailcheck = Admin::where('adminemail', $input['email'])
                    ->first();

        $id = $emailcheck['adminid'];
        if(!$id)
        {
            $password = substr(md5(uniqid(mt_rand(), true)) , 0, 6);
            $password = 'demo123';
            $hash = Hash::make($password);

            $adminid = DB::table('admin')->insertGetId([
            'adminname' => $input['name'], 
            'adminemail' =>  $input['email'],
			'contact' =>  $input['contact'],
            'password' => $hash
            ]);

 
        }
        else
        {
            Session::set('error_message', "Admin Exists");
            return redirect()->back();             
        }


            Session::set('success_message', "Admin Created Successfully");
            return redirect()->back(); 
    }

    public function editAdmin($id)
    {
    
            $admin = Admin::where('adminid',$id)                              
                                ->first();  
        
            
            
            return view('admin.editadmin',['admin' => $admin]);
    }

    /**
     * Update Student Details based on inputs
     *
     * @param  $id
     * @return View User editteacher 
     */
    public function updateAdmin($id, Request $request) 
    {
          
        $admin = Admin::findorFail($id);
                  
        
       $input= $request->all();
       //check if duplicate email
       if(trim($admin->adminemail) == trim($input['email']))
       {
           $emailvalidation = 'required|email';
       }
       else
       {
           $emailvalidation = 'required|email|unique:admin,adminemail';
       }

        $validator= validator($request->all(), [
                'name' => 'required',
                'email' => $emailvalidation,
        ]);

   
        //Validate inputs
        if ($validator -> fails())
        {
            Session::set('error_message', "Email already exists");
            return redirect()->back();
        }     
        
       
       DB::table('admin')
                ->where('adminid', $id)
                ->update(['adminname' => $input['name'],'adminemail' => $input['email'], 'contact' =>  $input['contact']]);          
          
                Session::set('success_message', "Admin Profile updated sucessfully."); 
               return redirect()->back();
          
    }

    public function deleteAdmin($id){
        
           DB::table('admin')->where('adminid', $id)->delete();
                                       
        Session::set('success_message', "Admin deleted Successfully");  
        return redirect()->back();
    } 
	
	
	/** --- MODULE CONTROL -- */

    public function showModule(){


        $modules = DB::table('module')
            ->join('lecturer','lecturer.lecturerid', '=', 'module.lecturerid')
            ->join('hod','hod.hodid', '=','module.hodid')
            ->select('module.*','hod.*','lecturer.*')->paginate(5);


        return view('admin.module')->with([
            'modules' => $modules
            ]);


    }


    public function showAddModule(){

            $lecturers = Lecturer::all();
            $hods = Hod::all();

            return view('admin.addmodule')->with([
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
            'credit' => $input['credit'],
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

            return view('admin.editmodule')->with([
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
                ->update(['modulename' => $input['name'],'credit' => $input['credit'],'description' => $input['description'],'lecturerid' => $input['lecturer'],'hodid' => $input['hod'],'editdate' => $editdate, 'freezedate' => $freezedate]);          
          
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

	
	/** --- ENROL CONTROL --- */
    public function displayStudent($id)
    {

        $students = DB::select('select * from students WHERE NOT EXISTS (SELECT * FROM enroll WHERE students.studentid = enroll.studentid and enroll.moduleid = ?)', [$id]);

        return view('admin.enrollstudent')->with([
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


         $module = Module::findorFail($id);

         for($i=0;$i<count($enroll);$i++)
         {
            $enrollid = DB::table('enroll')->insertGetId([
            'moduleid' => $id, 
            'studentid' =>  $enroll[$i]
            ]);

            $gradeid = DB::table('grades')->insertGetId([
            'moduleid' => $module->id,
            'studentid' => $enroll[$i],
            'lecturerid'=> $module->lecturerid,
            'hodid' => $module->hodid,
            'publish' => 0



            ]);
         }
         
        Session::set('success_message', "Student enrolled Successfully");  
        return redirect()->back();
    }
	
	
	/** --- ROUTINE OPERATIONS --- */
	public function backupSystem(Request $request)
	{
        //Get zip file name
        $dir    = 'C:\xampp\htdocs\ict3104\storage\app\http---localhost';
        $files1 = scandir($dir,1);
        $url = $request->session()->get('url');
        $url2 = $request->session()->get('url2');
        if(strcmp($files1[0],"..")!=0)
        {
        //Delete the Zip
        unlink('C:/xampp/htdocs/ict3104/storage/app/http---localhost/'. $files1[0]);
        }
        if(!isset($url) || !isset($url2))
        {
            
        }
        else
        {
            File::deleteDirectory($url);
            File::delete($url2 . '\ict3104.sql');
        }

		return view('admin.backupsystem');
	}
	
	public function processSystemBackup(Request $request)
	{
        $input = $request->all();
        $option = $input['option'];
        $duration = $input['duration'];

        //Download zip.dll AND PLACE IN xampp/php/ext
        //Use it at the top
        //Add in parameters for users to choose where to save it to
        //Backup
        $artisanCall_Result = Artisan::call('backup:run', []);
        
        
        //Get zip file name
        $dir    = 'C:\xampp\htdocs\ict3104\storage\app\http---localhost';
        $files1 = scandir($dir,1);

        //Extract default zip file in storage
        // DB backup
        if(strcmp($option,"Database") == 0)
        {
            $zip = new ZipArchive;
            if ($zip->open('C:/xampp/htdocs/ict3104/storage/app/http---localhost/'. $files1[0]) === TRUE) 
            {
                $zip->extractTo($input['file']);
                $zip->close();

                $dirname = $input['file'].'\Database';
                if (!is_dir($dirname))
                {
                     mkdir($dirname, 0755, true);
                }

                //Zip up to the intended location
                $zipper = new \Chumper\Zipper\Zipper;
                $date = date("mdy") ."DB.zip";
                $zipper->make($dirname . '\\'. $date);
                $zipper->zip($dirname . '\\'. $date)->add($input['file'] . '\ict3104.sql');

                if(strcmp($duration,"Monthly") == 0)
                {

                //Zip up to the intended location
                $zipper2 = new \Chumper\Zipper\Zipper;
                $date2 = date("my") ."MonthlyDB.zip";
                $zipper2->make($input['file'] . '\\'. $date2);
                $zipper2->zip($input['file'] . '\\'. $date2)->add($dirname);  

                }
            } else {
                Session::set('error_message', "Backup Failed");
                return redirect()->back();
            }
        }
        elseif(strcmp($option,"Web Application") == 0)
        {
            //Extract default zip file in storage
            $zip = new ZipArchive;
            if ($zip->open('C:/xampp/htdocs/ict3104/storage/app/http---localhost/'. $files1[0]) === TRUE) {
                $zip->extractTo($input['file']);
                $zip->close();

                $dirname = $input['file'].'\Web';
                if (!is_dir($dirname))
                {
                     mkdir($dirname, 0755, true);
                }

                //Zip up to the intended location
                $zipper = new \Chumper\Zipper\Zipper;
                $date = date("mdy") ."Web.zip";
                $zipper->make($dirname . '\\'. $date);
                $zipper->zip($dirname . '\\'. $date)->add($input['file'] . '\xampp\htdocs\ict3104');

                if(strcmp($duration,"Monthly") == 0)
                {

                    //Zip up to the intended location
                    $zipper2 = new \Chumper\Zipper\Zipper;
                    $date2 = date("my") ."MonthlyWeb.zip";
                    $zipper2->make($input['file'] . '\\'. $date2);
                    $zipper2->zip($input['file'] . '\\'. $date2)->add($dirname);  

                }

            } else {
                Session::set('error_message', "Backup Failed");
                return redirect()->back();
            } 
        }

        // //Extract default zip file in storage
        // $zip = new ZipArchive;
        // if ($zip->open('C:/xampp/htdocs/ict3104/storage/app/http---localhost/'. $files1[0]) === TRUE) {
        //     $zip->extractTo($input['file']);
        //     $zip->close();

        //     //Copy db to web app root folder
        //     $dst =  $input['file'] . '\xampp\htdocs\ict3104\ict3104.sql';
        //     $src = $input['file'] . '\ict3104.sql';
        //     //@mkdir($dst); 
        //     $success = File::copy($src, $dst);

        //     //Zip up to the intended location
        //     $zipper = new \Chumper\Zipper\Zipper;

        //     $zipper->make($input['file'] . '\backup.zip');
        //     $zipper->zip($input['file'] . '\backup.zip')->add($input['file'] . '\xampp\htdocs\ict3104');

            

        // } else {
        //     Session::set('error_message', "Backup Failed");
        //     return redirect()->back();
        // }
  
        $url = $input['file'] . '\xampp';
        $url2 = $input['file'];

        session(['url' => $url,'url2' => $url2]);
        Session::set('success_message', "Backup Successful");
        return redirect()->back();
	}


    

	/** --- UPDATE PERSONAL INFO  ---*/
    public function displayDetails()
    {

            $userid = auth()->guard('admin')->user()->id; 

              $user = User::where('id',$userid)                              
                                ->first();  

            return view('admin.editdetails',['user' => $user]);
    
}

	/** --- RECOMMENDATION --- */
    public function showRecommendation($moduleid)
    {

        $module = Module::findorFail($moduleid);

        // $recommendations = DB::table('recommendation')
        //     ->join('students','students.studentid', '=', 'recommendation.studentid')
        //     ->select('recommendation.*','students.*')
        //     ->where('recommendation.moduleid', $moduleid)
        //     ->where('recommendation.status', 1)->paginate(5);  

        $recommendations = DB::table('recommendation')
            ->leftjoin('students','students.studentid', '=', 'recommendation.studentid')
            ->leftjoin('grades','grades.studentid', '=', 'recommendation.studentid')
            ->select('recommendation.*','students.studentname','grades.marks')
            ->where('recommendation.moduleid', $moduleid)
            ->where('grades.moduleid',$moduleid)
            ->where('recommendation.status', 1)->paginate(5);  

            return view('admin.moderate')->with([
                'module' => $module,
                'recommendations' => $recommendations
                ]); 
    }

	
	/** --- MODERATE GRADES --- */
    public function moderateGrade($moduleid,$recommendationid)
    {

        $recommendation = Recommendation::findorFail($recommendationid);
        $grade = Grade::where('studentid', $recommendation->studentid)
                    ->where('moduleid', $recommendation->moduleid)
                    ->first();
        
        $finalgrade = decrypt($grade->marks) + $recommendation->moderation;

        $convertedGrade = $this->calculateIndivGrade($finalgrade);

        DB::table('grades')
                ->where('id', $grade->id)
                ->update(['marks' => encrypt($finalgrade),'grade'=> $convertedGrade]);

        DB::table('recommendation')
                ->where('id', $recommendationid)
                ->update(['status' => 3]);   

        Session::set('success_message', "Student Grade moderated.");
        return redirect()->back();
    }

    public function calculateIndivGrade($marks)
    {
        //TODO: this function converts the marks into grades (alphabets) and store into grades table
        if ($marks >= 80)
        {
            $gradeScore = 'A';
        }
        elseif ($marks >= 75  && $marks < 80)
        {
            $gradeScore = 'B+';
        }
        elseif ($marks>= 70  && $marks < 75)
        {
            $gradeScore = 'B';
        }
        elseif ($marks>= 60  && $marks < 70)
        {
            $gradeScore = 'C';
        }
        elseif ($marks>= 50  && $marks < 60)
        {
            $gradeScore = 'D';
        }
        else
        {
            $gradeScore = 'Fail';
        }

        return $gradeScore;
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

    public function resetPassword($type,$id)
    {
        $password = $this->generatePassword(8);

        $hash = Hash::make($password);
        $today = (new DateTime())->format('Y-m-d');
        $expirydate = date('Y-m-d', strtotime($today. ' + 90 days'));

        if($type == 1)
        {
            $user =   DB::table('lecturer')->where('lecturerid',$id)->first(); 
            //set gmail email and password in .env to work
            $data = array( 'email' =>  $user->lectureremail, 'password' => $password);
            Mail::send('email.reset', $data,  function ($message) use ($data) {
            //Uncomment to work;
            $message->to(trim($data['email']))->subject('Reset Password for SMS');
               });
            DB::table('lecturer')
                ->where('lecturerid', $id)
                ->update([
             'password' => $hash,
             'expirydate' => $expirydate,
             'lockacc' => 0      
             ]); 

        }
        
        else
        {
            $user =   DB::table('hod')->where('hodid',$id)->first();
            //set gmail email and password in .env to work
            $data = array( 'email' =>  $user->hodemail, 'password' => $password);
            Mail::send('email.reset', $data,  function ($message) use ($data) {
            //Uncomment to work;
            $message->to(trim($data['email']))->subject('Reset Password for SMS');
               });
            DB::table('hod')
                ->where('hodid', $id)
                ->update([
             'password' => $hash,
             'expirydate' => $expirydate,
             'lockacc' => 0      
             ]); 
        }

        Session::set('success_message', "Password Reset");
        return redirect()->back();


        return $id;  
    }

    public function sendReminder()
    {
        $today = (new DateTime())->format('Y-m-d');
        $lowDate = '';
        $highDate = '';

        $students = DB::table('students')->get();
        $hods = DB::table('hod')->get();
        $lecturers = DB::table('lecturer')->get();

        foreach($students as $student)
        {
            $lowDate  = date('Y-m-d', strtotime($student->expirydate. ' - 10 days'));
            $highDate = date('Y-m-d', strtotime($student->expirydate. ' + 10 days'));
            if($today >= $lowDate && $today <= $highDate)
            {

                //set gmail email and password in .env to work
                $data = array( 'email' =>  $student->studentemail);
                Mail::send('email.remind', $data,  function ($message) use ($data) {
                //Uncomment to work;
                $message->to(trim($data['email']))->subject('Update Password');
                });

            }
        }

        foreach($lecturers as $lecturer)
        {
            $lowDate  = date('Y-m-d', strtotime($lecturer->expirydate. ' - 10 days'));
            $highDate = date('Y-m-d', strtotime($lecturer->expirydate. ' + 10 days'));
            if($today >= $lowDate && $today <= $highDate)
            {
                
                //set gmail email and password in .env to work
                $data = array( 'email' =>  $lecturer->lectureremail);
                Mail::send('email.remind', $data,  function ($message) use ($data) {
                //Uncomment to work;
                $message->to(trim($data['email']))->subject('Update Password');
                });  
                  
            }
        }

        foreach($hods as $hod)
        {
            $lowDate  = date('Y-m-d', strtotime($hod->expirydate. ' - 10 days'));
            $highDate = date('Y-m-d', strtotime($hod->expirydate. ' + 10 days'));
            if($today >= $lowDate && $today <= $highDate)
            {
                
                //set gmail email and password in .env to work
                $data = array( 'email' =>  $hod->hodemail);
                Mail::send('email.remind', $data,  function ($message) use ($data) {
                //Uncomment to work;
                $message->to(trim($data['email']))->subject('Update Password');
                });  
            }
        }
        return 'SENT';
    } 
}