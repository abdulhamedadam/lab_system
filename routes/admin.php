<?php

use App\Http\Controllers\Admin\app_setting\NotificationController;
use App\Http\Controllers\Admin\app_setting\DiscountController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\EmployeesController;

use App\Http\Controllers\Admin\GeneralSettingsController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


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
        Route::get('delete/{id}',[ClientController::class,'destroy'])->name('delete_client');
        /********************************************************************************************************************************/
        Route::get('clients/{id}/companies',[ClientController::class,'companies'])->name('client_companies');
        Route::post('clients/{id}/companies/save',[ClientController::class,'store_company'])->name('client_store_company');
        Route::get('clients/companies/edit/{id}',[ClientController::class,'edit_company'])->name('client_edit_company');
        Route::post('clients/companies/update/{id}',[ClientController::class,'update_company'])->name('client_update_company');
        Route::get('clients/companies/delete/{id}',[ClientController::class,'delete_company'])->name('client_delete_company');
        /********************************************************************************************************************************/
        Route::get('clients/{id}/projects',[ClientController::class,'projects'])->name('client_projects');
        Route::post('clients/{id}/projects/save',[ClientController::class,'store_project'])->name('client_store_project');
        Route::get('clients/projects/edit/{id}',[ClientController::class,'edit_project'])->name('client_edit_project');
        Route::post('clients/projects/update/{id}',[ClientController::class,'update_project'])->name('client_update_project');
        Route::get('clients/projects/delete/{id}',[ClientController::class,'delete_project'])->name('client_delete_project');
        /********************************************************************************************************************************/
        Route::resource('company',\App\Http\Controllers\Admin\CompanyController::class);
        Route::get('company/delete/{id}',[\App\Http\Controllers\Admin\CompanyController::class,'destroy'])->name('delete_company');
        /********************************************************************************************************************************/
        Route::resource('project',\App\Http\Controllers\Admin\ProjectController::class);
        Route::get('project/delete/{id}',[\App\Http\Controllers\Admin\ProjectController::class,'destroy'])->name('delete_project');
        Route::get('get_company/{id}',[\App\Http\Controllers\Admin\ProjectController::class,'get_company'])->name('get_company');
        /********************************************************************************************************************************/
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



    require __DIR__ . '/adminauth.php';
});
