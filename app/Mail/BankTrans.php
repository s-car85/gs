<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BankTrans extends Mailable
{
    use Queueable, SerializesModels;


    /**
     * The demo object instance.
     *
     * @var Demo
     */
    public $order, $user;
    private $adminMail;

    //protected $adminMail = ['info@gradskisifonjer.rs', 'tijana@gradskisifonjer.rs', 'tasatomic@gmail.com'];
    //protected $adminMail = ['s-car@cyber-infinity.net'];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $user)
    {
        $this->order = $order;
        $this->user = $user;
        $this->adminMail = config('mail.adminmail');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return $this
            ->from(['address' => 'no_reply@gradskisifonjer.rs', 'name' => 'Uspešna transakcija - Gradski Šifonjer'])
            ->cc($this->adminMail)
            ->replyTo('info@gradskisifonjer.rs')
            ->subject('Uspešna transakcija - Gradski Šifonjer')
            ->view('email.transakcija');
    }
}
