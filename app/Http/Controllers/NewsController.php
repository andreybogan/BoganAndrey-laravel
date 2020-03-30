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
        return view('news.view', ['oneNews' => $oneNews]);
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

        return view('news.category-view', ['news' => $news]);
    }
}
