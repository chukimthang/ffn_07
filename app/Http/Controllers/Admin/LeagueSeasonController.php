<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\LeagueSeason;
use App\League;
use App\Rank;
use App\Team;

use Lang;

class LeagueSeasonController extends Controller
{
    public function index()
    {
        $leagues = League::all()->lists('name', 'id');
        $leagueSeasons = LeagueSeason::paginate(config('view.paginate'));
        return view('admin.league_season.index', compact('leagueSeasons', 'leagues'));
    }

    public function create()
    {
        $leagues = League::all()->lists('name', 'id');
        return view('admin.league_season.create', compact('leagues'));
    }

    public function store(Request $request)
    {
        $season = new LeagueSeason;
        $data = $request->only('year', 'league_id');
        if ($season->validate($data, 'storeRule')) {
            $season = $season->create($data);
            $teams = Team::all();
            foreach ($teams as $key => $team) {
                $rank = new Rank;
                $rank->team_id = $team->id;
                $rank->league_season_id = $season->id;
                $rank->save();
            }
            return redirect()->route('admin.league_season.index')->with([
                'flash_level' => Lang::get('admin.success'),
                'flash_message' => Lang::get('admin.message.complate', ['name' => 'league season'])
            ]);
        }
        return redirect()->back()->withErrors($season->valid());
    }

    public function edit($id)
    {
        $season = LeagueSeason::find($id);
        if (!$season) {
            return redirect()->route('admin.league_season.index')->with([
                'flash_level' => Lang::get('admin.danger'),
                'flash_message' => Lang::get('admin.message.not_found', ['name' => 'League Season'])
            ]);
        }
        $leagues = League::all()->lists('name', 'id');
        return view('admin.league_season.edit', compact('season', 'leagues'));
    }

    public function update(Request $request, $id)
    {
        $season = LeagueSeason::find($id);
        if (!$season) {
            return redirect()->route('admin.league_season.index')->with([
                'flash_level' => Lang::get('admin.danger'),
                'flash_message' => Lang::get('admin.message.not_found', ['name' => 'League Season'])
            ]);
        }
        $data = $request->only('year', 'league_id');
        if ($season->validate($data, 'updateRule')) {
            $season->update($data);
            return redirect()->route('admin.league_season.index')->with([
                'flash_level' => Lang::get('admin.success'),
                'flash_message' => Lang::get('admin.message.edit_success', ['name' => 'league season'])
            ]);
        }
        return redirect()->back()->withErrors($season->valid());
    }

    public function destroy($id)
    {
        $season = LeagueSeason::find($id);
        if (!$season) {
            return redirect()->route('admin.league_season.index')->with([
                'flash_level' => Lang::get('admin.danger'),
                'flash_message' => Lang::get('admin.message.not_found', ['name' => 'League Season'])
            ]);
        }
        $season->delete();

        $ranks = Rank::findRankbySeason($season->id);
        foreach ($ranks as $key => $rank) {
            $rank->delete();
        }

        return redirect()->route('admin.league_season.index')->with([
            'flash_level' => Lang::get('admin.success'),
            'flash_message' => Lang::get('admin.message.delete_success', ['name' => 'league season'])
        ]);
    }
}
