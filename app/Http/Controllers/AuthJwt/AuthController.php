<?php


namespace App\Http\Controllers\AuthJwt;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.verify', ['except' => ['login','registration']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {

       $credentials = $request->only('phone', 'password');
        try {
            if (! $token = auth('api-jwt')->attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    'errors'=>['credentials'=>['Login credentials are invalid']]
                ], 402);
            }
        } catch (JWTException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Could not create token.',
                'errors'=>[$credentials]
            ], 500);
        }
        return $this->respondWithToken($token);

    }



    public function socialite(){

    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {

        return $this->respondWithToken( auth('api-jwt')->refresh());
    }



    public function registration(RegistrationRequest  $request)
    {


        return User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);

    }


    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api-jwt')->factory()->getTTL() * 60,
            'user' => auth('api-jwt')->user()
        ]);
    }
}
