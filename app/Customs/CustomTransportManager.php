<?php

namespace App\Customs;

use Illuminate\Mail\TransportManager;
use App\MailModel; //my models are located in app\models

class CustomTransportManager extends TransportManager {

    /**
     * Create a new manager instance.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    public function __construct($app)
    {
        $this->app = $app;

        if( $mail = MailModel::first() ){

            $this->app['config']['mail'] = [
                'driver'        => $mail->driver,
                'host'          => $mail->host,
                'port'          => $mail->port,
                'from'          => [
                    'address'   => $mail->from_address,
                    'name'      => $mail->from_name
                ],
                'encryption'    => $mail->encryption,
                'username'      => $mail->username,
                'password'      => $mail->password,
            ];
        }

    }
}