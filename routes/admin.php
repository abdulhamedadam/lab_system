<?php

use App\Http\Controllers\Admin\app_setting\NotificationController;
use App\Http\Controllers\Admin\app_setting\DiscountController;
use App\Http\Controllers\Admin\EmployeesController;
use App\Http\Controllers\Admin\Finance\Accounts_Type_C;
use App\Http\Controllers\Admin\Finance\AccountController;
use App\Http\Controllers\Admin\Finance\AccountingEntryController;
use App\Http\Controllers\Admin\Finance\ExchangeController;
use App\Http\Controllers\Admin\Finance\MainController;
use App\Http\Controllers\Admin\Finance\Receipt_VoucherController;
use App\Http\Controllers\Admin\GeneralSettingsController;
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

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


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

        Route::get('/branches', [GeneralSettingsController::class, 'branches'])->name('branches');
        Route::post('/branch/create', [GeneralSettingsController::class, 'add_branch'])->name('add_branch');
        Route::get('/branch/edit/{id}', [GeneralSettingsController::class, 'edit_branch'])->name('edit_branch');
        Route::get('/branch/delete/{id}', [GeneralSettingsController::class, 'delete_branch'])->name('delete_branch');
        Route::get('/get_ajax_branches', [GeneralSettingsController::class, 'get_ajax_branches'])->name('get_ajax_branches');

        Route::get('/governorates', [GeneralSettingsController::class, 'governorates'])->name('governorates');
        Route::post('/governorate/create', [GeneralSettingsController::class, 'add_governorate'])->name('add_governorate');
        Route::get('/governorate/edit/{id}', [GeneralSettingsController::class, 'edit_governorate'])->name('edit_governorate');
        Route::get('/governorate/delete/{id}', [GeneralSettingsController::class, 'delete_governorate'])->name('delete_governorate');
        Route::get('/get_ajax_governorates', [GeneralSettingsController::class, 'get_ajax_governorates'])->name('get_ajax_governorates');
        Route::get('/get_ajax_branches', [GeneralSettingsController::class, 'get_ajax_branches'])->name('get_ajax_branches');

        Route::get('/areas', [GeneralSettingsController::class, 'areas'])->name('areas');
        Route::post('/area/create', [GeneralSettingsController::class, 'add_area'])->name('add_area');
        Route::get('/area/edit/{id}', [GeneralSettingsController::class, 'edit_area'])->name('edit_area');
        Route::get('/area/delete/{id}', [GeneralSettingsController::class, 'delete_area'])->name('delete_area');
        Route::get('/get_ajax_areas', [GeneralSettingsController::class, 'get_ajax_areas'])->name('get_ajax_areas');

        Route::get('/site_data', [GeneralSettingsController::class, 'siteData'])->name('siteData');
        Route::get('/site_data/edit/{id}', [GeneralSettingsController::class, 'edit_siteData'])->name('edit_siteData');
        Route::post('/site_data/create', [GeneralSettingsController::class, 'save_siteData'])->name('save_siteData');
        Route::get('/get_ajax_siteData', [GeneralSettingsController::class, 'get_ajax_siteData'])->name('get_ajax_siteData');

        Route::get('/Employees', [EmployeesController::class, 'index'])->name('employee_data');
        Route::get('/get_ajax_employee', [EmployeesController::class, 'get_ajax_employee'])->name('get_ajax_employee');
        Route::get('/add_employee', [EmployeesController::class, 'add_employee'])->name('add_employee');
        Route::get('/edit_employee/{id}', [EmployeesController::class, 'edit_employee'])->name('edit_employee');
        Route::post('/update_employee/{id}', [EmployeesController::class, 'update_employee'])->name('update_employee');
        Route::post('/save_employee', [EmployeesController::class, 'save_employee'])->name('save_employee');
        Route::get('/employee_files/{id}', [EmployeesController::class, 'employee_files'])->name('employee_files');
        Route::get('/employee_details/{id}', [EmployeesController::class, 'employee_details'])->name('employee_details');

        Route::post('/employee_add_files/{id}', [EmployeesController::class, 'employee_add_files'])->name('employee_add_files');
        Route::get('/employee_read_file/{id}', [EmployeesController::class, 'read_file'])->name('employee_read_file');
        Route::get('/employee_download_file/{id}/{file?}', [EmployeesController::class,'download_file'])->name('employee_download_file');
        Route::get('/employee_delete_file/{id}', [EmployeesController::class, 'delete_file'])->name('employee_delete_file');
        Route::get('/get_area/{id}', [GeneralSettingsController::class, 'get_area_list'])->name('get_area');


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
