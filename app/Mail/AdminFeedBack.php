<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminFeedBack extends Mailable
{
    use Queueable, SerializesModels;

    public $filePath;
    public $status;


    /**
     * Create a new message instance.
     */
    public function __construct($filePath, $status)
    {
        $this->filePath = $filePath;
        $this->status = $status;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Admin Feed Back',
        );
    }

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->subject('Admin Feedback')
            ->view('web.AdminFeedBack')
            ->with([
                'status' => $this->status,
            ])->attach(storage_path('app/public/' . $this->filePath));
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
