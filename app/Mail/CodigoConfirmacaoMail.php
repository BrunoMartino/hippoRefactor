<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CodigoConfirmacaoMail extends Mailable
{
    use Queueable, SerializesModels;

    private $codigo;

    public function __construct($digitos)
    {
        $this->codigo = $digitos;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Hippo Notify - código para confirmação do email',
        );
    }

    public function content(): Content
    {
        $dados = [
            'nome' => session('usuario')['nome_usuario'],
            'codigo' => $this->codigo,
        ];
    
        return new Content(
            view: 'emails.codigo_confirmacao',
            with: $dados
        );
    }

    /**
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
