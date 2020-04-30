<?php

namespace App\Services;

use App\Model\Category;
use App\Model\News;
use Orchestra\Parser\Xml\Facade as XmlParser;
use DateTime;
use Storage;

/**
 * Class XMLParserService
 * @package App\Services
 */
class XMLParserService
{
    public function saveNews($link)
    {
        // Получаем XML файл.
        $xml = XmlParser::load($link);

        // Распарсиваем XML.
        $data = $xml->parse([
            'news' => ['uses' => 'channel.item[title,link,description,pubDate,enclosure::url,category]'],
        ]);

        // Обходим все новости и добавляем в базу данных.
        foreach ($data['news'] as $key => $value) {
            // Создаем новый объект новости.
            $newNews = new News();

            // Проверяем существует ли такая новость в базе, если нет, то добавляем ее, если да, то пропускаем.
            if (!News::query()->where(['link' => $value['link']])->first()) {
                // Заполняем новую новость данными.
                $newNews->title = $value['title'];
                $newNews->text = $value['description'];
                $newNews->created_at = (new DateTime($value['pubDate']))->format('Y-m-d H:i:s');
                $newNews->link = $value['link'];
                $newNews->image = $value['enclosure::url'];
                // Проверяем, существует ли данная категория, если да, то добавляем ее ID,
                // если нет, то добавляем ее и добавляем новый ID.
                $newNews->category_id = Category::getIdCategoryIfNotCreateNew($value['category'] ?? 'разное');
                $newNews->save();
            }
        }

        // Логируем.
        Storage::disk('logs')->append('logs.txt', date('c') . ' ' . $link);
    }
}
