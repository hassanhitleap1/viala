<?php


namespace App\Http\Controllers\AuthJwt;

use App\Helper\Media;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Http\Request;
use App\Models\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\SocialiteRequest;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    use Media;
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.verify', ['except' => ['login','social','registration','forgetPassword']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request) // LoginRequest
    {
       $credentials = $request->only('email', 'password');
        try {
            if (! $token = auth('api-jwt')->attempt($credentials)) {
                return response()->json([
                    'success' => false,
                    "massage"=>'Login credentials are invalid',
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



    // public function social(SocialiteRequest  $request)
    // {
      
    //     $user=User::updateOrcreate([
    //         'facebook_id' => $request->uiid,
    //         'provider'=>$request->provider,
    //     ], [
    //         'provider' => $request->provider,
    //         'name' => $request->name,
    //         'password'=> Hash::make("pass1234"),
           
        
    //     ]);

    //         $token = JWTAuth::fromUser($user);
    //         return $this->respondWithToken($token);    

    // }


    public function social(SocialiteRequest $request)
    {
        $type=isset( $request['type'] )  ?  User::CUSTOMER : User::Merchant;
     
        if($request->provider =="facebook"){
            $user = User::updateOrCreate([
                'provider'=>$request->provider,
                'email'=>$request->email,
            ], [
                'facebook_id' => $request->uiid,
                'provider' => $request->provider,
                'name' => $request->name,
                'password'=> Hash::make("123456789"),
                'type'=> $type
            
            ]);
           
        }else{
            $user = User::updateOrCreate([
                'email' => $request->email,
                'provider'=>$request->provider,
            ], [
                'google_id' => $request->uiid,
                'email'=>$request->email,
                'provider' => $request->provider,
                'name' => $request->name,
                'password'=> Hash::make("123456789"),
                'type'=> $type

            ]);
        }
       
      
        $token = JWTAuth::fromUser($user);
        return $this->respondWithToken($token);
    }



    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth('api-jwt')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth("api-jwt")->logout();

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

        $type=isset( $request['type'] )  ?  User::CUSTOMER : User::Merchant;

        $user= User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'phone'=> $request['phone'],
                'type'=>$type,
               
            ]);

            $token = JWTAuth::fromUser($user);
            return $this->respondWithToken($token);    

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

        // if(auth('api-jwt')->user()->status==0){
        //     return response()->json([
        //         'success' => false,
        //         "massage"=>'this user is not active',
        //         'errors'=>['credentials'=>['Login credentials are invalid']]
        //     ], 402);
        // }

        return response()->json([
            'success' => true,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api-jwt')->factory()->getTTL() * 60*24*7*4,
           'user' => auth('api-jwt')->user()
        ]);
    }


    public function getSocialAvatar($file, $path ,$user){
        $fileContents = file_get_contents($file);
        return Storage::disk('public')->put($path . $file, File::get($file));
        //return File::put(public_path() . $path . $user->getId() . ".jpg", $fileContents);
    }



    
    public function setFcm (Request $request){
       $user= User::find(auth('api-jwt')->user()->id);
       $user->fcm= $request->fcm;
       $user->save();
       return response()->json([
        'success' => true,
        'message' =>"successfully"
    ]);

    }


    public function updateprofile (Request $request){
        $user= User::find(auth('api-jwt')->user()->id);
        $user->name=$request->name;
        $user->phone=$request->phone;
        $user->email=$request->email;
        $user->lang=$request->lang;
        $user->lat=$request->lat;

        if($file = $request->file('avater')) {
            $fileData = $this->uploads($file,"users/$user->id/");
            $user->avater = $fileData['filePath'] ."/".$fileData['fileName'];
        }
        $user->save();
        return response()->json([
            'success' => true,
            'message' =>"successfully"
        ]);
 
     }

     public function addlocaltion (Request $request){
        $user= User::find(auth('api-jwt')->user()->id);
        $user->lang=$request->lang;
        $user->lat=$request->lat;
        $user->save();
        return response()->json([
            'success' => true,
            'message' =>"successfully"
        ]);
 
     }



     public function forgetPassword(ForgetPasswordRequest $request){  
        $user = User::where('email',$request->email)->first();
        if(is_null($user)){
            throw new HttpResponseException(response()->json([
                'success'=>false,
                "message" => 'email not found',
                'errors' => ['email not found'],
                'status' => 422
            ], 422));
        }
        $user->password = Hash::make("123456789");
        $user->save();
        $data = array('name'=>"Virat Gandhi");
        
      
      // send email
        mail($user->email,"My subject",'new password is 123456789');
        //  Mail::send(['text'=>'mail'], $data, function($message) use($user){
        //     $message->to($user->email, 'new password is pass@123')->subject
        //        ('Laravel Basic Testing Mail');
        //        $message->from(env('MAIL_USERNAME'),'tasheh');
        //  });


         return response()->json([
            'success' => true,
            'message' =>"successfully send email new password"
        ]);
     }
     


    public function sendSMS($OTP, $mobileNumber){
        $isError = 0;
        $errorMessage = true;

        //Your message to send, Adding URL encoding.
        $message = urlencode("Welcome to www.codershood.info , Your OPT is : $OTP");


        //Preparing post parameters
        $postData = array(
            'authkey' => $this->API_KEY,
            'mobiles' => $mobileNumber,
            'message' => $message,
            'sender' => $this->SENDER_ID,
            'route' => $this->ROUTE_NO,
            'response' => $this->RESPONSE_TYPE
        );

        $url = "https://control.msg91.com/sendhttp.php";

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData
        ));


        //Ignore SSL certificate verification
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


        //get response
        $output = curl_exec($ch);

        //Print error if any
        if (curl_errno($ch)) {
            $isError = true;
            $errorMessage = curl_error($ch);
        }
        curl_close($ch);
        if($isError){
            return array('error' => 1 , 'message' => $errorMessage);
        }else{
            return array('error' => 0 );
        }
    }

}
