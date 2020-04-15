<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use App\Model\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Storage;
use Str;

class CategoryController extends Controller
{
    /**
     * Главная страница категорий.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Получаем все категории.
        $categories = Category::query()->orderByDesc('id')->paginate(5);

        return view('admin.category-index', ['categories' => $categories]);
    }

    /**
     * Добавление категории.
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        // Создаем новый объект категории.
        $category = new Category();

        // Если переданные данные, то обрабатываем их и перенаправляем на страницу со списком категорий.
        if ($this->isMethodPostSaveNews($request, $category)) {
            return redirect()->route('admin.category.index')->with('success', 'Категория успешно добавлена!');
        }

        return view('admin.category-create', ['category' => $category]);
    }

    /**
     * Вывод страницы с редактирюемой категорией.
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return view('admin.category-create', ['category' => $category]);
    }

    /**
     * Редактирование категории.
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function update(Request $request, Category $category)
    {
        // Если переданные данные, то обрабатываем их и перенаправляем на страницу со списком категорий.
        if ($this->isMethodPostSaveNews($request, $category)) {
            return redirect()->route('admin.category.index')->with('success', 'Категория успешно изменена!');
        }

        return view('admin.category-create', ['category' => $category]);
    }

    /**
     * Удалине новости.
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Category $category)
    {
        if ($category->delete()) {
            return redirect()->route('admin.category.index')->with('success', 'Категория удалена!');
        };
    }

    /**
     * Метод сохраняет категорию, если данные поступили через POST.
     * @param Request $request
     * @param Category $category
     * @return bool|\Illuminate\Http\RedirectResponse
     */
    private function isMethodPostSaveNews(Request $request, Category $category)
    {
        // Если переданные данные, то обрабатываем их.
        if ($request->isMethod('post')) {
            $request->flash();

            // Заполняем модель данными.
            $category->fill($request->all());

            // Добавляем slug.
            $category->slug = Str::slug($category->title, '-');

            // Сохранаяем модель.
            $category->save();

            return true;
        }

        return false;
    }
}
