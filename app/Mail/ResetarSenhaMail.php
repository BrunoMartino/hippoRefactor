<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetarSenhaMail extends Mailable
{
    use Queueable, SerializesModels;

    private $dados;

    public function __construct($dados)
    {
        $this->dados = $dados;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Hippo Notify - Redefinir Senha',
        );
    }

    public function content(): Content
    {
        $dados = [
            'nome' => $this->dados['nome'],
            'link' => $this->dados['url'],
        ];
    
        return new Content(
            view: 'emails.resetar_senha',
            with: $dados
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
