<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/logout",
     *     tags={"authenticated"},
     *     summary="Logout",
     *     description="Logout Admin",
     *     operationId="logout",
     *     security={
     *          {"sanctum": {}}
     *     },
     *      @OA\Response(
     *          response=200,
     *          description="Logout success"
     *       ),
     *     @OA\Response(
     *         response=400,
     *         description="Logout failed"
     *     ),
     * )
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Logout Successfully'
        ], 200);
    }
}
