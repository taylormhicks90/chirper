<?php

namespace App\Http\Controllers\Chirps;

use App\Http\Controllers\Controller;
use App\Models\Chirp;
use Conner\Likeable\LikeCounter;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LikeChirpsController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \App\Models\Chirp
     */
    public function __invoke(Request $request, Chirp $chirp)
    {
        $chirp->liked() ? $chirp->unlike() : $chirp->like();
        $chirp->refresh();
        return $chirp;
    }
}
