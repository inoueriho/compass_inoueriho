<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
            [
              'over_name' => 'Atlas',
              'under_name' => 'オレンジ',
              'over_name_kana' => 'アトラス',
              'under_name_kana' => 'オレンジ',
              'mail_address' => '678910@mail',
              'sex' => '1',
              'birth_day' => '2000-6-21',
              'role' => '4',
              'password' => bcrypt('62775115'),
            ],

            [
              'over_name' => 'Atlas',
              'under_name' => '緑',
              'over_name_kana' => 'アトラス',
              'under_name_kana' => 'ミドリ',
              'mail_address' => '7891011@mail',
              'sex' => '1',
              'birth_day' => '2000-11-27',
              'role' => '4',
              'password' => bcrypt('751151127'),
            ],
            [
              'over_name' => 'Atlas',
              'under_name' => '黒',
              'over_name_kana' => 'アトラス',
              'under_name_kana' => 'クロ',
              'mail_address' => '89101112@mail',
              'sex' => '1',
              'birth_day' => '2000-2-16',
              'role' => '4',
              'password' => bcrypt('1151127216'),
             ]

        ]);
    }
}
