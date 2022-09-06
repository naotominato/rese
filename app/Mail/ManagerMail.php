<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ManagerMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_name, $email, $shop_name, $text)
    {
        $this->user_name = $user_name;
        $this->email = $email;
        $this->shop_name = $shop_name;
        $this->text = $text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->email)
            ->subject('【' . $this->shop_name . '】　お気に入り登録済みの方へ')
            ->view('managers.mail-content')
            ->with([
                'user_name' => $this->user_name,
                'shop_name' => $this->shop_name,
                'text' => $this->text,
            ]);
    }
}
