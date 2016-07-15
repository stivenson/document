<?php

use Illuminate\Database\Seeder;
use document\Models\Typedocument;

class TypedocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('typedocuments')->delete();
        Typedocument::create(['id'=>1,'name' => 'CÉDULA']);
        Typedocument::create(['id'=>2,'name' => 'CÉDULA DE EXTRANJERÍA ']);
        Typedocument::create(['id'=>3,'name' => 'PASAPORTE']);
        Typedocument::create(['id'=>4,'name' => 'LIBRETA MILITAR']);
    }
}
