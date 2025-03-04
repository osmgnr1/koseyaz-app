<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function cornerPosts():HasMany{
        return $this->hasMany(CornerPost::class, 'user_id');

    }

    public function comments():HasMany{
        return $this->hasMany(Comment::class);
    }

    public function replies():HasMany{
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function avatar(){
        return 'https://www.gravatar.com/avatar/' . md5($this->email) . '?s=80&d=mp';
    }

    public function likes():HasMany{
        return $this->hasMany(Like::class);
    }

    public function views():HasMany{
        return $this->hasMany(Viewer::class);
    }

    public function myStatistics(){

        $user_id = auth()->user()->id;
        $cornerposts = CornerPost::where('user_id', $user_id)->get();
        $cornerposts_published = $this->published();
        $cornerposts_pending = $this->pending();
        $cornerposts_published_ids = $this->published()->pluck('id');
        $cornerposts_total_view = Viewer::whereIn('corner_post_id', $cornerposts_published_ids)->count();
        // dd($cornerposts_total_view);


        return [
            'cornerposts' => $cornerposts,
            'cornerposts_published' => $cornerposts_published,
            'cornerposts_pending' => $cornerposts_pending,
            'cornerposts_total_view' => $cornerposts_total_view
        ];

    }

    public function published(){
        return $this->cornerPosts()->whereNotNull('published_at')->get();
    }

    public function pending(){
        return $this->cornerPosts()->whereNull('published_at')->get();
    }

}
