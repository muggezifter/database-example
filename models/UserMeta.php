<?php

namespace WordpressDB;

use Illuminate\Database\Eloquent\Model;

/**
 * Class UserMeta
 * @package WordpressDB
 */
class UserMeta extends Model
{
    /**
     * set table name
     * @var string
     */
    protected $table = 'wp_usermeta';

    /**
     * don't use eloquent default timestamps
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * define many-to-one relation with user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('User', 'user_id', 'ID');
    }
}