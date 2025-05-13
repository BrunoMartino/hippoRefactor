<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AffiliateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // afiliado
        $user = \App\Models\User::factory()->create([
            'email' => 'afiliado@email.com',
            'password' => bcrypt('123'),
            'endereco' => 'Lorem ipsum',
            'cidade' => 'São Paulo',
            'estado' => 'SP',
            // 'whatsapp' => '(99) 99999-9999',
            'nivel_id' => 3,
        ]);


        // assinar
        $user->assignRole('afiliado');
        $user->givePermissionTo('edit-perfil', 'ver-rend-afiliados');


        $affiliate = \App\Models\Affiliate::factory()->create([
            'user_id' => $user->id,
            'ref_id' => Str::random(10),
            'comission' => 10
        ]);

        // Usuários de referência
        $usersReferral =  \App\Models\User::factory(20)->create([
            'password' => bcrypt('123'),
            'endereco' => 'Lorem ipsum',
            'cidade' => 'São Paulo',
            'estado' => 'SP',
            'nivel_id' => 2,
        ]);

        foreach ($usersReferral as $key => $user) {

            $user->assignRole(['usuario_princ'])->givePermissionTo(Permission::where('level_id', 'like', '%2%')->get());

            $affiliateReferral = \App\Models\AffiliateReferral::factory()->create([
                'user_id' => $user->id,
                'affiliate_id' => $affiliate->id
            ]);

            $planId = fake()->randomElement([1, 3]);
            $user->plano_id = $planId;
            $user->save();


            \App\Models\Subscription::factory()->create([
                'user_id' => $user->id,
                'plan_id' => $planId,
                'status' => 'ativo'
            ]);
        }

        /* mais usuários afiliados */
        $users = \App\Models\User::factory(20)->create([
            // 'email' => 'afiliado@email.com',
            'password' => bcrypt('123'),
            'endereco' => 'end-afiliado',
            'cidade' => 'São Paulo',
            'estado' => 'SP',
            // 'whatsapp' => '(99) 99999-9999',
            'nivel_id' => 3,
        ]);

        foreach (User::where('endereco', 'end-afiliado')->get() as $key => $user) {

            // $user = User::find($value->id);
            $user->assignRole('afiliado');
            $user->givePermissionTo('edit-perfil', 'ver-rend-afiliados');

            \App\Models\Affiliate::factory()->create([
                'user_id' => $user->id,
                'ref_id' => Str::random(10),
                'comission' => 10
            ]);
        }
    }
}
