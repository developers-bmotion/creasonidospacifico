<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Country
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $country
 * @property int $city_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country whereUpdatedAt($value)
 * @property string|null $flag
 * @property-read \App\Artist $artist
 * @property-read \App\City $cities
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country whereFlag($value)
 * @property-read \App\Management $management
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Country query()
 */
class Country extends Model
{

    protected $table = "departamento";

    public function cities(){
        return $this->hasMany(City::class);
    }
    public function artist(){
        return $this->hasOne(Artist::class);
    }
    public function management(){
        return $this->hasOne(Management::class);
    }

}
