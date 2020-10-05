<?php

namespace App;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $last_name
 * @property string|null $picture
 * @property string $phone_1
 * @property string|null $phone_2
 * @property string $state
 * @property string|null $slug
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhone1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePhone2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @property-read \App\Artist $artist
 * @property-read \App\Management $managements
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $roles
 * @property-read \App\UserSocialAccount $socialAcounts
 * @property-read mixed $url_artist
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 */
class User extends Authenticatable
{
    use Notifiable;

    protected static function boot()
    {
        parent::boot();
        static::creating(function(User $user){
           if ( ! \App::runningInConsole()){
               $user->slug = str_slug($user->name . " " . $user->last_name, '-')."-".rand(5000,90000);
           }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','picture','last_name','phone_1','phone_2','slug','email','front_picture','pdf_cedula'
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = array('url_artist');

    const ACTIVE = 1;
    const INACTIVE = 2;

    public function getRouteKeyName(){
        return 'slug';
    }

    public function getUrlArtistAttribute(){
        return route('projects.artist',$this->slug);
    }

    public static function navigation(){
        return auth()->check() ? auth()->user()->roles[0]->rol : 'Artist';
    }

    public static function rating_proyect(){
        return auth()->check() ? auth()->user()->roles[0]->rol : 'Artist';
    }

    public static function dashboard(){
        return auth()->check() ? auth()->user()->roles[0]->rol : 'Artist';
    }
    public function pathAttachment(){
        if(\Storage::disk('public')->exists('users/'.$this->picture)){
            return '/images/users/'. $this->picture;
        }
        return $this->picture;
    }

    public function getPictureAttribute($value){
        if(\Storage::disk('public')->exists('users/'.$value)){
            return '/images/users/'. $value;
        }
        return $value;
    }

    public function artist(){
        return $this->hasOne(Artist::class,'id')->select('user_id','nickname');
    }

    public function artista(){
        return $this->hasOne(Artist::class,'user_id');
    }

    public function managements(){
        return $this->hasOne(Management::class,'id');
    }

    public function socialAcounts(){
        return $this->hasOne(UserSocialAccount::class);
    }
    public function roles(){
        return $this->belongsToMany(Role::class,'roles_users','user_idUser','role_idRole');
    }

    public function artist_user($id){
        return User::select('*')
            ->where('id',$id)
            ->first();
    }
}
