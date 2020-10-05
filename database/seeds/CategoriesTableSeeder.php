<?php

use Illuminate\Database\Seeder;
use \App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        $category = new Category;
        $category->category = "Músicas populares y campesinas";
        $category->slug = str_slug("populares_campesinas",'-');
        $category->description = "";
        $category->typeCategory_id = 1;
        $category->save();

        $category = new Category;
        $category->category = "Música andina";
        $category->slug = str_slug("música_andina",'-');
        $category->description = "Tradicional y/o contemporánea";
        $category->typeCategory_id = 1;
        $category->save();

        $category = new Category;
        $category->category = "Música tradicional del Sur Occidente";
        $category->slug = str_slug("música_tradicional",'-');
        $category->description = "Norte, centro y sur";
        $category->typeCategory_id = 1;
        $category->save();

        $category = new Category;
        $category->category = "Música tradicional del Pacífico";
        $category->slug = str_slug("música_tradicional_pc",'-');
        $category->description = "Norte, centro y sur";
        $category->typeCategory_id = 1;
        $category->save();

        $category = new Category;
        $category->category = "Música urbana Pacífico";
        $category->slug = str_slug("música_urbana",'-');
        $category->description = "fusiones urbanas con música tradicional del Pacífico.";
        $category->typeCategory_id = 1;
        $category->save();

        $category = new Category;
        $category->category = "Música salsa, antillana y fusión salsa";
        $category->slug = str_slug("música_urbana",'-');
        $category->description = "";
        $category->typeCategory_id = 1;
        $category->save();



        $category = new Category;
        $category->category = "Música jazz";
        $category->slug = str_slug("música_jazz",'-');
        $category->description = "Jazz Pacífico, latín jazz, blues, góspel.";
        $category->typeCategory_id = 1;
        $category->save();

        $category = new Category;
        $category->category = "Músicas espirituales y religiosas";
        $category->slug = str_slug("músicas_espirituales",'-');
        $category->description = "música sacra, cantos gregorianos, música sacra negra (chigüalos, alabaos, salves, cantos de boga) etcétera";
        $category->typeCategory_id = 1;
        $category->save();

        $category = new Category;
        $category->category = "Música Clásica";
        $category->slug = str_slug("música_clásica",'-');
        $category->description = "En todos sus formatos";
        $category->typeCategory_id = 1;
        $category->save();

        $category = new Category;
        $category->category = "Música joven";
        $category->slug = str_slug("música_joven",'-');
        $category->description = "Trap, rap, reggaetón, hip-hop";
        $category->typeCategory_id = 1;
        $category->save();

        $category = new Category;
        $category->category = "Otras Músicas";
        $category->slug = str_slug("otras_musicas",'-');
        $category->description = "Música experimental, world music, proyectos especiales y nuevas propuestas.";
        $category->typeCategory_id = 1;
        $category->save();



    }
}
