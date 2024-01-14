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
use App\Http\Controllers\TwilioSMSController;
use Maatwebsite\Excel\Row;

Route::prefix('facebook')->name('facebook.')->group( function(){
    Route::get('auth', 'App\Http\Controllers\FatherController@loginUsingFacebook')->name('login');
    Route::get('callback', 'App\Http\Controllers\FatherController@callbackFromFacebook')->name('callback');
});

Route::get('/companiesLocations','App\Http\Controllers\CompanyDataController@companiesLocations')->name('companiesLocations');


Route::post('/social/login/father', "App\Http\Controllers\FatherController@socialLogin")->name('social.login');
Route::post('/social/login/facility_owner', "App\Http\Controllers\FacilityOwnerController@socialLogin")->name('social.login');


Route::post('/import_data', 'App\Http\Controllers\ImportExcelController@import')->name('import');

Route::post('/facility_owners', 'App\Http\Controllers\FacilityOwnerController@storeApi')->name('storeApi');
Route::post('/facility_owners/login', 'App\Http\Controllers\FacilityOwnerController@login');



//افضل العروض في مدينتك => الصفحة الرئيسية
Route::get('/companydata_all/id_city/{id_city}/type_sort/{type_sort?}','App\Http\Controllers\CompanyDataController@showApi')->name('showApi');
//افضل العروض في مدينتك => الصفحة الرئيسية
Route::get('/beastFacilityYourCity/id_city/{id_city}/type_sort/{type_sort?}','App\Http\Controllers\BeastFacilityYourCityController@showApi')->name('showApi');


Route::get('/companydata/id/{id}/{id_father?}','App\Http\Controllers\CompanyDataController@sinbleApi')->name('sinbleApi');
Route::get('/companydata_rate/id_company/{id_company}','App\Http\Controllers\CompanyRateController@singleRate')->name('singleRate'); //
//مؤسسات تعليمية في مدينتك => الصفحة الرئيسية
Route::get('/companydata/filter/id_country/{id_country}/id_city/{id_city}','App\Http\Controllers\CompanyDataController@search_company_with_cuntry_and_city')->name('search_company_with_cuntry_and_city');
Route::get('companydata/filter/id_company_type/{id_company_type}/id_city/{id_city}','App\Http\Controllers\CompanyDataController@search_company_with_company_type')->name('search_company_with_company_type');
Route::get('companydata/get','App\Http\Controllers\CompanyDataController@GetCompany')->name('GetCompany');
Route::get('/companydata/likeSearch/{search}/{city}/{type_company?}','App\Http\Controllers\CompanyDataController@search_like')->name('search_like');
Route::get('/companydata/likeSearch2/search/{search}/city/{city}/type_company/{type_company?}','App\Http\Controllers\CompanyDataController@search_like2')->name('search_like2');
Route::get('/companydata/getDistance/lat1/{lat1}/lon1/{long1}/lat2/{lat2}/lon2/{long2}','App\Http\Controllers\CompanyDataController@getDistance');
//جلب الشركات حسب قرب المكان
Route::get('/companydata_all/sort/location/{type_sort}/id_city/{id_city}','App\Http\Controllers\CompanyDataController@sortLocation')->name('sortLocation');

Route::get('/programs/all/id_facility_owner/{id_facility_owner}','App\Http\Controllers\ProgramController@showApi')->name('showApi');
Route::get('/programs/id/{id}','App\Http\Controllers\ProgramController@singleApi')->name('singleApi');
Route::get('/programs-withFacility/id/{id}','App\Http\Controllers\ProgramController@singleApiWithFacility')->name('singleApiWithFacility');
Route::get('/programs/id_type_program/{id_type_program}/id_city/{id_city}/{search?}','App\Http\Controllers\ProgramController@getProgramWithTypeProgram')->name('getProgramWithTypeProgram');

Route::get('/time_types/all','App\Http\Controllers\TimeTypeController@showApi')->name('showApi');

Route::get('/program_types/all','App\Http\Controllers\ProgramTypeController@showApi')->name('showApi');

Route::get('/setting/langueges','App\Http\Controllers\SettingLanguegeController@showApi')->name('showApi');
Route::get('/setting/coins','App\Http\Controllers\SettingCoinsController@showApi')->name('showApi');
Route::get('/setting/country','App\Http\Controllers\SettingCountryCityController@showApi_country')->name('showApi_country');
Route::get('/setting/city','App\Http\Controllers\SettingCountryCityController@showApi_city')->name('showApi_city');
Route::get('/setting/area','App\Http\Controllers\SettingCountryCityController@showApi_area')->name('showApi_area');

Route::get('/setting/city/mycountry/{id_country}','App\Http\Controllers\SettingCountryCityController@showCity_Mycountry')->name('showCity_Mycountry');
Route::get('/setting/area/mycity/{id_country}','App\Http\Controllers\SettingCountryCityController@showDistrict_Mycity')->name('showDistrict_Mycity');



Route::get('/company_types/all','App\Http\Controllers\CompanyTypeController@showApi')->name('showApi');

Route::get('/curriculum/all', 'App\Http\Controllers\CurriculumTypesController@showApi')->name('showApi');

Route::get('/children/single/id/{id}', 'App\Http\Controllers\FahterChildrenController@singleApi')->name('singleApi');

Route::get('/coins/id_user/{id_user}/type/{type}', 'App\Http\Controllers\SettingCoinsController@getCoinsLogid')->name('getCoins');

// company_data
// Route::resource('/companydata', 'App\Http\Controllers\CompanyDataController');
// Route::get('/companydata_all/{id?}','App\Http\Controllers\CompanyDataController@showApi')->name('companydata_all');
// Route::post('/companydata_update/id/{id}','App\Http\Controllers\CompanyDataController@updateApi')->name('companydata_update');

Route::prefix('facility_owners')->group(function () {
    Route::post('logout', 'App\Http\Controllers\FacilityOwnerController@logout');
});



//start father routes
Route::post('/fathers/login', 'App\Http\Controllers\FatherController@login');
Route::post('/fathers/register', 'App\Http\Controllers\FatherController@register');

// Facebook Login URL
// Route::prefix('facebook')->name('facebook.')->group( function(){
//     Route::get('auth', [FaceBookController::class, 'loginUsingFacebook'])->name('login');
//     Route::get('callback', [FaceBookController::class, 'callbackFromFacebook'])->name('callback');
// });
//end father routes


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/companydata_save', 'App\Http\Controllers\CompanyDataController@storeApi')->name('companydata_save');
    // Route::get('/companydata/id/{id}','App\Http\Controllers\CompanyDataController@sinbleApi')->name('sinbleApi');
    Route::get('/my_companydata_singl','App\Http\Controllers\CompanyDataController@single_with_token')->name('single_with_token');
    Route::post('/companydata_update/id/{id}','App\Http\Controllers\CompanyDataController@updateApi')->name('companydata_update');    // return $request->user();
    Route::get('/companydata_destory/id/{id}','App\Http\Controllers\CompanyDataController@destroyApi')->name('destroyApi');
    // Route::get('/companydata_all','App\Http\Controllers\CompanyDataController@showApi')->name('showApi');

    Route::post('/companydata_rate','App\Http\Controllers\CompanyRateController@rateApi')->name('rateApi'); //لازم يكون صاحب مسجل دخول المستخدم
    Route::post('/companydata/update_languege_coin', 'App\Http\Controllers\CompanyDataController@updateCompanyLanguege_And_coins')->name('updateCompanyLanguege_And_coins');
    Route::get('/companydata/filter/country_city','App\Http\Controllers\CompanyDataController@search_company_with_cuntry_and_city_token')->name('search_company_with_cuntry_and_city_token');
    //حجوزات الشركة
    Route::get('/company/children/reservation/my/{search?}','App\Http\Controllers\ChildrenProgramController@my_reservations_company')->name('my_reservations_company');

    Route::get('/company/children/reservation/my/singleStatus/{id_satus}','App\Http\Controllers\ChildrenProgramController@my_reservations_data')->name('my_reservations_data');

    //حجوزات الشركة لطالب واحد
    Route::get('/company/children/reservation/my/single/{id}','App\Http\Controllers\ChildrenProgramController@singleApi')->name('singleApi');

    // Route::get('/company/children/reservation/my','App\Http\Controllers\ChildrenProgramController@my_reservations_company')->name('my_reservations_company');

    Route::post('/programs/save','App\Http\Controllers\ProgramController@storeApi')->name('storeApi');
    Route::post('/programs/update/id/{id}','App\Http\Controllers\ProgramController@updateApi')->name('updateApi');
    Route::get('/programs_destroy/id/{id}','App\Http\Controllers\ProgramController@destroyApi')->name('destroyApi');
    Route::get('/programs/copy/id/{id}','App\Http\Controllers\ProgramController@copyProgram')->name('copyProgram');
    Route::get('/programs/all-auth/id_user/{id_user}','App\Http\Controllers\ProgramController@showApiAuth')->name('showApiAuth');
    Route::get('/programs-auth/id/{id}','App\Http\Controllers\ProgramController@singleApiAuth')->name('singleApiAuth');

    // Route::get('/programs/id/{id}','App\Http\Controllers\ProgramController@singleApi')->name('singleApi');
    // Route::get('/programs/all/id_facility_owner/{id_facility_owner}','App\Http\Controllers\ProgramController@showApi')->name('showApi');

    Route::post('/program/discountSave', 'App\Http\Controllers\ProgramDiscountController@storeApi')->name('storeApi');
    Route::post('/program/discountUpdate/id/{id}','App\Http\Controllers\ProgramDiscountController@updateApi')->name('updateApi');
    Route::get('/program/discountDestroy/id/{id}','App\Http\Controllers\ProgramDiscountController@destroyApi')->name('destroyApi');

    Route::post('/media/save','App\Http\Controllers\MediaController@storeApi')->name('storeApi');
    Route::get('/media_destroy/id/{id}','App\Http\Controllers\MediaController@destroyApi')->name('destroyApi');

    Route::post('/service_more/save','App\Http\Controllers\ServiceMoreController@storeApi')->name('storeApi');
    Route::get('/service_more/destory/id/{id}','App\Http\Controllers\ServiceMoreController@destroyApi')->name('destroyApi');
    Route::post('/service_more/update/id/{id}','App\Http\Controllers\ServiceMoreController@updateApi')->name('updateApi');

    Route::get('/reservation_status/all','App\Http\Controllers\ReservationStatusController@showApi')->name('showApi');

    Route::get('/agreements/all','App\Http\Controllers\AgreementsController@showApi')->name('showApi');

    Route::get('/agreements/facility_owner','App\Http\Controllers\AgreementsFacilityController@showApi_facility_owner')->name('showApi_facility_owner');


    Route::post('/chat/send', 'App\Http\Controllers\ChatController@sendChat')->name('sendChat');
    Route::get('/chat/my/id_company/{id_company}/id_father/{id_father}', 'App\Http\Controllers\ChatController@myChat')->name('myChat');
    Route::get('/chat/my/main', 'App\Http\Controllers\ChatController@myMainChats')->name('myMainChats');//قائمة الرسائل
    Route::get('/chat/countNotRead/id_company/{id_company}/id_father/{id_father}', 'App\Http\Controllers\ChatController@count_not_reading');
    Route::get('/chat/chatNotRead', 'App\Http\Controllers\ChatController@countChatMainNotRead');
    //تحديث الحالة الحالية للحجز
    Route::post('/update/children_program/reservation_status', 'App\Http\Controllers\ChildrenProgramController@update_reservation_status')->name('update_reservation_status');

    Route::post('/save-token-facility', 'App\Http\Controllers\NotificationController@saveToken_facility')->name('save-token-facility');


    Route::get('/get-notification_facility', 'App\Http\Controllers\NotificationController@getNotification_facility')->name('get.notification_facility');
    Route::get('/get-notification_facility_not_read', 'App\Http\Controllers\NotificationController@getNotification_facility_not_read')->name('getNotification_facility_not_read');
    Route::get('/count-notification_facility_not_read', 'App\Http\Controllers\NotificationController@getCountNoteficationNotRead_facility')->name('getCountNoteficationNotRead_facility');
    Route::get('/getnotification_facility_read_and_noteRead', 'App\Http\Controllers\NotificationController@getnotification_facility_read_and_noteRead')->name('getnotification_facility_read_and_noteRead');



    /**
     *
     * start user father api
     *
     */
    Route::get('/father', 'App\Http\Controllers\FatherController@getSingleFather')->name('getSingleFather');
    Route::post('/father/update', 'App\Http\Controllers\FatherController@updateFather')->name('updateFather');
    Route::post('/fathers/children/create','App\Http\Controllers\FahterChildrenController@storeApi')->name('storeApi');
    Route::post('/fathers/children/update/id/{id}','App\Http\Controllers\FahterChildrenController@updateApi')->name('updateApi');
    Route::get('/fathers/children/destroy/id/{id}','App\Http\Controllers\FahterChildrenController@destroyApi')->name('destroyApi');
    Route::get('/fathers/children/myChildren','App\Http\Controllers\FahterChildrenController@myChildren')->name('myChildren');

    //اضافة طالب لبرنامج
    Route::post('/fathers/children/reservation/create','App\Http\Controllers\ChildrenProgramController@storeApi')->name('storeApi');
    //طلابي الغير مسجلين في هذا البرنامج
    Route::get('/fahters/children/not_register/id_program/{id_program}','App\Http\Controllers\ChildrenProgramController@my_child_not_resrvation_this_program')->name('not_register');
    //عرض حجوزاتي
    Route::get('/fathers/children/reservation/my','App\Http\Controllers\ChildrenProgramController@my_reservations')->name('my_reservations');
    Route::get('/fathers/children/reservation/my/delete/id/{id}','App\Http\Controllers\ChildrenProgramController@destroyApi')->name('destroyApi');
    //اضافة رأي
    Route::post('/fathers/opinion','App\Http\Controllers\FatherOpinionsController@sendOpinions')->name('sendOpinions');
    // Route::get('/opinions/id_company/{id_company}','App\Http\Controllers\FatherOpinionsController@getOpinions')->name('getOpinions');
    //تعديل الاحداثية للاب
    Route::post('/father/location/update', 'App\Http\Controllers\LocationFatherController@updateLocationFatherApi');
    // //جلب الشركات حسب قرب المكان
    // Route::get('/companydata_all/sort/location/{type_sort}','App\Http\Controllers\CompanyDataController@sortLocation')->name('sortLocation');

    //get Notefcation
    Route::get('/get-notification_father', 'App\Http\Controllers\NotificationController@getNotification_father')->name('get.notification_father');
    Route::get('/get-notification_father_not_read', 'App\Http\Controllers\NotificationController@getNotification_father_not_read')->name('getNotification_father_not_read');
    Route::get('/count-notification_father_not_read', 'App\Http\Controllers\NotificationController@getCountNoteficationNotRead_fahter')->name('getCountNoteficationNotRead_fahter');
    Route::get('/getnotification_father_read_and_noteRead', 'App\Http\Controllers\NotificationController@getnotification_father_read_and_noteRead')->name('getnotification_father_read_and_noteRead');




    Route::post('/father_sendSMS', [TwilioSMSController::class, 'father_sendSMS']);
    Route::post('/father_getSMS', [TwilioSMSController::class, 'father_getVerfication']);

    Route::post('/facility_sendSMS', [TwilioSMSController::class, 'facility_sendSMS']);
    Route::post('/facility_getSMS', [TwilioSMSController::class, 'facility_getVerfication']);

    Route::get('/favorate/save/{company_id}', 'App\Http\Controllers\FatherController@AddfavoriteCompany')->name('AddfavoriteCompany');
    Route::get('/favorate/delete/{favorite_id}', 'App\Http\Controllers\FatherController@removeFavoruteCompany')->name('removeFavoruteCompany');
    Route::get('/favorate/get', 'App\Http\Controllers\FatherController@getFavorateCompany')->name('getFavorateCompany');

    Route::get('/profile', function(Request $request) {
        return auth()->user();
    });

});
Route::get('/opinions/id_company/{id_company}','App\Http\Controllers\FatherOpinionsController@getOpinions')->name('getOpinions');


Route::post('/save-token-father', 'App\Http\Controllers\NotificationController@saveToken_father')->name('save-token-father');

Route::post('/send-notification_father', 'App\Http\Controllers\NotificationController@sendNotification_all_father')->name('send.notification_father');



Route::get('/noteTest/{title}/{body}/{device_token}/{type_notification}', 'App\Http\Controllers\NotificationController@sendNotification')->name('set.sendNotification');


Route::get('test/fatherCountry', 'App\Http\Controllers\FatherController@fatherCountry');

Route::get('test/topFaciliry', 'App\Http\Controllers\FacilityOwnerController@getPestTop_10_Facility');

Route::get("test/adminMainChat", 'App\Http\Controllers\ChatController@adminMainChats');
