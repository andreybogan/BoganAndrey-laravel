<?php

namespace App\Http\Controllers\admin;

use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function add()
    {
        $categories = Category::getCategory();
        return view('admin.news-add', ['categories' => $categories]);
    }
}
