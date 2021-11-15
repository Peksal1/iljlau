<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class qna_post extends Model
{
    protected $fillable = [
        'topic_id',
        'user_id',
        'post_text',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function qna_topics()
    {
        return $this->belongsTo(qna_topic::class);
    }
 /*    public function post()
    {
        return $this->hasOne(qna_topic::class, 'id', 'topic_id');
    } */
  
}
