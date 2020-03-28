<?php

namespace App\Http\Controllers;

use App\Model\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::getNews();
        return view('news.index', ['news' => $news]);
    }

    public function view($id)
    {
        $oneNews = News::getOneNews($id);
        return view('news.view', ['oneNews' => $oneNews]);
    }
}
