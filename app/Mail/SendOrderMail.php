<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendOrderMail extends Mailable
{
    use Queueable, SerializesModels;

   public $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
      public function build()
    {
        return $this
            ->from(['address' => 'no_reply@gradskisifonjer.rs', 'name' => 'Gradski Šifonjer'])
            ->replyTo('info@gradskisifonjer.rs')
            ->subject('Gradski Šifonjer - Poslata porudžbenica - '.$this->order->id)
            ->view('email.ordersent');

    }
}
