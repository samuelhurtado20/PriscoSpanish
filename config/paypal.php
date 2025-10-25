<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Configuracion de paypal
    |--------------------------------------------------------------------------
    |
    | Aqui va la configuracion del sdk REST de paypal.
    |
    */
    
    // credenciales de paypal
    'client_id' => 'AUk2rNym3mJhLZN0Qufj36dWE1nBeC4NLbysazzvFNONsUJG31dhKJVZBlQKcm5vNTJA5nTQQKoG-UDO',
    'secret' => 'EPRfvRedeHe0_sYbiW9IgBQAPngcAxj9Nr_ybFMYmwQbgOrdVdnQmtI9Gwi8c4j-6wSnpzPsRGn4j3nx',

    /**
     * SDK configuration 
     */
    'settings' =>[
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,

        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ]

];

