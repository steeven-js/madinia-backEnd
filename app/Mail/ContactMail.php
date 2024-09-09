<?php

namespace App\Mail;

use App\Models\ContactMail as ContactMailModel; // Assurez-vous d'importer le modèle ContactMail si vous ne l'avez pas déjà fait
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $contactMail; // Déclarez une propriété pour stocker les données du contact de messagerie

    /**
     * Create a new message instance.
     *
     * @param ContactMailModel $contactMail Les données du contact de messagerie
     */
    public function __construct(ContactMailModel $contactMail)
    {
        $this->contactMail = $contactMail; // Stockez les données du contact de messagerie dans la propriété
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('contact@jsprod.fr') // Définissez l'adresse e-mail de l'expéditeur
            ->subject('Contact Mail') // Définissez le sujet de l'e-mail
            ->markdown('mail.contact') // Définissez la vue Markdown pour le contenu de l'e-mail
            ->with(['contactMail' => $this->contactMail]); // Transmettez les données du contact de messagerie à la vue
    }
}
