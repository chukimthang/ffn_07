<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Team;
use App\LeagueSeason;
use App\Match;

use Lang;

class MatchController extends Controller
{
    public function index()
    {
        $matches = Match::paginate(config('view.paginate'));
        return view('admin.match.index', compact('matches'));
    }

    public function create()
    {
        $teams = Team::all()->lists('name', 'id');
        $leagueSeasons = LeagueSeason::all()->lists('year', 'id');
        $status = config('view.status');
        return view('admin.match.create', compact('teams', 'leagueSeasons', 'status'));
    }

    public function store(Request $request)
    {
        $match = new Match;
        $data = $request->only('team1_id', 'team2_id', 'start_time', 'end_time', 'league_season_id', 'status');
        if ($match->validate($data, 'storeRule')) {
            $match->create($data);
            return redirect()->route('admin.match.index')->with([
                'flash_level' => Lang::get('admin.success'),
                'flash_message' => Lang::get('admin.message.complate', ['name' => 'Match'])
            ]);
        }
        return redirect()->back()->withErrors($match->valid());
    }
}
