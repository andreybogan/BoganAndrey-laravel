<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App\Model
 */
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

    /**
     * Методо возвращает массив категорий.
     * @return array
     */
    public static function getCategory()
    {
        return static::$categories;
    }

    /**
     * Метод возвращает одну категорию по ID.
     * @param int|null $category_id
     * @return mixed|null
     */
    public static function getOneCategory(?int $category_id)
    {
        if (is_null($category_id)){
            return null;
        }

        if ($id = array_search($category_id, array_column(static::$categories, 'url'))) {
            return static::$categories[$id];
        }

        return null;
    }

    /**
     * Метод возвращает одну категорию по названию URL категории.
     * @param string|null $url
     * @return mixed|null
     */
    public static function getOneCategoryByUrl(?string $url)
    {
        if (is_null($url)){
            return null;
        }

        if ($id = array_search($url, array_column(static::$categories, 'url'))) {
            return static::$categories[$id];
        }

        return null;
    }
}
