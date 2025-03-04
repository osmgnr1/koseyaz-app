<?php

namespace App\Models;

use App\Models\Presenters\CommentPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = ['user_id', 'body'];


    public function commentable():MorphTo{
        return $this->morphTo();
    }

    public function presenter()
    {
        return new CommentPresenter($this);
    }


    public function isReply()
    {
        return isset($this->parent_id);
    }

    public function scopeParent(Builder $query): Builder{
        return $query->whereNull('parent_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function cornerpost():BelongsTo{
        return $this->BelongsTo(CornerPost::class);
    }


    protected static function boot() {
        //in this method, when a comment is deleted, replies will be deleted too
        parent::boot();
        static::deleted(function ($comment) {
          if ($comment->replies()->count()) {
            $comment->replies()->delete();
          }

        });
    }

}
