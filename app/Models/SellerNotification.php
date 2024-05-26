<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerNotification extends Model
{
    use HasFactory;

    protected $fillable=[
        'content',
        'type',
        'from_who',
        'to_who',
        'linked_id',
        'status',
    ];
}
