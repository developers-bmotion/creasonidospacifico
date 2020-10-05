<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistType extends Model
{
    //
    protected $table = "artist_types";
    protected $fillable = ['name'];

    public function artist()
    {
        return $this->hasMany(Artist::class, 'artist_types_id');
    }

}
