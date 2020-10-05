<?php

use App\ArtistType;
use Illuminate\Database\Seeder;

class ArtistTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ArtistType::truncate();

        $artistType = new ArtistType();
        $artistType->name = "Solista";
        $artistType->save();


        // $artistType = new ArtistType();
        // $artistType->name = "Compositor";
        // $artistType->save();

        $artistType = new ArtistType();
        $artistType->name = "Agrupación musical";
        $artistType->save();


    }
}
