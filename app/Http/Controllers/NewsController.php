<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\News;

class NewsController extends Controller
{
    /**
     * Выводим список новостей.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Получаем все новости.
        $news = News::query()->orderByDesc('id')->paginate(5);

        // Получаем все категории.
        $categories = Category::all();

        return view('news.index', ['news' => $news, 'categories' => $categories]);
    }

    /**
     * Выводим новость по заданному ID.
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(News $news)
    {
        // Преобразовываем разрывы строки в абзацы.
        $news->text = News::wrapTextInTag($news->text, 'p');

        return view('news.show', ['oneNews' => $news]);
    }

    /**
     * Выводим список категорий.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function categories()
    {
        // Получаем все категории.
        $categories = Category::all();

        return view('news.categories', ['categories' => $categories]);
    }

    /**
     * Выводим новости по заданным категориям.
     * @param $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category($slug)
    {
        // Получаем все категории.
        $categories = Category::all();

        /** @var Category $category */
        $category = Category::query()->where(['slug' => $slug])->first();

        // Получаем все новости в данной категории.
        $news = $category->news()->orderByDesc('id')->paginate(5);

        return view('news.category', ['news' => $news, 'categories' => $categories, 'category' => $category]);
    }
}
