<?php

namespace Database\Seeders;

use App\Models\Contacts;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class NFSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\NFS::factory(50)->create([
            'user_id' => 1,
        ]);
    }
}
