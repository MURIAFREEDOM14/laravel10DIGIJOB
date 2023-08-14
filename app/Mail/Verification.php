<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Verification extends Mailable
{
    use Queueable, SerializesModels;

    public $nama;
    public $message;
    public $token;
    public $email;
    public $fromName;
    /**
     * Create a new message instance.
     */
    public function __construct($name, $token, $message, $email)
    {
        $this->nama = $name;
        $this->token = $token;
        $this->message = $message;
        $this->email = $email;
        $this->fromName = env('MAIL_FROM_NAME');
    }

    public function build()
    {
        return $this->from($this->email, $this->fromName)
        ->subject($this->token)
        ->markdown('mail.mail')
        ->with([
            'token' => $this->token,
            'message' => $this->message,
        ]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verification',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.mail',
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
