<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

/**
 * Class News
 * @package App\Model
 */
class News
{
    /**
     * Метод возвращает массив новостей.
     * @return mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function getNews()
    {
        return json_decode(File::get(storage_path() . '/json/news.json'), true);
    }


    /**
     * Метод возвращает одну новость по ее ID.
     * @param int|null $news_id
     * @return mixed|null
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function getOneNews(?int $news_id)
    {
        if (is_null($news_id)) {
            return null;
        }

        // Получаем все новости.
        $news = static::getNews();

        if (array_key_exists($news_id, $news)) {
            return $news[$news_id];
        }

        return null;
    }

    /**
     * Метод возвращает массив новостей по ID категории новостей.
     * @param int|null $category_id
     * @return array
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public static function getNewsByCategory(?int $category_id)
    {
        $arr = [];

        if (is_null($category_id)) {
            return $arr;
        }

        foreach (static::getNews() as $item) {
            if ($item['category_id'] == $category_id) {
                $arr[] = $item;
            }
        }

        return $arr;
    }
}
