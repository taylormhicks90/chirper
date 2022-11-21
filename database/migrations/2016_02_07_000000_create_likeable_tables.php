<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLikeableTables extends Migration
{
    public function up()
    {
        Schema::create('likeable_likes', function (Blueprint $table) {
            $table->id();
            $table->morphs('likeable');
            $table->foreignIdFor(User::class)->index()->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->unique(['likeable_id', 'likeable_type', 'user_id'], 'likeable_likes_unique');
        });

        Schema::create('likeable_like_counters', function (Blueprint $table) {
            $table->id();
            $table->morphs('likeable');
            $table->unsignedBigInteger('count')->default(0);
            $table->unique(['likeable_id', 'likeable_type'], 'likeable_counts');
        });
    }

    public function down()
    {
        Schema::drop('likeable_likes');
        Schema::drop('likeable_like_counters');
    }
}
