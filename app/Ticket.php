<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'category', 'first_name', 'last_name', 'email', 'issue',
        'status', 'latitude', 'longitude', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

