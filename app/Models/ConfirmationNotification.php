<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfirmationNotification extends Model
{
    use HasFactory;
    protected $fillable=[
        'seller_id',
        'buyer_id',
        'order_id',
        'seller_response',
        'buyer_response',
    ];
}
