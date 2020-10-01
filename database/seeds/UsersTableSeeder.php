<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            'document_type_id' => 1,
            'document_number'=>'0000000',
            'last_name'=>Str::random(4),
            'first_name'=>'admin',
            'born_date'=> date('Y-m-d'),
            'phone'=> Str::random(9),
            'gender' => 'M',
            'email' => Str::random(9).'@mail.com',
            'password' => Hash::make('admin')
        ]);  
    }
}
