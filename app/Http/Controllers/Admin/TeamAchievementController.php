<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\TeamAchievement;
use App\Team;
use App\LeagueSeason;

use Lang;

class TeamAchievementController extends Controller
{
   
    public function index()
    {
        $achievements = TeamAchievement::paginate(config('view.paginate'));
        return view('admin.team_achievement.index', compact('achievements'));
    }

    public function create()
    {
        $teams = Team::all()->lists('name', 'id');
        $league_seasons = LeagueSeason::all()->lists('year', 'id');
        return view('admin.team_achievement.create', compact('teams', 'league_seasons'));
    }

    public function store(Request $request)
    {
        $achievement = new TeamAchievement;
        $data = $request->only('name', 'team_id', 'league_season_id');
        if ($achievement->validate($data, 'storeRule')) {
            TeamAchievement::create($data);
            return redirect()->route('admin.team_achievement.index')->with([
                'flash_level' => Lang::get('admin.success'),
                'flash_message' => Lang::get('admin.message.complate', ['name' => 'Achievement'])
            ]);
        }
        return redirect()->back()->withErrors($achievement->valid());
    }

    public function edit($id)
    {
        $achievement = TeamAchievement::find($id);
        if (!$achievement) {
            return redirect()->route('admin.team_achievement.index')->with([
                'flash_level' => Lang::get('admin.danger'),
                'flash_message' => Lang::get('admin.message.not_found', ['name' => 'Achievement'])
            ]);
        }
        $teams = Team::all()->lists('name', 'id');
        $league_seasons = LeagueSeason::all()->lists('year', 'id');
        return view('admin.team_achievement.edit', compact('achievement', 'teams', 'league_seasons'));
    }

    public function update(Request $request, $id)
    {
       $achievement = TeamAchievement::find($id);
       if (!$achievement) {
            return redirect()->route('admin.team_achievement.index')->with([
                'flash_level' => Lang::get('admin.danger'),
                'flash_message' => Lang::get('admin.message.not_found', ['name' => 'Achievement'])
            ]);
        }
        $data = $request->only('name', 'team_id', 'league_season_id');
        if ($achievement->validate($data, 'updateRule')) {
            $achievement->update($data);
            return redirect()->route('admin.team_achievement.index')->with([
                'flash_level' => Lang::get('admin.success'),
                'flash_message' => Lang::get('admin.message.complate', ['name' => 'Achievement'])
            ]);
        }
        return redirect()->back()->withErrors($achievement->valid());
    }

    public function destroy($id)
    {
        $achievement = TeamAchievement::find($id);
        if (!$achievement) {
            return redirect()->route('admin.team_achievement.index')->with([
                'flash_level' => Lang::get('admin.danger'),
                'flash_message' => Lang::get('admin.message.not_found', ['name' => 'Achievement'])
            ]);
        }
        $achievement->delete();
        return redirect()->route('admin.team_achievement.index')->with([
            'flash_level' => Lang::get('admin.success'),
            'flash_message' => Lang::get('admin.message.complate', ['name' => 'Achievement'])
        ]);
    }
}
