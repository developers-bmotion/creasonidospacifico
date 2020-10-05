<?php

use Illuminate\Database\Seeder;
use  \App\Level;

class LevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::truncate();

        $level = new Level;
        $level->level = "Principiante";
        $level->save();

        $level = new Level;
        $level->level = "Intermedio";
        $level->save();

        $level = new Level;
        $level->level = "Profesional";
        $level->save();
    }
}
