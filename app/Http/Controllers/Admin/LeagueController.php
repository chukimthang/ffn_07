<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\League;
use App\Country;
use Lang;

class LeagueController extends Controller
{
    public function index()
    {
        $leagues = League::paginate(config('view.paginate'));
        return view('admin.league.index', compact('leagues'));
    }

    public function create()
    {
        $countries = Country::all()->lists('name', 'id');
        return view('admin.league.create', compact('countries'));
    }

    public function store(Request $request)
    {
        $league = new League;
        $data = $request->only('name', 'country_id');
        if ($league->validate($data, 'storeRule')) {
            League::create($data);
            return redirect()->route('admin.league.index')->with([
                'flash_level' => Lang::get('admin.success'),
                'flash_message' => Lang::get('admin.message.complate', ['name' => 'league'])
            ]);
        }
        return redirect()->back()->withErrors($league->valid());
    }

    public function edit($id)
    {
        $countries = Country::all()->lists('name', 'id');
        $league = League::find($id);
        if (!$league) {
            return redirect()->route('admin.league.index')->with([
                'flash_level' => Lang::get('admin.danger'),
                'flash_message' => Lang::get('admin.message.not_found', ['name' => 'league'])
            ]);
        }
        return view('admin.league.edit', compact('league', 'countries'));
    }

    public function update(Request $request, $id)
    {
        $league = League::find($id);
        if (!$league) {
            return redirect()->route('admin.league.index')->with([
                'flash_level' => 'danger',
                'flash_message' => Lang::get('admin.message.not_found', ['name' => 'league'])
            ]);
        }
        $data = $request->only('name', 'country_id');
        if ($league->validate($data, 'updateRule')) {
            $league->update($data);
            return redirect()->route('admin.league.index')->with([
                'flash_level' => Lang::get('admin.success'),
                'flash_message' => Lang::get('admin.message.edit_success', ['name' => 'league'])
            ]);
        }
        return redirect()->back()->withErrors($league->valid());
    }

    public function destroy($id)
    {
        $league = League::find($id);
        if (!$league) {
            return redirect()->route('admin.league.index')->with([
                'flash_level' => Lang::get('admin.danger'),
                'flash_message' => Lang::get('admin.message.not_found', ['name' => 'league'])
            ]);
        }
        $league->delete();
        return redirect()->route('admin.league.index')->with([
            'flash_level' => Lang::get('admin.success'),
            'flash_message' => Lang::get('admin.message.complate', ['name' => 'league'])
        ]);
    }
}
