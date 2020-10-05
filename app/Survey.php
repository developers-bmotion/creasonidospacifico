<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Survey
 *
 * @property int $id
 * @property string $tittle
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Question[] $question
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Survey newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Survey newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Survey query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Survey whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Survey whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Survey whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Survey whereTittle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Survey whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Survey extends Model
{
    public function question (){

        return $this->hasMany(Question::class);
    }


}
