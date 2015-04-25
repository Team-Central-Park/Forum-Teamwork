<?php
/**
 * Created by PhpStorm.
 * User: Re5PecT
 * Date: 15-4-24
 * Time: 17:15
 */

class Tag extends Eloquent{

    public $timestamps = false;

    protected $fillable = array('thread_id', 'tag');

    public function thread()
    {
        return $this->belongsTo('ForumThread', 'thread_id', 'id');
    }
} 