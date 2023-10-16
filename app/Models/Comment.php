<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = [
        'id',
        'content',
        'user_id',
        'feedback_id',
    ];

    public function feedback()
    {
        return $this->belongsTo(Feedback::class);
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
