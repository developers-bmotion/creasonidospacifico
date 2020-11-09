<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryRevision extends Model
{
    protected $table = "history_revisions";
    protected $fillable = ['user_id', 'project_id', 'observation', 'state'];
    public function project(){
        return $this->hasMany(Project::class);
    }
}
