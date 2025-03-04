<?php

use App\Models\Comment;
use App\Models\CornerPost;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            // $table->foreignIdFor(CornerPost::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Comment::class, 'parent_id')->nullable()->constrained('comments')->cascadeOnDelete();
            $table->text('body');
            $table->morphs('commentable');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
