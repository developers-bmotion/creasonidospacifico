<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonType extends Model
{
    //
    protected $fillable = ['name'];
    protected $table = 'person_types';

    public function artist(){
        return $this->hasMany(Artist::class, 'person_types_id');
    }
}
