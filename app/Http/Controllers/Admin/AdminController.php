<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Category;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    /**
     * Выводим главную страницу Админинтерфейса
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('Admin.index');
    }

    /**
     * Закачка json файл со списком категорий.
     * @return \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\JsonResponse
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function downloadJsonCategory()
    {
        return response()->json(json_decode(File::get(storage_path() . '/json/category.json')))
            ->header('Content-Disposition', 'attachment; filename = "category.json"')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
