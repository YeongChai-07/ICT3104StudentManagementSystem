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
    return view('student.login');
});


//Student URL
Route::group(['middleware' => ['student']], function () {  

Route::get('student/login', 'StudentController@displayLogin');
Route::post('student/login', 'StudentController@login');
Route::get('student/logout', 'StudentController@logout');

	Route::group(['middleware' =>['studentauth']], function(){
		Route::get('student/index', 'StudentController@index');
		Route::get('student/recommendation', 'StudentController@recommendation');
        Route::get('student/grade', 'StudentController@viewGrade');// added
        
        Route::get('student/module','StudentController@showModule'); // added 
        Route::get('student/showdetails','StudentController@showDetailsFunction'); // added 


        Route::get('student/editdetails', 'StudentController@displayDetails');
        Route::post('student/editdetails', 'StudentController@updateDetails');
        Route::get('student/change', 'StudentController@displayPassword');
        Route::post('student/change', 'StudentController@updatePassword');
    });
});

//Admin URL
Route::group(['middleware' => ['web']], function () {

Route::get('user/login', 'UserController@displayLogin');
Route::post('user/login', 'UserController@login');
Route::get('user/logout', 'UserController@logout');

	Route::group(['middleware' =>['auth']], function(){

		Route::get('user/index', 'UserController@index');
		Route::get('/user/addstudent', 'UserController@showAddStudent');
        Route::post('/user/addstudent', 'UserController@addStudent');
        Route::get('/user/{id}/editstudent', 'UserController@editStudent');
        Route::post('/user/{id}/editstudent', 'UserController@updateStudent');
        Route::get('/user/{id}/deletestudent', 'UserController@deleteStudent');

		Route::get('user/hod', 'UserController@showHod');
		Route::get('/user/addhod', 'UserController@showAddHod');
        Route::post('/user/addhod', 'UserController@addHod');
        Route::get('/user/{id}/edithod', 'UserController@editHod');
        Route::post('/user/{id}/edithod', 'UserController@updateHod');
        Route::get('/user/{id}/deletehod', 'UserController@deleteHod');

		Route::get('user/lecturer', 'UserController@showLecturer');
		Route::get('/user/addlecturer', 'UserController@showAddLecturer');
        Route::post('/user/addlecturer', 'UserController@addLecturer');
        Route::get('/user/{id}/editlecturer', 'UserController@editLecturer');
        Route::post('/user/{id}/editlecturer', 'UserController@updateLecturer');
        Route::get('/user/{id}/deletelecturer', 'UserController@deleteLecturer');

        Route::get('user/module', 'UserController@showModule');
        Route::get('user/addmodule', 'UserController@showAddModule');
        Route::post('user/addmodule', 'UserController@addModule');
        Route::get('/user/{id}/editmodule', 'UserController@editModule');
        Route::post('/user/{id}/editmodule', 'UserController@updateModule');
        Route::get('/user/{id}/deletemodule', 'UserController@deleteModule');
        Route::get('/user/{id}/enrollstudent', 'UserController@displayStudent');
        Route::post('/user/{id}/enrollstudent', 'UserController@enrollStudent');
		
		//Routes for backing up the application files and DB
		Route::get('user/backupsystem', 'UserController@backupSystem');
		Route::get('user/processsystembackup', 'UserController@processSystemBackup');

    });
});

//LecturerURL
Route::group(['middleware' => ['lecturer']], function () {

Route::get('lecturer/login', 'LecturerController@displayLogin');
Route::post('lecturer/login', 'LecturerController@login');
Route::get('lecturer/logout', 'LecturerController@logout');

	Route::group(['middleware' =>['lecturerauth']], function(){
		
		Route::get('lecturer/index', 'LecturerController@index');
        Route::get('lecturer/{id}/managegrade', ['as' => 'manage_grade', 'uses' => 'LecturerController@showManageGrade']);

        Route::get('lecturer/editdetails', 'LecturerController@displayDetails');
        Route::post('lecturer/editdetails', 'LecturerController@updateDetails');

        
        Route::get('lecturer/{moduleid}/{id}/addgrade', 'LecturerController@showAddGrade');
        Route::post('lecturer/{moduleid}/{id}/addgrade', 'LecturerController@addGrade');
    });
});

//HOD URL
Route::group(['middleware' => ['hod']], function () {
	
Route::get('hod/login', 'HodController@displayLogin');
Route::post('hod/login', 'HodController@login');
Route::get('hod/logout', 'HodController@logout');

	Route::group(['middleware' =>['hodauth']], function(){
		
		Route::get('hod/index', 'HodController@index');
		Route::get('hod/{id}/managegrade', ['as' => 'manage_grade_hod', 'uses' => 'HodController@showManageGrade']);
		
		Route::get('hod/{moduleid}/{id}/addgrade', 'HodController@showAddGrade');
        Route::post('hod/{moduleid}/{id}/addgrade', 'HodController@addGrade');
		
		
		
       // Route::get('hod/recommendation', 'HodController@recommendation');
    });
});