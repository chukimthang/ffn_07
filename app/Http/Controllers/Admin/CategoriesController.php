<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;
use Session;
use Lang;

class CategoriesController extends Controller
{

    public function index()
    {
        $categories = Category::paginate(config('view.paginate'));
        return view('admin.categories.index')->with(['categories' => $categories]);
    }

    public function create()
    {
        return view('admin.categories.add');
    }

    public function store(Request $request)
    {
        $category = new Category();
        $data = $request->all();
        if ($category->validate($data, 'storeRule')) {
            $category->name = ucwords($request->name);
            $category->save();
            Session::flash('flash_message', Lang::get('categories.add_category_success'));
            return redirect()->back();
        }
        return redirect()->back()->withErrors($category->valid());
    }

    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit')->with('category', $category);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if(!$category) {
            return redirect()->back()->with('flash_message', Lang::get('categories.not_search_category'));
        }
        $data = $request->all();
        if ($category->validate($data, 'updateRule')) {
            $category->name = ucwords($request->name);
            $category->update();
            return redirect()->back()->with('flash_message', Lang::get('categories.edit_category_success'));
        }
        return redirect()->back()->withErrors($category->valid());
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if(!$category) {
            return redirect()->back()->with('flash_message', Lang::get('categories.not_search_category'));
        }
        $category->delete();
        return redirect()->back()->with('flash_message', Lang::get('categories.delete_category_success'));
    }
}
