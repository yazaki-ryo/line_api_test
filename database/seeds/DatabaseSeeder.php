<?php
declare(strict_types=1);

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
        $this->call(PermissionsSeeder::class);
        $this->call(PlansSeeder::class);
        $this->call(PrefecturesSeeder::class);
        $this->call(SexesSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(CompaniesSeeder::class);
        $this->call(StoresSeeder::class);
        $this->call(TagsSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(CustomersSeeder::class);
    }
}
