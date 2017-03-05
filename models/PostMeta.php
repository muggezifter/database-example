<?php

namespace WordpressDB;

use Illuminate\Database\Eloquent\Model;

class PostMeta extends Model
{
    // set table name
    protected $table = 'wp_postmeta';
    // don't use eloquent default timestamps
    public $timestamps = false;

    // define many-to-one relation with post
    public function user()
    {
        return $this->belongsTo('Post', 'post_id', 'ID');
    }
}