<?php

use Illuminate\Database\Seeder;

class MUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('m_user')->insert(
            array(
                array(
                    'email' => 'admin@test.com',
                    'password' => bcrypt('test'),
                    'name' => 'スーパーユーザー',
                ),
                array(
                    'email' => 'user1@test.com',
                    'password' => bcrypt('test'),
                    'name' => 'ユーザー1',
                ),
            )
        );
    }
}
