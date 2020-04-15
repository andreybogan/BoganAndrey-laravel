<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddCategoryTest extends DuskTestCase
{
    /**
     * Тестирование добавление категории.
     * @throws \Throwable
     */
    public function testAddNews()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/category/create')
                ->assertSee('Добавление категории')
                ->type('title', '123')
                ->press('Добавить категорию')
                ->assertPathIs('/admin/category/create');
        });
    }
}
