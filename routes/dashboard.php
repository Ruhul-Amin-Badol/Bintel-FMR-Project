<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\BatchVisitingReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\InstitutionVisitingReportController;
use App\Http\Controllers\LibraryReportController;
use App\Http\Controllers\LibraryVisitingReportController;
use App\Http\Controllers\OfficersController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RecordsController;
use App\Http\Controllers\SmsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
|Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::prefix('dashboard')->middleware('auth', 'admin')->group(function () {

    /* Common Route */

    Route::get('/', [DashboardController::class, 'home']);
    Route::get('/home', [DashboardController::class, 'home'])->name("dash.home");
    Route::get('/profile', [DashboardController::class, 'profile'])->name("dash.profile");
    Route::post('/profile/update/image', [DashboardController::class, 'update_image'])->name("dash.profile.update.image");
    Route::post('/profile/update/profile', [DashboardController::class, 'update_profile'])->name("dash.profile.update.profile");

    /* Restricted Route */
    Route::get('/setting', [DashboardController::class, 'setting'])->middleware('HasAccess')->name("dash.setting");
    Route::post('/setting/save', [DashboardController::class, 'settingStore'])->middleware('HasAccess')->name("dash.setting.store");
    Route::post('/setting/new', [DashboardController::class, 'settingStoreNew'])->middleware('HasAccess')->name("dash.setting.new");

    /* Admin Route */
    Route::get('/admin-list', [DashboardController::class, 'admin_list'])->middleware('HasAccess')->name("dash.admin.list");
    Route::get('/admin-new', [DashboardController::class, 'admin_new'])->middleware('HasAccess')->name("dash.admin.new");
    Route::get('/admin/delete/{id}', [DashboardController::class, 'delete_admin'])->middleware('HasAccess')->name("dash.admin.delete");
    Route::get('/admin/edit/{id}', [DashboardController::class, 'edit_admin'])->middleware('HasAccess')->name("dash.admin.edit");
    Route::post('/admin/edit/{id}', [DashboardController::class, 'edit_admin_Action'])->middleware('HasAccess')->name("dash.profile.update.profile.action");
    Route::post('/admin/status/update', [AjaxController::class, 'change_admin_status'])->middleware('HasAccess')->name("dash.profile.update.status");
    Route::post('/admin/new', [DashboardController::class, 'admin_new_Action'])->middleware('HasAccess')->name("dash.admin.new.action");

    /* Officer Route */
    Route::get('/officers-list', [OfficersController::class, 'officers_list'])->middleware('HasAccess')->name("officers.list");
    Route::get('/officers-new', [OfficersController::class, 'officers_new'])->middleware('HasAccess')->name("officers.new");
    Route::post('/officers/get', [OfficersController::class, 'officersAjax'])->middleware('HasAccess')->name("officers.ajax");
    Route::get('/officers/delete/{id}', [OfficersController::class, 'delete_officers'])->middleware('HasAccess')->name("officers.delete");
    Route::get('/officers/edit/{id}', [OfficersController::class, 'edit_officers'])->middleware('HasAccess')->name("officers.edit");
    Route::post('/officers/edit/{id}', [OfficersController::class, 'edit_officers_Action'])->middleware('HasAccess')->name("officers_profile.update.profile.action");
    Route::post('/officers/status/update', [AjaxController::class, 'change_officers_status'])->middleware('HasAccess')->name("officers_profile.update.status");
    Route::post('/officers/new', [OfficersController::class, 'officers_new_Action'])->middleware('HasAccess')->name("officers.new.action");

    /* Daily Records */

    Route::get('/records-list', [RecordsController::class, 'records_list'])->middleware('HasAccess')->name("records.list");
    Route::get('/records-new', [RecordsController::class, 'records_new'])->middleware('HasAccess')->name("records.new");
    Route::post('/records/get', [RecordsController::class, 'recordsAjax'])->middleware('HasAccess')->name("records.ajax");

    Route::get('/records-date', [RecordsController::class, 'records_list_by_date'])->middleware('HasAccess')->name('records.list.by.date');
    Route::get('/records/delete/{id}', [RecordsController::class, 'delete_records'])->middleware('HasAccess')->name("records.delete");
    Route::get('/records/edit/{id}', [RecordsController::class, 'edit_records'])->middleware('HasAccess')->name("records.edit");
    Route::post('/records/edit/{id}', [RecordsController::class, 'edit_records_Action'])->middleware('HasAccess')->name("records_profile.update.profile.action");
    Route::post('/records/new', [RecordsController::class, 'records_new_Action'])->middleware('HasAccess')->name("records.new.action");
    Route::post('/records/newAjax', [RecordsController::class, 'records_new_Ajax'])->middleware('HasAccess')->name("records.new.ajax");

    /* Daily Expenses */

//     Route::get('/expense-report', 'App\Http\Controllers\ExpenseReportController@showExpenseReport');
// Route::post('/expense-report', 'App\Http\Controllers\ExpenseReportController@generateReport')->name('expense-report.generate');

    Route::get('/expenses-list', [ExpensesController::class, 'expenses_list'])->middleware('HasAccess')->name("expenses.list");
    Route::get('/monthly-report', [ExpensesController::class, 'monthlyReport'])->middleware('HasAccess')->name("monthly.report");
    // Route::get('/monthly-report-list',[ExpensesController::class,'monthly_Report_list'])->middleware('HasAccess')->name("monthly.report.list");
    Route::get('/expenses-new', [ExpensesController::class, 'expenses_new'])->middleware('HasAccess')->name("expenses.new");

    Route::get('/expenses-date', [ExpensesController::class, 'expenses_list_by_date'])->middleware('HasAccess')->name('expenses.list.by.date');
    Route::post('/expenses/get', [ExpensesController::class, 'expensesAjax'])->middleware('HasAccess')->name("expenses.ajax");
    Route::get('/monthly/report', [ExpensesController::class, 'monthly_Report_Ajax'])->middleware('HasAccess')->name("monthly.report.ajax");
    Route::get('/expenses/delete/{id}', [ExpensesController::class, 'delete_expenses'])->middleware('HasAccess')->name("expenses.delete");
    Route::get('/expenses/edit/{id}', [ExpensesController::class, 'edit_expenses'])->middleware('HasAccess')->name("expenses.edit");
    Route::post('/expenses/edit/{id}', [ExpensesController::class, 'edit_expenses_Action'])->middleware('HasAccess')->name("expenses_profile.update.profile.action");
    Route::post('/expenses/new', [ExpensesController::class, 'expenses_new_Action'])->middleware('HasAccess')->name("expenses.new.action");
    Route::post('/expenses/newAjax', [ExpensesController::class, 'expenses_new_Ajax'])->middleware('HasAccess')->name("expenses.new.ajax");

    Route::get('/expenses-report/edit/{id}', [ExpensesController::class, 'edit_expenses_report'])->middleware('HasAccess')->name("expenses.report.edit");
    Route::post('/expenses-report/edit', [ExpensesController::class, 'edit_expenses_report_Action'])->middleware('HasAccess')->name("expenses.report.update.action");
    Route::get('/expenses-report/delete/{id}', [ExpensesController::class, 'delete_expenses_report'])->middleware('HasAccess')->name("expenses.report.delete");

    /* Roles and Permission */
    Route::get('/permissions', [PermissionController::class, 'index'])->middleware('HasAccess')->name("permission.index");
    Route::post('/permission/index', [PermissionController::class, 'store'])->middleware('HasAccess')->name("permission.store");
    Route::get('/routes', [AjaxController::class, 'route_list'])->middleware('HasAccess')->name("permission.routes");
    Route::get('/permissions/delete-all', [PermissionController::class, 'destroyALL'])->middleware('HasAccess')->name("permission.destroy.all");
    Route::get('/permissions/delete/{id}', [PermissionController::class, 'destroy'])->middleware('HasAccess')->name("permission.destroy");
    Route::get('/permissions/edit/{id}', [PermissionController::class, 'update'])->middleware('HasAccess')->name("permission.update");
    Route::post('/permissions/edit/{id}', [PermissionController::class, 'updateAction'])->middleware('HasAccess')->name("permission.update.store");

    Route::get('/roles', [PermissionController::class, 'roles_index'])->middleware('HasAccess')->name("roles.index");
    Route::post('/roles/save', [PermissionController::class, 'roles_store'])->middleware('HasAccess')->name("roles.store");
    Route::get('/roles/delete-all', [PermissionController::class, 'roles_destroyALL'])->middleware('HasAccess')->name("roles.destroy.all");
    Route::get('/roles/delete/{id}', [PermissionController::class, 'roles_destroy'])->middleware('HasAccess')->name("roles.destroy");
    Route::get('/roles/edit/{id}', [PermissionController::class, 'roles_update'])->middleware('HasAccess')->name("roles.update");
    Route::post('/roles/edit/{id}', [PermissionController ::class, 'roles_updateAction'])->middleware('HasAccess')->name("roles.update.store");

    // Upload Csv
    Route::post('/csv/upload', [SmsController::class, 'csv'])->middleware('HasAccess')->name("csv");

    // library visiting report
    Route::get('/library-visit', [LibraryReportController::class, 'LibraryReport'])->name("library.visit");
    Route::post('/library-visit/new', [LibraryReportController::class, 'Library_visit_new_Action'])->middleware('HasAccess')->name("library.visit.new.action");

    Route::get('/library-list', [LibraryReportController::class, 'library_list'])->middleware('HasAccess')->name("library.list");
    Route::get('/library-visit/edit/{id}', [LibraryReportController::class, 'edit_library_visit'])->middleware('HasAccess')->name("library.visit.edit");
    Route::post('/library-visit/edit/{id}', [LibraryReportController::class, 'edit_library_visit_Action'])->middleware('HasAccess')->name("library.visit.edit.action");
    Route::get('/library-visit/delete/{id}', [LibraryReportController::class, 'delete_library_visit'])->middleware('HasAccess')->name("delete.library.visit");

    Route::get('/get-division', [LibraryReportController::class, 'getDivision'])->name('get.division');
    Route::get('/get-districts', [LibraryReportController::class, 'getDistricts'])->name('get.districts');
    Route::get('/get-upazilas', [LibraryReportController::class, 'getUpazilas'])->name('get.upazilas');

    /**
     * Display all visiting reports route start.
     */

    //Admin library visiting report //--Ruhul Amin

    // Fetch districts and upazilas based on division ID and district ID
    Route::get('/get-districts/{divisionId}', [LibraryVisitingReportController::class, 'getDistricts'])->name('get.districts');
    Route::get('/get-upazilas/{districtId}', [LibraryVisitingReportController::class, 'getUpazilas'])->name('get.upazilas');

    Route::get('/library-visiting-list', [LibraryVisitingReportController::class, 'index'])->middleware('HasAccess')->name('library.show-list');
    Route::post('/library-list-ajax', [LibraryVisitingReportController::class, 'libraryList'])->name('library.list-ajax');
    Route::get('/library-visiting-list/{id}', [LibraryVisitingReportController::class, 'show'])->middleware('HasAccess')->name('library.visiting-list.show');
    Route::get('/library-visiting-list/edit/{id}', [LibraryVisitingReportController::class, 'edit'])->middleware('HasAccess')->name('library.visiting-list.edit');
    Route::post('/library-visiting-list/{id}', [LibraryVisitingReportController::class, 'update'])->middleware('HasAccess')->name('library.visiting-list.update');
    Route::get('/library-visiting-list/{id}', [LibraryVisitingReportController::class, 'destroy'])->middleware('HasAccess')->name('library.visiting-list.destroy');

    //Admin batch visiting report
    Route::get('batch-visiting-reports', [BatchVisitingReportController::class, 'index'])->middleware('HasAccess')->middleware('HasAccess')->name('batch.visiting.index');
    Route::post('batch-visiting-reports', [BatchVisitingReportController::class, 'batchList'])->middleware('HasAccess')->middleware('HasAccess')->name('batch.visiting.ajax');
    Route::get('batch-visiting-reports/{id}/edit', [BatchVisitingReportController::class, 'edit'])->middleware('HasAccess')->middleware('HasAccess')->name('batch.visiting.edit');
    Route::post('batch-visiting-reports/{id}/update', [BatchVisitingReportController::class, 'update'])->middleware('HasAccess')->middleware('HasAccess')->name('batch.visiting.update');
    Route::get('batch-visiting-reports/{id}', [BatchVisitingReportController::class, 'destroy'])->middleware('HasAccess')->middleware('HasAccess')->name('batch.visiting.destroy');
    Route::get('get-districts/{divisionId}', [BatchVisitingReportController::class, 'getDistricts']);
    Route::get('get-upazilas/{districtId}', [BatchVisitingReportController::class, 'getUpazilas']);

    //admin institution visiting report route
    Route::get('/index', [InstitutionVisitingReportController::class, 'index'])->middleware('HasAccess')->name('institution.visiting.index');
    Route::post('/index', [InstitutionVisitingReportController::class, 'institutionList'])->middleware('HasAccess')->name('institution.visiting.ajax');
    Route::get('/edit/{id}', [InstitutionVisitingReportController::class, 'edit'])->middleware('HasAccess')->name('institution.visiting.edit');
    Route::post('/update/{id}', [InstitutionVisitingReportController::class, 'update'])->middleware('HasAccess')->name('institution.visiting.update');
    Route::get('/destroy/{id}', [InstitutionVisitingReportController::class, 'destroy'])->middleware('HasAccess')->name('institution.visiting.destroy');
    Route::get('get-districts/{divisionId}', [InstitutionVisitingReportController::class, 'getDistricts']);
    Route::get('get-upazilas/{districtId}', [InstitutionVisitingReportController::class, 'getUpazilas']);

    /**
     * Display all visiting reports route end.
     */

});
