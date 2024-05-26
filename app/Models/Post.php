<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Post extends Model
{
    use HasFactory;

    // public $timestamps = FALSE;
    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    // protected $dateFormat = 'U';
        
    protected $fillable=[
        'material',
        'price',
        'image',
        'quantity',
        'description',
        'status',
        'rejected_reason',
        'user_id',
        'location',
        'available',
        
    ];

    public function post(){
        return $this->belongsTo(User::class);
    }
}