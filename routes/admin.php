<?php

use App\Http\Controllers\Admin\AllTestsController;
use App\Http\Controllers\Admin\app_setting\NotificationController;
use App\Http\Controllers\Admin\app_setting\DiscountController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ConfigAppController;
use App\Http\Controllers\Admin\EmployeesController;

use App\Http\Controllers\Admin\Finance\AccountsController;
use App\Http\Controllers\Admin\Finance\ReceiptVoucherController;
use App\Http\Controllers\Admin\GeneralSettingsController;
use App\Http\Controllers\Admin\MasrofatController;
use App\Http\Controllers\Admin\Payments\DuesController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SoilEarthTestController;
use App\Http\Controllers\Admin\SoilHasaTestsController;
use App\Http\Controllers\Admin\SoilTestController;
use App\Http\Controllers\Admin\TestsController;
use App\Http\Controllers\Admin\UsersController;
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
    ],
    function () {


        Route::group(['middleware' => ['auth:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
            Route::get('/dashboard', function () {
                return view('dashbord.home');
            })->name('dashboard');

            Route::get('/test', function () {
                return ' test admin ';
            });

            Route::resource('clients', ClientController::class);
            Route::get('delete/{id}', [ClientController::class, 'destroy'])->name('delete_client');
            /********************************************************************************************************************************/
            Route::get('clients/{id}/companies', [ClientController::class, 'companies'])->name('client_companies');
            Route::post('clients/{id}/companies/save', [ClientController::class, 'store_company'])->name('client_store_company');
            Route::get('clients/companies/edit/{id}', [ClientController::class, 'edit_company'])->name('client_edit_company');
            Route::post('clients/companies/update/{id}', [ClientController::class, 'update_company'])->name('client_update_company');
            Route::get('clients/companies/delete/{id}', [ClientController::class, 'delete_company'])->name('client_delete_company');
            /********************************************************************************************************************************/
            Route::get('clients/{id}/projects', [ClientController::class, 'projects'])->name('client_projects');
            Route::post('clients/{id}/projects/save', [ClientController::class, 'store_project'])->name('client_store_project');
            Route::get('clients/projects/edit/{id}', [ClientController::class, 'edit_project'])->name('client_edit_project');
            Route::post('clients/projects/update/{id}', [ClientController::class, 'update_project'])->name('client_update_project');
            Route::get('clients/projects/delete/{id}', [ClientController::class, 'delete_project'])->name('client_delete_project');
            /********************************************************************************************************************************/
            Route::resource('company', CompanyController::class);
            Route::get('company/delete/{id}', [CompanyController::class, 'destroy'])->name('delete_company');
            /********************************************************************************************************************************/
            Route::get('company/{id}/projects', [CompanyController::class, 'projects'])->name('company_projects');
            Route::post('company/{id}/projects/save', [CompanyController::class, 'store_project'])->name('company_store_project');
            Route::get('company/projects/edit/{id}', [CompanyController::class, 'edit_project'])->name('company_edit_project');
            Route::post('company/projects/update/{id}', [CompanyController::class, 'update_project'])->name('company_update_project');
            Route::get('company/projects/delete/{id}', [CompanyController::class, 'delete_project'])->name('company_delete_project');
            Route::get('');
            /********************************************************************************************************************************/
            Route::resource('project', ProjectController::class);
            Route::get('project/delete/{id}', [ProjectController::class, 'destroy'])->name('delete_project');
            Route::get('get_company/{id}', [ProjectController::class, 'get_company'])->name('get_company');
            /********************************************************************************************************************************/
            /************************** MAINDATA *****************************/
            // Route::resource('mdata', MaindataController::class);
            /************************** About *****************************/
            // Route::resource('about', AboutController::class);
            // Route::get('about/show_load/{id}', [AboutController::class, 'show_load'])->name('about.load_details');

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
            Route::get('/employee_download_file/{id}/{file?}', [EmployeesController::class, 'download_file'])->name('employee_download_file');
            Route::get('/employee_delete_file/{id}', [EmployeesController::class, 'delete_file'])->name('employee_delete_file');
            Route::get('/get_area/{id}', [GeneralSettingsController::class, 'get_area_list'])->name('get_area');

            Route::get('/sarf_bands', [GeneralSettingsController::class, 'sarf_bands'])->name('sarf_bands');
            Route::post('/sarf_band/create', [GeneralSettingsController::class, 'add_sarf_band'])->name('add_sarf_band');
            Route::get('/sarf_band/edit/{id}', [GeneralSettingsController::class, 'edit_sarf_band'])->name('edit_sarf_band');
            Route::get('/sarf_band/delete/{id}', [GeneralSettingsController::class, 'delete_sarf_band'])->name('delete_sarf_band');
            Route::get('/get_ajax_sarf_bands', [GeneralSettingsController::class, 'get_ajax_sarf_bands'])->name('get_ajax_sarf_bands');

            Route::resource('masrofat', MasrofatController::class);
            Route::get('masrofat/delete/{id}', [MasrofatController::class, 'destroy'])->name('delete_masrofat');

            Route::resource('test', TestsController::class);
            Route::get('tests/delete/{id}', [TestsController::class, 'destroy'])->name('delete_test');
            Route::get('tests/samples_test/{id}', [TestsController::class, 'samples_test'])->name('samples_test');
            Route::post('tests/save_compaction_test/{id}', [TestsController::class, 'save_compaction_test'])->name('save_compaction_test');
            Route::get('tests/soil_sample_report_details/{id}', [TestsController::class, 'soil_sample_report_details'])->name('soil_sample_report_details');
            Route::get('tests/print_soil_sample_report/{id}', [TestsController::class, 'print_soil_sample_report'])->name('print_soil_sample_report');

            /*************************************************************************************************/
            Route::get('setting/app_config', [ConfigAppController::class, 'index'])->name('app_config');
            Route::post('setting/app_config/save', [ConfigAppController::class, 'store'])->name('save_app_config');

            Route::resource('users', UsersController::class);
            Route::get('user/delete/{id}', [UsersController::class, 'destroy'])->name('delete_user');
            Route::get('users/change_status/{id}/{status}', [UsersController::class, 'change_status'])->name('change_status');

            Route::get('admin/users/{user}/permissions', [UsersController::class, 'permissions'])->name('users.permissions');
            Route::post('admin/users/{user}/permissions', [UsersController::class, 'updatePermissions'])->name('users.update_permissions');

            /**********************************************************************************************************/
            //all_test
            Route::get('all-tests', [AllTestsController::class, 'index'])->name('all_tests');
            Route::get('soil_test/{type?}/{test?}', [SoilTestController::class, 'index'])->name('soil_test');
            Route::get('soil_test/create/{type?}/{test?}', [SoilTestController::class, 'create'])->name('create_soil_test');
            Route::get('soil_test/edit/{id}/{type?}/{test?}', [SoilTestController::class, 'edit'])->name('edit_soil_test');
            Route::post('soil_test/save/{type?}/{test?}', [SoilTestController::class, 'store'])->name('store_soil_test');
            Route::post('soil_test/update/{id}/{type?}/{test?}', [SoilTestController::class, 'update'])->name('update_soil_test');

            //soil_test
            Route::get('soil_test/soil/compaction/', [SoilTestController::class, 'soil_compaction_index'])->name('soil_compaction_soil_test');
            Route::get('soil_test/soil/compaction/create/', [SoilTestController::class, 'soil_compaction_create'])->name('soil_compaction_create_soil_test');
            Route::get('soil_test/soil/compaction/edit/{id}/', [SoilTestController::class, 'soil_compaction_edit'])->name('soil_compaction_edit_soil_test');
            Route::post('soil_test/soil/compaction/save/', [SoilTestController::class, 'soil_compaction_store'])->name('soil_compaction_store_soil_test');
            Route::post('soil_test/soil/compaction/update/{id}/', [SoilTestController::class, 'soil_compaction_update'])->name('soil_compaction_update_soil_test');
            //hasa_test
            Route::get('soil_test/hasa/compaction/', [SoilTestController::class, 'hasa_compaction_index'])->name('hasa_compaction_soil_test');
            Route::get('soil_test/hasa/compaction/create/', [SoilTestController::class, 'hasa_compaction_create'])->name('hasa_compaction_create_soil_test');
            Route::get('soil_test/hasa/compaction/edit/{id}/', [SoilTestController::class, 'hasa_compaction_edit'])->name('hasa_compaction_edit_soil_test');
            Route::post('soil_test/hasa/compaction/save/', [SoilTestController::class, 'hasa_compaction_store'])->name('hasa_compaction_store_soil_test');
            Route::post('soil_test/hasa/compaction/update/{id}/', [SoilTestController::class, 'hasa_compaction_update'])->name('hasa_compaction_update_soil_test');

            Route::get('soil_test/{id}/hasa/compaction', [SoilHasaTestsController::class, 'compaction_test'])->name('hasa_compaction_test');
            Route::post('soil_test/{id}/hasa/compaction', [SoilHasaTestsController::class, 'save_compaction_test'])->name('save_hasa_compaction_test');
            Route::get('soil_test/{id}/hasa/compaction/details', [SoilHasaTestsController::class, 'hasa_compaction_test_details'])->name('hasa_compaction_test_details');
            Route::get('soil_test/{id}/hasa/compaction/print', [SoilHasaTestsController::class, 'print_compaction_test'])->name('print_compaction_test');

            Route::get('soil_test/{id}/earthy/compaction', [SoilEarthTestController::class, 'compaction_test'])->name('earth_compaction_test');
            Route::post('soil_test/{id}/earthy/compaction', [SoilEarthTestController::class, 'save_compaction_test'])->name('save_earth_compaction_test');
            Route::get('soil_test/{id}/earthy/compaction/details', [SoilEarthTestController::class, 'compaction_test_details'])->name('earth_compaction_test_details');
            Route::get('soil_test/{id}/earthy/compaction/print', [SoilEarthTestController::class, 'print_compaction_test'])->name('print_earth_compaction_test');
            Route::get('tests/soil/test_dues/{id}', [SoilTestController::class, 'test_dues'])->name('test_dues');
            /**********************************************************************************************************/
            Route::group(['prefix' => 'Finance', 'as' => 'finance.'], function () {
                Route::resource('accounts', AccountsController::class);
                Route::resource('Receipt_Voucher', ReceiptVoucherController::class);
            });
            /**********************************************************************************************************/

            Route::group(['prefix' => 'Payment', 'as' => 'payment.'], function () {
                Route::resource('dues', DuesController::class);
                Route::get('dues/payment/{id}', [DuesController::class, 'pay_dues'])->name('pay_dues');
                Route::post('dues/payment/{id}', [DuesController::class, 'save_pay_dues'])->name('save_pay_dues');
            });
            Route::get('/admin/get-invoice/{id}', [DuesController::class, 'getInvoiceForPrint'])->name('get_invoice');
        });
    }
);


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {



        require __DIR__ . '/adminauth.php';
    }
);
