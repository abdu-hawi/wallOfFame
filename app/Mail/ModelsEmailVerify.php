<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ModelsEmailVerify extends Mailable
{
    use Queueable, SerializesModels;

    protected $data =[];

    /**
     * ModelsEmailVerify constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.models_verify_email')
            ->with('data',$this->data)
            ->subject('Welcome');
    }
}