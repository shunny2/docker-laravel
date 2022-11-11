<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/login",
     *     summary="User Sign in",
     *     description="This route is responsible for performing user input in the application.",
     *     tags={"User"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="email",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  type="string"
     *              ),
     *              @OA\Examples(
     *                  summary="User",
     *                  example="UserExample",
     *                  value = {
     *                      "email": "johndoe@gmail.com",
     *                      "password": "12345678"
     *                  }
     *              )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Ok: Successful Operation",
     *         @OA\JsonContent(
     *             type="object",
     *              @OA\Examples(
     *                  summary="User",
     *                  example="UserLoginExample",
     *                  value = {
     *                      "status": "string",
     *                      "user": {
     *                          "id": "integer",
     *                          "name": "string",
     *                          "email": "string",
     *                          "email_verified_at": "null",
     *                          "created_at": "date-time",
     *                          "updated_at": "date-time"
     *                      },
     *                      "authorisation": {
     *                          "token": "string",
     *                          "type": "string"
     *                      }
     *                  }
     *              )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Client Error: Bad Request"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server Error: Internal Server Error"
     *     )
     * )
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = JWTAuth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth::user();
        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/register",
     *     summary="Store new user",
     *     description="This route is responsible for storing a new user.",
     *     tags={"User"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="name",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="email",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  type="string"
     *              ),
     *              @OA\Property(
     *                  property="confirmPassword",
     *                  type="string"
     *              ),
     *              @OA\Examples(
     *                  summary="User",
     *                  example="UserExample",
     *                  value = {
     *                      "name": "John Doe",
     *                      "email": "johndoe@gmail.com",
     *                      "password": "12345678",
     *                      "confirmPassword": "12345678"
     *                  }
     *              )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Created: New user created",
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Examples(
     *                  summary="User",
     *                  example="UserLoginExample",
     *                  value = {
     *                      "status": "string",
     *                      "message": "string",
     *                      "user": {
     *                          "name": "string",
     *                          "email": "string",
     *                          "email_verified_at": "null",
     *                          "created_at": "date-time",
     *                          "updated_at": "date-time",
     *                          "id": "integer"
     *                      },
     *                      "authorisation": {
     *                          "token": "null",
     *                          "type": "string"
     *                      }
     *                  }
     *              )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Client Error: Bad Request"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server Error: Internal Server Error"
     *     )
     * )
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = Auth::login($user);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ], 201);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/logout",
     *     summary="Sign out a user",
     *     description="This route is responsible for performing the user exit from the application.",
     *     tags={"User"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\Response(
     *         response=204,
     *         description="Ok: Successful Operation",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Client Error: Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server Error: Internal Server Error"
     *     )
     * )
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/me",
     *     summary="Verify Token",
     *     description="This route is responsible for verifying that the user's token is valid.",
     *     tags={"User"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="Ok: Successful Operation",
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Examples(
     *                  summary="User",
     *                  example="UserLoginExample",
     *                  value = {
     *                      "status": "string",
     *                      "user": {
     *                          "id": "integer",
     *                          "name": "string",
     *                          "email": "string",
     *                          "email_verified_at": "null",
     *                          "created_at": "date-time",
     *                          "updated_at": "date-time"
     *                      }
     *                  }
     *              )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Client Error: Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server Error: Internal Server Error"
     *     )
     * )
     *
     * @return \Illuminate\Http\Response
     */
    public function me()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/refresh",
     *     summary="Refresh Token",
     *     description="This route is responsible for updating or invalidating the user's token.",
     *     tags={"User"},
     *     security={{ "bearerAuth": {} }},
     *     @OA\Response(
     *         response=200,
     *         description="Ok: Successful Operation",
     *         @OA\JsonContent(
     *              type="object",
     *              @OA\Examples(
     *                  summary="User",
     *                  example="UserLoginExample",
     *                  value = {
     *                      "status": "string",
     *                      "user": {
     *                          "id": "integer",
     *                          "name": "string",
     *                          "email": "string",
     *                          "email_verified_at": "null",
     *                          "created_at": "date-time",
     *                          "updated_at": "date-time"
     *                      },
     *                      "authorisation": {
     *                          "token": "string",
     *                          "type": "string"
     *                      }
     *                  }
     *              )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Client Error: Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Server Error: Internal Server Error"
     *     )
     * )
     *
     * @return \Illuminate\Http\Response
     */
    public function refresh()
    {
        return response()->json([
            'status' => 'success',
            'user' => Auth::user(),
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ]
        ]);
    }
}
