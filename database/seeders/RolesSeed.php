<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            'desc' => 'Admin'
        ]);

        DB::table('roles')->insert([
            'name' => 'free',
            'desc' => 'Free'
        ]);

        DB::table('roles')->insert([
            'name' => 'member',
            'desc' => 'Member'
        ]);
    }
}
