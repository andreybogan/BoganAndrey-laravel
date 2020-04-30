<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = ['title', 'url'];

    /**
     * Метод возвращает правила валидации.
     * @return array
     */
    public static function rules()
    {
        return [
            'title' => ['required', 'min:5', 'max:45', 'unique:resources,url'],
            'url' => ['required', 'max:255', 'unique:resources,url'],
        ];
    }

    /**
     * Метод возвращает название атрибутов.
     * @return array
     */
    public static function attributeNames()
    {
        return [
            'title' => 'Название ресурса',
            'url' => 'URL адрес ресурса',
        ];
    }
}
