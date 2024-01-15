<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Support\Arr;
use NunoMaduro\LaravelMojito\InteractsWithViews;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Blog;
use App\Models\User;
use App\Http\Controllers\BlogController;

class BlogTest extends TestCase
{
    use InteractsWithViews;

    private $inputs = [
        'title'   => 'test blog1',
        'author'  => 'test blog author',
        'content' => 'test blog content this is the test blog contain this is the test blog contain test blog content this is the test blog contain this is the test blog contain'
    ];

    public function test_get_blog_view()
    {
        $response = $this->getJson(
                action([BlogController::class, 'index']),
                $this->inputs
            )->assertStatus(200);
        $response->assertView('blog');
    }

    public function test_blogs_create()
    {
        $response = $this->postJson(
            action([BlogController::class, 'create']),
            $this->inputs
        )->assertStatus(201);
    }

    public function test_blog_create_validation()
    {
        $reqData = ['title' => null, 'author' => null, 'content' => null];
        $response = $this->postJson(
            action([BlogController::class, 'create']),
            $reqData
        )->assertStatus(422);
    }

    public function test_blog_get_by_id()
    {
        $blog = Blog::first();
        $response = $this->getJson(
            action([BlogController::class, 'edit'], $blog->id),
        )->assertStatus(200);
        $response->assertView('blogs', ['blog' => $blog]);
    }

    public function test_blog_get_by_id_not_found()
    {
        $response = $this->getJson(
            action([BlogController::class, 'edit'], 'abc'),
            )->assertStatus(500);
    }

    public function test_blog_update_by_id_not_found()
    {
        $response = $this->putJson(
            action([BlogController::class, 'update'], 'abc'),
        )->assertStatus(422);
    }

    public function test_blog_by_id_update()
    {
        $blog = Blog::first();
        $response = $this->putJson(
            action([BlogController::class, 'update'], $blog->id),
            $this->inputs
        )->assertStatus(201);
    }

    public function test_blog_update_validation()
    {
        $blog = Blog::first();
        $reqData = ['title' => null, 'author' => null, 'content' => null];
        $response = $this->putJson(
            action([BlogController::class, 'update'], $blog->id),
            $reqData
        )->assertStatus(422);
    }

    public function test_blog_delete_not_found()
    {
        $response = $this->postJson(
            action([BlogController::class, 'destroy'], 'abc')
        )->assertStatus(302)->getOriginalContent();
    }

    public function test_blog_delete()
    {
        $blog = Blog::first();
        $response = $this->postJson(
            action([BlogController::class, 'destroy'], $blog->id)
        )->assertStatus(302);
    }
}