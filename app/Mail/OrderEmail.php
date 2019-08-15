<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Config;

class OrderEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The demo object instance.
     *
     * @var Demo
     */
    public $order;
    private $adminMail;

    //protected $adminMail = ['s-car@cyber-infinity.net'];
    //protected $adminMail = ['info@gradskisifonjer.rs', 'tijana@gradskisifonjer.rs', 'tasatomic@gmail.com'];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
        $this->adminMail = config('mail.adminmail');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->order->type == 1){
            return $this
                ->from(['address' => 'no_reply@gradskisifonjer.rs', 'name' => 'Gradski Šifonjer'])
                ->cc($this->adminMail)
                ->replyTo('info@gradskisifonjer.rs')
                ->subject('Gradski Šifonjer - Porudžbenica - '.$this->order->id)
                ->view('email.neworder')
                ->attach(public_path('/uplatnice').'/uplatnica_'.$this->order->id.'.pdf', [
                    'as' => 'uplatnica.pdf',
                    'mime' => 'pdf',
                ]);
        }
        return $this
            ->from(['address' => 'no_reply@gradskisifonjer.rs', 'name' => 'Gradski Šifonjer'])
            ->cc($this->adminMail)
            ->replyTo('info@gradskisifonjer.rs')
            ->subject('Gradski Šifonjer - Porudžbenica - '.$this->order->id)
            ->view('email.neworder');

    }
}
