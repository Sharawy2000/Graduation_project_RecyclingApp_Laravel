<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\DeleteOrder;

class Order extends Model
{
    use HasFactory;
    protected $fillable=[
        "content",
        'status',
        'buyer_id',
        'seller_id',
        'product_id',
        'payment_method',
        'online_payment_method',

    ];

    public function order(){
        return $this->belongsTo(User::class);
    }
    // protected static function boot()
    // {
    //     parent::boot();

    //     static::created(function ($order) {
    //         DeleteOrder::dispatch($order)->delay(now()->addDays(3));
    //     });
    // }
}
