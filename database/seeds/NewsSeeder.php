<?php

use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('news')->insert($this->getData());
    }

    private function getData()
    {
        $faker = Faker\Factory::create('ru_RU');

        $data = [];

        for ($i = 0; $i < 20; $i++) {
            $data[] = [
                'title' => $faker->realText(rand(30,80)),
                'text' => $faker->realText(rand(1000,5000)),
                'private' => (bool)rand(0, 1),
                'category_id' => (int)rand(1, 4),
            ];
        }

        return $data;
    }
}
