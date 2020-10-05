<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ProjectImage
 *
 * @property int $id
 * @property int|null $project_id
 * @property string|null $url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProjectImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProjectImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProjectImage whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProjectImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProjectImage whereUrl($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProjectImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProjectImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\ProjectImage query()
 */
class ProjectImage extends Model
{
    protected $guarded = [];

    public function pathAttachment(){
        return '/images/projects_images/'. $this->url;
    }
}
