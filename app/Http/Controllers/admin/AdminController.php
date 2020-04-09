<?php

namespace App\Http\Controllers\admin;

use App\Model\Category;
use App\Model\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Storage;
use DB;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function create(Request $request)
    {
        $categories = DB::table('categories')->get();

        if ($request->isMethod('post')) {
            $request->flash();
            $newNews = $request->all();

            $url = null;

            if ($request->file('image')) {
                $path = Storage::putFile('public/images', $request->file('image'));
                $url = Storage::url($path);
            }

            // Добавляем новость в базу и получим последний добавленный ID.
            $id = DB::table('news')->insertGetId(
                [
                    'title' => $newNews['title'],
                    'text' => $newNews['text'],
                    'category_id' => $newNews['category_id'],
                    'private' => isset($newNews['private']) ? true : false,
                    'image' => $url,
                ]
            );

            return redirect()->route('news.view', $id)->with('success', 'Новость успешно добавлена!');
        }

        return view('admin.create', ['categories' => $categories]);
    }

    public function downloadJsonCategory()
    {
        return response()->json(json_decode(File::get(storage_path() . '/json/category.json')))
            ->header('Content-Disposition', 'attachment; filename = "category.json"')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}
