<?php

namespace App\Mail;

use App\Models\TestDrive;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestDriveStatusChangedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public TestDrive $testDrive) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Статус тест-драйва изменён — NewCar',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.test-drive-status-changed',
        );
    }
}
