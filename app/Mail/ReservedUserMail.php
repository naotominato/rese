<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservedUserMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_name, $email,$shop_name, $start)
    {
        $this->user_name = $user_name;
        $this->email = $email;
        $this->shop_name = $shop_name;
        $this->start = $start;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->email)
        ->subject('【'.$this->shop_name.'】本日ご予約をいただいております。')
        ->view('emails.reserved-user')
        ->with([
            'user_name' => $this->user_name,
            'email' => $this->email,
            'shop_name' => $this->shop_name,
            'start' => $this->start,
            // 'reserves' => $this->reserves,
        ]);
    }
}
