<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TagApp extends Model
{
    use HasFactory;

    protected $fillable = ['corner_post_id', 'tag_id'];

    // public function cornerPosts():HasMany{
    //     return $this->hasMany(CornerPost::class);

    // }

}
