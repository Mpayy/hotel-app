<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'arrival_time' => 'datetime',
        'departure_date' => 'datetime',
    ];

    protected $fillable = [
        'user_id',
        'guest_id',
        'room_id',
        'no_of_person',
        'arrival_time',
        'departure_date',
        'safety_box_number',
        'receptionist_name',
        'payment_status',
    ];
    
    public function user()
    {
        // Many-to-One
        return $this->belongsTo(User::class , 'user_id', 'id');
    }

    public function guest()
    {
        // Many-to-One
        return $this->belongsTo(Guest::class, 'guest_id', 'id');
    }

    public function room()
    {
        // Many-to-One
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    public function payment()
    {
        // One-to-One
        return $this->hasOne(Payment::class, 'registration_id', 'id');
    }
}
