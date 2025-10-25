<?php

namespace App\Http\Controllers\Auth;
use Mail;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;
use Socialite;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    { //creacion de usuario via correo - no red social
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        
        //---------------- enviar correo de verificacion
        // obtener la url de confirmacion y enviarla
        $random_string = md5(microtime());
		$user->cod_confirmacion = $random_string;
		$user->save();
        
        $confirm_url = "http://priscospanish.com/confirm/".$random_string;
        
        Mail::send('emails.confirm-registration', ['user' => $user, 'confirm_url' => $confirm_url], function ($m) use ($user) {
            /*
                Referencia de lo que se puede enviar.
                $message->from($address, $name = null);
                $message->sender($address, $name = null);
                $message->to($address, $name = null);
                $message->cc($address, $name = null);
                $message->bcc($address, $name = null);
                $message->replyTo($address, $name = null);
                $message->subject($subject);
                $message->priority($level);
                $message->attach($pathToFile, array $options = []);

                // Attach a file from a raw $data string...
                $message->attachData($data, $name, array $options = []);

                // Get the underlying SwiftMailer message instance...
                $message->getSwiftMessage();
            */
            
            
            $m->from('no-reply@priscospanish.com', 'PriscoSpanish');

            $m->to($user->email)->subject('PriscoSpanish - mail confirmation');
        });
        
		//enviar al usuario a la pagina donde se pide que revise su correo de confirmacion
		
        return $user;
    }
    
    public function getRegister(){
        return redirect('/');
    }
    
    public function postRegister(Request $request){
         return view('register-sucessfull');
    }
    
    public function getLogin(){
        return redirect('/');
    }
    
    
    /**
    * Socialite configuration
    */
    
    public function redirectToGoogle()
    {
       //exit();
        return Socialite::driver('google')->scopes(['profile', 'email'])->redirect();
    }
    
    public function handleGoogleCallback()
    {//exit();
        $user = Socialite::driver('google')->user();

        //OAuth 2
        $token = $user->token;
        
       
       
       //$code = Input::get('code');
       
        //if(!$code){
        //    return redirect()->route('auth.login')
        //        ->with('status', 'danger')
        //        ->with('message', 'You did not share your profile data with our socail app.');
        //}
                
        if(!$user->email)
        {
            return redirect()->route('auth.login')
                ->with('status', 'danger')
                ->with('message', 'You did not share your email with our social app. You need to visit App Settings and remove our app, than you can come back here and login again. Or you can create new account.');
        }

		$socialUser = null;
		
        //Checar si el email existe
        $userCheck = User::where('email', '=', $user->email)->first();
        if(!empty($userCheck))
        {
            $socialUser = $userCheck;
        }
        else
        {
            $sameSocialId = \App\SocialLogon::where('provider_id', '=', $user->getId() )->where('provider', '=', 'google' )->first();
            if(empty($sameSocialId))
            {
                //There is no combination of this social id and provider, so create new one
                $newSocialUser = new User;
                $newSocialUser->email       = $user->getEmail();
                                           //$user->getNickname()
                $name = explode(' ', $user->getName());
                $newSocialUser->name         = $name[0];
                $newSocialUser->apellido     = $name[1];
                $newSocialUser->avatar       =  $user->getAvatar();
                $newSocialUser->save();
                
                $socialData = new \App\SocialLogon;
                $socialData->provider_id = $user->getId();
                $socialData->provider= 'google';
                $newSocialUser->social()->save($socialData);
                //dd($newSocialUser);
                Auth::login($newSocialUser);
                return redirect('/settings');
               exit;
            }
            else
            {
                //Load this existing social user
                $socialUser = $sameSocialId->user;
            }
        }
        //\Auth::login($socialUser, true);
		Auth::login($socialUser);
 		return redirect('/dashboard'); 

		
        
    }
    
    public function redirectToFacebook()
    {
       //exit();
        return Socialite::driver('facebook')->scopes(['profile', 'email'])->redirect();
    }
    
    public function handleFacebookCallback()
    {//exit();
        $user = Socialite::driver('facebook')->user();

        //OAuth 2
        $token = $user->token;
        
       
       
       //$code = Input::get('code');
       
        //if(!$code){
        //    return redirect()->route('auth.login')
        //        ->with('status', 'danger')
        //        ->with('message', 'You did not share your profile data with our socail app.');
        //}
                
        if(!$user->email)
        {
            return redirect()->route('auth.login')
                ->with('status', 'danger')
                ->with('message', 'You did not share your email with our social app. You need to visit App Settings and remove our app, than you can come back here and login again. Or you can create new account.');
        }

		$socialUser = null;
		
        //Checar si el email existe
        $userCheck = User::where('email', '=', $user->email)->first();
        if(!empty($userCheck))
        {
            $socialUser = $userCheck;
        }
        else
        {
            $sameSocialId = \App\SocialLogon::where('provider_id', '=', $user->getId() )->where('provider', '=', 'facebook' )->first();
            if(empty($sameSocialId))
            {
                //There is no combination of this social id and provider, so create new one
                $newSocialUser = new User;
                $newSocialUser->email       = $user->getEmail();
                                           //$user->getNickname()
                $name = explode(' ', $user->getName());
                $newSocialUser->name         = $name[0];
                $newSocialUser->apellido     = $name[1];
                $newSocialUser->avatar       =  $user->getAvatar();
                $newSocialUser->save();
                
                $socialData = new \App\SocialLogon;
                $socialData->provider_id = $user->getId();
                $socialData->provider= 'facebook';
                $newSocialUser->social()->save($socialData);
                //dd($newSocialUser);
                Auth::login($newSocialUser);
                return redirect('/settings');
               exit;
            }
            else
            {
                //Load this existing social user
                $socialUser = $sameSocialId->user;
            }
        }
        //\Auth::login($socialUser, true);
		Auth::login($socialUser);
 		return redirect('/dashboard'); 

		
        
    }

    
}
