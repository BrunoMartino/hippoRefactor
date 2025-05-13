<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        /* Permissões */
        foreach ($this->arrayPermissoes() as $value) :
            Permission::create($value);
        endforeach;

        /* Roles Super Admin */
        $superAdmin = Role::create(['name' => 'super_admin']);
        $superAdmin->givePermissionTo(Permission::where('level_id', 'like', '%1%')->get());

        /* Role Admin */
        Role::create(['name' => 'admin']);

        /* Role usuário principal */
        Role::create(['name' => 'usuario_princ']);

        /* Role usuário secondario */
        Role::create(['name' => 'usuario_sec']);

        /* Role usuário afiliado */
        Role::create(['name' => 'afiliado']);
    }

    public function arrayPermissoes()
    {
        $permissions = [
            [
                'name' => 'edit-perfil',
                'description' => 'Editar dados do perfil',
                'area' => 'Perfil',
                'level_id' => '1,2,3'
            ],
            [
                'name' => 'ver-user-cadast',
                'description' => 'Visualizar somente usuário(s) cadastrado(s)',
                'area' => 'Usuários',
                'level_id' => '1,2'
            ],
            [
                'name' => 'cad-user',
                'description' => 'Cadastrar usuário(s)',
                'area' => 'Usuários',
                'level_id' => '1'
            ],
            [
                'name' => 'ver-todos-users',
                'description' => 'Visualizar todos os usuários',
                'area' => 'Usuários',
                'level_id' => '1'
            ],

            [
                'name' => 'cad-user-admin',
                'description' => 'Cadastrar usuário(s) nível administrativo',
                'area' => 'Usuários',
                'level_id' => '1'
            ],
            [
                'name' => 'cad-user-princ',
                'description' => 'Cadastrar usuário(s) nível principal',
                'area' => 'Usuários',
                'level_id' => '1'
            ],
            [
                'name' => 'cad-user-secund',
                'description' => 'Cadastrar usuário(s) nível secundário',
                'area' => 'Usuários',
                'level_id' => '1,2'
            ],
            [
                'name' => 'edit-users',
                'description' => 'Editar dados de todos usuários',
                'area' => 'Usuários',
                'level_id' => '1'
            ],
            [
                'name' => 'edit-user',
                'description' => 'Editar dados do(s) usuário(s) cadastrado(s)',
                'area' => 'Usuários',
                'level_id' => '1,2'
            ],
            [
                'name' => 'deletar-users',
                'description' => 'Deletar usuários',
                'area' => 'Usuários',
                'level_id' => '1'
            ],
            [
                'name' => 'deletar-user',
                'description' => 'Deletar usuário(s) nível secundário',
                'area' => 'Usuários',
                'level_id' => '1,2'
            ],
            [
                'name' => 'ver-permissoes',
                'description' => 'Visualizar permissões de usuários',
                'area' => 'Usuários',
                'level_id' => '1,2'
            ],
            [
                'name' => 'edit-permissoes',
                'description' => 'Editar permissões de usuários',
                'area' => 'Usuários',
                'level_id' => '1,2'
            ],
            [
                'name' => 'ver-planos',
                'description' => 'Visualizar planos de assinatura',
                'area' => 'Planos',
                'level_id' => '1'
            ],
            [
                'name' => 'edit-planos',
                'description' => 'Editar planos de assinatura',
                'area' => 'Planos',
                'level_id' => '1'
            ],
            [
                'name' => 'ver-config-conta',
                'description' => 'Visualizar configurações da conta',
                'area' => 'Conta',
                'level_id' => '2'
            ],
            [
                'name' => 'edit-config-conta',
                'description' => 'Editar configurações da conta',
                'area' => 'Conta',
                'level_id' => '2'
            ],
            // [
            //     'name' => 'ver-sistema',
            //     'description' => 'Visualizar configurações do sistema',
            //     'area' => 'Configurações',
            //     'level_id' => '2'
            // ],
            // [
            //     'name' => 'edit-sistema',
            //     'description' => 'Editar configurações do sistema',
            //     'area' => 'Configurações',
            //     'level_id' => '2'
            // ],
            [
                'name' => 'ver-relat-notif',
                'description' => 'Visualizar relatórios de notificações',
                'area' => 'Notificações',
                'level_id' => '2'
            ],
            [
                'name' => 'ver-assinaturas',
                'description' => 'Visualizar relatórios de assinaturas',
                'area' => 'Assinaturas',
                'level_id' => '1'
            ],
            [
                'name' => 'edit-assinaturas',
                'description' => 'Editar dados das assinaturas',
                'area' => 'Assinaturas',
                'level_id' => '1'
            ],
            [
                'name' => 'cancel-assinaturas',
                'description' => 'Cancelar assinaturas',
                'area' => 'Assinaturas',
                'level_id' => '1'
            ],
            [
                'name' => 'ver-assinatura',
                'description' => 'Visualizar dados sobre a assinatura',
                'area' => 'Assinaturas',
                'level_id' => '1'
            ],
            [
                'name' => 'edit-assinatura',
                'description' => 'Editar dados da assinatura',
                'area' => 'Assinaturas',
                'level_id' => '1'
            ],
            [
                'name' => 'edit-vl-assinaturas',
                'description' => 'Editar valor das assinaturas',
                'area' => 'Assinaturas',
                'level_id' => '1'
            ],
            [
                'name' => 'ver-relat-financ',
                'description' => 'Visualizar relatórios financeiros',
                'area' => 'Relatórios',
                'level_id' => '1'
            ],
            [
                'name' => 'ver-relat-plano',
                'description' => 'Visualizar relatórios de plano gratuito',
                'area' => 'Relatórios',
                'level_id' => '1'
            ],
            [
                'name' => 'ver-relat-plano-pago',
                'description' => 'Visualizar relatórios de plano pago',
                'area' => 'Relatórios',
                'level_id' => '1'
            ],
            [
                'name' => 'ver-relat-mensagens-env',
                'description' => 'Visualizar relatórios de mensagens enviadas',
                'area' => 'Relatórios',
                'level_id' => '1'
            ],
            [
                'name' => 'ver-mensagens',
                'description' => 'Visualizar relatório de mensagens',
                'area' => 'Mensagens',
                'level_id' => '2'
            ],
            [
                'name' => 'criar-mensagens',
                'description' => 'Criar mensagem',
                'area' => 'Mensagens',
                'level_id' => '2'
            ],
            [
                'name' => 'edit-mensagens',
                'description' => 'Editar dados da mensagem',
                'area' => 'Mensagens',
                'level_id' => '2'
            ],
            [
                'name' => 'deletar-mensagens',
                'description' => 'Deletar mensagem',
                'area' => 'Mensagens',
                'level_id' => '2'
            ],
            [
                'name' => 'ver-logs-acesso',
                'description' => 'Visualizar relatório de logs de entrada',
                'area' => 'Logs',
                'level_id' => '1'
            ],
            [
                'name' => 'ver-cupons',
                'description' => 'Visualizar dados sobre cupons',
                'area' => 'Cupons de desconto',
                'level_id' => '1'
            ],
            [
                'name' => 'criar-cupons',
                'description' => 'Criar cupons',
                'area' => 'Cupons de desconto',
                'level_id' => '1'
            ],
            // [
            //     'name' => 'edi-cupons',
            //     'description' => 'Editar dados de cupom',
            //     'area' => 'Cupons de desconto',
            //     'level_id' => '1'
            // ],
            [
                'name' => 'deletar-cupons',
                'description' => 'Deletar registros de cupons',
                'area' => 'Cupons de desconto',
                'level_id' => '1'
            ],
            [
                'name' => 'ativar-desativar-cupons',
                'description' => 'Ativar/Desativar registros de cupons',
                'area' => 'Cupons de desconto',
                'level_id' => '1'
            ],
            // Descontos mensais
            [
                'name' => 'ver-desc-mensais',
                'description' => 'Visualizar descontos mensais',
                'area' => 'Descontos mensais',
                'level_id' => '1'
            ],
            [
                'name' => 'criar-desc-mensais',
                'description' => 'Criar descontos mensais',
                'area' => 'Descontos mensais',
                'level_id' => '1'
            ],
            [
                'name' => 'edit-desc-mensais',
                'description' => 'Editar descontos mensais',
                'area' => 'Descontos mensais',
                'level_id' => '1'
            ],
            [
                'name' => 'deletar-desc-mensais',
                'description' => 'Deletar descontos mensais',
                'area' => 'Descontos mensais',
                'level_id' => '1'
            ],

            // Afiliados
            [
                'name' => 'ver-afiliados',
                'description' => 'Visualizar dados sobre afiliados',
                'area' => 'Afiliados',
                'level_id' => '1'
            ],
            [
                'name' => 'criar-afiliados',
                'description' => 'Criar afiliados',
                'area' => 'Afiliados',
                'level_id' => '1'
            ],
            [
                'name' => 'edit-afiliados',
                'description' => 'Editar dados de afiliados',
                'area' => 'Afiliados',
                'level_id' => '1'
            ],
            [
                'name' => 'deletar-afiliados',
                'description' => 'Deletar afiliados',
                'area' => 'Afiliados',
                'level_id' => '1'
            ],
            [
                'name' => 'ver-rend-afiliados-adm',
                'description' => 'Ver rendimento de afiliados',
                'area' => 'Afiliados',
                'level_id' => '1'
            ],
            // Para usuário tipo afiliado 
            [
                'name' => 'ver-rend-afiliados',
                'description' => 'Ver rendimentos de afiliados',
                'area' => 'Rendimentos afiliados',
                'level_id' => '3'
            ],
            // módulo cobranças
            [
                'name' => 'ver-modulo-cobrancas',
                'description' => 'Visualizar módulo Cobranças',
                'area' => 'Cobranças',
                'level_id' => '2'
            ],
            [
                'name' => 'edit-modulo-cobrancas',
                'description' => 'Editar módulo Cobranças',
                'area' => 'Cobranças',
                'level_id' => '2'
            ],
            // módulo faturamento
            [
                'name' => 'ver-modulo-faturamento',
                'description' => 'Visualizar módulo Faturamento',
                'area' => 'Faturamento',
                'level_id' => '2'
            ],
            [
                'name' => 'edit-modulo-faturamento',
                'description' => 'Editar módulo Faturamento',
                'area' => 'Faturamento',
                'level_id' => '2'
            ],
            // módulo rastreamento
            [
                'name' => 'ver-modulo-rastreamento',
                'description' => 'Visualizar módulo Rastreamento',
                'area' => 'Rastreamento',
                'level_id' => '2'
            ],
            [
                'name' => 'edit-modulo-rastreamento',
                'description' => 'Editar módulo Rastreamento',
                'area' => 'Rastreamento',
                'level_id' => '2'
            ],
            // módulo remarketing
            [
                'name' => 'ver-modulo-remarketing',
                'description' => 'Visualizar módulo Remarketing',
                'area' => 'Remarketing',
                'level_id' => '2'
            ],
            [
                'name' => 'edit-modulo-remarketing',
                'description' => 'Editar módulo Remarketing',
                'area' => 'Remarketing',
                'level_id' => '2'
            ],


            // importar Cobranças
            [
                'name' => 'ver-import-cobrancas',
                'description' => 'Visualizar dados importados Cobranças',
                'area' => 'Dados Importados Cobranças',
                'level_id' => '2'
            ],
            [
                'name' => 'criar-import-cobrancas',
                'description' => 'Importar dados Cobranças',
                'area' => 'Dados Importados Cobranças',
                'level_id' => '2'
            ],
            [
                'name' => 'deletar-import-cobrancas',
                'description' => 'Deletar dados Cobranças',
                'area' => 'Dados Importados Cobranças',
                'level_id' => '2'
            ],

            // importar remarketing
            [
                'name' => 'ver-import-remarketing',
                'description' => 'Visualizar dados importados Remarketing',
                'area' => 'Dados Importados Remarketing',
                'level_id' => '2'
            ],
            [
                'name' => 'criar-import-remarketing',
                'description' => 'Importar dados Remarketing',
                'area' => 'Dados Importados Remarketing',
                'level_id' => '2'
            ],
            [
                'name' => 'deletar-import-remarketing',
                'description' => 'Deletar dados Remarketing',
                'area' => 'Dados Importados Remarketing',
                'level_id' => '2'
            ],

            // importar Faturamento
            [
                'name' => 'ver-import-faturamento',
                'description' => 'Visualizar dados importados Faturamento',
                'area' => 'Dados Importados Faturamento',
                'level_id' => '2'
            ],
            [
                'name' => 'criar-import-faturamento',
                'description' => 'Importar dados Faturamento',
                'area' => 'Dados Importados Faturamento',
                'level_id' => '2'
            ],
            [
                'name' => 'deletar-import-faturamento',
                'description' => 'Deletar dados Faturamento',
                'area' => 'Dados Importados Faturamento',
                'level_id' => '2'
            ],

            // importar Rastreamento
            [
                'name' => 'ver-import-rastreamento',
                'description' => 'Visualizar dados importados Rastreamento',
                'area' => 'Dados Importados Rastreamento',
                'level_id' => '2'
            ],
            [
                'name' => 'criar-import-rastreamento',
                'description' => 'Importar dados Rastreamento',
                'area' => 'Dados Importados Rastreamento',
                'level_id' => '2'
            ],
            [
                'name' => 'deletar-import-rastreamento',
                'description' => 'Deletar dados Rastreamento',
                'area' => 'Dados Importados Rastreamento',
                'level_id' => '2'
            ],

        ];

        return $permissions;
    }
}
