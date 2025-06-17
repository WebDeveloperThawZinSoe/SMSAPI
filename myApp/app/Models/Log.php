<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
     protected $fillable = [
        'user_id',
        'message',
        'type',
        'phone_number',
        'status',
        "country"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
