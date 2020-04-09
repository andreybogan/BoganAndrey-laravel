<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\News;
use Illuminate\Http\Request;
use DB;

class NewsController extends Controller
{
    public function index()
    {
        $news = DB::table('news')->get();
        $categories = DB::table('categories')->get();
        return view('news.index', ['news' => $news, 'categories' => $categories]);
    }

    public function view($id)
    {
        $oneNews = DB::table('news')->find($id);

        if ($oneNews) {
            // Преобразовываем разрывы строки в абзацы
            $oneNews->text = News::wrapTextInTag($oneNews->text, 'p');
        }

        return view('news.view', ['oneNews' => $oneNews]);
    }

    public function categories()
    {
        $categories = DB::table('categories')->get();
        return view('news.categories', ['categories' => $categories]);
    }

    public function category($name)
    {
        // получаем ID категории по его url
        $category = DB::table('categories')->where(['slug' => $name])->first();

        if ($category) {
            // получаем ID категории по его url
            $news = DB::table('news')->select('news.*')->join('categories', function ($join) use ($category) {
                $join->on('categories.id', '=', 'news.category_id')
                    ->where('categories.id', '=', $category->id);
            })->get();
        } else {
            $news = [];
        }

        return view('news.category', ['news' => $news, 'category' => $category]);
    }
}
