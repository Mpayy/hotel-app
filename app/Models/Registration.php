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
        return $this->belongsTo(User::class , 'user_id', 'id');
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class , 'guest_id', 'id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class , 'room_id', 'id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
