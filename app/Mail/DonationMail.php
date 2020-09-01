<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Auth;
class DonationMail extends Mailable
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
      
        if(Auth::guard('donor')->check()){
        $type= 'donor';
         $id=Auth::guard('donor')->user()->id;
        }
        if(Auth::guard('membre')->check()){
        $type='membre';
        $id=Auth::guard('membre')->user()->id;
        }
    return $this->markdown('emails.donation',
    ['user'=>Auth::guard('donor')->user(),
    'url'=>'http://127.0.0.1:8000/publication/'.$this->publication,
    'url1'=>'http://127.0.0.1:8000/helper/'.$id.'/'.$type, 
    ]

   );
    
     
     
    }
}
