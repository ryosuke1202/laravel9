<?php

use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            [
                'id' => '1',
                'name' => 'コスメ',
            ],
            [
                'id' => '2',
                'name' => '化粧品',
            ],
            [
                'id' => '3',
                'name' => '夏コスメ',
            ],
            [
                'id' => '4',
                'name' => 'パック',
            ],
            [
                'id' => '5',
                'name' => '雑貨',
            ],
            [
                'id' => '6',
                'name' => '日用品',
            ],
            [
                'id' => '7',
                'name' => 'プレゼント',
            ],
            [
                'id' => '8',
                'name' => 'セール',
            ],
            [
                'id' => '9',
                'name' => 'ウェア',
            ],
            [
                'id' => '10',
                'name' => '人気商品',
            ],
        ]);
    }
}
