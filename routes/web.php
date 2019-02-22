<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('starter');
});

Route::resource('/professor', 'ProfessorController');
Route::resource('/professorDetail', 'ProfessorDetailController');
Route::resource('/student', 'StudentController');
Route::resource('/courseYear', 'CourseYearController');
Route::resource('/courseGroup', 'CourseGroupController');
Route::resource('/courseSection', 'CourseSectionController');
Route::resource('/subject', 'SubjectController');
Route::resource('/exam', 'ExamController');
Route::resource('/studentGroupDetail', 'StudentGroupDetailController');
Route::get('/profile', 'ProfileController@profile');
Route::get('email', 'ProfessorController@sendEmail');
Route::post('/getStudents', 'CourseYearController@getStudents');
Route::post('/getStudentsByGroup', 'CourseGroupController@getStudents');
Route::get('/generate-pdf', 'StudentController@studentsPdf');
Route::get('/download', 'StudentController@getDownload');
Route::get('/areaChart', 'StudentController@areaChart');
Route::get('/getStudents/{ids}', 'StudentGroupDetailController@getStudents');

Auth::routes();

Route::get('/admin-home', 'HomeController@index')->name('home');

Route::get('/home', function () {
    return view('starter');
});