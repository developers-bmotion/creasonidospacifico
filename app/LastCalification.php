<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LastCalification extends Model
{
    protected $fillable = [
        'project_id','user_id','musicality','sonority','coloratura', 'spokesperson',
         'finalist','comment'
    ];

    public function projects(){
        return $this->hasMany(Project::class, 'id','project_id');
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
}
