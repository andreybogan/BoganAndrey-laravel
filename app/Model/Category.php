<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

/**
 * Class Category
 * @package App\Model
 */
class Category
{
    /**
     * Методо возвращает массив категорий.
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function getCategory()
    {
        return json_decode(File::get(storage_path() . '/json/category.json'), true);
    }

    /**
     * Метод возвращает одну категорию по ID.
     * @param int|null $category_id
     * @return mixed|null
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function getOneCategory(?int $category_id)
    {
        if (is_null($category_id)) {
            return null;
        }

        // Получаем все категории.
        $categories = static::getCategory();

        if (array_key_exists($category_id, $categories)) {
            return $categories[$category_id];
        }

        return null;
    }

    /**
     * Метод возвращает одну категорию по названию URL категории.
     * @param string|null $url
     * @return mixed|null
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function getOneCategoryByUrl(?string $url)
    {
        if (is_null($url)) {
            return null;
        }

        // Получаем все категории.
        $categories = static::getCategory();

        // Получаем ID категории с искомым url.
        $id = array_search($url, array_column($categories, 'url'));

        if (is_int($id) && array_key_exists($id, $categories)) {
            return $categories[$id];
        }

        return null;
    }
}
