<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Suggestion;
use App\Models\SuggestionAnswer;

class SuggestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sugestoes = [
            'Como podemos melhorar as notificações de cobrança via WhatsApp?' => [
                'Incluir nome e valor na mensagem.',
                'Adicionar botão de pagamento.',
                'Enviar lembretes antes do vencimento.',
                'Agendar envio para horários melhores.',
            ],
            'O que você gostaria de ver no painel de faturamento?' => [
                'Gráficos mensais de faturamento.',
                'Exportar para Excel e PDF.',
                'Filtros por cliente e período.',
            ],
            'Como o sistema pode ajudar a reduzir inadimplência?' => [
                'Lembretes antes e depois do vencimento.',
                'Renegociação automática.',
                'Notificação de segunda via do boleto.',
            ],
            'O que falta nas notificações de rastreamento de pedidos?' => [
                'Atualizações em tempo real.',
                'Link direto com a transportadora.',
                'Alertas de atraso.',
            ],
            'Que tipo de campanhas de remarketing você gostaria de automatizar?' => [
                'Recuperação de boletos não pagos.',
                'Promoções para clientes inativos.',
                'Aniversário do cliente com cupom.',
            ],
            'Como as mensagens poderiam ser mais eficientes?' => [
                'Serem mais curtas e objetivas.',
                'Usar emojis para chamar atenção.',
                'Incluir nome e valor com destaque.',
            ],
            'Você sente falta de alguma integração?' => [
                'Com sistemas de contabilidade.',
                'Com plataformas de e-commerce.',
                'Com WhatsApp oficial.',
            ],
            'O que acha da interface atual para gerenciamento de cobranças?' => [
                'Mais visual com cards.',
                'Boa, mas difícil no mobile.',
                'Complexa no começo.',
            ],
            'Qual seria uma funcionalidade que te ajudaria no dia a dia?' => [
                'Envio automático de cobranças recorrentes.',
                'Dashboard de KPIs financeiros.',
                'Avisos de risco de inadimplência.',
            ],
            'Como podemos tornar o sistema mais proativo?' => [
                'Alertas preventivos.',
                'Relatórios automáticos semanais.',
                'Sugerir ações baseadas no comportamento.',
            ],
        ];

        foreach ($sugestoes as $pergunta => $respostas) {
            $sugestao = Suggestion::create([
                'text' => $pergunta,
                'user_id' => rand(3, 5),
            ]);

            foreach ($respostas as $resposta) {
                SuggestionAnswer::create([
                    'text' => $resposta,
                    'user_id' => rand(1, 3),
                    'suggestion_id' => $sugestao->id,
                ]);
            }
        }
    }
}

