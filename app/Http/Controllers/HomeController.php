<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',
        ['except' => [
            'getPublicProfile',
            'getRegisterOk',
            'completeRegistration',
        ]]);
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        return view('welcome');
    }
    
    
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function dashboard()
    {
        return view('dashboard');
    }
    
    /**
    *
    */
    public function getPublicProfile(Request $request,$profile_id)
    {
        $user  =  \App\User::where('profile_id',$profile_id)->first();

        if(null == $user ){
            return view('profiles.profile-public')->with(['not_found' => 1]);
        }
        
        $teacher_profile = \App\Perfil_Profesor::firstOrNew(['user_id'=> $user->id]);
        
        return view('profiles.profile-public')->with(['teacher_profile' => $teacher_profile,'not_found' => 0]);
    }
    
    public function getRegisterOk(Request $request){
    	return view('register-sucessfull');
    
    }
    
    
    /**
    * en esta funcion se procesa la ruta donde se procesa el codigo del email
    *
    */
   public function completeRegistration( Request $request,$cod )
   {
   		$user  =  \App\User::where('cod_confirmacion',$cod)->first();
   		
   		if(null != $user ){
   		    //dd($user);
   		    $user->cod_confirmacion =null;
   		    $user->save();
   			return view('email-confirmation')->with(['success' => 1]);
        }
        
        return view('email-confirmation')->with(['success' => 0]);
   }
}
