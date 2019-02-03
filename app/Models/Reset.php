<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reset extends Model
{
	
	protected $table = 'password_resets';

	public $primaryKey = 'email';
	public $incrementing = false;
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['created_at'];
}
