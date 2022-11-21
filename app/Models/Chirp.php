<?php

namespace App\Models;

use App\Events\ChirpCreated;
use App\Traits\Likeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chirp extends Model
{
    use HasFactory, Likeable;

    protected $with = ['user:id,name','likeCounter'];


    public static function boot(){
        parent::boot();
        static::retrieved(function(Chirp $chirp){
            $chirp->liked = $chirp->liked();
        });

    }

    protected $fillable = [
        'message',
    ];

    protected $dispatchesEvents = [
        'created' => ChirpCreated::class,
    ];



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }



}
