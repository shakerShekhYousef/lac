<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

// User authorization Api Routes
Route::group([
    'prefix' => 'auth',
], function () {
    Route::post('login', 'Api\auth\UserController@login');
    Route::post('create-user', 'Api\auth\UserController@store');
    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', 'Api\auth\UserController@logout');
        Route::get('user', 'Api\auth\UserController@user');
    });
});
// user api
Route::group(['middleware' => 'auth:api'], function () {
    // upload file
    Route::post('file/upload', 'Api\UserController@UploadFile');
    Route::get('users/show-request/{user}', 'Api\UserController@showRequest')->middleware('isSuper');
    Route::put('users/password/update/{user}', 'Api\UserController@updatePassword')->middleware('isSuper');
// delete edit request
    Route::delete('users/editRequest/{id}/delete', 'Api\UserController@deleteRequest')->middleware('isSuper');
// delete password request
    Route::delete('users/passwordRequest/{id}/delete', 'Api\UserController@deletePasswordRequest')->middleware('isSuper');
    Route::resource('questions', 'Api\FaqController');
//get all auth user's groups
    Route::get('auth/user/groups','Api\UserController@getUserGroups');
//Chat Requests
    Route::post('chatRequests','Api\ChatRequestController@store');
    Route::get('chatRequests/show','Api\ChatRequestController@showRequest');
    // users api routes
    Route::get('users', [
        'uses' => 'Api\UserController@index',
        'middleware' => 'roles',
        'roles' => ['superAdmin', 'admin'],
    ]);
    Route::get('users/{user}', [
        'uses' => 'Api\UserController@show',
        'middleware' => 'roles',
        'roles' => ['SuperAdmin', 'admin'],
    ]);
    Route::delete('users/{user}', [
        'uses' => 'Api\UserController@destroy',
        'middleware' => 'roles',
        'roles' => ['SuperAdmin', 'admin']
    ]);
    Route::post('users/edit-request/{user}', [
        'uses' => 'Api\UserController@createRequest',
        'middleware' => 'roles',
        'roles' => ['SuperAdmin', 'admin']
    ]);
    Route::put('users/{user}', [
        'uses' => 'Api\UserController@update',
        'middleware' => 'roles',
        'roles' => ['SuperAdmin']
    ]);
    //user's password edit request
    Route::put('users/password/edit/{user}', [
        'uses' => 'Api\UserController@editPassword',
        'middleware' => 'roles',
        'roles' => ['SuperAdmin', 'admin']
    ]);
    Route::group(['middleware' => 'roles', 'roles' => ['admin', 'superAdmin', 'marketing']], function () {
        Route::post('lastNews/store', 'Api\LastNewsController@store');
        Route::post('lastNews/{lastNews}/update', 'Api\LastNewsController@update');
        Route::delete('lastNews/{lastNews}/delete', 'Api\LastNewsController@destroy');
        Route::get('lastNews/{lastNews}', 'Api\LastNewsController@show');
        Route::get('lastNews/{lastNews}/edit', 'Api\LastNewsController@edit');
    });
    Route::group(['middleware' => 'roles', 'roles' => ['superAdmin']], function () {
        // Roles Api Routes
        Route::get('roles', 'Api\RolesController@index');
        Route::post('roles', 'Api\RolesController@store');
        Route::get('roles/{role}/edit', 'Api\RolesController@edit');
        Route::put('roles/{role}', 'Api\RolesController@update');
        Route::get('roles/{role}', 'Api\RolesController@show');
        Route::delete('roles/{role}', 'Api\RolesController@destroy');
    });
    Route::group(['middleware' => 'roles', 'roles' => ['superAdmin', 'admin']], function () {
        // Sections Api Routes
        Route::post('sections', 'Api\SectionController@store');
        Route::get('sections/{section}/edit', 'Api\SectionController@edit');
        Route::put('sections/{section}', 'Api\SectionController@update');
        Route::get('sections/{section}', 'Api\SectionController@show');
        Route::delete('sections/{section}', 'Api\SectionController@destroy');
    });
    Route::group(['middleware' => 'roles', 'roles' => ['superAdmin', 'admin']], function () {
        // FAQ Api Routes
        Route::post('questions', 'Api\FaqController@store');
        Route::get('questions/{question}/edit', 'Api\FaqController@edit');
        Route::put('questions/{question}', 'Api\FaqController@update');
        Route::get('questions/{question}', 'Api\FaqController@show');
        Route::delete('questions/{question}', 'Api\FaqController@destroy');
    });
    Route::group(['middleware' => 'roles', 'roles' => ['superAdmin', 'admin']], function () {
        // About Api Routes
        Route::get('about/{about}/edit', 'Api\AboutController@edit');
        Route::put('about/{about}', 'Api\AboutController@update');
        Route::delete('about/{about}', 'Api\AboutController@destroy');
    });
    Route::post('studentRequest/store', [
        'uses' => 'Api\StudentRequestController@store',
        'as' => 'studentRequest.store',
        'middleware' => 'roles',
        'roles' => ['student']
    ]);
    Route::get('studentRequest', [
        'uses' => 'Api\StudentRequestController@index',
        'middleware' => 'roles',
        'roles' => ['superAdmin']
    ]);
    Route::get('studentRequest/{studentRequest}', [
        'uses' => 'Api\StudentRequestController@show',
        'as' => 'studentRequest.show',
        'middleware' => 'roles',
        'roles' => ['superAdmin']
    ]);
    Route::delete('studentRequest/{studentRequest}', [
        'uses' => 'Api\StudentRequestController@destroy',
        'as' => 'studentRequest.delete',
        'middleware' => 'roles',
        'roles' => ['superAdmin']
    ]);
    Route::put('studentRequest/{studentRequest}', [
        'uses' => 'Api\StudentRequestController@forward',
        'as' => 'studentRequest.forward',
        'middleware' => 'roles',
        'roles' => ['superAdmin']
    ]);
    Route::get('user/information/{user}/edit', [
        'uses' => 'Api\UserController@editUser',
    ]);
    // update user image
    Route::post('user/image/{user}/update', [
        'uses' => 'Api\UserController@updateUserImage',
        'as' => 'userImage.update',
    ]);
    // update user password
    Route::post('user/password/{user}/update', [
        'uses' => 'Api\UserController@updateUserPassword',
        'as' => 'userPassword.update',
    ]);
    // Hrd api
    Route::group(['middleware' => 'roles', 'roles' => ['superAdmin', 'admin']], function () {
        // Hrd Api Routes
        Route::post('hrd', 'Api\HrdController@store');
        Route::get('hrd/{hrd}', 'Api\HrdController@show');
        Route::get('hrd/{hrd}/edit', 'Api\HrdController@edit');
        Route::put('hrd/{hrd}', 'Api\HrdController@update');
        Route::delete('hrd/{hrd}', 'Api\HrdController@destroy');
        Route::post('user/group_updated', 'Api\UserController@updateUserGroups');
    });
    // Groups api
    Route::group(['middleware' => 'roles', 'roles' => ['superAdmin' , 'admin']], function () {
        Route::post('createGroup', 'Api\ChatController@createGroup');
    });
    // firebase api
    Route::post('firebase/create_token', 'Api\FirebaseController@createToken');
    Route::post('firebase/token_delete', 'Api\FirebaseController@deleteToken');
});
// get user's token
Route::get('firebase/get_user_token', 'Api\FirebaseController@getUserToken');
// Last News Api Routes
Route::get('lastNews', 'Api\LastNewsController@index');
// Sections Api Routes
Route::get('sections', 'Api\SectionController@index');
// FAQ Api Routes
Route::get('questions', 'Api\FaqController@index');
// About Api Routes
Route::get('about', 'Api\AboutController@index');
// Hrd Api Routes
Route::get('hrd', 'Api\HrdController@index');
// procedure types api
Route::get('procedure_types', 'Api\ProcedureTypeController@index');
// return all student api
Route::get('students', 'Api\UserController@returnStudents');
// return all user status
Route::get('statuses', 'Api\UserController@status');
// upload file
Route::post('file/upload', 'Api\UserController@UploadFile');
Route::get('firebase/send_one', 'Api\FirebaseController@sendToOne');
Route::get('firebase/send_group', 'Api\FirebaseController@sendToGroup');

Route::get('groups', 'Api\GroupController@index');
Route::get('groups/user', 'Api\UserController@userGroups');
Route::post('groups2', 'Api\UserController@userGroups2');

//get all teachers
Route::get('teachers','Api\UserController@getAllTeachers');
// get all students in group
Route::get('students','Api\UserController@studentsInGroup');
// notification
Route::post('send_notification','Api\ChatController@sendNotification');
//send notification to a group
Route::post('send_notification_to_group','Api\ChatController@sendNotificationGroup');
//send chat notification
//Route::post('notify', 'Api\ChatController@notification');
//Route::get('alert/{name}','Api\ChatController@alert');
//Route::get('enterName/{name}','Api\ChatController@enterName');
//Route::get('listen','Api\ChatController@ListenUser');
