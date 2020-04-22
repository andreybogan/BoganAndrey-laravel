<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Auth;

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
            'title' => ['required','min:5','max:45','unique:categories,title'],
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

    public static function getIdCategoryIfNotCreateNew(string $title): int
    {
        // Переводим название в нижний регистр.
        $title = mb_strtolower($title);

        // Получаем все категории.
        $categories = Category::all()->keyBy('title')->toArray();

        // Проверяем есть ли переданное название категории в базе, если есть возвращаем ее ID,
        // если нет, то создаем новую категорию по названию и возвращаем ее ID.
        if (key_exists($title, $categories)) {
            $id = $categories[$title]['id'];
        } else {
            // Создаем новую категорию.
            $newCategory = new Category();
            $newCategory->title = $title;
            $newCategory->slug = Str::slug($title, '-');
            $newCategory->save();

            $id = $newCategory->id;
        }

        return $id;
    }
}
