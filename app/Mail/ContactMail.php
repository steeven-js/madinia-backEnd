<?php
namespace App\Mail;
use App\Models\ContactMail as ContactMailModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    public $contactMail;

    public function __construct(ContactMailModel $contactMail)
    {
        $this->contactMail = $contactMail;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nouveau message de contact',
            from: 'contact@madinia.fr'
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.contact.send',
            with: [
                'contactMail' => $this->contactMail,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }

    public function headers()
    {
        return $this->withSymfonyMessage(function ($message) {
            $message->getHeaders()
                ->addTextHeader('Sender', 'contact@madinia.fr');
        });
    }
}
