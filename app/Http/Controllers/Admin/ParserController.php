<?php

namespace App\Http\Controllers\Admin;

use App\Model\Category;
use App\Model\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Orchestra\Parser\Xml\Facade as XmlParser;
use DateTime;

class ParserController extends Controller
{
    public function index()
    {
        // Получаем XML файл.
        $xml = XmlParser::load('https://lenta.ru/rss/news');

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
                $newNews->category_id = Category::getIdCategoryIfNotCreateNew($value['category']);
                $newNews->save();
            }
        }

        return redirect()->route('admin.news.index')->with('success', 'Новости добавлены!');
    }
}
