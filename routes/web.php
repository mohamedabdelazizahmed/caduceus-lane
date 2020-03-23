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

Auth::routes();

Route::get('/','HomeController@index')->name('index');
Route::post('/appointment/{id}','HomeController@makeAppointment')->name('MakeAppointment')->middleware('IsPatient');


Route::prefix('cpanel')->name('cpanel.')->group(function () {

    Route::get('profile','CpanelController@index')->name('profile');
    Route::post('saveBasicData/{id}','CpanelController@savePersonalData')->name('PersonalData');
    Route::get('addDoctor','CpanelController@addDoctor')->name('AddDoctor')->middleware('IsAdmin');
    Route::post('createDoctor','CpanelController@createDoctor')->name('CreateDoctor')->middleware('IsAdmin');
    Route::get('sendNotification','CpanelController@sendNotification')->middleware('IsAdmin');
    Route::post('sendNotificationPost','CpanelController@sendNotificationPost')->name('SendNotificationPost')->middleware('IsAdmin');
    Route::get('notifications','CpanelController@notifications')->name('Notifications');
    Route::post('notificationsPost','CpanelController@notificationsPost')->name('NotificationsPost');
    Route::get('adminNotifications','CpanelController@adminNotifications')->name('AdminNotifications')->middleware('IsAdmin');
});





