<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = ['title', 'text', 'private', 'category_id', 'image'];

    /**
     * Метод возвращает правила валидации.
     * @return array
     */
    public static function rules()
    {
        $tableNameCategory = (new Category())->getTable();

        return [
            'title' => 'required|min:5|max:255',
            'text' => 'required|min:10',
            'private' => 'boolean',
            'category_id' => "required|exists:{$tableNameCategory},id",
            'image' => 'mimes:jpeg,gif,png',
        ];
    }

    /**
     * Метод возвращает название атрибутов.
     * @return array
     */
    public static function attributeNames()
    {
        return [
            'title' => 'Название',
            'text' => 'Содержание новости',
            'private' => 'Приватная новость',
            'category_id' => 'Категория новости',
            'image' => 'Изображение',
        ];
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

    /**
     * Получаем запрос категории новости текующего объекта.
     * @return Model|\Illuminate\Database\Eloquent\Relations\BelongsTo|object|null
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
