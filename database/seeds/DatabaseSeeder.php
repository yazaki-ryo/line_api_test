<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Masters...
         */
        $this->call(PrefecturesSeeder::class);
        $this->call(PlansSeeder::class);
        $this->call(RolesSeeder::class);

        /**
         * Records...
         */
        $this->call(SampleDataSeeder::class);
    }
}
