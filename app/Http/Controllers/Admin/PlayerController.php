<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Country;
use App\Team;
use App\Player;

use Lang;

class PlayerController extends Controller
{
    
    public function index()
    {
        $players = Player::paginate(config('view.paginate'));
        return view('admin.player.index', compact('players'));
    }

    public function create()
    {
        $countries = Country::all()->lists('name', 'id');
        $teams = Team::all()->lists('name', 'id');
        $positions = Lang::get('admin.positions');
        return view('admin.player.create', compact('countries', 'teams', 'positions'));
    }

    public function store(Request $request)
    {
        $player = new Player;
        $data = $request->only('name', 'introduction', 'position', 'birthday', 'avatar',
            'team_id', 'country_id');
        if ($player->validate($data, 'storeRule')) {
            Player::create($data);
            return redirect()->route('admin.player.index')->with([
                'flash_level' => Lang::get('admin.success'),
                'flash_message' => Lang::get('admin.message.complate', ['name' => 'Player'])
            ]);
        }
        return redirect()->back()->withErrors($player->valid());
    }

    public function edit($id)
    {
        $player = Player::find($id);
        if (!$player) {
            return redirect()->route('admin.player.index')->with([
                'flash_level' => Lang::get('admin.danger'),
                'flash_message' => Lang::get('admin.message.not_found', ['name' => 'player'])
            ]);
        }
        $teams = Team::all()->lists('name', 'id');
        $countries = Country::all()->lists('name', 'id');
        $positions = Lang::get('admin.positions');
        return view('admin.player.edit', compact('player', 'teams', 'countries', 'positions'));
    }

    public function update(Request $request, $id)
    {
        $player = Player::find($id);
        if (!$player) {
            return redirect()->route('admin.player.index')->with([
                'flash_level' => Lang::get('admin.danger'),
                'flash_message' => Lang::get('admin.message.not_found', ['name' => 'player'])
            ]);
        }
        $data = $request->only('name', 'introduction', 'position', 'birthday', 'avatar', 'team_id', 'country_id');
        if ($player->validate($data, 'updateRule')) {
            $player->update($data);
            return redirect()->route('admin.player.index')->with([
                'flash_level' => Lang::get('admin.success'),
                'flash_message' => Lang::get('admin.message.edit_success', ['name' => 'Player'])
            ]);
        }
        return redirect()->back()->withErrors($player->valid());
    }

    public function destroy($id)
    {
        $player = Player::find($id);
        if (!$player) {
            return redirect()->route('admin.player.index')->with([
                'flash_level' => Lang::get('admin.danger'),
                'flash_message' => Lang::get('admin.message.not_found', ['name' => 'player'])
            ]);
        }
        $player->delete();
        return redirect()->route('admin.player.index')->with([
            'flash_level' => Lang::get('admin.success'),
            'flash_message' => Lang::get('admin.message.delete_success', ['name' => 'Player'])
        ]);
    }
}
