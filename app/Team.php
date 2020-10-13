<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Team
 *
 * @property int $id
 * @property string $name
 * @property string $role
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Team whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Team extends Model
{
    protected $fillable = [
        'name', 'role', 'name', 'last_name', 'second_last_name',
        'document_type', 'identification', 'expedition_place',
        'birthday', 'email', 'adress', 'phone1', 'phone2', 'pdf_identification',
        'img_document_from', 'img_document_back', 'artist_id'
    ];


    public function project(){

        return $this->hasOne(Project::class);
    }

    public function artist(){
        return $this->hasOne(Artist::class,'id');
    }
    public function city(){
        return $this->belongsTo(City::class, 'place_birth');
    }

    public function expeditionPlace(){
        return $this->belongsTo(City::class, 'place_expedition');
    }
    public function documentType(){
        return $this->belongsTo(DocumentType::class,'type_document');
    }
}
