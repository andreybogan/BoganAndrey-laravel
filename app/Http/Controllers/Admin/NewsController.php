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
     * Добавление новости.
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create(Request $request)
    {
        // Получаем все категории.
        $categories = Category::query()->select(['id', 'title'])->get();

        // Создаем новый объект новости.
        $news = new News();

        // Если переданные данные, то обрабатываем их и перенаправляем на страницу со списком новостей.
        if ($this->isMethodPostSaveNews($request, $news)) {
            return redirect()->route('admin.news.index')->with('success', 'Новость успешно добавлена!');
        }

        return view('admin.news-create', ['categories' => $categories, 'news' => $news]);
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
        // Получаем все категории.
        $categories = Category::query()->select(['id', 'title'])->get();

        // Если переданные данные, то обрабатываем их и перенаправляем на страницу со списком новостей.
        if ($this->isMethodPostSaveNews($request, $news)) {
            return redirect()->route('admin.news.index')->with('success', 'Новость успешно изменена!');
        } else {
            // Перенесим данные для текущего запроса в сеанс.
            $request->flash();

            return view('admin.news-create', ['categories' => $categories, 'news' => $news]);
        }
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
        // Если переданные данные, то обрабатываем их.
        if ($request->isMethod('post')) {
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

        return false;
    }
}
