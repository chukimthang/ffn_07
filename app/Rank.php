<?php

namespace App;

use App\Team;
use App\LeagueSeason;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $table = 'ranks';

    protected $fillable = ['won', 'drawn', 'lost', 'gd', 'score', 'team_id', 
        'league_season_id'];

    public function scopeFindRank($query, $teamId, $leagueSeasonId)
    {
        return $query->where('team_id', $teamId)
            ->where('league_season_id', $leagueSeasonId)->first();
    }

    public function scopeFilterRank($query, $id)
    {
        return $query->where('league_season_id', $id)->orderBy('score', 'desc')->get();
    }

    public function scopeAllRank($query)
    {
        return $query->orderBy('score', 'desc')->get();
    }

    public function scopeFindRankbySeason($query, $id)
    {
        return $query->where('league_season_id', $id)->get();
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
