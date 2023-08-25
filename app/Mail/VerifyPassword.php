<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class VerifyPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $nama;
    public $text;
    public $token;
    public $fromEmail;
    public $message;
    public $fromName;

    /**
     * Create a new message instance.
     */
    public function __construct($nama, $email, $token, $text, $message)
    {
        $this->nama = $nama;
        $this->fromEmail = $email;
        $this->token = $token;
        $this->text = $text;
        $this->message = $message;
        $this->fromName = "DIGIJOB-UGIPORT";
    }

    public function build()
    {
        return $this->from($this->fromEmail, $this->fromName)
        ->subject($this->message)
        ->view('mail.verify');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->message,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.verify',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
