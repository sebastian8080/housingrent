<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'role_id' => 1, 
            'name' => 'Sebastian Armijos',
            'email' => 'sebas25211@hotmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('27108318c'), 
            'phone' => '0964085651  ',
            'address' => 'Totoracocha',
            'is_active' => true,
        ]);
        User::create([
            'role_id' => 1, 
            'name' => 'Sebastian Ayala',
            'email' => 'sayala7986@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('Andyhermano7986'), 
            'phone' => '0959194364  ',
            'address' => 'Francisco Moscoso y 27 de febrero',
            'is_active' => true,
        ]);
    }
}
