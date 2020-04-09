<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert($this->getData());
    }

    private function getData()
    {
        return [
            [
                "title" => "Спорт",
                "slug" => "sport"
            ],
            [
                "title" => "Наука",
                "slug" => "science"
            ],
            [
                "title" => "Политика",
                "slug" => "politics"
            ],
            [
                "title" => "Космос",
                "slug" => "cosmos"
            ]
        ];
    }
}
