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
        $this->call([
            DocumentTypesTableSeeder::class,
            UsersTableSeeder::class,
            RolsTableSeeder::class,
            RolUserTableSeeder::class
        ]);
    }
}
