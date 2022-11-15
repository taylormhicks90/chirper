<?php

namespace App\Http\Controllers\Chirps;

use App\Http\Controllers\Controller;
use App\Models\Chirp;
use App\Models\ChirpLike;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ChirpLikesController extends Controller
{

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Chirp        $chirp
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request,Chirp $chirp): RedirectResponse
    {
        //TODO: Authorize and Validate Request
        ChirpLike::create([
            'chirp_id' => $chirp->id,
            'user_id' => $request->user()->id
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Chirp        $chirp
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request, Chirp $chirp): RedirectResponse
    {
        $like = ChirpLike::query()->where('user_id','=', $request->user()->id)->where('chirp_id','=',$chirp->id,)->first();
        $like?->delete();
        return redirect()->back();
    }
}
