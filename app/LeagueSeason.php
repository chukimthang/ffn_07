<?php

namespace App;

use App\League;
use App\Rank;
use App\TeamAchievement;
use App\Match;
use App\PlayerAward;
use Illuminate\Database\Eloquent\Model;

class LeagueSeason extends Model
{
    protected $table = 'league_seasons';
    
    protected $fillable = ['year', 'league_id'];

    public function league()
    {
    	return $this->belongsTo(League::class);
    }

    public function ranks()
    {
    	return $this->hasMany(Rank::class);
    }

    public function teamAchievements()
    {
    	return $this->hasMany(TeamAchievement::class);
    }

    public function matchs()
    {
    	return $this->hasMany(Match::class);
    }

    public function playerAwards()
    {
    	return $this->hasMany(PlayerAward::class);
    }
}
