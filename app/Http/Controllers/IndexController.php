<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $pathExist = Link::where('short_path', $request->url())->select('full_path')->first();
        if (null !== $pathExist) {
            return redirect($pathExist->full_path);
        }
        return redirect()->route('home');
    }
}
