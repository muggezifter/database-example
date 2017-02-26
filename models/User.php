<?php

namespace Wordpress;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
	// set table name
	protected $table = 'wp_users';
	// define custom attributes
	protected $appends = ['nickname'];
	// don't use eloquent default timestamps
	public $timestamps = false;

	// define one-to-many relation with usermeta
	public function meta() {
		return $this->hasMany('Wordpress\Usermeta','user_id','ID');
	}


	// getter for custom attribute: nickname
	public function getNicknameAttribute() {
		return $this->getMetaValue('nickname');
	}

	// helper method for custom attributes
	protected function getMetaValue($meta_key){
		return $this->meta()->where('meta_key',$meta_key)->first()->meta_value;
	}
}