<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title'];

    /**
     * Метод возвращает правила валидации.
     * @return array
     */
    public static function rules()
    {
        return [
            'title' => 'required|min:5|max:45',
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
        ];
    }

    /**
     * олучаем запрос всех новостей для категории текущей модели.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function news()
    {
        return $this->hasMany(News::class, 'category_id');
    }
}
