<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FirebaseAuthController;
use Illuminate\Support\Facades\Auth;

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
    return redirect('admin');
});
Route::get('/home', function () {
    return redirect('admin');
});


// Facebook Login URL
Route::prefix('facebook')->name('facebook.')->group( function(){
    Route::get('auth', 'App\Http\Controllers\FatherController@loginUsingFacebook')->name('login');
    Route::get('callback', 'App\Http\Controllers\FatherController@callbackFromFacebook')->name('callback');
});

Auth::routes();

Route::group(['prefix' => 'admin','middleware' => ['auth']], function() {
    // Route::get('dashboard','AdminController@dashboard');
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/registerCustomAdmin', [App\Http\Controllers\Auth\RegisterController::class, 'customRegister'])->name('registerCustomAdmin');
    Route::get('/showAdmin', [App\Http\Controllers\Auth\RegisterController::class, 'show'])->name('show');
    Route::get('/deleteAdmin/{id}', [App\Http\Controllers\Auth\RegisterController::class, 'delete'])->name('delete');
    Route::post('/updateAdmin/{id}', [App\Http\Controllers\Auth\RegisterController::class, 'update'])->name('update');

    Route::get('/fatherAdmin', [App\Http\Controllers\FatherController::class, 'showFromAdmin'])->name('showFromAdmin');
    Route::get('/fatherAdminList', [App\Http\Controllers\FatherController::class, 'showFromAdmin_list'])->name('showFromAdmin_list');
    Route::resource('/father', 'App\Http\Controllers\FatherController');

    Route::get('/facilityAdmin', [App\Http\Controllers\FacilityOwnerController::class, 'showFromAdmin'])->name('showFromAdmin');
    Route::get('/showFromAdminList', [App\Http\Controllers\FacilityOwnerController::class, 'showFromAdminList'])->name('showFromAdminList');

    Route::get('/facilityAdmin/create', [App\Http\Controllers\FacilityOwnerController::class, 'createNewWithAadmin'])->name('createNewWithAadmin');
    Route::get('/facilityAdmin/edit/{id}', [App\Http\Controllers\FacilityOwnerController::class, 'editAdmin'])->name('editAdmin');
    Route::post('/facilityAdmin/activeAll', [App\Http\Controllers\FacilityOwnerController::class, 'activeAll'])->name('activeAll');
    Route::get('/facilityAdmin/program/{id_facility}', [App\Http\Controllers\ProgramController::class, 'createWithAdmin'])->name('createWithAdmin');
    Route::POST('/facilityAdmin/save/program/', [App\Http\Controllers\ProgramController::class, 'storeWithAdmin'])->name('storeWithAdmin');
    Route::resource('programs', 'App\Http\Controllers\ProgramController');
    Route::get("/program/copy/{id}",[App\Http\Controllers\ProgramController::class, 'CopyProgramWithAdmin'])->name('CopyProgramWithAdmin');
    Route::get('/facilityAdmin/top_pest_facility', [App\Http\Controllers\FacilityOwnerController::class, 'getPestTop_10_Facility'])->name('getPestTop_10_Facility');
    Route::get('/facilityAdmin/facility_program_page', [App\Http\Controllers\FacilityOwnerController::class, 'facility_program_page'])->name('facility_program_page');
    Route::get('/facilityAdmin/facility_program', [App\Http\Controllers\FacilityOwnerController::class, 'facility_program'])->name('facility_program');
    Route::get('/facilityAdmin/reservations', [App\Http\Controllers\ChildrenProgramController::class, 'reservations_company_dashboard_admin'])->name('reservations_company_dashboard_admin');
    Route::get('/facilityAdmin/reservations_list', [App\Http\Controllers\ChildrenProgramController::class, 'reservations_company_dashboard_admin_list'])->name('reservations_company_dashboard_admin_list');
    Route::get('/facilityAdmin/reservations_single/{id}', [App\Http\Controllers\ChildrenProgramController::class, 'show_admin'])->name('show_admin');
    Route::get('/get-record/{id}', [App\Http\Controllers\ChildrenProgramController::class, 'getOnereservations'])->name('reservations.get');
    Route::post('/update-status', [App\Http\Controllers\ChildrenProgramController::class, 'updateeservations'])->name('reservations.updat');


    Route::resource('/facility_owner', 'App\Http\Controllers\FacilityOwnerController');

    Route::resource('/father', 'App\Http\Controllers\FatherController');

    Route::resource('/timeTypes', 'App\Http\Controllers\TimeTypeController');

    Route::resource('/programType', 'App\Http\Controllers\ProgramTypeController');

    Route::resource('/reservation_status', 'App\Http\Controllers\ReservationStatusController');

    Route::resource('/setting/coins', 'App\Http\Controllers\SettingCoinsController');

    Route::resource('/setting/CountryCity', 'App\Http\Controllers\SettingCountryCityController');

    Route::get('/setting/district/delete/{id}', 'App\Http\Controllers\SettingCountryCityController@deleteDistrict');


    Route::resource('/agreement', 'App\Http\Controllers\AgreementsController');

    Route::resource('/agreements_facility','App\Http\Controllers\AgreementsFacilityController');
    Route::resource('media', 'App\Http\Controllers\MediaController');
    Route::get('media/type/{type}', 'App\Http\Controllers\MediaController@index')->name('media.index');

    Route::post('/agreements_facility/search','App\Http\Controllers\AgreementsFacilityController@search');

    Route::resource('/company_type', 'App\Http\Controllers\CompanyTypeController');

    Route::resource('/curriculum_types', 'App\Http\Controllers\CurriculumTypesController');

    Route::get('/import_data', 'App\Http\Controllers\ImportExcelController@main')->name('main');
    Route::post('/import_data', 'App\Http\Controllers\ImportExcelController@import')->name('import');

    Route::get('/notification', 'App\Http\Controllers\NotificationController@index');
    Route::get('/notification/all', 'App\Http\Controllers\NotificationController@allNotifications');
    Route::get('/notification/delete/{id}', 'App\Http\Controllers\NotificationController@deleteNotifications');



    Route::post('/send-notification_father', 'App\Http\Controllers\NotificationController@sendNotification_all_father')->name('send.notification_father');
    Route::post('/send-notification_facility', 'App\Http\Controllers\NotificationController@sendNotification_all_facility')->name('send.notification_facility');

    Route::resource('/opinions', 'App\Http\Controllers\FatherOpinionsController');
    Route::get('/opinions-active/{id}', 'App\Http\Controllers\FatherOpinionsController@activeSingle');
    Route::get('/opinions-active', 'App\Http\Controllers\FatherOpinionsController@activeAll');
    Route::get('/opinions-delete/{id}', 'App\Http\Controllers\FatherOpinionsController@destroySingle');

    Route::resource('programs2', 'App\Http\Controllers\ProgramController');
    Route::get('programs2/edit/{id}', 'App\Http\Controllers\ProgramController@editWithAdmin');
    Route::resource('discount', 'App\Http\Controllers\ProgramDiscountController');
    Route::resource('services_more', 'App\Http\Controllers\ServiceMoreController');

    Route::get('page/main/chat','App\Http\Controllers\ChatController@pageAdminMainChat');
    Route::get('main/chat','App\Http\Controllers\ChatController@adminMainChats');
    Route::get('page/private/chat/{id_father}/{id_company}','App\Http\Controllers\ChatController@pageAdminPrivateChat');

    Route::resource('beastFacilityYourCity', 'App\Http\Controllers\BeastFacilityYourCityController');

});








//user facility owner dashboard
Route::get('/login_page/facility', 'App\Http\Controllers\FacilityOwnerController@loginPage');
Route::post('/login/facility', 'App\Http\Controllers\FacilityOwnerController@loginDashboard');
Route::resource('/facility_owner', 'App\Http\Controllers\FacilityOwnerController');
Route::PUT("/company_data/update/{id}",'App\Http\Controllers\CompanyDataController@customeUpdate');

Route::group(['prefix' => 'facility_m','middleware' => ['FacilityOwner']], function() {
    Route::get('/', 'App\Http\Controllers\FacilityOwnerController@index');
    Route::resource('programs', 'App\Http\Controllers\ProgramController');
    Route::resource('services_more', 'App\Http\Controllers\ServiceMoreController');
    Route::resource('media', 'App\Http\Controllers\MediaController');
    Route::resource('discount', 'App\Http\Controllers\ProgramDiscountController');
    Route::resource('children_propgram', 'App\Http\Controllers\ChildrenProgramController');

    Route::resource('/company_data', 'App\Http\Controllers\CompanyDataController');
    Route::PUT("/company_data/update/{id}",'App\Http\Controllers\CompanyDataController@customeUpdate');

    Route::get('/programChildren/my_reservattions', 'App\Http\Controllers\ChildrenProgramController@my_reservations_company_dashboard');
    Route::post('/programChildren/update_reservattions/{id}', 'App\Http\Controllers\ChildrenProgramController@update_reservation_status_dashboard');

    Route::get('/agreements_facility/my','App\Http\Controllers\AgreementsFacilityController@showDashboard_facility_owner');
    Route::get('/agreements_facility/my/id/{id?}','App\Http\Controllers\AgreementsFacilityController@showDashboard_facility_owner_sibgle');

    Route::post('/facility_owner/update/password', 'App\Http\Controllers\FacilityOwnerController@updatePassword');

    Route::get('/logout', 'App\Http\Controllers\FacilityOwnerController@logoutDashboard');
});
// Route::get('/facility/d', function(){
//     return view('facility_owner.main');
// })->middleware('FacilityOwner');




