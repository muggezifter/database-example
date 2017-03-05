<?php

namespace WordpressDB;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // set table name
    protected $table = 'wp_posts';
    // don't use eloquent default timestamps
    public $timestamps = false;

    // make it simple to just get posts
    public function scopePosts($query)
    {
        return $query->where('post_type', 'post');
    }

    // make it simple to just get pages
    public function scopePages($query)
    {
        return $query->where('post_type', 'page');
    }

    //  only get published
    public function scopePublished($query)
    {
        return $query->where('post_status', 'publish');
    }

    // define many-to-one relation with user
    public function user()
    {
        return $this->belongsTo('WordpressDB\User', 'post_author', 'ID');
    }

    // define one-to-many relation with postmeta
    public function meta()
    {
        return $this->hasMany('WordpressDB\PostMeta', 'post_id', 'ID');
    }
} 