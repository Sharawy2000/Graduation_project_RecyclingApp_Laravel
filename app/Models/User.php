<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'TIN',
        'organization',
        'address',
        'image',
        'user_type',
        'location',
        'password',
        'phone_number',
        'email_verified_at',
        'verificationToken',
        'social_id',
        'social_type',
        'governorate',
        'city',
        'street',
        'residential_quarter',
        'interests',
        'balance',
        'commision',
        'role',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }

    public function posts(){
        return $this->hasMany(Post::class);
    }

    // public function wishlist(){
    //     return $this->hasMany(Wishlist::class);
    // }
    public function wishlists(){
        return $this->hasMany(Wishlist::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    // public function CompletedOrders(){
    //     return $this->hasMany(CompletedOrders::class);
    // }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($user) {
            $user->posts()->delete();
        });
    }
    

}
