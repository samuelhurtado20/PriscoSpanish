<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
    /*
        'App\Listeners\App\Events\Illuminate\Auth\Events\Attempting' => [
        'App\Listeners\LogAuthenticationAttempt',
    	],

    	'Illuminate\Auth\Events\Login' => [
        	'App\Listeners\LogSuccessfulLogin',
    	],

    	'App\Events\Illuminate\Auth\Events\Login' => [
        	'App\Listeners\LogSuccessfulLogout',
    	],

    	'App\Events\Illuminate\Auth\Events\Login' => [
        	'App\Listeners\LogLockout',
   		],
   		*/
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        /**
         * Luego de que el usuario a sido creado se generara
         * una direccion unica para la 'pagina de perfil'
         * esto sera una cadena distinta para cada ususario
         */
        \App\User::created(function($user)
        {

            $random_string = md5(microtime());
            $temp = \App\User::where('profile_id', $random_string)->first();

            if(null == $temp){
                $user->profile_id = $random_string;
                $user->save();
            }
            
        });
        	
        
    }
}
