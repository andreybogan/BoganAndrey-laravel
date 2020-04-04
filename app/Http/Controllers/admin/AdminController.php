<?php

namespace App\Http\Controllers\admin;

use App\Model\Category;
use App\Model\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function create(Request $request)
    {
        $categories = Category::getCategory();

//            var_dump(File::get(storage_path(). '/json/news.json'));
        if ($request->isMethod('post')) {
            $request->flash();
            $newNews = $request->all();

            $news = json_decode(File::get(storage_path() . '/json/news.json'), true);

            // Вычисляем ID новой новости.
            if (is_array($news)) {
                $count = max($news)['id'] + 1;
            } else {
                $count = 1;
            }

            $news[$count] = [
                'id' => $count,
                'title' => $newNews['title'],
                'text' => $newNews['text'],
                'category_id' => $newNews['category_id'],
                'isPrivate' => isset($newNews['private']) ? true : false,
            ];

            var_dump($news); exit;
            return redirect()->route('admin.news.create');
        }

        return view('admin.create', ['categories' => $categories]);
    }

    public function downloadJsonCategory()
    {
        return response()->download(storage_path() . '/json/category.json');
//        return File::get(storage_path(). '/json/category.json');
    }
}
