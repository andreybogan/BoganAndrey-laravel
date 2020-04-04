<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::getNews();
        $categories = Category::getCategory();
        return view('news.index', ['news' => $news, 'categories' => $categories]);
    }

    public function view($id)
    {
        $oneNews = News::getOneNews($id);

        // Преобразовываем разрывы строки в абзацы
        $oneNews['text'] = News::wrapTextInTag($oneNews['text'], 'p');

        return view('news.view', ['oneNews' => $oneNews]);
    }

    public function categories()
    {
        $categories = Category::getCategory();
        return view('news.categories', ['categories' => $categories]);
    }

    public function category($name)
    {
        // получаем ID категории по его url
        $category = Category::getOneCategoryByUrl($name);

        if ($category) {
            // получаем ID категории по его url
            $categoryId = $category['id'];
            $news = News::getNewsByCategory($categoryId);
        } else {
            $news = [];
        }

        return view('news.category', ['news' => $news, 'category' => $category]);
    }
}
