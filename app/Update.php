<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Update
 *
 * @property int $id
 * @property string $title
 * @property int $project_id
 * @property string $description
 * @property string $media
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Project $projects
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Update whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Update whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Update whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Update whereMedia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Update whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Update whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Update whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Update newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Update newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Update query()
 */
class Update extends Model
{
    public function projects()
    {
        return $this->belongsTo(Project::class);
    }
}
