<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Team;
use App\LeagueSeason;
use App\Match;
use App\Rank;

use Lang;

class MatchController extends Controller
{
    public function index()
    {
        $matches = Match::paginate(config('view.paginate'));
        $leagueSeasons = LeagueSeason::all()->lists('year', 'id');
        return view('admin.match.index', compact('matches', 'leagueSeasons'));
    }

    public function create()
    {
        $teams = Team::all()->lists('name', 'id');
        $leagueSeasons = LeagueSeason::all()->lists('year', 'id');
        $status = config('view.status');
        unset($status[1]);
        unset($status[2]);
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

    public function edit($id)
    {
        $match = Match::find($id);
        if (!$match) {
            return redirect()->route('admin.match.index')->with([
                'flash_level' => Lang::get('admin.danger'),
                'flash_message' => Lang::get('admin.message.not_found', ['name' => 'Match'])
            ]);
        }
        $teams = Team::all()->lists('name', 'id');
        $leagueSeasons = LeagueSeason::all()->lists('year', 'id');
        $status = config('view.status');
        switch ($match->status) {
            case 1:
                unset($status[0]);
                break;
            case 2:
                unset($status[0]);
                unset($status[1]);
                break;
            default:
                break;
        }
        return view('admin.match.edit', compact('match', 'teams', 'leagueSeasons', 'status'));
    }

    public function update(Request $request, $id)
    {
        $match = Match::find($id);
        if (!$match) {
            return redirect()->route('admin.match.index')->with([
                'flash_level' => Lang::get('admin.danger'),
                'flash_message' => Lang::get('admin.message.not_found', ['name' => 'Match'])
            ]);
        }
        $data = $request->only('team1_id', 'team2_id', 'start_time', 'end_time', 
            'team1_goal', 'team2_goal', 'league_season_id', 'status');
        if ($match->validate($data, 'updateRule')) {
            $match->update($data);
            if ($match->status == config('view.number_two')) {
                $this->updateRank($match->league_season_id, $match->team1_id, $match->status);
                $this->updateRank($match->league_season_id, $match->team2_id, $match->status);
            }
            return redirect()->route('admin.match.index')->with([
                'flash_level' => Lang::get('admin.success'),
                'flash_message' => Lang::get('admin.message.edit_success', ['name' => 'match'])
            ]);
        }
        return redirect()->back()->withErrors($match->valid());
    }

    public function destroy($id)
    {
        $match = Match::find($id);
        if (!$match) {
            return redirect()->route('admin.match.index')->with([
                'flash_level' => Lang::get('admin.danger'),
                'flash_message' => Lang::get('admin.message.not_found', ['name' => 'Match'])
            ]);
        }
        if ($match->status == config('view.number_zero') || $match->status == config('view.number_three')) {
            $match->delete();
            return redirect()->route('admin.match.index')->with([
                'flash_level' => Lang::get('admin.success'),
                'flash_message' => Lang::get('admin.message.delete_success', ['name' => 'match'])
            ]);
        }
        return redirect()->route('admin.match.index')->with([
            'flash_level' => Lang::get('admin.danger'),
            'flash_message' => Lang::get('admin.message.not_delete', ['name' => 'Match'])
        ]);
    }

    public function filter(Request $request)
    {
        $filter = $request->filter;
        $matches = $filter ? Match::filterMatch($filter)->paginate(config('view.paginate')) :
            Match::paginate(config('view.paginate'));
        $leagueSeasons = LeagueSeason::all()->lists('year', 'id');
        return view('admin.match.index', compact('matches', 'leagueSeasons'));
    }

    public function updateRank($leagueSeasonId, $teamId, $status)
    {
        $matches = Match::findMatchByTeam($leagueSeasonId, $teamId, $status)->get();
        $won = $drawn = $lost = $goalDiff = $score = 0;
        foreach ($matches as $key => $match) {
            if ($match->team1_id == $teamId || $match->team2_id == $teamId) {
                if ($match->team1_id == $teamId) {
                    $gd = $match->team1_goal - $match->team2_goal;
                }
                if ($match->team2_id == $teamId) {
                    $gd = $match->team2_goal - $match->team1_goal;
                }
                if ($gd > 0) {
                    $won++;
                    $goalDiff += $gd;
                    $score += 3;
                } elseif ($gd == 0) {
                    $drawn++;
                    $score++;
                } else {
                    $lost++;
                    $goalDiff += $gd;
                }
            }
        }
        $rank = Rank::findRank($teamId, $leagueSeasonId);
        $rank->update([
            'won' => $won,
            'drawn' => $drawn,
            'lost' => $lost,
            'gd' => $goalDiff,
            'score' => $score
        ]);
    }
}
