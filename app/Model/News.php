<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class News
 * @package App\Model
 */
class News
{
    private static $news = [
        [
            'id' => 1,
            'title' => 'Новость 1',
            'text' => 'Текст новости 1 для примера.',
            'category_id' => 1,
            'isPrivate' => true,
        ],
        [
            'id' => 2,
            'title' => 'Новость 2',
            'text' => 'Текст новости 2 для примера.',
            'category_id' => 1,
            'isPrivate' => false,
        ],
        [
            'id' => 3,
            'title' => 'Новость 3',
            'text' => 'Текст новости 3 для примера.',
            'category_id' => 1,
            'isPrivate' => false,
        ],
        [
            'id' => 4,
            'title' => 'Новость 4',
            'text' => 'Текст новости 4 для примера.',
            'category_id' => 2,
            'isPrivate' => false,
        ],
        [
            'id' => 5,
            'title' => 'Новость 5',
            'text' => 'Текст новости 5 для примера.',
            'category_id' => 2,
            'isPrivate' => false,
        ],
        [
            'id' => 6,
            'title' => 'Новость 6',
            'text' => 'Текст новости 6 для примера.',
            'category_id' => 2,
            'isPrivate' => false,
        ],
        [
            'id' => 7,
            'title' => 'Новость 7',
            'text' => 'Текст новости 7 для примера.',
            'category_id' => 3,
            'isPrivate' => false,
        ],
        [
            'id' => 8,
            'title' => 'Новость 8',
            'text' => 'Текст новости 8 для примера.',
            'category_id' => 3,
            'isPrivate' => true,
        ],
        [
            'id' => 9,
            'title' => 'Новость 9',
            'text' => 'Текст новости 9 для примера.',
            'category_id' => 3,
            'isPrivate' => true,
        ],
        [
            'id' => 10,
            'title' => 'Новость 10',
            'text' => 'Текст новости 10 для примера.',
            'category_id' => 4,
            'isPrivate' => false,
        ],
        [
            'id' => 11,
            'title' => 'Новость 11',
            'text' => 'Текст новости 11 для примера.',
            'category_id' => 4,
            'isPrivate' => false,
        ],
        [
            'id' => 12,
            'title' => 'Новость 12',
            'text' => 'Текст новости 12 для примера.',
            'category_id' => 4,
            'isPrivate' => false,
        ],
    ];

    /**
     * Метод возвращает массив новостей.
     * @return array
     */
    public static function getNews()
    {
        return static::$news;
    }


    /**
     * Метод возвращает одну новость по ее ID.
     * @param int|null $news_id
     * @return mixed|null
     */
    public static function getOneNews(?int $news_id)
    {
        if (is_null($news_id)){
            return null;
        }

        $id = array_search($news_id, array_column(static::$news, 'id'));

        if (is_int($id) && array_key_exists($id, static::$news)) {
            return static::$news[$id];
        }

        return null;
    }

    /**
     * Метод возвращает массив новостей по ID категории новостей.
     * @param int|null $category_id
     * @return array
     */
    public static function getNewsByCategory(?int $category_id)
    {
        $arr = [];

        if (is_null($category_id)){
            return $arr;
        }

        foreach (static::$news as $item) {
            if ($item['category_id'] == $category_id) {
                $arr[] = $item;
            }
        }

        return $arr;
    }
}
