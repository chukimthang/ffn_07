<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Category;
use App\Country;
use App\News;

use Session;
use Lang;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::paginate(config('view.paginate'));
        return view('admin.news.index')->with(['news' => $news]);
    }

    public function create()
    {
        $categories = Category::lists('name', 'id')->all();
        $countries = Country::lists('name', 'id')->all();
        return view('admin.news.add')->with(['categories' => $categories, 'countries' => $countries]);
    }

    public function store(Request $request)
    {
        $news = new News();
        $data = $request->only('title', 'description', 'content', 'cate_id', 'country_id');
        if ($news->validate($data, 'storeRule')) {
            News::create($data);
            Session::flash('flash_message', Lang::get('news.add_news_success'));
            return redirect()->back()->with('flash_level', 'success');
        }
        return redirect()->back()->withErrors($news->valid());
    }

    public function edit($id)
    {
        $news = News::find($id);
        $categories = Category::lists('name', 'id')->all();
        $countries = Country::lists('name', 'id')->all();
        return view('admin.news.edit')->with(['news' => $news, 
            'categories' => $categories, 'countries' => $countries]);
    }

    public function update(Request $request, $id)
    {
        $news = News::find($id);
        if (!$news) {
            return redirect()->back()->with([
                'flash_message', Lang::get('news.not_search_news'),
                'flash_level' => 'danger']);
        }
        $data = $request->only('title', 'description', 'content', 'cate_id', 'country_id');
        if ($news->validate($data, 'updateRule')) {
            $news->update($data);
            return redirect()->back()->with([
                'flash_message' => Lang::get('news.edit_news_success'),
                'flash_level' => 'success']);
        }
        return redirect()->back()->withErrors($news->valid());
    }

    public function destroy($id){
        $news = News::find($id);
        if (!$news) {
            return redirect()->back()->with([
                'flash_message' => Lang::get('news.not_search_news'),
                'flash_level' => 'danger']);
        }
        $news->delete();
        return redirect()->back()->with([
            'flash_message' => Lang::get('news.delete_success'),
            'flash_level' => 'success']);
    }
}
