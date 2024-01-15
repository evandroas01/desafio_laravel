<?php

namespace Tests\Feature;

use NunoMaduro\LaravelMojito\InteractsWithViews;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Blog;
use App\Models\User;

class BlogTest extends TestCase
{
    use InteractsWithViews;

    public function test_get_blog_view()
    {
        $response = $this->get('/blog')->assertStatus(200);
        $response->assertView('blog');
    }

    public function test_blog_create()
    {
        $response = $this->post('/blog', [
            'title'   => 'test blog1',
            'author'  => 'test blog author',
            'content' => 'test blog content this is the test blog contain this is the test blog contain test blog content this is the test blog contain this is the test blog contain'
        ]);
        $response->assertStatus(201);
    }

    public function test_blog_create_validation()
    {
        $response = $this->post('/blog', [
            'title'   => '',
            'author'  => '',
            'content' => ''
        ]);
        
        $response->assertSessionHasErrors([
            'title',
            'author',
            'content'
        ]);
    }

    public function test_blog_get_by_id()
    {
        $blog = Blog::first();

        $response = $this->get('/blog/edit/'.$blog->id)->assertStatus(200);
        $response->assertView('editblog', ['blog' => $blog]);
    }

    public function test_blog_get_by_id_not_found()
    {
        $this->get('/blog/edit/abc')->assertStatus(500);
    }

    public function test_blog_by_id_update()
    {
		$blog = Blog::first();

        $response = $this->put('/blog/edit/'.$blog->id, [
            'title'   => 'test blog1',
            'author'  => 'test blog author',
            'content' => 'test blog content this is the test blog contain this is the test blog contain test blog content this is the test blog contain this is the test blog contain'
        ]);
        $response->assertStatus(201);
    }

    public function test_blog_update_validation()
    {
        $blog = Blog::first();
        $response = $this->put('/blog/edit/'.$blog->id, [
            'title'   => '',
            'author'  => '',
            'content' => ''
        ]);
        $response->assertSessionHasErrors([
            'title',
            'author',
            'content'
        ]);
    }

    public function test_blog_by_id_delete()
    {
		$blog = Blog::first();

        $this->post('/blog/delete/'.$blog->id)->assertStatus(302);
    }
}