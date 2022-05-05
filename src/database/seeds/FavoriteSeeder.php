<?php

use Illuminate\Database\Seeder;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('favorites')->insert([
            [
                'id' => '1',
                'user_id' => '1',
                'product_id' => '1',
            ],
            [
                'id' => '2',
                'user_id' => '2',
                'product_id' => '2',
            ],
            [
                'id' => '3',
                'user_id' => '1',
                'product_id' => '5',
            ],
            [
                'id' => '4',
                'user_id' => '4',
                'product_id' => '1',
            ],
            [
                'id' => '5',
                'user_id' => '2',
                'product_id' => '3',
            ],
            [
                'id' => '6',
                'user_id' => '2',
                'product_id' => '7',
            ],
            [
                'id' => '7',
                'user_id' => '2',
                'product_id' => '8',
            ],
            [
                'id' => '8',
                'user_id' => '2',
                'product_id' => '2',
            ],
            [
                'id' => '9',
                'user_id' => '4',
                'product_id' => '13',
            ],
            [
                'id' => '10',
                'user_id' => '3',
                'product_id' => '6',
            ],
        ]);
    }
}
