<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DisnakerSender extends Mailable
{
    public $kandidatNama;
    public $disnakerNama;
    public $message;
    public $fromEmail;
    public $fromName;
    public $subject;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($disnaker_nama, $kandidat_nama, $email, $subject)
    {
        $this->disnakerNama = $disnaker_nama;
        $this->kandidatNama = $kandidat_nama;
        $this->subject = $subject;
        $this->fromEmail = $email;
        $this->fromName = "DIGIJOB-UGIPORT";
    }

    public function build()
    {
        return $this->from($this->fromEmail, $this->fromName)
        ->subject($this->subject)
        ->view('mail.disnaker');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.disnaker',
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
