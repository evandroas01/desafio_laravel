<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Chrome;
use Tests\DuskTestCase;
use App\Models\Blog;
use App\Models\User;

class BlogTest extends DuskTestCase
{
    public function test_create_blog()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/blog')
                    ->type('title', 'test blog1')
                    ->type('author', 'test blog author')
                    ->type('content', 'test blog content this is the test blog contain this is the test blog contain test blog content this is the test blog contain this is the test blog contain')
                    ->press('Create')
                    ->assertPathIs('/');
        });
    }

    public function test_on_click_edit_button()
    {
        $blog = Blog::first();

        $this->browse(function (Browser $browser) use ($blog) {
            $browser->visit('/')
                    ->clickLink('Edit')
                    ->assertPathIs('/blog/edit/'.$blog->id);
        });
    }

    public function test_update_blog()
    {
        $blog = Blog::latest()->first();

        $this->browse(function (Browser $browser) use ($blog) {
            $browser->visit('/blog/edit/'.$blog->id)
                    ->type('title', 'test blog2')
                    ->type('author', 'test blog2 author')
                    ->type('content', 'test blog2 content this is the test blog contain this is the test blog contain test blog content this is the test blog contain this is the test blog contain')
                    ->press('Update')
                    ->assertPathIs('/');
        });
    }

    public function test_delete_blog()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->press('Delete')
                    ->assertPathIs('/');
        });
    }
}
