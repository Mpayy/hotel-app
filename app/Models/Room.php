<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public const STATUS_AVAILABLE = 'available';
    public const STATUS_OCCUPIED = 'occupied';
    public const STATUS_DIRTY = 'dirty';

    protected $guarded = ['id'];
    
    public function registrations()
    {
        // One-to-Many
        return $this->hasMany(Registration::class , 'room_id', 'id');
    }
}
