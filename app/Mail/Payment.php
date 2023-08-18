<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Payment extends Mailable
{
    use Queueable, SerializesModels;

    public $nama;
    public $subject;
    public $fromEmail;
    public $fromName;
    public $payment;
    public $namarec;
    public $nomorec;

    /**
     * Create a new message instance.
     */
    public function __construct($nama, $payment, $subject, $fromEmail, $namarec,$nomorec)
    {
        $this->nama = $nama;
        $this->subject = $subject;
        $this->fromEmail = $fromEmail;
        $this->payment = $payment;
        $this->namarec = $namarec;
        $this->nomorec = $nomorec;
        $this->fromName = env('MAIL_FROM_NAME');
    }

    /**
     * Get the message envelope.
     */
    
    public function build()
    {
        return $this->from($this->fromName)
        ->subject($this->subject)
        ->view('mail.');
    }
    
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Pembayaran',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail/pembayaran',
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
