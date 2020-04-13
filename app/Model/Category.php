<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['title', 'slug'];

    /**
     * олучаем все новости для категории текущей модели.
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function news()
    {
        return $this->hasMany(News::class, 'category_id')->get();
    }
}
