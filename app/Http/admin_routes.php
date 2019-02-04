<?php

/* ================== Homepage ================== */

Route::auth();

/* ================== Access Uploaded Files ================== */
Route::get('files/{hash}/{name}', 'LA\UploadsController@get_file');

/*
|--------------------------------------------------------------------------
| Admin Application Routes
|--------------------------------------------------------------------------
*/

$as = "";
if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
	$as = config('laraadmin.adminRoute').'.';
	
	// Routes for Laravel 5.3
	Route::get('/logout', 'Auth\LoginController@logout');
}

Route::group(['as' => $as, 'middleware' => ['auth', 'permission:ADMIN_PANEL']], function () {
	
	/* ================== Dashboard ================== */
	
	Route::get(config('laraadmin.adminRoute'), 'LA\DashboardController@index');
	Route::get(config('laraadmin.adminRoute'). '/dashboard', 'LA\DashboardController@index');
	
	/* ================== Users ================== */
	Route::resource(config('laraadmin.adminRoute') . '/users', 'LA\UsersController');
	Route::get(config('laraadmin.adminRoute') . '/user_dt_ajax', 'LA\UsersController@dtajax');

	Route::get(config('laraadmin.adminRoute') . '/drop/{id}', 'LA\UsersController@delete');
	Route::get(config('laraadmin.adminRoute') . '/ban/{id}', 'LA\UsersController@ban');
	Route::get(config('laraadmin.adminRoute') . '/unban/{id}', 'LA\UsersController@unban');

	
	/* ================== Uploads ================== */
	Route::resource(config('laraadmin.adminRoute') . '/uploads', 'LA\UploadsController');
	Route::post(config('laraadmin.adminRoute') . '/upload_files', 'LA\UploadsController@upload_files');
	Route::get(config('laraadmin.adminRoute') . '/uploaded_files', 'LA\UploadsController@uploaded_files');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_caption', 'LA\UploadsController@update_caption');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_filename', 'LA\UploadsController@update_filename');
	Route::post(config('laraadmin.adminRoute') . '/uploads_update_public', 'LA\UploadsController@update_public');
	Route::post(config('laraadmin.adminRoute') . '/uploads_delete_file', 'LA\UploadsController@delete_file');
	
	/* ================== Roles ================== */
	Route::resource(config('laraadmin.adminRoute') . '/roles', 'LA\RolesController');
	Route::get(config('laraadmin.adminRoute') . '/role_dt_ajax', 'LA\RolesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_module_role_permissions/{id}', 'LA\RolesController@save_module_role_permissions');
	
	/* ================== Permissions ================== */
	Route::resource(config('laraadmin.adminRoute') . '/permissions', 'LA\PermissionsController');
	Route::get(config('laraadmin.adminRoute') . '/permission_dt_ajax', 'LA\PermissionsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/save_permissions/{id}', 'LA\PermissionsController@save_permissions');
	
	/* ================== Departments ================== */
	Route::resource(config('laraadmin.adminRoute') . '/departments', 'LA\DepartmentsController');
	Route::get(config('laraadmin.adminRoute') . '/department_dt_ajax', 'LA\DepartmentsController@dtajax');
	
	/* ================== Employees ================== */
	Route::resource(config('laraadmin.adminRoute') . '/employees', 'LA\EmployeesController');
	Route::get(config('laraadmin.adminRoute') . '/employee_dt_ajax', 'LA\EmployeesController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/change_password/{id}', 'LA\EmployeesController@change_password');
	
	/* ================== Organizations ================== */
	Route::resource(config('laraadmin.adminRoute') . '/organizations', 'LA\OrganizationsController');
	Route::get(config('laraadmin.adminRoute') . '/organization_dt_ajax', 'LA\OrganizationsController@dtajax');

	/* ================== Backups ================== */
	Route::resource(config('laraadmin.adminRoute') . '/backups', 'LA\BackupsController');
	Route::get(config('laraadmin.adminRoute') . '/backup_dt_ajax', 'LA\BackupsController@dtajax');
	Route::post(config('laraadmin.adminRoute') . '/create_backup_ajax', 'LA\BackupsController@create_backup_ajax');
	Route::get(config('laraadmin.adminRoute') . '/downloadBackup/{id}', 'LA\BackupsController@downloadBackup');


	/* ================== Cities ================== */
	Route::resource(config('laraadmin.adminRoute') . '/cities', 'LA\CitiesController');
	Route::get(config('laraadmin.adminRoute') . '/city_dt_ajax', 'LA\CitiesController@dtajax');


	/* ================== Reviews ================== */
	Route::resource(config('laraadmin.adminRoute') . '/reviews', 'LA\ReviewsController');
	Route::get(config('laraadmin.adminRoute') . '/review_dt_ajax', 'LA\ReviewsController@dtajax');

	/* ================== Clients ================== */
	Route::resource(config('laraadmin.adminRoute') . '/clients', 'LA\ClientsController');
	Route::get(config('laraadmin.adminRoute') . '/client_dt_ajax', 'LA\ClientsController@dtajax');

	/* ================== Statuses ================== */
	Route::resource(config('laraadmin.adminRoute') . '/statuses', 'LA\StatusesController');
	Route::get(config('laraadmin.adminRoute') . '/status_dt_ajax', 'LA\StatusesController@dtajax');

	/* ================== Comments ================== */
	Route::resource(config('laraadmin.adminRoute') . '/comments', 'LA\CommentsController');
	Route::get(config('laraadmin.adminRoute') . '/comment_dt_ajax', 'LA\CommentsController@dtajax');

	/* ================== Personal_statuses ================== */
	Route::resource(config('laraadmin.adminRoute') . '/personal_statuses', 'LA\Personal_statusesController');
	Route::get(config('laraadmin.adminRoute') . '/personal_status_dt_ajax', 'LA\Personal_statusesController@dtajax');

	/* ================== SendStatuses ================== */
	Route::resource(config('laraadmin.adminRoute') . '/sendstatuses', 'LA\SendStatusesController');
	Route::get(config('laraadmin.adminRoute') . '/sendstatus_dt_ajax', 'LA\SendStatusesController@dtajax');
});
