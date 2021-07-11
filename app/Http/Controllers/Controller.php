<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     description="API for Customer",
 *     version="1.0.0",
 *     title="Customers App",
 *     termsOfService="https://laravel-testing-breeze-api.test/terms-of-service",
 *     @OA\Contact(
 *         email="dev.mrizal@gmail.com"
 *     ),
 *     @OA\License(
 *         name="GNU General Public License",
 *         url="https://www.gnu.org/licenses/gpl-3.0.html"
 *     )
 * )
 */

/**
 * @OA\Tag(
 *   name="authenticated",
 *   description="All available Authenticated APIs"
 * )
 */

/**
 * @OA\Tag(
 *   name="customer",
 *   description="All available Customer APIs"
 * )
 */

/**
 * @OA\Server(
 *      url="{schema}://laravel-testing-breeze-api.test",
 *      description="OpenApi parameters",
 *      @OA\ServerVariable(
 *          serverVariable="schema",
 *          enum={"https", "http"},
 *          default="https"
 *      )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
