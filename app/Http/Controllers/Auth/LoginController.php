<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class LoginController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"authenticated"},
     *     summary="Login",
     *     description="Login Admin",
     *     operationId="login",
     *     @OA\Parameter(
     *         name="email",
     *         in="query",
     *         description="Please enter your email",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         in="query",
     *         description="Please enter your password",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Login success"
     *       ),
     *     @OA\Response(
     *         response=400,
     *         description="Login failed"
     *     ),
     * )
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                        'status'  => false,
                        'data'  => $validator->errors(),
                    ], 400);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $token = $request->user()->createToken('LoginMobile');

            return response()->json([
                        'status'  => true,
                        'message' => 'Login success',
                        'token' => $token->plainTextToken,
                    ], 200);
        } else {
            return response()->json([
                        'status'  => false,
                        'message' => 'Login failed'
                    ], 401);
        }
    }

    public function loginRedirect()
    {
        return response()->json([
            'status'  => false,
            'message' => 'Page Not Found'
        ], 404);
    }
}
