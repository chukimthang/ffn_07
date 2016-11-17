<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Team;
use App\Country;

use Lang;
use Session;

class TeamsController extends Controller
{
    public function index()
    {
        $teams = Team::paginate(config('view.paginate'));
        return view('admin.teams.index')->with(['teams' => $teams]);
    }

    public function create()
    {
        $countries = Country::lists('name', 'id')->all();
        return view('admin.teams.add')->with('countries', $countries);
    }

    public function store(Request $request)
    {
        $team = new Team();
        $data = $request->only('name', 'introduction', 'country_id', 'logo');
        if ($team->validate($data, 'storeRule')) {
            Team::create($data);
            Session::flash('flash_message', Lang::get('teams.add_team_success'));
            return redirect()->back()->with('flash_level', 'success');
        }
        return redirect()->back()->withErrors($team->valid());
    }

    public function edit($id)
    {
        $team = Team::find($id);
        $countries = Country::lists('name', 'id')->all();
        return view('admin.teams.edit')->with([
            'team' => $team, 
            'countries' => $countries
        ]);
    }

    public function update(Request $request, $id)
    {
        $team = Team::find($id);
        if (!$team) {
            return redirect()->back()->with([
                'flash_message', Lang::get('teams.not_search_team'),
                'flash_level' => 'danger'
            ]);
        }
        $data = $request->only('name', 'introduction', 'country_id', 'logo');
        if ($team->validate($data, 'updateRule')) {
            if (!$data['logo']) {
                $data['logo'] = $team->logo;
            }
            $team->update($data);
            return redirect()->back()->with([
                'flash_message' => Lang::get('teams.edit_team_success'),
                'flash_level' => 'success'
            ]);
        }
        return redirect()->back()->withErrors($team->valid());
    }

    public function destroy($id)
    {
        $team = Team::find($id);
        if (!$team) {
            return redirect()->back()->with([
                'flash_message' => Lang::get('teams.not_search_team'),
                'flash_level' => 'danger'
            ]);
        }
        $team->delete();
        return redirect()->back()->with([
            'flash_message' => Lang::get('teams.delete_success'),
            'flash_level' => 'success'
        ]);
    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'search' => 'required'
        ]);
        $search = $request->search;
        $teams = Team::searchByName($search)
            ->paginate(config('view.paginate'))
            ->appends(['search' => $search]);
        return view('admin.teams.index')->with(['teams' => $teams]);
    }
}
