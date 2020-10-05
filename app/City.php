<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\City
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $city
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\City whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\City whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\City whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\City whereUpdatedAt($value)
 * @property-read \App\Country $countries
 * @property-read \App\Location $location
 * @method static \Illuminate\Database\Eloquent\Builder|\App\City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\City query()
 */
class City extends Model
{

    protected $table = 'ciudad';
    public function countries()
    {
        return $this->hasOne(Country::class);
    }
    public function location()
    {
        return $this->hasOne(Location::class);
    }

    public function beneficiary(){
        return $this->hasMany(Beneficiary::class);
    }
    public function team(){
        return $this->hasMany(Team::class);
    }

    public function artist(){
        return $this->hasMany(Artist::class);
    }

    public function departaments(){
        return $this->belongsTo(Country::class, 'iddepartamento');
    }
}
