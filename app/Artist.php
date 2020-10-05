<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * App\Artist
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property string|null $nickname
 * @property string $biography
 * @property string|null $website_url
 * @property string|null $facebook
 * @property string|null $instagram
 * @property string|null $youtube
 * @property int $level_id
 * @property int $country_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Artist whereBiography($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Artist whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Artist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Artist whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Artist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Artist whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Artist whereLevelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Artist whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Artist whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Artist whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Artist whereWebsiteUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Artist whereYoutube($value)
 * @property-read \App\Country|null $countries
 * @property-read \App\Level|null $levels
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Project[] $projects
 * @property-read \App\User $users
 * @property int|null $location_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Answer[] $answers
 * @property-read \App\Location|null $location
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Artist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Artist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Artist query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Artist whereLocationId($value)
 */
class Artist extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'published_at',
        'birthdate',
    ];
    protected $fillable = [
        'user_id','nickname','biography','website_url',
        'facebook','instagram','youtube','level_id',
        'country_id','age','birthdate', 'adress',
        'cities_id', 'township','permission','expedition_place',
        'person_types_id','artist_types_id'
    ];

    public function projects(){
        return $this->belongsToMany(Project::class,'artist_projects','artist_id','project_id');
    }

    public function levels(){
       return $this->belongsTo(Level::class,'level_id')->select('id','level');
    }

    public function countries(){
        return $this->belongsTo(Country::class,'cities_id');
    }

    public function city(){
        return $this->belongsTo(City::class, 'cities_id');
    }
    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function location(){
        return $this->belongsTo(Location::class,'location_id');
    }

    public function answers(){
        return $this->belongsToMany(Answer::class,'answer_artist','artist_id','answer_id');
    }

    public function beneficiary(){
        return $this->hasMany(Beneficiary::class, 'artist_id');
    }

    public function personType(){
        return $this->belongsTo(PersonType::class,'person_types_id');
    }

    public function artistType(){
        return $this->belongsTo(ArtistType::class,'artist_types_id');
    }

    public function documentType(){
        return $this->belongsTo(DocumentType::class,'document_type');
    }


    public function teams(){
        return $this->hasMany(Team::class,'artist_id');
    }

    public function expeditionPlace(){
        return $this->belongsTo(City::class, 'expedition_place');
    }
    /**
     * Consultas $
     */

}
