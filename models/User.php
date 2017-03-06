<?php

namespace WordpressDB;

use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @package WordpressDB
 */
class User extends Model
{
    /**
     * set table name
     *
     * @var string
     */
    protected $table = 'wp_users';

    /**
     * define custom attributes
     *
     * @var array
     */
    protected $appends = ['nickname', 'postcount'];

    /**
     * don't use eloquent default timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * define one-to-many relation with usermeta
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function meta()
    {
        return $this->hasMany('WordpressDB\UserMeta', 'user_id', 'ID');
    }

    /**
     * define one-to-many relation with post
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany('WordpressDB\Post', 'post_author', 'ID');
    }

    /**
     * getter for custom attribute: nickname
     *
     * @return mixed
     */
    public function getNicknameAttribute()
    {
        return $this->getMetaValue('nickname');
    }

    /**
     * getter for custom attribute: postcount
     *
     * @return mixed
     */
    public function getPostcountAttribute()
    {
        return $this->posts()->posts()->published()->count();
    }

    /**
     * helper method for custom attributes
     *
     * @param $meta_key String
     * @return mixed
     */
    protected function getMetaValue($meta_key)
    {
        return $this->meta()->where('meta_key', $meta_key)->first()->meta_value;
    }
}