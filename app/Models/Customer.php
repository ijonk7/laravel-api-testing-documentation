<?php
/**
 * @license Apache 2.0
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Customer
 *
 * @package Laravel Testing Breeze Api
 *
 * @author  Muhammad Rizal <dev.mrizal@gmail.com>
 *
 * @OA\Schema(
 *     description="List property model Customer",
 *     title="Model Customer",
 * )
 */

class Customer extends Model
{
    use HasFactory;

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

    /**
     * @OA\Property(
     *     description="Hobby",
     *     title="Hobby",
     *     enum={"art", "basketball", "chess", "fashion", "video gaming", "photography", "music", "dance", "jogging", "swimming"},
     * )
     *
     * @var string
     */
    private $hobby;

    /**
     * @OA\Property(
     *     format="date",
     *     description="Date of Birth",
     *     title="Date of Birth",
     * )
     *
     * @var string
     */
    private $date_of_birth;

    /**
     * @OA\Property(
     *     description="Photo",
     *     title="Photo",
     * )
     *
     * @var string
     */
    private $photo;

    /**
     * @OA\Property(
     *     format="int32",
     *     description="Age",
     *     title="Age",
     * )
     *
     * @var integer
     */
    private $age;

    /**
     * @OA\Property(
     *     description="Status",
     *     title="Status",
     *     enum={"single", "married", "divorce"},
     * )
     *
     * @var string
     */
    private $status;

    /**
     * @OA\Property(
     *     description="Vehicle",
     *     title="Vehicle",
     *     enum={"motorcycle", "car", "bike"},
     * )
     *
     * @var string
     */
    private $vehicle;

    /**
     * @OA\Property(
     *     description="address",
     *     title="address",
     * )
     *
     * @var string
     */
    private $address;
}
