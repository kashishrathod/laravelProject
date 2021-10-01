<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            All Product

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">

                <div class="col-md-12">


                    <div class="card-header">All Product
                        <a href="{{ route('create_product') }}" class="btn btn-info" style="margin-left: 850px;">Add Product</a>
                    </div>

                    <div class="card">
                        <table class="table">
                            @if(session('success'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                            </div>
                            @endif
                            <thead>
                                <tr>
                                    <th scope="col">sr no.</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Rating</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">available</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($all_product_data as $product)
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->rating }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        @if($product->available == 1)
                                        Yes
                                        @else
                                        No
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('edit/product/'.$product->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('delete/product/'.$product->id) }}" class="btn btn-danger">Delete</a>
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
</x-app-layout>