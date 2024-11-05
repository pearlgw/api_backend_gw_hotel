<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code_user',
        'first_name',
        'last_name',
        'email',
        'password',
        'no_phone',
        'address',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * Get all of the reservationUser for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservationUser(): HasMany
    {
        return $this->hasMany(Reservation::class, 'user_id', 'id');
    }

    /**
     * Get all of the reservationOrder for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservationOrder(): HasMany
    {
        return $this->hasMany(Reservation::class, 'order_id', 'id');
    }

    /**
     * Get all of the cashierUser for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cashierUser(): HasMany
    {
        return $this->hasMany(User::class, 'user_id', 'id');
    }

    /**
     * Get all of the cashierOrder for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cashierOrder(): HasMany
    {
        return $this->hasMany(User::class, 'order_id', 'id');
    }
}
