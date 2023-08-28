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

    public $name;
    public $token;
    public $subject;
    public $fromEmail;
    public $fromName;
    public $payment;
    public $namarec;
    public $nomorec;
    public $bank;

    /**
     * Create a new message instance.
     */
    public function __construct($nama, $token, $payment, $subject, $fromEmail, $namarec,$nomorec, $bank)
    {
        $this->name = $nama;
        $this->token = $token;
        $this->payment = $payment;
        $this->subject = $subject;
        $this->fromEmail = $fromEmail;
        $this->namarec = $namarec;
        $this->nomorec = $nomorec;
        $this->bank = $bank;
        $this->fromName = "DIGIJOB-UGIPORT";
    }

    /**
     * Get the message envelope.
     */
    
    public function build()
    {
        return $this->from($this->fromEmail,$this->fromName)
        ->subject($this->subject)
        ->view('mail.pembayaran');
    }
    
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
