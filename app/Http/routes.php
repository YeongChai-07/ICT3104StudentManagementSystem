<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('common.login');
});


//Student URL
Route::group(['middleware' => ['student']], function () {  
Route::get('common/login', 'CommonController@displayLogin');
Route::post('common/login', 'CommonController@login');
Route::get('common/logout', 'CommonController@logout');

	Route::group(['middleware' =>['studentauth']], function(){
		Route::get('student/index', 'StudentController@showModule');
        // Route::get('student/grade', 'StudentController@viewGrade');// added
        
        Route::get('student/module','StudentController@showModule'); // added 


		// personal info update
        Route::get('common/change', 'CommonController@displayPassword');
        Route::post('common/change', 'CommonController@updatePassword');
        Route::get('common/editdetails', 'CommonController@displayDetails');
        Route::post('common/editdetails', 'CommonController@updateDetails');
        Route::get('common/showdetails','CommonController@showDetailsFunction'); // added 

    });
});

//Admin URL
Route::group(['middleware' => ['admin']], function () {
Route::get('common/login', 'CommonController@displayLogin');
Route::post('common/login', 'CommonController@login');
Route::get('common/logout', 'CommonController@logout');


	Route::group(['middleware' =>['adminauth']], function(){

		Route::get('admin/hod', 'AdminController@showHod');
		Route::get('/admin/addhod', 'AdminController@showAddHod');
        Route::post('/admin/addhod', 'AdminController@addHod');
        Route::get('/admin/{id}/edithod', 'AdminController@editHod');
        Route::post('/admin/{id}/edithod', 'AdminController@updateHod');
        Route::get('/admin/{id}/deletehod', 'AdminController@deleteHod');

		Route::get('admin/lecturer', 'AdminController@showLecturer');
		Route::get('/admin/addlecturer', 'AdminController@showAddLecturer');
        Route::post('/admin/addlecturer', 'AdminController@addLecturer');
        Route::get('/admin/{id}/editlecturer', 'AdminController@editLecturer');
        Route::post('/admin/{id}/editlecturer', 'AdminController@updateLecturer');
        Route::get('/admin/{id}/deletelecturer', 'AdminController@deleteLecturer');
		
		Route::get('admin/admin', 'AdminController@showAdmin');
		Route::get('/admin/addadmin', 'AdminController@showAddAdmin');
        Route::post('/admin/addadmin', 'AdminController@addAdmin');
        Route::get('/admin/{id}/editadmin', 'AdminController@editAdmin');
        Route::post('/admin/{id}/editadmin', 'AdminController@updateAdmin');
        Route::get('/admin/{id}/deleteadmin', 'AdminController@deleteAdmin');

        Route::get('admin/module', 'AdminController@showModule');
        Route::get('admin/addmodule', 'AdminController@showAddModule');
        Route::post('admin/addmodule', 'AdminController@addModule');
        Route::get('/admin/{id}/editmodule', 'AdminController@editModule');
        Route::post('/admin/{id}/editmodule', 'AdminController@updateModule');
        Route::get('/admin/{id}/deletemodule', 'AdminController@deleteModule');
		
		
		
        Route::get('/admin/{id}/enrollstudent', 'AdminController@displayStudent');
        Route::post('/admin/{id}/enrollstudent', 'AdminController@enrollStudent');
		Route::get('/admin/{moduleid}/moderate', 'AdminController@showRecommendation');
		Route::get('/admin/{moduleid}/{recommendationid}/moderateGrade', 'AdminController@moderateGrade');
		//Routes for backing up the application files and DB
		Route::get('admin/backupsystem', 'AdminController@backupSystem');
		Route::post('admin/backupsystem', 'AdminController@processSystemBackup');
		
		// personal info update
        Route::get('common/change', 'CommonController@displayPassword');
        Route::post('common/change', 'CommonController@updatePassword');
        Route::get('common/editdetails', 'CommonController@displayDetails');
        Route::post('common/editdetails', 'CommonController@updateDetails');
        Route::get('common/showdetails','CommonController@showDetailsFunction'); // added 
		
		//crud student info
		Route::get('studentinfo/viewAllStudents', ['as' => 'view_students', 'uses' => 'StudentInfoController@viewAllStudents']);
		Route::get('studentinfo/{studentID}/editStudentInfoView', 'StudentInfoController@editStudentInfoView');
		Route::post('studentinfo/{studentID}/editStudentInfoView', 'StudentInfoController@updateStudentInfo');		
		Route::get('studentinfo/{studentID}/viewAllStudents', 'StudentInfoController@archiveStudent');	
		Route::get('studentinfo/addStudentView', 'StudentInfoController@showAddStudent');
		Route::post('studentinfo/addStudentView', 'StudentInfoController@addStudent');
		
		//Grad student info
		Route::get('graduatedStudents/viewAllGradStudents', 'GraduatedStudentsController@viewAllGradStudents');
		Route::get('graduatedStudents/viewGradStudentsMetaInfo', 'GraduatedStudentsController@viewMetaInfo');
		
		

	
		
    });
});

//LecturerURL
Route::group(['middleware' => ['lecturer']], function () {
Route::get('common/login', 'CommonController@displayLogin');
Route::post('common/login', 'CommonController@login');
Route::get('common/logout', 'CommonController@logout');


	Route::group(['middleware' =>['lecturerauth']], function(){
		
		Route::get('grade/index', 'GradeController@index');
		Route::get('grade/{id}/managegrade', ['as' => 'manage_grade', 'uses' => 'GradeController@showManageGrade']);

		Route::get('grade/{moduleid}/{id}/addgrade', 'GradeController@showAddGrade');
  		Route::post('grade/{moduleid}/{id}/addgrade', 'GradeController@addGrade');	

		Route::get('grade/{moduleid}/{id}/editgrade', 'GradeController@showEditGrade');
  		Route::post('grade/{moduleid}/{id}/editgrade', 'GradeController@editGrade');

  		Route::get('grade/{moduleid}/approval', 'GradeController@showRecommendation');

  		Route::get('grade/{moduleid}/{recommendationid}/approveRec', 'GradeController@approveRec');
  		Route::get('grade/{moduleid}/{recommendationid}/rejectRec', 'GradeController@rejectRec');  		
		//Route::get('lecturer/index', 'LecturerController@index');
        //Route::get('lecturer/{id}/managegrade', ['as' => 'manage_grade', 'uses' => 'LecturerController@showManageGrade']);
		//Route::post('lecturer/{moduleid}/{id}/addgrade', 'LecturerController@addGrade');
		//Route::get('lecturer/{moduleid}/{id}/addgrade', 'LecturerController@showAddGrade');

		
		// personal info update		
        Route::get('common/change', 'CommonController@displayPassword');
        Route::post('common/change', 'CommonController@updatePassword');
        Route::get('common/editdetails', 'CommonController@displayDetails');
        Route::post('common/editdetails', 'CommonController@updateDetails');
        Route::get('common/showdetails','CommonController@showDetailsFunction'); // added 
		
		//jerlyn - edit student info //
		Route::get('studentinfo/viewAllStudents', ['as' => 'view_students', 'uses' => 'StudentInfoController@viewAllStudents']);
		Route::get('studentinfo/{studentID}/editStudentInfoView', 'StudentInfoController@editStudentInfoView');
		Route::post('studentinfo/{studentID}/editStudentInfoView', 'StudentInfoController@updateStudentInfo');
		Route::get('studentinfo/{studentID}/viewAllStudents', 'StudentInfoController@archiveStudent');
		Route::get('studentinfo/addStudentView', 'StudentInfoController@showAddStudent');
		Route::post('studentinfo/addStudentView', 'StudentInfoController@addStudent');

    });
});

//HOD URL
Route::group(['middleware' => ['hod']], function () {
	
Route::get('common/login', 'CommonController@displayLogin');
Route::post('common/login', 'CommonController@login');
Route::get('common/logout', 'CommonController@logout');


	Route::group(['middleware' =>['hodauth']], function(){
		
		Route::get('grade/index', 'GradeController@index');
		Route::get('grade/{id}/managegrade', ['as' => 'manage_grade', 'uses' => 'GradeController@showManageGrade']);

		Route::get('grade/{moduleid}/{id}/addgrade', 'GradeController@showAddGrade');
  		Route::post('grade/{moduleid}/{id}/addgrade', 'GradeController@addGrade');

		Route::get('grade/{moduleid}/{id}/editgrade', 'GradeController@showEditGrade');
  		Route::post('grade/{moduleid}/{id}/editgrade', 'GradeController@editGrade');

  		Route::get('grade/{moduleid}/approval', 'GradeController@showRecommendation');

  		Route::get('grade/{moduleid}/{recommendationid}/approveRec', 'GradeController@approveRec');
  		Route::get('grade/{moduleid}/{recommendationid}/rejectRec', 'GradeController@rejectRec');
		// Route::get('hod/index', 'HodController@index');
		// Route::get('hod/{id}/managegrade', ['as' => 'manage_grade_hod', 'uses' => 'HodController@showManageGrade']);

		// personal info update
        Route::get('common/change', 'CommonController@displayPassword');
        Route::post('common/change', 'CommonController@updatePassword');
        Route::get('common/editdetails', 'CommonController@displayDetails');
        Route::post('common/editdetails', 'CommonController@updateDetails');
        Route::get('common/showdetails','CommonController@showDetailsFunction'); // added 
		

		// Route::get('hod/{moduleid}/{id}/addgrade', 'HodController@showAddGrade');
  		// Route::post('hod/{moduleid}/{id}/addgrade', 'HodController@addGrade');

        
		
		
		

    });
});