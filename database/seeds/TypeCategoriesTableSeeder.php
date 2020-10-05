<?php

use Illuminate\Database\Seeder;
use \App\typeCategories;

class TypeCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        typeCategories::truncate();

        $tipoCategories = new typeCategories;
        $tipoCategories->name = "Musica";
        $tipoCategories->save();

        $tipoCategories = new typeCategories;
        $tipoCategories->name = "Comedia";
        $tipoCategories->save();
    }
}
