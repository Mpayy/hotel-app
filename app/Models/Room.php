<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $guarded = ['id'];
    
    protected $fillable = [
        'room_number',
        'room_type',
        'status',
    ];

    public function registrations()
    {
        // One-to-Many
        return $this->hasMany(Registration::class , 'room_id', 'id');
    }
}
