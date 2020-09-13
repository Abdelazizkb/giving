<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Auth;
class DemandeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $publication='';

    public function __construct($publication)
    {
        $this->publication=$publication;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {    
        return $this->markdown('emails.demande',
        ['user'=>Auth::guard('demandeur')->user(),
        'url'=>'http://localhost:8001/publication/'.$this->publication,
        'url1'=>'http://localhost:8001/helper/'.Auth::guard('demandeur')->user()->id.'/demandeur', 
        ]
    
       );
    }
}
