<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Resource;

class ResourceController extends Controller
{
    /**
     * Главная страница категорий.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Получаем все ресурсы.
        $resources = Resource::query()->orderByDesc('id')->paginate(10);

        return view('admin.resource-index', ['resources' => $resources]);
    }

    /**
     * Форма добавления ресурсов.
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function create()
    {
        // Создаем новый объект категории.
        $resource = new Resource();

        return view('admin.resource-create', ['resource' => $resource]);
    }

    /**
     * Добавляем ресурс.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // Создаем новый объект ресурса.
        $resource = new Resource();

        // Обрабатываем полученные данные и, в случае успешной валидации, перенаправляем на страницу со списком ресурсов.
        $this->isMethodPostSaveResource($request, $resource);

        return redirect()->route('admin.resource.index')->with('success', 'RSS ресурс успешно добавлен!');
    }

    /**
     * Вывод страницы с редактирюемым ресурсом.
     * @param Resource $resource
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Resource $resource)
    {
        return view('admin.resource-create', ['resource' => $resource]);
    }

    /**
     * Редактирование ресурса.
     * @param Request $request
     * @param Resource $resource
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Resource $resource)
    {
        // Если переданные данные, то обрабатываем их и перенаправляем на страницу со списком ресурсов.
        $this->isMethodPostSaveResource($request, $resource);

        return redirect()->route('admin.resource.index')->with('success', 'RSS ресурс успешно изменен!');
    }

    /**
     * Удалине ресурса.
     * @param Resource $resource
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Resource $resource)
    {
        if ($resource->delete()) {
            return redirect()->route('admin.resource.index')->with('success', 'RSS ресурс удален!');
        } else {
            return redirect()->route('admin.resource.index')->with('error', 'RSS ресурс не удален!');
        }
    }

    /**
     * Метод сохраняет ресурс, если данные поступили через POST.
     * @param Request $request
     * @param Resource $resource
     * @return bool
     * @throws \Illuminate\Validation\ValidationException
     */
    private function isMethodPostSaveResource(Request $request, Resource $resource)
    {
        // Выполняем валидацию данных.
        $data = $this->validate($request, Resource::rules(), [], Resource::attributeNames());

        // Заполняем модель данными.
        $resource->fill($data);

        // Сохранаяем модель.
        $resource->save();

        return true;
    }
}
