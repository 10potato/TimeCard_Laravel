<?php

use Illuminate\Database\Seeder;

class SampleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [];
        for ($i = 0; $i < 10; $i++) {
            $item = array();
            $item['name'] = 'サンプル太郎'.$i;
            $item['address'] = 'サンプル住所'.$i;
            $item['sex'] = ($i % 2 === 0)?'男':'女';
            $item['birthday'] = NOW();
            $item['phone_number'] = '090-0000-000'.$i;

            $items[] = $item;
        }

        DB::table('sample')->insert($items);
    }
}
