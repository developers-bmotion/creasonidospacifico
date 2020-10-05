<?php

use Illuminate\Database\Seeder;
use \App\Country;

class CountryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::truncate();

        $country = new Country;
        $country->country = "Colombia";
        $country->flag = "/backend/assets/app/media/img/countries/colombia.png";
        $country->save();

        $country = new Country;
        $country->country = "Venezuela";
        $country->flag = "/backend/assets/app/media/img/countries/venezuela.png";
        $country->save();

        $country = new Country;
        $country->country = "Ecuador";
        $country->flag = "/backend/assets/app/media/img/countries/ecuador.png";
        $country->save();

        $country = new Country;
        $country->country = "Perú";
        $country->flag = "/backend/assets/app/media/img/countries/peru.png";
        $country->save();

        $country = new Country;
        $country->country = "Brasil";
        $country->flag = "/backend/assets/app/media/img/countries/brazil.png";
        $country->save();

        $country = new Country;
        $country->country = "Paraguay";
        $country->flag = "/backend/assets/app/media/img/countries/paraguay.png";
        $country->save();

        $country = new Country;
        $country->country = "Uruguay";
        $country->flag = "/backend/assets/app/media/img/countries/uruguay.png";
        $country->save();

        $country = new Country;
        $country->country = "Argentina";
        $country->flag = "/backend/assets/app/media/img/countries/argentina.png";
        $country->save();

        $country = new Country;
        $country->country = "Mexico";
        $country->flag = "/backend/assets/app/media/img/countries/mexico.png";
        $country->save();

        $country = new Country;
        $country->country = "Puerto Rico";
        $country->flag = "/backend/assets/app/media/img/countries/puerto-rico.png";
        $country->save();

        $country = new Country;
        $country->country = "Guatemala";
        $country->flag = "/backend/assets/app/media/img/countries/guatemala.png";
        $country->save();

        $country = new Country;
        $country->country = "Cuba";
        $country->flag = "/backend/assets/app/media/img/countries/cuba.png";
        $country->save();

        $country = new Country;
        $country->country = "El Salvador";
        $country->flag = "/backend/assets/app/media/img/countries/el-salvador.png";
        $country->save();

        $country = new Country;
        $country->country = "República Dominicana";
        $country->flag = "/backend/assets/app/media/img/countries/dominican-republic.png";
        $country->save();

        $country = new Country;
        $country->country = "Honduras";
        $country->flag = "/backend/assets/app/media/img/countries/honduras.png";
        $country->save();

        $country = new Country;
        $country->country = "Nicaragua";
        $country->flag = "/backend/assets/app/media/img/countries/nicaragua.png";
        $country->save();

        $country = new Country;
        $country->country = "Bolivia";
        $country->flag = "/backend/assets/app/media/img/countries/bolivia.png";
        $country->save();

        $country = new Country;
        $country->country = "Estados Unidos";
        $country->flag = "/backend/assets/app/media/img/countries/united-states.png";
        $country->save();

        $country = new Country;
        $country->country = "Costa Rica";
        $country->flag = "/backend/assets/app/media/img/countries/costa-rica.png";
        $country->save();
    }
}
