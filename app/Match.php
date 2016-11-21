<?php

namespace App;

use App\LeagueSeason;
use App\Team;
use App\PlayerAward;
use App\MatchPlayer;
use App\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Match extends BaseModel
{
    protected $table = 'matches';

    protected $fillable = ['team1_id', 'team2_id', 'start_time', 'end_time',
        'team1_goal', 'team2_goal', 'league_season_id', 'status'];

    public function rules($ruleName)
    {
        $result = [
            'team1_id' => 'required|exists:teams,id',
            'team2_id' => 'required|different:team1_id|exists:teams,id',
            'start_time' => 'required|unique:matches,start_time',
            'end_time' => 'required|after:start_time',
            'league_season_id' => 'required|exists:league_seasons,id',
            'status' => 'required'
        ];
        if ($ruleName == 'updateRule') {
            $result['team1_goal'] = 'required|numeric';
            $result['team2_goal'] = 'required|numeric';
        }
        return $result; 
    }

    public function checkStatus($status, $goal)
    {
        return $status == 0 || $status == 3 ? '?' : $goal;
    }

    public function findTeam($id)
    {
        $team = Team::find($id);
        return $team->name;
    }

    public function leagueSeason()
    {
    	return $this->belongsTo(LeagueSeason::class);
    }

    public function team()
    {
    	return $this->belongsTo(Team::class);
    }

    public function playerAwards()
    {
    	return $this->hasMany(PlayerAward::class);
    }

    public function matchPlayers()
    {
    	return $this->hasMany(MatchPlayer::class);
    }
}
