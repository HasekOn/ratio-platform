<?php

namespace App\Mail;

use App\Models\Invitation;
use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvitationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     * @param string $remember_token
     * @param Invitation $invitation
     * @param Project $project
     */
    public function __construct(string $remember_token, Invitation $invitation, Project $project)
    {
        $this->remember_token = $remember_token;
        $this->project = $project;
        $this->invitation = $invitation;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invitation Email to project: ' . $this->project->name,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.invitation-email',
            with: [
                'project' => $this->project,
                'remember_token' => $this->remember_token,
                'invitation' => $this->invitation
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
