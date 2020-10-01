<?php

use Illuminate\Database\Seeder;

class RolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('rols')->insert([
            ['name' =>'admin','description' => 'Tiene control de todo']
        ]);
    }
}
