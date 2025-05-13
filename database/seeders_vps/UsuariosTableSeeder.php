<?php

namespace Database\Seeders;

use App\Models\User;
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
            'cnpj' => '53882614000100',
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

        \App\Models\Subscription::factory()->create([
            'user_id' => $userMain->id,
            'plan_id' => 2,
            'status' => 'ativo'
        ]);

        \App\Models\Subscription::factory()->create([
            'user_id' => $userMain->id,
            'plan_id' => 6,
            'status' => 'ativo'
        ]);
        
        \App\Models\Subscription::factory()->create([
            'user_id' => $userMain->id,
            'plan_id' => 10,
            'status' => 'ativo'
        ]);

        \App\Models\Subscription::factory()->create([
            'user_id' => $userMain->id,
            'plan_id' => 14,
            'status' => 'ativo'
        ]);

        User::create([
            'nome_usuario' => 'Super Admin',
            'email' => 'super.admin@email.com',
            'password' => bcrypt('123'),
            'nivel_id' => 1
        ])->assignRole('super_admin');

        $users = [
            [
                'nome_usuario' => 'Danilo',
                'email' => 'danilo@email.com',
                'password' => bcrypt('123'),
                'nivel_id' => 1
            ],
            [
                'nome_usuario' => 'Renato',
                'email' => 'renato@email.com',
                'password' => bcrypt('123'),
                'nivel_id' => 1
            ],
            [
                'nome_usuario' => 'Geovane',
                'email' => 'geovane@email.com',
                'password' => bcrypt('123'),
                'nivel_id' => 1
            ],
            [
                'nome_usuario' => 'Matheus',
                'email' => 'matheus@email.com',
                'password' => bcrypt('123'),
                'nivel_id' => 1
            ]
        ];

        foreach ($users as $userData) {
            User::create($userData)
                ->assignRole('admin')
                ->givePermissionTo(
                    Permission::where('level_id', 'like', '%1%')
                        ->get()
                );
        }
    }
}
