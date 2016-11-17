<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Country;
use Lang;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::paginate(config('view.paginate'));
        return view('admin.country.list', compact('countries'));
    }
	
    public function create()
    {
        return view('admin.country.add');
    }

    public function store(Request $request)
    {
        $country = new Country();
        $data = $request->only('name', 'code');
        if ($country->validate($data, 'storeRule')) {
            Country::create($data);

            return redirect()->route('admin.country.index')->with([
                'flash_level' => Lang::get('admin.success'),
                'flash_message' => Lang::get('admin.message.complate', ['name' => 'country'])
            ]);
        }
        return redirect()->back()->withErrors($country->valid());
    }

    public function edit($id)
    {
        $country = Country::find($id);
        if (!$country) {
            return redirect()->route('admin.country.index')->with([
                'flash_level' => Lang::get('admin.danger'),
                'flash_message' => Lang::get('admin.message.not_found', ['name' => 'country'])
            ]);
        }
        return view('admin.country.edit', compact('country'));
    }

    public function update(Request $request, $id)
    {
        $country = Country::find($id);
        if (!$country) {
            return redirect()->route('admin.country.index')->with([
                'flash_level' => Lang::get('admin.danger'),
                'flash_message' => Lang::get('admin.message.not_found', ['name' => 'country'])
            ]);
        }
        $data = $request->only('name', 'code');
        if ($country->validate($data, 'updateRule')) {
            $country->update($data);
            return redirect()->route('admin.country.index')->with([
                'flash_level' => Lang::get('admin.success'),
                'flash_message' => Lang::get('admin.message.edit_success', ['name' => 'country'])
            ]);
        }
        return redirect()->back()->withErrors($country->valid());
    }

    public function destroy($id)
    {
        $country = Country::find($id);
        if (!$country) {
            return redirect()->route('admin.country.index')->with([
                'flash_level' => Lang::get('admin.danger'),
                'flash_message' => Lang::get('admin.message.not_found', ['name' => 'country'])
            ]);
        }
        $country->delete();
        return redirect()->route('admin.country.index')->with([
            'flash_level' => Lang::get('admin.success'),
            'flash_message' => Lang::get('admin.message.delete_success', ['name' => 'country'])
        ]);
    }
}
