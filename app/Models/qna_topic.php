<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class qna_topic extends Model
{
    protected $fillable = [
        'topic_title',
        'topic_description',
        'user_id',
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function qna_posts()
    {
        return $this->hasMany(qna_post::class);
    }
  
}
