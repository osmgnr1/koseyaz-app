<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'corner_post_id'];

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function user():BelongsTo{
        return $this->belongsTo(User::class, 'user_id');
    }


    /**
     * Write code on Method
     *
     * @return response()
     */
    public function cornerpost():BelongsTo{
        return $this->belongsTo(CornerPost::class, 'corner_post_id');
    }

}
