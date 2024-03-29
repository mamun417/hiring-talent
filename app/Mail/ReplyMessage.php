<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReplyMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $reply_details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reply_details)
    {
        $this->reply_details = $reply_details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->reply_details['reply_subject'])->view('admin.pages.messages.reply_message');
    }
}
