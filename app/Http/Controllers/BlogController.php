<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\User;

class BlogController extends Controller
{
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showBlogs()
    {
      return view('blog');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      #write your code to display create blog form in blog.blade.php

      $articles = Article::latest()->get();
      return view('articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
          'title' => 'required',
          'author' => 'required',
          'content' => 'required|min:50',
      ]);

      Blog::create($request->all());

      return redirect('/')->with('success', 'Blog created successfully!');
    }

    /**
     * show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $blog = Blog::find($id);
        return view('editblog', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
          $request->validate([
            'title' => 'required',
            'author' => 'required',
            'content' => 'required|min:50',
        ]);

        $blog = Blog::getBlogById($id);
        $blog->update($request->all());

        return redirect('/')->with('success', 'Blog updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::deleteBlog($id);

        return redirect('/')->with('success', 'Blog deleted successfully!');
    }
}