<?php

namespace WordpressDB;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Post
 * @package WordpressDB
 */
class Post extends Model
{
    /**
     * set table name
     *
     * @var string
     */
    protected $table = 'wp_posts';

    /**
     * don't use eloquent default timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * get posts only
     *
     * @param Builder $query
     * @return Builder|static
     */
    public function scopePosts(Builder $query)
    {
        return $query->where('post_type', 'post');
    }

    /**
     * get pages only
     *
     * @param Builder $query
     * @return Builder|static
     */
    public function scopePages(Builder $query)
    {
        return $query->where('post_type', 'page');
    }

    /**
     * get published items only
     *
     * @param Builder $query
     * @return Builder|static
     */
    public function scopePublished(Builder $query)
    {
        return $query->where('post_status', 'publish');
    }

    /**
     * define many-to-one relation with user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('WordpressDB\User', 'post_author', 'ID');
    }

    /**
     * define one-to-many relation with postmeta
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function meta()
    {
        return $this->hasMany('WordpressDB\PostMeta', 'post_id', 'ID');
    }
} 