<?php

use Illuminate\Database\Seeder;
use App\Models\Users\Subjects;
use Illuminate\Support\Facades\DB;

class SubjectUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subject_users')->insert([
          ['user_id' => '1',
           'subject_id' => '2',
          ],
          ['user_id' => '2',
           'subject_id' => '1',
          ],
          ['user_id' => '3',
           'subject_id' => '3',
          ]
        ]);
    }
}
