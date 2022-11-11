<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

/**
 * Class User.
 *
 * @author Alexander Davis <alexander.davis.098@gmail.com>
 *
 * @OA\Schema(
 *  title="User",
 *  description="User model"
 * )
 */
class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * @OA\Property(format="int64", property="_id")
     * @OA\Property(property="name",type="string")
     * @OA\Property(property="email",type="string")
     * @OA\Property(format="date-time", property="email_verified_at")
     * @OA\Property(property="password",type="string")
     * @OA\Property(format="date-time", property="created_at")
     * @OA\Property(format="date-time", property="updated_at")
     *
     * The attributes that are mass assignable.
     *
     * @return array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];

     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
