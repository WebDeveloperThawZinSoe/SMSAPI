<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Count extends Model
{
     protected $fillable = [
        'user_id',
        'count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
