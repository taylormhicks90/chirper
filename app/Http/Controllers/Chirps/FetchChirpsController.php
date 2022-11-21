<?php

namespace App\Http\Controllers\Chirps;

use App\Http\Controllers\Controller;
use App\Models\Chirp;

class FetchChirpsController extends Controller
{

    public function __invoke()
    {
        return Chirp::latest()->paginate();
    }
}
