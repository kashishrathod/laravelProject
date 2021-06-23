<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            All Category
            
        </h2>
    </x-slot>
@section('content')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card-header">All Category</div>
                    <div class="card">
                        @if(session('success'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>{{ session('success') }}</strong>
                        </div>
                        @endif
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">sr no.</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">user</th>
                                    <th scope="col">date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($displaycategory as $cat)
                                <tr>
                                    <th scope="row">{{ $displaycategory->firstItem()+$loop->index }}</th>
                                    <td>{{ $cat->category_name }}</td>
                                    <td>{{ $cat->Username->name }}</td>
                                    <td>{{ Carbon\Carbon::parse($cat->created_at)->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ url('categoryedit/'.$cat->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('categorydelete/'.$cat->id) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $displaycategory->links() }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-header">Add Category</div>
                    <div class="card-body">
                        <form action="{{ route('storecategory') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Category Name</label>
                                <input type="text" name="category_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('category_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Add Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- trash -->
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card-header">Trash List</div>
                    <div class="card">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">sr no.</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">user</th>
                                    <th scope="col">date</th>
                                    <th scope="col">Action</th>    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($trash_data as $cat)
                                <tr>
                                    <th scope="row">{{ $displaycategory->firstItem()+$loop->index }}</th>
                                    <td>{{ $cat->category_name }}</td>
                                    <td>{{ $cat->Username->name }}</td>
                                    <td>{{ Carbon\Carbon::parse($cat->created_at)->diffForHumans() }}</td>
                                    <td>
                                        <a href="{{ url('restore/'.$cat->id) }}" class="btn btn-info">Restore</a>
                                        <a href="{{ url('pdelete/'.$cat->id) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $trash_data->links() }}
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>
@endsection    
</x-app-layout>