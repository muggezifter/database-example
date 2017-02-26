<?php

namespace Wordpress;

use Illuminate\Database\Eloquent\Model;

class Usermeta extends Model {
	protected $table = 'wp_usermeta';
	public $timestamps = false;

	public function user() {
		return $this->belongsTo('Wordpress\User','user_id','ID');
	}
	
}