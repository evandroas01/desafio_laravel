@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                  <div><a type="button" class="btn btn-outline-info btn-sm" href="{{ url('blog') }}">Create Blog</a></div>
                </div>

                <div class="card-body">
                  @if(session()->has('status'))
                    <div class="text-success font-weight-bold py-2">{{ session('status') }}</div>
                  @endif
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($blogs as $blog)
                      <tr>
                        <td>{{ $blog->id }}</td>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->author }}</td>
                        <td class="d-flex">
                          <div class="d-inline"><a type="button" href="{{ url('/blog/edit',$blog->id) }}" class="btn btn-outline-primary btn-sm">Edit</a></div>
                          <div class="d-inline mx-2">
                          <form method="POST" action="/blog/delete/{{$blog->id}}">
                            {{ csrf_field() }}
                            <div class="form-group">
                              <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                            </div>
                          </form>
                          </div>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
