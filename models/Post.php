<?php

namespace Wordpress;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {
	protected $table = 'wp_posts';
	public $timestamps = false;
} 