<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Management
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property string|null $company
 * @property string|null $description
 * @property string|null $website_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Management whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Management whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Management whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Management whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Management whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Management whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Management whereWebsiteUrl($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Category[] $categories
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Project[] $projects
 * @property-read \App\User $users
 * @property int|null $country_id
 * @property int|null $location_id
 * @property-read \App\Category|null $countries
 * @property-read \App\Location|null $locations
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Management newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Management newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Management query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Management whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Management whereLocationId($value)
 */
class Management extends Model
{
    protected $table = 'managements';
    protected $fillable = ['user_id','company','description','country_id','website_url','tipoCurador'];
    public function projects(){
        return $this->belongsToMany(Project::class);
    }
    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function countries(){
        return $this->belongsTo(Category::class,'country_id');
    }
    public function locations(){
        return $this->belongsTo(Location::class,'location_id');
    }
    public function categories(){
        return $this->belongsToMany(Category::class,'categories_management','management_id','category_id');
    }
}
