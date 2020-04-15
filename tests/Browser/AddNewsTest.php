<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddNewsTest extends DuskTestCase
{
    /**
     * Тестирование добавление новости.
     * @throws \Throwable
     */
    public function testAddNews()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news/create')
                ->assertSee('Добавление новости')
                ->type('title', '123')
                ->type('text', '123')
                ->type('private', '123')
                ->type('category_id', '123')
                ->press('Добавить новость')
                ->assertPathIs('/admin/news/create');
        });
    }
}
