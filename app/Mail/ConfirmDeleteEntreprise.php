<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use App\Models\Entreprise;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmDeleteEntreprise extends Mailable
{
        use Queueable, SerializesModels;
    
        public $entreprise;
    
        /**
         * Create a new message instance.
         *
         * @return void
         */
        public function __construct(Entreprise $entreprise)
        {
            $this->entreprise = $entreprise;
        }
    
        /**
         * Get the message envelope.
         */
        public function envelope(): Envelope
        {
            return new Envelope(
                subject: 'Confirmation de suppression d\'entreprise',
            );
        }
    
        /**
         * Get the message content definition.
         */
        public function content(): Content
        {
            return new Content(
                markdown: 'emails.confirm-delete-entreprise',
                with: [
                    'entrepriseName' => $this->entreprise->nom,
                    'entrepriseId' => $this->entreprise->id,
                ],
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
