<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\NewsParsing;
use App\Model\Resource;
use App\Services\XMLParserService;

/**
 * Class ParserController
 * @package App\Http\Controllers\Admin
 */
class ParserController extends Controller
{
    public function index(XMLParserService $parserService)
    {
        // Получаем коллекцию ссылок на ресурсы.
        $linkRss = Resource::all('url')->toArray();

        // Если ссылок на ресурсы нет, то выводим сообщение об ошибке.
        if (empty($linkRss)) {
            return redirect()->route('admin.news.index')->with('error', 'У вас нет ни одной ссылки на RSS ресурсы для парсинга. Пожалуйста, добавьте ресурсы.');
        }

        foreach ($linkRss as $link) {
            NewsParsing::dispatch($link['url']);
        }

        return redirect()->route('admin.news.index')->with('success', 'Новости добавлены! Обновите страницу ...');
    }
}
