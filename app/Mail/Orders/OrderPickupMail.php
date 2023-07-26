<?php

namespace App\Mail\Orders;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPickupMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($allOrderDetails)
    {
        //
        $this->allOrderDetails = $allOrderDetails;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $subject =  "Pickup for service";
        $date = date_create($this->allOrderDetails->delivery_date);
        $date = date_format($date, "l, d F");
        $this->allOrderDetails->delivery_date = $date;
        return $this->view('Mail.Orders.orderPickedup', ['allOrderDetails' => $this->allOrderDetails])->subject($subject);
    }
}
