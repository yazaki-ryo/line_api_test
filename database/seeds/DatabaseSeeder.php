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
        $this->call(PermissionsSeeder::class);
        $this->call(PlansSeeder::class);
        $this->call(PrefecturesSeeder::class);
        $this->call(SexesSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(TagsSeeder::class);

        /**
         * Records...
         */
        $this->call(SampleDataSeeder::class);
    }
}
