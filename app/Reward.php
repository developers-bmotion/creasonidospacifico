<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Reward
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $title
 * @property string $description
 * @property float $price
 * @property int $project_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reward whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reward whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reward whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reward wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reward whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reward whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reward whereUpdatedAt($value)
 * @property string|null $shipments
 * @property \Illuminate\Support\Carbon|null $estimated
 * @property-read \App\Project $projects
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reward whereEstimated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reward whereShipments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reward newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reward newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reward query()
 */
class Reward extends Model
{
    protected $dates = ['estimated'];
    public function projects(){
        return $this->belongsTo(Project::class);
    }
}
