<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\UserSocialAccount
 *
 * @property int $id
 * @property int $user_id
 * @property string $provider
 * @property string $provider_uid
 * @property-read \App\User $users
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSocialAccount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSocialAccount whereProvider($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSocialAccount whereProviderUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSocialAccount whereUserId($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSocialAccount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSocialAccount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\UserSocialAccount query()
 */
class UserSocialAccount extends Model
{
    protected $fillable = ['user_id','provider','provider_uid'];
    public $timestamps = false;
    public function users(){
        return $this->belongsTo(User::class);
    }
}
