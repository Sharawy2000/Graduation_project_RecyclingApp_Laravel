<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerNotification extends Model
{
    use HasFactory;

    protected $fillable=[
        'content',
        'from_who',
        'to_who',
        'linked_id',
        'status',
    ];
}
