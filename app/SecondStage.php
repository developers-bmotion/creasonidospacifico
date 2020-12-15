<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SecondStage extends Model
{
    protected $fillable = [
        'project_id','user_id','lyric','comment','end_time', 'melody_rhythm',
         'arrangements', 'originality','trajectory','project_interest', 'comment'
    ];

    public function projects(){
        return $this->hasMany(Project::class, 'id','project_id');
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
}
