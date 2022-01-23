<?php

namespace App\Http\Controllers;

use App\Helpers\RecommendHelper;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $recommends = RecommendHelper::getRecommends([
            'recommend.area.HOME_SLIDE',
            'recommend.area.HOME_DOC',
            'recommend.area.HOME_PROJECT',
            'recommend.area.HOME_WIKI',
            'recommend.area.HOME_COURSE',
        ]);
        if (!empty($recommends['recommend.area.HOME_WIKI'])) {
            $firstWiki = array_shift($recommends['recommend.area.HOME_WIKI']);
        } else {
            $firstWiki = null;
        }
        return view('home', [
            'recommends' => $recommends,
            'firstWiki' => $firstWiki,
        ]);
    }
}
