<?php

namespace WordpressDB;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // set table name
    protected $table = 'wp_users';
    // define custom attributes
    protected $appends = ['nickname', 'postcount'];
    // don't use eloquent default timestamps
    public $timestamps = false;

    // define one-to-many relation with usermeta
    public function meta()
    {
        return $this->hasMany('WordpressDB\UserMeta', 'user_id', 'ID');
    }

    // define one-to-many relation with post
    public function posts()
    {
        return $this->hasMany('WordpressDB\Post', 'post_author', 'ID');
    }

    // getter for custom attribute: nickname
    public function getNicknameAttribute()
    {
        return $this->getMetaValue('nickname');
    }

    // getter for custom attribute: postcount
    public function getPostcountAttribute()
    {
        return $this->posts()->posts()->published()->count();
    }

    // helper method for custom attributes
    protected function getMetaValue($meta_key)
    {
        return $this->meta()->where('meta_key', $meta_key)->first()->meta_value;
    }
}