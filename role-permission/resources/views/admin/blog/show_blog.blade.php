<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            All Blog

        </h2>
    </x-slot>
    @section('content')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">All Blog
                        @if(Auth::user())
                        <a href="{{ route('newblog') }}" id="add" class="btn btn-info" style="margin-left: 850px;">Add Blog</a>
                        @endif
                    </div>
                    <div class="card">
                        @if(session('success'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                        </div>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Blog Image</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Tag</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($blog_details as $blog)
                                <tr>
                                    <th scope="row"><img src="{{ asset($blog->blog_img) }}" width="50px" height="50px" alt=""></th>
                                    <td>{{ $blog->title }}</td>
                                    <td>
                                        @if(strlen($blog->description) > 100)
                                        {{ Str::limit($blog->description, 100) }}
                                        @else
                                        {{ $blog->description }}
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($blog->blog))
                                        @foreach($blog->blog as $key => $value)
                                        @if( count( $blog->blog ) != $key + 1 )
                                        {{ $value->tag_name }},
                                        @else
                                        {{ $value->tag_name }}
                                        @endif
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if(Auth::user() && Auth::user()->id == $blog->user_id)
                                        <a href="{{ url('editblog/'.$blog->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('deleteblog/'.$blog->id) }}" class="btn btn-danger" onclick="return confirm('Are you Sure you want to delete?');">Delete</a>
                                        @else
                                        <button class=" mr-2 btn btn-info" disabled>Edit</a>
                                        <button class="btn btn-danger" disabled>Delete</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $blog_details->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
</x-app-layout>
