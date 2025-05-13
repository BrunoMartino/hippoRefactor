<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsuariosTableSeeder extends Seeder
{
    public function run(): void
    {

        $userMain = \App\Models\User::factory()->create([
            'nome_usuario' => 'Hippo',
            'email' => 'notifyhippo@gmail.com',
            'cnpj' => '66588451000108',
            'tipo_usuario' => 'PJ',
            'whatsapp' => '61991012077',
            'plano_id' => 2,
            'razao_social' => 'Hippo',
            'endereco' => 'R EUNILDO STEVANATO, 380',
            'bairro' => 'JARDIM SANTA MONICA II',
            'cidade' => 'CIANORTE',
            'estado' => 'PR',
            'password' => bcrypt('123'),
            'nivel_id' => 2
        ])->assignRole(['usuario_princ'])->givePermissionTo(Permission::where('level_id', 'like', '%2%')->get());

        \App\Models\User::factory()->create([
            'email' => 'super@email.com',
            'password' => bcrypt('123'),
            'nivel_id' => 1
        ])->assignRole('super_admin');

        \App\Models\User::factory()->create([
            'email' => 'admin@email.com',
            'password' => bcrypt('123'),
            'nivel_id' => 1
        ])->assignRole('admin')->givePermissionTo(Permission::where('level_id', 'like', '%1%')->get());

        $userSec = \App\Models\User::factory()->create([
            'email' => 'usuario.sec@email.com',
            'password' => bcrypt('123'),
            'nivel_id' => 2,
            'plano_id' => 2,
            'cadastrado_por' => $userMain->id,
        ])->assignRole(['usuario_sec'])->givePermissionTo('edit-perfil');

        \App\Models\Subscription::factory()->create([
            'user_id' => $userMain->id,
            'plan_id' => 2,
            'status' => 'ativo'
        ]);

        // \App\Models\Subscription::factory()->create([
        //     'user_id' => $userSec->id,
        //     'plan_id' => 2,
        //     'status' => 'ativo'
        // ]);

        for ($i = 0; $i < 30; $i++) {

            // $userMain = \App\Models\User::factory()->create([
            //     'password' => bcrypt('123'),
            //     'nivel_id' => 2
            // ])->assignRole([ 'usuario_princ']);

            // \App\Models\Subscription::factory()->create([
            //     'user_id' => $userMain->id,
            //     'plan_id' => 2
            // ]);
        }

        /* Usuários plano gratuito */
        for ($i = 0; $i < 20; $i++) {
            $userFree = \App\Models\User::factory()->create([
                // 'email' => 'usuario.princ@email.com',
                'cpf' => rand(10000000000, 99999999999),
                'plano_id' => 4,
                'password' => bcrypt('123'),
                'nivel_id' => 2
            ])->assignRole(['usuario_princ'])->givePermissionTo(Permission::where('level_id', 'like', '%2%')->get());

            \App\Models\Subscription::factory()->create([
                'user_id' => $userFree->id,
                'plan_id' => 4,
                'status' => 'ativo'
            ]);
        }
        /* Usuários plano gratuito */
        for ($i = 0; $i < 20; $i++) {
            $userTotal = \App\Models\User::factory()->create([
                // 'email' => 'usuario.princ@email.com',
                'cpf' => rand(10000000000, 99999999999),
                'plano_id' => 2,
                'password' => bcrypt('123'),
                'nivel_id' => 2
            ])->assignRole(['usuario_princ'])->givePermissionTo(Permission::where('level_id', 'like', '%2%')->get());

            \App\Models\Subscription::factory()->create([
                'user_id' => $userTotal->id,
                'plan_id' => 2,
                'status' => 'ativo'
            ]);
        }
    }
}
