<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * App\Project
 *
 * @mixin \Eloquent
 * @property int $id
 * @property string $title
 * @property string $short_description
 * @property string|null $description
 * @property string|null $project_picture
 * @property string $status
 * @property string|null $iframe_video
 * @property string|null $end_time
 * @property float $price
 * @property string $slug
 * @property int $category_id
 * @property int|null $update_id
 * @property int $previous_approved
 * @property int $previous_rejected
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereIframeVideo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project wherePreviousApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project wherePreviousRejected($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereProjectPicture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereUpdateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Artist[] $artists
 * @property-read \App\Category $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Donation[] $donations
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\ProjectImage[] $images
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Management[] $management
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Review[] $reviews
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Reward[] $rewards
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Update[] $updates
 * @property-read mixed $rating
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Project query()
 */
class Project extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'published_at',
        'original_datetime'
    ];


    const REVISION = 1;
    const QUALIFIED = 2;
    const APPROVAL = 3;
    // const PUBLISHED = 4;
    const PENDING = 4;
    const REJECTED = 5;
    const REVISON_UPDATE = 6;
    const ACEPTED = 7;

    const PENDING_REGISTER = 9;
    const NOT_PROJECT_REGISTER = 10;
    // const NOPUBLISHED = 6;

//    const PERCENTAGE_APPROVAL = 3;

    protected $withCount = ['reviews', 'updates'];
    protected $fillable = [
        'title',
        'short_description',
        'description',
        'audio',
        'status',
        'author',
        'end_time',
        'price',
        'slug',
        'category_id',
        'type_categories_id',
        'audio_secundary_one',
        'audio_secundary_two',
        'rejected'
    ];

    public function getRejectedAttribute($value)
    {
        return $value ? 'Si' : 'No';
    }

    public static function card($arrayProject, $artist = null)
    {
        return $arrayProject->map(function ($project) use ($artist) {
            if ($artist == null) {
                $artist = $project->artists[0];
            }
            $project->nameLimit = str_limit($project->title, 35);
            $project->img = $project->pathAttachment();
            $project->url = route('projects.show', $project->slug);
            $project->fotoUsuario = $artist->users->pathAttachment();
            $project->rutaPro = route('projects.artist', $artist->users->slug);
            $project->totalDonations = $project->donations->sum('amount');
            return $project;
        });
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'teams_project', 'project_id', 'team_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function pathAttachment()
    {
        return '/images/projects/' . $this->project_picture;
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->select('id', 'category', 'description');
    }

    public function type_category()
    {
        return $this->belongsTo(typeCategories::class);
    }

    public function updates()
    {
        return $this->hasMany(Update::class)->select('id', 'project_id', 'title', 'description', 'media', 'created_at');
    }

    public function donations()
    {
        return $this->hasMany(Donation::class)->select('id', 'user_id', 'project_id', 'amount', 'created_at');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->select('id', 'user_id', 'project_id', 'rating', 'comment', 'created_at');
    }

    public function reviews_curador()
    {
        return $this->hasMany(Review::class)->select('id', 'user_id', 'project_id', 'lyric', 'melody_rhythm', 'arrangements', 'originality');
    }

    public function rewards()
    {
        return $this->hasMany(Reward::class)->select('id', 'title', 'description', 'price', 'shipments', 'estimated', 'project_id', 'created_at');
    }

    public function observations()
    {
        return $this->hasMany(ProjectObservation::class);
    }

    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'artist_projects', 'project_id', 'artist_id');
    }

    public function management()
    {
        return $this->belongsToMany(Management::class, 'management_project', 'project_id', 'management_id');
    }

    public function getRatingAttribute()
    {
        return $this->reviews->avg('rating');
    }

    public function historyReviews()
    {
        return $this->belongsToMany(User::class, 'history_revisions', 'project_id', 'user_id')->withPivot('observation', 'state');
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class);
    }

    public function endProject()
    {
        return $this->hasOne(EndProject::class);
    }

    public function messages()
    {
        return $this->hasMany(ProjectMessage::class, 'id_projects');
    }
    /*
     * Consultas
     */
    // public static function countbycategories($id){
    //     return DB::table('projects')
    //         ->where([['category_id',$id],['status',\App\Project::PUBLISHED]])
    //         ->count('id');
    // }

    public function levelArtist($id)
    {
        return DB::table('levels')
            ->select('level')
            ->where('id', $id)
            ->first();
    }

    public function countryArtist($id)
    {
        return DB::table('countries')
            ->select('*')
            ->where('id', $id)
            ->first();
    }

    public function artist_user($id)
    {
        return User::select('*')
            ->where('id', $id)
            ->first();
    }

    public static function countProjects($id)
    {

        $count = Project::where('status', $id)->count();
    }

    public static function countbyCategories($id)
    {
        return DB::table('projects')
            ->where('category_id', $id)
            ->orderBy('category_id', 'desc')
            ->count('id');

    }

    public static function sumRating($id)
    {
        $review = Review::select(['lyric', 'melody_rhythm', 'originality', 'arrangements'])->where('project_id', $id)->get();
        $lyric = $review[0]->lyric;
        $sum = collect([$review[0]->lyric, $review[0]->melody_rhythm, $review[0]->originality, $review[0]->arrangements])->sum();
        return $sum;
    }
}
