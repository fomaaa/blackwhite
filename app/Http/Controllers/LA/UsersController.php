<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Models\ModuleFields;
use Dwij\Laraadmin\Helpers\LAHelper;

use App\User;
use App\Role;

class UsersController extends Controller
{
	public $show_action = false;
	public $view_col = 'name';
	public $listing_cols = ['id', 'name', 'type', 'is_ban'];
	
	public function __construct() {
		// Field Access of Listing Columns
		if(\Dwij\Laraadmin\Helpers\LAHelper::laravel_ver() == 5.3) {
			$this->middleware(function ($request, $next) {
				$this->listing_cols = ModuleFields::listingColumnAccessScan('Users', $this->listing_cols);
				return $next($request);
			});
		} else {
			$this->listing_cols = ModuleFields::listingColumnAccessScan('Users', $this->listing_cols);
		}
	}
	
	/**
	 * Display a listing of the Users.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$module = Module::get('Users');
		
		if(Module::hasAccess($module->id)) {
			return View('la.users.index', [
				'show_actions' => $this->show_action,
				'listing_cols' => $this->listing_cols,
				'module' => $module
			]);
		} else {
            return redirect(config('laraadmin.adminRoute')."/");
        }
	}

	/**
	 * Display the specified user.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		if(Module::hasAccess("Users", "view")) {
			$user = User::findOrFail($id);
			if(isset($user->id)) {
				if($user['type'] == "Employee") {
					return redirect(config('laraadmin.adminRoute') . '/employees/'.$user->id);
				} else if($user['type'] == "Client") {
					return redirect(config('laraadmin.adminRoute') . '/clients/'.$user->id);
				}
			} else {
				return view('errors.404', [
					'record_id' => $id,
					'record_name' => ucfirst("user"),
				]);
			}
		} else {
			return redirect(config('laraadmin.adminRoute')."/");
		}
	}
	public function store (Request $request) {

			$rules = Module::validateRules("Users", $request);
			
			$validator = Validator::make($request->all(), $rules);
			
			if ($validator->fails()) {
				return redirect()->back()->withErrors($validator)->withInput();
			}
			
			// generate password
			$password = LAHelper::gen_password();
			// Create User
			$user = User::create([
				'name' => $request->name,
				'email' => 'fake@fake.r' . rand(0, 22222),
				'password' => bcrypt($request->password),
				'type' => $request->type,
			]);

			$user->detachRoles();
			$role = Role::find(2);
			$user->attachRole($role);

			$now = date("Y-m-d H:i:s");
			if ($request->type == 'Admin') {
				DB::insert('insert into role_user (role_id, user_id) values (2, '. $user->id .')'); 
			}

			return redirect()->route(config('laraadmin.adminRoute') . '.users.index');
	}
	
	/**
	 * Datatable Ajax fetch
	 *
	 * @return
	 */
	public function dtajax()
	{
		$values = DB::table('users')->select($this->listing_cols)->whereNull('deleted_at');
		$out = Datatables::of($values)->make();
		$data = $out->getData();

		$fields_popup = ModuleFields::getModuleFields('Users');
		
		for($i=0; $i < count($data->data); $i++) {
			for ($j=0; $j < count($this->listing_cols); $j++) { 
				$col = $this->listing_cols[$j];
				if($fields_popup[$col] != null && starts_with($fields_popup[$col]->popup_vals, "@")) {
					$data->data[$i][$j] = ModuleFields::getFieldValue($fields_popup[$col], $data->data[$i][$j]);
				}
				if($col == $this->view_col) {
					$data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/users/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
				}
				// else if($col == "author") {
				//    $data->data[$i][$j];
				// }
			}
			$output = '';
			
			if(Auth::user()->type == "SuperAdmin") {
				
				$output .= ' <a href="/admin/drop/'. $data->data[$i][0] .'" class="btn btn-danger btn-xs  act-btn" type="submit"><i class="fa fa-times"></i></a>';
				
			} 

			$output .= ' <a href="/admin/ban/'. $data->data[$i][0] .'" class="btn btn-warning btn-xs  act-btn" type="submit"><i class="fa fa-ban"></i></a>';
			$data->data[$i][] = (string)$output;
		}
		$out->setData($data);
		return $out;
	}
}
