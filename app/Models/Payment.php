<?php

namespace App\Models;

use App\Models\Registration;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'registration_id',
        'total_bill',
        'amount_paid',
        'balance',
        'payment_method',
        'receipt_number',
    ];

    public function registration()
    {
        // One-to-One
        return $this->belongsTo(Registration::class, 'registration_id', 'id');
    }
}
