<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();
Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController');
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
// show request
    Route::get('users/show-request/{user}', [
        'uses'=>'UserController@showRequest',
        'as'=>'showRequest',
        'middleware'=>'roles',
        'roles'=>['superAdmin'],
    ]);
//user's password edit request
    Route::put('user/password/edit', [
        'uses'=>'UserController@editPassword',
        'as'=>'edit.password',
        'middleware'=>'roles',
        'roles'=>['admin','superAdmin'],
    ]);
    Route::put('user/password/update', [
        'uses'=>'UserController@updatePassword',
        'as'=>'update.password',
        'middleware'=>'roles',
        'roles'=>['superAdmin'],
    ]);
// delete edit request
    Route::delete('users/editRequest/{id}/delete', [
        'uses'=>'UserController@deleteRequest',
        'as'=>'deleteRequest',
        'middleware'=>'roles',
        'roles'=>['superAdmin'],
    ]);
//show user group request
    Route::get('group/{user}/request', [
        'uses'=>'UserController@userGroupsRequest',
        'as'=>'userGroupsRequest',
        'middleware'=>'roles',
        'roles'=>['superAdmin'],
    ]);
// Approve request update group
    Route::post('group/request/approve', [
        'uses'=>'UserController@activeUserGroups',
        'as'=>'approve.request',
        'middleware'=>'roles',
        'roles'=>['superAdmin'],
    ]);
// delete password request
    Route::delete('users/passwordRequest/delete',[
        'uses'=>'UserController@deletePasswordRequest',
        'as'=>'deletePasswordRequest',
        'middleware'=>'roles',
        'roles'=>['superAdmin'],
    ]);

   Route::group(['middleware'=>'roles','roles'=>['admin','superAdmin']],function (){
       // add user to group
       Route::get('groups/{room}/group_users','ChatController@groupUser')->name('group_user');
       // update user's groups
       Route::get('user/{user}/group_update','UserController@updateGroupsView')->name('updateGroupUserView');
       Route::post('user/{user}/group_updated','UserController@updateGroups')->name('updateGroupUser');
   });
   Route::group(['middleware'=>'roles','roles'=>['superAdmin']],function (){
      Route::get('users/update/requests','UserController@userUpdateRequests')
          ->name('userUpdateRequests');
      Route::get('user/update/password/requests','UserController@userUpdatePasswordRequests')
          ->name('userPasswordRequests');
       Route::get('user/update/groups/requests','UserController@indexUserGroupRequests')
           ->name('indexUserGroupRequests');
       Route::delete('user/update/groups/requests/delete','UserController@deleteGroupRequest')
           ->name('deleteGroupRequest');
   });

});
// request for edit
Route::post('edit-request','UserController@createRequest')->name('createRequest');
// Role Routes
Route::resource('roles','RolesController');
// Last News Routes
Route::resource('lastNews','LastNewsController')->except(['destroy']);
Route::delete('lastNews/{post}/delete','LastNewsController@destroy')->name('lastNews.delete');
// Section Routes
Route::resource('section','SectionController');
// About Routes
Route::resource('about','AboutController');
// Question Routes
Route::resource('questions','FaqController');
// Chat Routes
Route::resource('Chat','ChatController');
Route::get('/chat.show/{id}',[\App\Http\Controllers\ChatController::class, 'show'])->name('groupName');
Route::get('/conve/{code}',[\App\Http\Controllers\UserController::class, 'conversation'])->name('conversation');
Route::get('/D/{id}',function ($id){
    $getById = \App\Models\Chatroom::find($id);
    $getById->delete();
    return redirect()->back()->withstatus(__('Room Deleted'));
});
Route::get('/editRoom/{id}',[\App\Http\Controllers\ChatController::class, 'editRoom'])->name('editRoom');
Route::post('/editRoom/{id}',[\App\Http\Controllers\ChatController::class, 'editRoom'])->name('editRoom');
Route::post('/activeRoom/{id}',[\App\Http\Controllers\ChatController::class, 'activeRoom'])->name('activeRoom');
//private chat route
Route::get('/messages',[\App\Http\Controllers\UserController::class ,'messages'])->name('messages');
// Answers Routes
Route::get('answers/{answer}/show','FaqController@showAnswer')->name('answer.show');
Route::get('answers/{answer}/edit','FaqController@editAnswer')->name('answer.edit');
Route::put('answers/{answer}/update','FaqController@updateAnswer')->name('answer.update');
Route::get('answers/{question}/create','FaqController@createAnswer')->name('answer.create');
Route::post('answers/store','FaqController@storeAnswer')->name('answer.store');
Route::delete('answers/{answer}/delete','FaqController@destroyAnswer')->name('answer.delete');
//procedure types
Route::resource('procedureType', 'ProcedureTypeController');
//student requests
Route::resource('studentRequest', 'StudentRequestController')->except(['index']);
Route::post('studentRequest/forward_to/{studentRequest}', 'StudentRequestController@forward')->name('studentRequest.forward');
Route::post('studentRequest/done/{studentRequest}','StudentRequestController@done')->name('done');
Route::get('studentRequests','StudentRequestController@adminIndex')->name('request.admin');
Route::get('studentRequest',[
    'uses'=>'StudentRequestController@index',
    'as'=>'studentRequest.index',
    'middleware'=>'roles',
    'roles'=>['superAdmin']
]);
//chat request
Route::resource('chatRequests','ChatRequestController');
Route::post('chatRequest/confirm/{chatRequest}','ChatRequestController@confirm')->name('chatRequest.confirm');
// Hdr Routes
Route::resource('hrd','HrdController');
// Groups Routes
Route::resource('groups','UserGroupsController');
//excel
Route::get('file-import-export', 'UserController@fileImportExport');
Route::post('file-import', 'UserController@fileImport')->name('file-import');
Route::get('file-export', 'UserController@fileExport')->name('file-export');
//lang
Route::get('lang/{lang}', 'LanguageController@swap')->name('lang');
Route::post('notify',[\App\Http\Controllers\ChatController::class, 'notification'])->name('notification');
//reports
Route::get('reports','UserController@counter')->name('reports');
