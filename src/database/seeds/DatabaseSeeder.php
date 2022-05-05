<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TypeSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(TagSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(CartSeeder::class);
        // $this->call(ProductTagSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(FavoriteSeeder::class);
        $this->call(EvaluationSeeder::class);
        $this->call(TotalFeeSeeder::class);
    }
}
