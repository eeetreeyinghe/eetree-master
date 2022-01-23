<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

class PageController extends Controller
{
    /**
     * Show the static page
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($tpl)
    {
        if (View::exists('page.' . $tpl)) {
            return view('page.' . $tpl);
        } else {
            abort(404);
        }
    }

    public function digikeyFunpack($phase = null)
    {
        $tpl = 'digikey-funpack';
        if (empty($phase)) {
            // default phase
            $phase = 'phase12';
        }
        return $this->index($tpl . '-' . $phase);
    }
}
