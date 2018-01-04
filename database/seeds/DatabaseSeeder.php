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
        $this->call(AccountTypesTableSeeder::class);
        $this->call(AddressTypesTableSeeder::class);
        $this->call(CommunicationTypesTableSeeder::class);
        $this->call(ContactDetailTypesTableSeeder::class);
        $this->call(ContactTypesTableSeeder::class);
        $this->call(LocalitiesTableSeeder::class);
        $this->call(OfficesTableSeeder::class);
        $this->call(TitlesTableSeeder::class);
        $this->call(WebSiteTypesTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(AddDummyEvent::class);
        $this->call(AddFirstRolePermission::class);
    }
}
