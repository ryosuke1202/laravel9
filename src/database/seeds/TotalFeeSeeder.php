<?php

use Illuminate\Database\Seeder;

class TotalFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\TotalFee::class, 40)->create();
    }
}
