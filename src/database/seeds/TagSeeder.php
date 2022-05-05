<?php

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([
            [
                'id' => '1',
                'name' => '化粧水',
            ],
            [
                'id' => '2',
                'name' => 'マスク',
            ],
            [
                'id' => '3',
                'name' => 'パック',
            ],
            [
                'id' => '4',
                'name' => 'ヘアケア',
            ],
            [
                'id' => '5',
                'name' => 'クリーム',
            ],
            [
                'id' => '6',
                'name' => '乾燥肌',
            ],
            [
                'id' => '7',
                'name' => '夏コスメ',
            ],
            [
                'id' => '8',
                'name' => 'オーガニック',
            ],
            [
                'id' => '9',
                'name' => 'ネイル',
            ],
            [
                'id' => '10',
                'name' => '低刺激',
            ],
        ]);
    }
}
