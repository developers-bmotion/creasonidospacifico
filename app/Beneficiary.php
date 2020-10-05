<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Seiler\EloquentDate\EloquentDate;

class Beneficiary extends Model
{

    protected $dates = [
        'created_at',
        'updated_at',
        'published_at',
        'birthday',
    ];
    protected $fillable = [
        'document_type', 'identification', 'name', 'last_name',
        'second_last_name', 'pdf_documento', 'phone', 'adress',
        'biography', 'birthday', 'cities_id', 'township', 'expedition_place',
        'artist_id'
    ];

    public function artist(){
        return $this->hasOne(Artist::class,'id');
    }

    public function documentType(){
        return $this->belongsTo(DocumentType::class,'document_type');
    }

    public function city(){
        return $this->belongsTo(City::class, 'cities_id');
    }

    public function expeditionPlace(){
        return $this->belongsTo(City::class, 'expedition_place');
    }
}
