<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'userid',
        'trxid',
        'amount',
        'nid_balance',
        'vat',
        'total_amount',
        'mobile_no',
        'payment_wallet',
        'method',
        'mer_trxid',
        'date',
        'status',
        'month',
        'year',
        'payment_type',
        'ipn',
        'payment_url',
        'old_nid_balance',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }



}
