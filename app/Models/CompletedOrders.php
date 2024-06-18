<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompletedOrders extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'order_id',
        'post_id',
        'seller_id',
        'buyer_id'
    ];


    public function completeOrder(){
        return $this->belongsTo(User::class);
    }
}
