<?php

use App\Http\Controllers\Admin\app_setting\NotificationController;
use App\Http\Controllers\Admin\app_setting\DiscountController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\Finance\Accounts_Type_C;
use App\Http\Controllers\Admin\Finance\AccountController;
use App\Http\Controllers\Admin\Finance\AccountingEntryController;
use App\Http\Controllers\Admin\Finance\ExchangeController;
use App\Http\Controllers\Admin\Finance\MainController;
use App\Http\Controllers\Admin\Finance\Receipt_VoucherController;
use App\Http\Controllers\Admin\hr\BonusesController;
use App\Http\Controllers\Admin\hr\DeductionsController;
use App\Http\Controllers\Admin\hr\EmployeeController;
use App\Http\Controllers\Admin\hr\HolidaysController;
use App\Http\Controllers\Admin\hr\LoanController;
use App\Http\Controllers\Admin\hr\MainHrController;
use App\Http\Controllers\Admin\hr\PerformanceReportController;
use App\Http\Controllers\Admin\hr\PermissionController;
use App\Http\Controllers\Admin\hr\Setting\HolidaysettingController;
use App\Http\Controllers\Admin\hr\Setting\MainsettingController;
use App\Http\Controllers\Admin\hr\Setting\TypeSettingController;
use App\Http\Controllers\Admin\Members\InbodyController;
use App\Http\Controllers\Admin\Members\MembersReportsController;
use App\Http\Controllers\Admin\Members\MemberSubscriptionsController;
use App\Http\Controllers\Admin\Site\AboutController;
use App\Http\Controllers\Admin\Site\BlogController;
use App\Http\Controllers\Admin\Site\ContactController;
use App\Http\Controllers\Admin\Site\EventController;
use App\Http\Controllers\Admin\Site\GalleryController;
use App\Http\Controllers\Admin\Site\MaindataController;
use App\Http\Controllers\Admin\Site\TeacherController;
use App\Http\Controllers\Admin\Site\TermsController;
use App\Http\Controllers\Admin\Site\VideosController;
use App\Http\Controllers\Admin\subscriptions\DeviceExercises_C;
use App\Http\Controllers\Admin\subscriptions\Devices_C;
use App\Http\Controllers\Admin\subscriptions\ReportController;
use App\Http\Controllers\Admin\subscriptions\SpecialSubscription_C;
use App\Http\Controllers\Admin\subscriptions\SubscriptionSettings_C;
use App\Http\Controllers\Admin\subscriptions\TaskManagementController;
use App\Http\Controllers\Admin\Trainers\ScheduleController;
use App\Http\Controllers\Admin\Trainers\TrainersController;
use App\Http\Controllers\Admin\Users\PermissionsController;
use App\Http\Controllers\Admin\Users\ProfileController;
use App\Http\Controllers\Admin\Users\RolesController;
use App\Http\Controllers\Admin\Users\UsersController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Admin\subscriptions\Exercises_C;
use App\Http\Controllers\Admin\subscriptions\MainSubscription_C;
use App\Http\Controllers\Admin\subscriptions\Transportation_C;
use App\Http\Controllers\Admin\subscriptions\Offers_C;
use App\Http\Controllers\Admin\Members\MembersController;
use App\Http\Controllers\Admin\ComplaintsController;
use App\Http\Controllers\Admin\Finance\AccountSettingController;
use App\Http\Controllers\Admin\Finance\TaxSettingController;
use App\Http\Controllers\Admin\Finance\PaymentController;
use App\Http\Controllers\Admin\Finance\ExpendituresController;
// use App\Http\Controllers\Admin\Users\UsersController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Define routes for the "languages" prefix outside the group
Route::prefix('languages')->group(function () {
    // Your routes for the "languages" prefix
});
Route::get('/pre_home', function () {
    return view('welcome');
});
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:admin']
    ], function () {


    Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/dashboard', function () {
            return view('dashbord.home');
        })->name('dashboard');

        Route::get('/test', function () {
            return ' test admin ';
        });

        Route::resource('clients',ClientController::class);

        /************************** MAINDATA *****************************/
        Route::resource('mdata', MaindataController::class);
        /************************** About *****************************/
        Route::resource('about', AboutController::class);
        Route::get('about/show_load/{id}', [AboutController::class, 'show_load'])->name('about.load_details');

        /******************************************************************************************************** */
        Route::group(['prefix' => 'app_setting', 'as' => 'app_setting.'], function () {
        Route::resource('Notification', NotificationController::class);
        Route::get('Notification/show_load/{id}', [NotificationController::class, 'show_load'])->name('Notification.load_details');
        Route::resource('Discount', DiscountController::class);

        });
        //************************************** Complaints ********************************************** */

        /********************************************************************************************* */
        Route::group(['prefix' => 'UserManagement', 'as' => 'UserManagement.'], function () {

            Route::resource('users', UsersController::class);

            /*Route::get('/add_user', [UsersController::class, 'index'])->name('add_users_form');
            Route::post('/add_user', [UsersController::class, 'store'])->name('add_users');
            Route::get('/all_users', [UsersController::class, 'get_all_users'])->name('all_users');
            Route::get('/all_users/{id}', [UsersController::class, 'edit'])->name('user.edit');
            Route::patch('/all_users/{id}', [UsersController::class, 'update'])->name('user_update');
            Route::delete('/all_users/{id}', [UsersController::class, 'destroy'])->name('user_destroy');*/
            Route::get('users/delete/{id}', [UsersController::class, 'destroy'])->name('users.delete');


            /************************** permission *****************************/
            Route::resource('permission', PermissionsController::class);
            Route::get('permission/delete/{id}', [PermissionsController::class, 'delete'])->name('permission.delete');
            /************************** rolls *****************************/
            Route::resource('roles', RolesController::class);
            Route::get('roles/load_edit', [RolesController::class, 'load_edit'])->name('roles.load_edit');

            Route::get('roles/permission/{id}', [RolesController::class, 'get_permission'])->name('roles.permission');
            Route::get('roles/delete/{id}', [RolesController::class, 'delete'])->name('roles.delete');

        });



        /******************************************abdulhamed zaghloul*********************************************/




    });


});


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    Route::post('printQr/{id}', [MemberSubscriptionsController::class, 'printQr'])->name('printQr');


    require __DIR__ . '/adminauth.php';
});
