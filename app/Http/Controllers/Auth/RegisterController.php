<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class RegisterController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/register",
     *     tags={"authenticated"},
     *     summary="Register",
     *     description="Register Admin",
     *     operationId="store",
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Please enter your full name",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
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
     *     @OA\Parameter(
     *         name="password_confirmation",
     *         in="query",
     *         description="Please enter your password confirmation",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *      @OA\Response(
     *          response=201,
     *          description="Registration success"
     *       ),
     *     @OA\Response(
     *         response=400,
     *         description="Registration failed"
     *     ),
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return response()->json([
                        'status'  => false,
                        'data'  => $validator->errors(),
                    ], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        if (Auth::check()) {
            $token = $request->user()->createToken('LoginMobile');

            return response()->json([
                        'status'  => true,
                        'message' => 'Registration success',
                        'token' => $token->plainTextToken,
                    ], 201);
        } else {
            return response()->json([
                        'status'  => false,
                        'message' => 'Registration failed'
                    ], 401);
        }
    }
}
