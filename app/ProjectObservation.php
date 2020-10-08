<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectObservation extends Model
{
    public function projects(){
        return $this->belongsTo(Project::class);
    }
}
