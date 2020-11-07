<?php

namespace Database\Seeders;

use App\Models\SerieList;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use function PHPSTORM_META\map;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'email' => 'luizeduardo.ufg@gmail.com',
            'password' => Hash::make('Legs_22.'),
            'username' => 'luiz'
        ]);
    }
}
