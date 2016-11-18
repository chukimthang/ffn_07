<?php

namespace App;

use App\Team;
use App\LeagueSeason;
use Illuminate\Database\Eloquent\Model;

class TeamAchievement extends BaseModel
{
    protected $table = 'team_achievements';

    protected $fillable = ['name', 'league_season_id', 'team_id'];

    public function rules($ruleName)
    {
        if ($ruleName == 'updateRule') {
            $name = 'required|unique:team_achievements,name,' . $this->id;
        } else {
            $name = 'required|unique:team_achievements,name';
        }
        return [
            'name' => $name,
            'league_season_id' => 'required|exists:league_seasons,id',
            'team_id' => 'required|exists:teams,id'
        ];
    }

    public function team()
    {
    	return $this->belongsTo(Team::class);
    }

    public function leagueSeason()
    {
    	return $this->belongsTo(LeagueSeason::class);
    }
}
