<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'avatar',
        'title',
        'message',
        'reference',
        'start_at',
        'end_at',
        'user_id'        
    ];

    public function reporter()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
