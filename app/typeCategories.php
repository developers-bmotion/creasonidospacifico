<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\typeCategories
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\typeCategories newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\typeCategories newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\typeCategories query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\typeCategories whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\typeCategories whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\typeCategories whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\typeCategories whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class typeCategories extends Model
{
    protected $table = "type_categories";
    protected $fillable = ['name'];

    public function projects(){
        return $this->hasOne(Project::class);
    }
}
