<?php

class ForumLike extends Model
{
    protected $fillable = ['forum_id', 'user_id'];

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }
}

