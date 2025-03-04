<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;

class CornerPost extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'title', 'body', 'category_id', 'images'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tag():BelongsToMany{
        return $this->belongsToMany(Tag::class, 'tag_apps');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeWithoutTimestamps()
    {
        $this->timestamps = false;
        return $this;
    }

    public function comments():MorphMany{
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function viewers():HasMany{
        return $this->hasMany(Viewer::class);
    }


    public function addViewer(int $cornerpost_id){

        if (Auth::check()) {
            Viewer::firstOrCreate([
                'user_id' => auth()->user()->id,
                'corner_post_id' => $cornerpost_id
            ]);

        }
    }

    public function scopeFilter(Builder|QueryBuilder $query, $search): Builder|QueryBuilder
    {
        $filter = $search['filter'];
        $search_term = $search['search'];

        if ($search) {

            switch ($filter) {

                case 'all':
                    $result =  $query;
                    break;

                case 'title':
                    $result =  $query->where('title', 'like', '%' . $search_term . '%');
                    break;

                case 'script':
                    $result = $query->where('body', 'like', '%'.$search_term.'%');
                    // ->orWhere('body', 'like', '%'.$search_term.'%')
                    // ->orWhere('conclusion','like','%'.$search_term.'%');
                    break;

                case 'author':
                    $result =  $query->whereHas('user', function($query) use($search_term){
                        $query->where('username', 'like', '%' . $search_term . '%');
                    });
                    break;

                case 'category':
                    $result =  $query->whereHas('category', function($query) use($search_term){
                        $query->where('name', 'like', '%' . $search_term . '%');
                    });
                    break;

                case 'tag':
                    $result =  $query->whereHas('tag', function($query) use($search_term){
                        $query->where('name', 'like', '%' . $search_term . '%');
                    });
                    break;

                default:
                    $result =  $query->where('title', 'like', '%' . $search_term . '%');
                    break;
            }

        }else {
            $result = $query;
        }


        return $result;

    }

    public function commentCount()    {
        $result = Comment::where('commentable_id', $this->id)->count();

        return $result;
    }

}
