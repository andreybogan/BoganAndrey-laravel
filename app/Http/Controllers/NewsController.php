<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\News;
use Illuminate\Http\Request;
use DB;

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
    public function show($id)
    {
        // Получаем новость.
        $oneNews = News::query()->find($id);

        // Преобразовываем разрывы строки в абзацы.
        $oneNews->text = News::wrapTextInTag($oneNews->text, 'p');

        return view('news.show', ['oneNews' => $oneNews]);
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
     * @param $name
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category($name)
    {
        // Получаем все категории.
        $categories = Category::all();

        /** @var Category $category */
        $category = Category::query()->where(['slug' => $name])->first();

        // Можно было бы сделать так, но нам нужно сделать пагинацию.
//        $news = $category->news();

        $news = News::query()->where(['category_id' => $category->id])->orderByDesc('id')->paginate(5);

        return view('news.category', ['news' => $news, 'categories' => $categories, 'category' => $category]);
    }
}
