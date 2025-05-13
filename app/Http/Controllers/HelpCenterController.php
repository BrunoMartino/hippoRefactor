<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpCenterController extends Controller
{
    public function introducao()
    {
        return view('ajuda.pages.introducao');
    }

    public function registro()
    {
        return view('ajuda.pages.registro');
    }

    public function dashboard()
    {
        return view('ajuda.pages.dashboard');
    }

    public function menuSuperior()
    {
        return view('ajuda.pages.menu_superior');
    }

    public function usuarios()
    {
        return view('ajuda.pages.usuarios');
    }

    public function configConta()
    {
        return view('ajuda.pages.configuracoes.conta.plano_atual');
    }

    public function financeiro()
    {
        return view('ajuda.pages.configuracoes.conta.financeiro');
    }

    public function cobrancas()
    {
        return view('ajuda.pages.configuracoes.sistema.cobrancas');
    }

    public function faturamento()
    {
        return view('ajuda.pages.configuracoes.sistema.faturamento');
    }

    public function rastreamento()
    {
        return view('ajuda.pages.configuracoes.sistema.rastreamento');
    }

    public function remarketing()
    {
        return view('ajuda.pages.configuracoes.sistema.remarketing');
    }

    public function msgApresentacao()
    {
        return view('ajuda.pages.configuracoes.mensagens.apresentacao');
    }

    public function relatMensagens()
    {
        return view('ajuda.pages.configuracoes.mensagens.relatorio');
    }

    public function agradecimento()
    {
        return view('ajuda.pages.configuracoes.mensagens.agradecimento');
    }

    public function aniversario()
    {
        return view('ajuda.pages.configuracoes.mensagens.aniversario');
    }

    public function pesquisaSatisfacao()
    {
        return view('ajuda.pages.configuracoes.mensagens.pesquisa_satisfacao');
    }

    public function msgCobrancas()
    {
        return view('ajuda.pages.configuracoes.mensagens.cobrancas');
    }

    public function msgFaturamento()
    {
        return view('ajuda.pages.configuracoes.mensagens.faturamento');
    }

    public function impApresentacao()
    {
        return view('ajuda.pages.configuracoes.dados_importados.apresentacao');
    }

    public function impCobrancas()
    {
        return view('ajuda.pages.configuracoes.dados_importados.cobrancas');
    }

    public function impFaturamento()
    {
        return view('ajuda.pages.configuracoes.dados_importados.faturamento');
    }

    public function impRastreamento()
    {
        return view('ajuda.pages.configuracoes.dados_importados.rastreamento');
    }

    public function impRemarketing()
    {
        return view('ajuda.pages.configuracoes.dados_importados.remarketing');
    }

    public function relApresentacao()
    {
        return view('ajuda.pages.relatorios.apresentacao');
    }

    public function relCobrancas()
    {
        return view('ajuda.pages.relatorios.cobrancas');
    }

    public function relFaturamento()
    {
        return view('ajuda.pages.relatorios.faturamento');
    }

    public function relRastreamento()
    {
        return view('ajuda.pages.relatorios.rastreamento');
    }

    public function relRemarketing()
    {
        return view('ajuda.pages.relatorios.remarketing');
    }

    public function sugestoes() {

        return view('ajuda.pages.sugestoes');
    }

    public function integracaoCorreios()
    {
        return view('ajuda.pages.anexos.correios');
    }

    public function perfil()
    {
        return view('ajuda.pages.anexos.perfil');
    }
}
