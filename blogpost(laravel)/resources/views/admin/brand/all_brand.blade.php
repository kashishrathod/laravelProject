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
                    <div class="card-header">All Brands</div>
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
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Brand Image</th>
                                    <th scope="col">date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($brands as $brand)
                                <tr>
                                    <th scope="row">{{ $brand->firstItem()+$loop->index }}</th>
                                    <td>{{ $brand->brand_name }}</td>
                                    <td>{{ $brand->brand_image }}</td>
                                    <td>{{ Carbon\Carbon::parse($brand->created_at)->diffForHumans() }}</td>
                                    <td>
                                        <a href="" class="btn btn-info">Edit</a>
                                        <a href="" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $brands->links() }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card-header">Add Brand</div>
                    <div class="card-body">
                        <form action="{{ route('storecategory') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail1">Brand Name</label>
                                <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('brand_name')
                                <span class="text-danger">{{ $message }}</span>

                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Brand Image</label>
                                <input type="text" name="brand_image" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                @error('brand_image')
                                <span class="text-danger">{{ $message }}</span>

                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Add Brand</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
</x-app-layout>