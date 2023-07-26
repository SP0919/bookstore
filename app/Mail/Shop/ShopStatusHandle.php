<?php

namespace App\Mail\Shop;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ShopStatusHandle extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $status, $reason = "", $subject)
    {
        $this->user = $user;
        $this->status = $status;
        $this->reason = $reason;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('Mail.Shop.shopStatus', ['user' => $this->user, 'reason' => $this->reason, 'status' => $this->status])->subject($this->subject);
    }
}
