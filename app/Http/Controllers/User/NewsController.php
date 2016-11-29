<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\News;
use App\Comment;
use App\User;
use Auth;

class NewsController extends Controller
{
    public function show($id)
    {
        $news = News::findOrFail($id);
        $comments = $news->comments()->orderBy('created_at', 'desc')->get();
        $ortherNews = News::getNews(config('view.other_news'))->get();
        $readestNews = News::getNews(config('view.readest_news'), 'view_number')->get();
        return view('user.news.news-detail')->with([
            'news' => $news,
            'comments' => $comments,
            'ortherNews' => $ortherNews,
            'readestNews' => $readestNews,
        ]);
    }

    public function addComment(Request $request)
    {
        $comment = new Comment();
        $data = $request->only('content', 'news_id', 'user_id');
        if (Auth::check() && $comment->validate($data, 'storeRule')) {
            Comment::create($data);
            return response()->json(['result' => 'success']);
        }
        return response()->json(['result' => 'error']);
    }
}
