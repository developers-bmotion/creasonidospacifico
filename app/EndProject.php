<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

/**
 * App\EndProject
 *
 * @property int $id
 * @property int|null $project_id
 * @property \Illuminate\Support\Carbon|null $end_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EndProject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EndProject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EndProject query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EndProject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EndProject whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EndProject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EndProject whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\EndProject whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EndProject extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'end_time',
    ];

    protected $guarded = [];

    public function getEndTimeAttribute($date){
        return new Date($date);
    }
}
