<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                'name' => 'Diogo Bezerra',
                'email' => 'diogobezerra5@gmail.com',
                'password' => Hash::make('secret'),
            ]
        );
        DB::table('users')->insert(
            [
                'name' => 'Lauriza Bezerra',
                'email' => 'laurizabezerra@yahoo.com.br',
                'password' => Hash::make('secret'),
            ]
        );
    }
}
