<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     public $order;
     public $status;
     public $comment;

    public function __construct($order, $status, $comment)
    {
        $this->order = $order;
        $this->status = $status;
        $this->comment = $comment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.OrderUpdate')
         ->subject('Order#: '.$this->order->id.'. Your Order Status: '.$this->status);

    }
}
