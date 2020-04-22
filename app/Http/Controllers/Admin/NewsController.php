<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\News;
use Illuminate\Http\Request;
use Storage;

class NewsController extends Controller
{
    /**
     * Главная страница новостей.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Получаем все новости.
        $news = News::query()->orderByDesc('id')->paginate(5);

        return view('admin.news-index', ['news' => $news]);
    }

    /**
     * Форма добавления новости.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        // Получаем все категории.
        $categories = Category::query()->select(['id', 'title'])->get();

        // Создаем новый объект новости.
        $news = new News();

        return view('admin.news-create', ['categories' => $categories, 'news' => $news]);
    }

    /**
     * Добавляем новость.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // Создаем новый объект новости.
        $news = new News();

        // Обрабатываем полученные данные и, в случае успешной валидации, перенаправляем на страницу со списком новостей.
        $this->isMethodPostSaveNews($request, $news);

        return redirect()->route('admin.news.index')->with('success', 'Новость успешно добавлена!');
    }

    /**
     * Вывод страницы с редактирюемой новостью.
     * @param News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(News $news)
    {
        // Получаем все категории.
        $categories = Category::query()->select(['id', 'title'])->get();

        return view('admin.news-create', ['categories' => $categories, 'news' => $news]);
    }

    /**
     * Редактирование новости.
     * @param Request $request
     * @param News $news
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, News $news)
    {
        // Обрабатываем полученные данные и, в случае успешной валидации, перенаправляем на страницу со списком новостей.
        $this->isMethodPostSaveNews($request, $news);

        return redirect()->route('admin.news.index')->with('success', 'Новость успешно изменена!');
    }

    /**
     * Удалине новости.
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(News $news)
    {
        if ($news->delete()) {
            return redirect()->route('admin.news.index')->with('success', 'Новость удалена!');
        } else {
            return redirect()->route('admin.news.index')->with('error', 'Новость не удалена!');
        }
    }

    /**
     * Метод сохраняет новость, если данные поступили через POST.
     * @param Request $request
     * @param News $news
     * @return bool
     * @throws \Illuminate\Validation\ValidationException
     */
    private function isMethodPostSaveNews(Request $request, News $news)
    {
        // Выполняем валидацию данных.
        $data = $this->validate($request, News::rules(), [], News::attributeNames());

        // Если есть изображением то сохраняем его и добавляем в модель.
        $url = null;
        if ($request->file('image')) {
            $path = Storage::putFile('public/images', $request->file('image'));
            $news->image = Storage::url($path);
        }

        // Заполняем модель данными.
        $news->fill($data);

        // Сохранаяем модель.
        $news->save();

        return true;
    }
}
