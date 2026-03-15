<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $guarded = ['id'];
    
    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'id_card_number',
        'birth_date',
        'profession',
        'company',
        'nationality',
        'member_no',
    ];

    public function registrations()
    {
        // One-to-Many
        return $this->hasMany(Registration::class , 'guest_id', 'id');
    }
}
