<?php

namespace Wordpress;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
	protected $table = 'wp_users';
	public $timestamps = false;
}