<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=[
        'material',
        'price',
        'image',
        'quantity',
        'description',
        'status',
        'rejected_reason',
        'user_id',
    ];

    public function post(){
        return $this->belongsTo(User::class);
    }
    public function comments(){
        return $this->hasMany(comment::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}