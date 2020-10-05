<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $table = 'documenttypes';

    public function artist(){
        return $this->hasMany(Artist::class, 'document_type');
    }

    public function beneficiary(){
        return $this->hasMany(Artist::class, 'document_type');
    }

}
