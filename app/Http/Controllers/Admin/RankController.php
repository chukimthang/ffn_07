<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Rank;
use App\LeagueSeason;
use App\Team;

class RankController extends Controller
{
    public function index()
    {
        $ranks = Rank::allRank();
        $leagueSeasons = LeagueSeason::all()->lists('year', 'id');
        return view('admin.rank.index', compact('ranks', 'leagueSeasons'));
    }

    public function filter(Request $request)
    {
        $filter = $request->filter;
        $ranks = $filter ? Rank::filterRank($filter) : Rank::allRank();
        $leagueSeasons = LeagueSeason::all()->lists('year', 'id');
        return view('admin.rank.index', compact('ranks', 'leagueSeasons'));
    }
}
