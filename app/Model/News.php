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

    /**
     * Метод позволяет преобразовать текст в котором перевод строки обозначен \r\n таким образом, чтобы
     * каждая строка была обернута в заданный тег.
     * @param string|null $text - Исходный текст
     * @param string $tag - Тег в который необходимо обернуть текст.
     * @return string Возвращает текст обернутый в заданный тег.
     */
    public static function wrapTextInTag(?string $text, string $tag)
    {
        if ($text == null) {
            return '';
        }

        // Преобразуем все переводы строки в PHP_EOL.
        // Обрабатывает сначала \r\n для избежания их повторной замены.
        $order = array("\r\n", "\n", "\r");
        $replace = PHP_EOL;
        $text = str_replace($order, $replace, $text);

        $newText = '';

        // Разбиваем текст по разделителю PHP_EOL.
        $arr = explode(PHP_EOL, $text);

        // Каждый не пустой элемент массива обертываем в заданный тег предварительно убрав лишние пробелы.
        foreach ($arr as $value) {
            if (!empty($value)) {
                $newText .= "<{$tag}>" . trim($value) . "</{$tag}>";
            }
        }

        return $newText;
    }
}
