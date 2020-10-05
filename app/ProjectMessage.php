<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class ProjectMessage extends Model
{

    protected $table = 'projects_messages';

    protected $dates = [
        'created_at',
        'updated_at',
        'read_admin',
        'read_user'
    ];


    protected $fillable = [
        'comments',
        'id',
        'id_projects',
        'id_users'
    ];


    function user() {
        return $this->belongsTo(User::class, 'id_users');
    }
}
