<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class LogController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:ver-logs-acesso']);
        $this->middleware('role:super_admin|admin');
    }

    public function index()
    {
        $logErros = $this->getErrorLogs();
        $logAcoes = $this->getInfoLogs();

        return view('pages.logs.index', compact('logAcoes', 'logErros'));
    }

    function getErrorLogs()
    {
        $logPath = storage_path('logs');
        $logFiles = File::files($logPath);
        $errors = [];

        if (!empty($logFiles)) {
            // Pega o arquivo de log mais recente
            $latestLogFile = last($logFiles);

            // Lê o conteúdo do arquivo
            $logContent = File::get($latestLogFile);

            // Divide o log em linhas
            $logEntries = explode("\n", $logContent);

            foreach ($logEntries as $entry) {
                // Verifica se a linha contém um erro
                if (str_contains($entry, 'ERROR') || str_contains($entry, 'error')) {
                    // Extrai a data e a mensagem de erro
                    if (preg_match('/\[(.*?)\].*?(ERROR|error).*?: (.*?)$/', $entry, $matches)) {
                        $errors[] = [
                            'date' => $matches[1],
                            'message' => $matches[3]
                        ];
                    }
                }
            }
        }

        $errors = array_reverse($errors);
        return $errors;
    }

    public function getInfoLogs()
    {
        $filePath = storage_path('logs/laravel.log');
        $lines = file($filePath); // Lê o arquivo em um array de linhas

        $infoLogs = array_filter($lines, function ($line) {
            return str_contains($line, 'INFO');
        });

        $logEntries = array_map(function ($line) {
            // Supondo que o formato do log seja algo como: [2023-01-30 12:00:00] local.INFO: Sua mensagem aqui
            if (preg_match('/\[(.*?)\].*?INFO: (.*)/', $line, $matches)) {
                return ['datetime' => $matches[1], 'message' => $matches[2]];
            }
            return null;
        }, $infoLogs);

        // Remove os valores nulos (caso alguma linha não corresponda ao padrão esperado)
        $logEntries = array_filter($logEntries);

        // Ordenar os mais recentes primeiro
        $logEntries = array_reverse($logEntries);

        return $logEntries;
    }
}
