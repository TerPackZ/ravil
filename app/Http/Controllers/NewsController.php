<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        return view('news.index', [
            'newsItems' => News::query()->latest('published_at')->paginate(6),
        ]);
    }

    public function show(News $news): View
    {
        return view('news.show', [
            'article' => $news,
            'relatedNews' => News::query()->whereKeyNot($news->id)->latest('published_at')->take(3)->get(),
        ]);
    }
}
