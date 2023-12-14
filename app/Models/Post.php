<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'price',
        'image',
        'content',
        'status',
        'rejected_reason',
        'user_id',
    ];
}