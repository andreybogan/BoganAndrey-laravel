<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Model\News;
use App\Model\Category;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

    public function testNewsTest()
    {
        $news = new News();
        $this->assertIsArray(News::getNews());
    }

    public function testCategoryTest()
    {
        $news = new News();
        $this->assertIsArray(Category::getCategory());
    }
}
