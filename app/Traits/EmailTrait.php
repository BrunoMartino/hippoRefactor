<?php

namespace App\Traits;

use App\Models\User;
use App\Mail\ResetarSenhaMail;
use App\Mail\CodigoConfirmacaoMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

trait EmailTrait
{
    public function enviarEmailConfirmacao(string $email, string $digitos)
    {
        try {
            Mail::to($email)->send(new CodigoConfirmacaoMail($digitos));
        } catch (\Throwable $th) {
            Log::error('Erro ao enviar email com código confirmação: ' . $th->getMessage(), [
                'exception' => $th
            ]);
        }
    }

    public function enviarEmailResetarSenha($dados)
    {
        try {
            Mail::to($dados['email'])->send(new ResetarSenhaMail($dados));
            return true;
        } catch (\Throwable $th) {
            Log::error('Erro ao enviar email para resetar senha: ' . $th->getMessage(), [
                'exception' => $th
            ]);
            return false;
        }
    }

    public function enviarEmailCadastro(array $dados_usuario)
    {
        $email = '';
    }

    public function renderEmail($dados)
    {
        $email = new ResetarSenhaMail($dados);
        $htmlContent = $email->render();
        echo $htmlContent;
    }
}
