<?php

use Illuminate\Database\Seeder;

class RolUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('rol_user')->insert([
            'user_id' => 1,
            'rol_id' => 1
        ]);
    }
}
