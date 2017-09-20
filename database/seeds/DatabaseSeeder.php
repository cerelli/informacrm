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
        $this->call(UsersTableSeeder::class);
        $this->call(InfAccountTypesTableSeeder::class);
        $this->call(InfAddressTypesTableSeeder::class);
        $this->call(InfCommunicationTypesTableSeeder::class);
        $this->call(InfContactDetailTypesTableSeeder::class);
        $this->call(InfContactTypesTableSeeder::class);
        $this->call(InfLocalitiesTableSeeder::class);
        $this->call(InfOfficesTableSeeder::class);
        $this->call(InfTitlesTableSeeder::class);
        $this->call(InfWebSiteTypesTableSeeder::class);
    }
}
