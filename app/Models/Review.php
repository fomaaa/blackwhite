<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;
	
	protected $table = 'reviews';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];

	public function images($width = null, $height = null)
    {
        $data = json_decode($this->photos);
        $files    = Upload::whereIn('id', $data)->orderBy('id', 'desc')->get();
        $result = [];

        foreach ($files as $file) {
            $url = "/files/{$file->hash}/{$file->name}";
            if ($width && $height) {
                $url .= "?w={$width}&h={$height}";
            }

            $result[] = $url;
        }

        return $result;
    }
}
