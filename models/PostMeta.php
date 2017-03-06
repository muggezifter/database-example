<?php

namespace WordpressDB;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PostMeta
 * @package WordpressDB
 */
class PostMeta extends Model
{
    /**
     * set table name
     *
     * @var string
     */
    protected $table = 'wp_postmeta';

    /**
     * don't use eloquent default timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * define many-to-one relation with post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('Post', 'post_id', 'ID');
    }
}