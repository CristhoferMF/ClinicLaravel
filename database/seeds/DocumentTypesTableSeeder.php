<?php

use Illuminate\Database\Seeder;

class DocumentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('document_types')->insert([
            ['name' => 'DNI'],
            ['name' => 'PASAPORTE'],
            ['name' => 'CARNET DE EXTRANJERÍA']
        ]);
    }
}
