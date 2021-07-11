<?php
/**
 * @license Apache 2.0
 */

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * @package Laravel Testing Breeze Api
 *
 * @author  Muhammad Rizal <dev.mrizal@gmail.com>
 *
 * @OA\Schema(
 *     description="List property model User",
 *     title="Model User",
 * )
 */

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        'email_verified_at' => 'datetime',
    ];

    /**
     * @OA\Property(
     *     description="Name",
     *     title="Name",
     *     maximum=255
     * )
     *
     * @var string
     */
    private $name;

    /**
     * @OA\Property(
     *     format="email",
     *     description="Email",
     *     title="Email",
     *     maximum=255
     * )
     *
     * @var string
     */
    private $email;

    /**
     * @OA\Property(
     *     description="Password",
     *     title="Password",
     * )
     *
     * @var string
     */
    private $password;
}
