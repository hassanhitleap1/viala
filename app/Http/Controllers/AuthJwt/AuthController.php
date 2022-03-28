<?php


namespace App\Http\Controllers\AuthJwt;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\Vaila;
use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
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



    public function loginWithFacebook()
    {
        try {
            $facebookUser = Socialite::driver('facebook')->user();
            $user = User::updateOrCreate([
                'facebook_id' => $facebookUser->id,
            ], [
                'name' => $facebookUser->name,
                'email' => $facebookUser->email,
                'avatar'=>  $facebookUser->getAvatar(),

            ]);
            $this->getSocialAvatar($facebookUser->getAvatar(), "avatar/$user->id" ,$facebookUser);
            $token = JWTAuth::fromUser($user);
            return $this->respondWithToken($token);

        } catch (Exception $exception) {

            return response()->json([
                'success' => false,
                'message' => 'Could not create token.',
                'errors'=>$exception->getMessage()
            ], 500);

        }
    }

    public function loginWithGoogle()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::updateOrCreate([
                'google_id' => $googleUser->id,
            ], [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'avatar'=>  $googleUser->getAvatar(),

            ]);
            $this->getSocialAvatar($googleUser->getAvatar(), "avatar/$user->id" ,$googleUser);
            $token = JWTAuth::fromUser($user);
            return $this->respondWithToken($token);

        } catch (Exception $exception) {

            return response()->json([
                'success' => false,
                'message' => 'Could not create token.',
                'errors'=>$exception->getMessage()
            ], 500);

        }
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
        $next_id=User::get_next_id();
        $file = $request->file('avatar');
        $fileData = $this->uploads($file,"avatar/$next_id");
        $avatar = $fileData['filePath'] ."/".$fileData['fileName'];
        return User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'phone'=> $request['phone'],
                'avatar'=>$avatar
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


    public function getSocialAvatar($file, $path ,$user){
        $fileContents = file_get_contents($file);
        return Storage::disk('public')->put($path . $file, File::get($file));
        //return File::put(public_path() . $path . $user->getId() . ".jpg", $fileContents);
    }
}
