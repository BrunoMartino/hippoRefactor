<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\ImportedOrderGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ImportedOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /* ========== Remrketing ============ */
        $group = ImportedOrderGroup::create([
            'name' => 'Rem1',
            'user_id' => 1,
            'module_id' => 3
        ]);

        \App\Models\ImportedRemarketing::factory(20)->create([
            'user_id' => 1, // 3 -> id usuário princ.
            'group_id' => $group->id,
            'module_id' => 3
        ]);


        /* ========== Cobranças ========== */
        $group = ImportedOrderGroup::create([
            'name' => 'Cob1',
            'user_id' => 1,
            'module_id' => 1
        ]);

        \App\Models\ImportedBilling::factory(20)->create([
            'user_id' => 1,
            'group_id' => $group->id,
            'module_id' => 1,
        ]);
        /* ========== Rastreamento ========== */
        $group = ImportedOrderGroup::create([
            'name' => 'Rast1',
            'user_id' => 1,
            'module_id' => 4
        ]);

        for ($i = 0; $i < 20; $i++) {
            \App\Models\ImportedTracking::factory()->create([
                'user_id' => 1,
                'group_id' => $group->id,
                'module_id' => 4,
            ]);
        }

        /* ========== Faturamento ========== */
        $group = ImportedOrderGroup::create([
            'name' => 'Fat1',
            'user_id' => 1,
            'module_id' => 2
        ]);

        \App\Models\ImportedInvoicing::factory(20)->create([
            'user_id' => 1,
            'group_id' => $group->id,
            'module_id' => 2,
        ]);


        /* ================================= */
        /* ================================= */
        /* ================================= */
        /* ================================= */
        /* ================================= */


        for ($i = 2; $i < 14; $i++) {
            $group = ImportedOrderGroup::create([
                'name' => 'Rem' . $i,
                'user_id' => 1,
                'module_id' => 3
            ]);

            \App\Models\ImportedRemarketing::factory(20)->create([
                'user_id' => 1, // 3 -> id usuário princ.
                'group_id' => $group->id,
                'module_id' => 3
            ]);
        }


        /* ========== Cobranças ========== */
        for ($i = 2; $i < 14; $i++) {
            $group = ImportedOrderGroup::create([
                'name' => 'Cob' . $i,
                'user_id' => 1,
                'module_id' => 1
            ]);

            \App\Models\ImportedBilling::factory(20)->create([
                'user_id' => 1,
                'group_id' => $group->id,
                'module_id' => 1,
            ]);
        }

        /* ========== Rastreamento ========== */
        for ($ind = 2; $ind < 14; $ind++) {
            $group = ImportedOrderGroup::create([
                'name' => 'Rast' . $ind,
                'user_id' => 1,
                'module_id' => 4
            ]);

            \App\Models\ImportedTracking::factory(20)->create([
                'user_id' => 1,
                'group_id' => $group->id,
                'module_id' => 4,
            ]);
        }


        /* ========== Faturamento ========== */
        for ($i = 2; $i < 14; $i++) {
            $group = ImportedOrderGroup::create([
                'name' => 'Fat' . $i,
                'user_id' => 1,
                'module_id' => 2
            ]);

            \App\Models\ImportedInvoicing::factory(20)->create([
                'user_id' => 1,
                'group_id' => $group->id,
                'module_id' => 2,
            ]);
        }
    }
}
