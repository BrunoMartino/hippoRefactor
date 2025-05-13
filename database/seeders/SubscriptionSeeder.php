<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Plano;
use App\Models\Subscription;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $usersMain = User::role('usuario_princ')->get();

        $user1 = User::find(3);
        $idPlans = [4, 3, 2, 3, 1, 2,10,15,16,8]; //sequencia de planos que o cliente vai mudar
        foreach ($idPlans as $id) :
            // ir para o plano premium 
            $user1->plano_id = $id;
            $user1->save();
            Subscription::where('user_id', 1)->update([
                'status' => 'inativo',
            ]);
            Subscription::create([
                'user_id' => 1,
                'status' => 'ativo',
                'plan_id' => $id,
                'valor_plano' => Plano::find($id)->valor
            ]);
        endforeach;

        $user2 = User::role('usuario_princ')->where('id', '!=', 3)->first();
        $idPlans = [4, 3, 2, 1, 2,5,12,6,9,10]; //sequencia de planos que o cliente vai mudar
        foreach ($idPlans as $id) :
            // ir para o plano premium 
            $user2->plano_id = $id;
            $user2->save();
            Subscription::where('user_id', 1)->update([
                'status' => 'inativo',
            ]);
            Subscription::create([
                'user_id' => 1,
                'status' => 'ativo',
                'plan_id' => $id,
                'valor_plano' => Plano::find($id)->valor
            ]);
        endforeach;

        Subscription::where('user_id', 1)->update([
            'status' => 'inativo',
        ]);



        /* Aplicar todos os planos ao usuário principal */

         // ir para o plano básico, de modulo 1 
         $user2->plano_id = 3;
         $user2->save();
         Subscription::create([
             'user_id' => 1,
             'status' => 'ativo',
             'plan_id' => 3,
             'valor_plano' => Plano::find(3)->valor
         ]);
         // ir para o plano básico, de modulo 2
         $user2->plano_id = 7;
         $user2->save();
         Subscription::create([
             'user_id' => 1,
             'status' => 'ativo',
             'plan_id' => 7,
             'valor_plano' => Plano::find(7)->valor
         ]);
         // ir para o plano básico, de modulo 3
         $user2->plano_id = 11;
         $user2->save();
         Subscription::create([
             'user_id' => 1,
             'status' => 'ativo',
             'plan_id' => 11,
             'valor_plano' => Plano::find(11)->valor
         ]);
         // ir para o plano básico, de modulo 4
         $user2->plano_id = 15;
         $user2->save();
         Subscription::create([
             'user_id' => 1,
             'status' => 'ativo',
             'plan_id' => 15,
             'valor_plano' => Plano::find(15)->valor
         ]);



    }
}
