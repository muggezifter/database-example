<?php

namespace WordpressDB;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model {
	// set table name
	protected $table = 'wp_usermeta';
	// don't use eloquent default timestamps
	public $timestamps = false;

    // define many-to-one relation with user
	public function user() {
		return $this->belongsTo('User','user_id','ID');
	}	
}