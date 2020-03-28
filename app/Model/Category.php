<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category
{
    private static $categories = [
        [
            'id' => 1,
            'title' => 'Спорт',
            'url' => 'sport',
        ],
        [
            'id' => 2,
            'title' => 'Наука',
            'url' => 'science',
        ],
        [
            'id' => 3,
            'title' => 'Политика',
            'url' => 'politics',
        ],
        [
            'id' => 4,
            'title' => 'Здоровье',
            'url' => 'health',
        ],
    ];

    public static function getCategory()
    {
        return static::$categories;
    }

    public static function getOneCategory($id)
    {
        return static::$categories[array_search($id, array_column(static::$categories, 'id'))];
    }

    public static function getOneCategoryByUrl($id)
    {
        return static::$categories[array_search($id, array_column(static::$categories, 'url'))];
    }
}
