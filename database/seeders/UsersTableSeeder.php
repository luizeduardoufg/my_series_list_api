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
        $user1 = User::create([
            'email' => 'luizeduardo.ufg@gmail.com',
            'password' => Hash::make('Legs_22.'),
            'username' => 'luiz'
        ]);
        $user2 = User::create([
            'email' => 'teste@teste',
            'password' => Hash::make('teste'),
            'username' => 'teste'
        ]);
        $user1->list_id = $user1->id;
        $user1->save();
        $user2->list_id = $user2->id;
        $user2->save();
    }
}
