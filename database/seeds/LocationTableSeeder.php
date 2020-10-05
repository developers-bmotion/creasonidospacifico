<?php

use Illuminate\Database\Seeder;
use \App\Location;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::truncate();

        $location = new Location;
        $location->country = "Colombia";
        $location->flag = "/backend/assets/app/media/img/countries/colombia.png";
        $location->save();

        $location = new Location;
        $location->country = "Venezuela";
        $location->flag = "/backend/assets/app/media/img/countries/venezuela.png";
        $location->save();

        $location = new Location;
        $location->country = "Ecuador";
        $location->flag = "/backend/assets/app/media/img/countries/ecuador.png";
        $location->save();

        $location = new Location;
        $location->country = "Perú";
        $location->flag = "/backend/assets/app/media/img/countries/peru.png";
        $location->save();

        $location = new Location;
        $location->country = "Brasil";
        $location->flag = "/backend/assets/app/media/img/countries/brazil.png";
        $location->save();

        $location = new Location;
        $location->country = "Paraguay";
        $location->flag = "/backend/assets/app/media/img/countries/paraguay.png";
        $location->save();

        $location = new Location;
        $location->country = "Uruguay";
        $location->flag = "/backend/assets/app/media/img/countries/uruguay.png";
        $location->save();

        $location = new Location;
        $location->country = "Argentina";
        $location->flag = "/backend/assets/app/media/img/countries/argentina.png";
        $location->save();

        $location = new Location;
        $location->country = "Mexico";
        $location->flag = "/backend/assets/app/media/img/countries/mexico.png";
        $location->save();

        $location = new Location;
        $location->country = "Puerto Rico";
        $location->flag = "/backend/assets/app/media/img/countries/puerto-rico.png";
        $location->save();

        $location = new Location;
        $location->country = "Guatemala";
        $location->flag = "/backend/assets/app/media/img/countries/guatemala.png";
        $location->save();

        $location = new Location;
        $location->country = "Cuba";
        $location->flag = "/backend/assets/app/media/img/countries/cuba.png";
        $location->save();

        $location = new Location;
        $location->country = "El Salvador";
        $location->flag = "/backend/assets/app/media/img/countries/el-salvador.png";
        $location->save();

        $location = new Location;
        $location->country = "República Dominicana";
        $location->flag = "/backend/assets/app/media/img/countries/dominican-republic.png";
        $location->save();

        $location = new Location;
        $location->country = "Honduras";
        $location->flag = "/backend/assets/app/media/img/countries/honduras.png";
        $location->save();

        $location = new Location;
        $location->country = "Nicaragua";
        $location->flag = "/backend/assets/app/media/img/countries/nicaragua.png";
        $location->save();

        $location = new Location;
        $location->country = "Bolivia";
        $location->flag = "/backend/assets/app/media/img/countries/bolivia.png";
        $location->save();

        $location = new Location;
        $location->country = "Estados Unidos";
        $location->flag = "/backend/assets/app/media/img/countries/united-states.png";
        $location->save();

        $location = new Location;
        $location->country = "Costa Rica";
        $location->flag = "/backend/assets/app/media/img/countries/costa-rica.png";
        $location->save();
    }
}
