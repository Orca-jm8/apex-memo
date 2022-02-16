<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name'  => 'admin',
            'email' => 'admin@co.jp',
            'password' => '00000000',
            'rank_id' => 1,
        ];
        $user = new User;
        $user->fill($param)->save();
    }
}
