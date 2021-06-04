<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            All Product

        </h2>
    </x-slot>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">Add Product</div>
                <div class="card-body">
                    <form action="{{ route('storeproduct') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Name</label>
                            <input type="text" name="Product_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <textarea name="description" id="" cols="80" rows="3" class="form-control"></textarea>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Rating</label>
                                    <select name="rating" class="form-control">
                                        <option value="" selected disabled>select rating</option>
                                        <option value="5">5</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Price</label>
                                    <input type="text" name="price" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                        <label>Available</label><br>
                        <input type="radio" name="available" value="1"> Yes
                        <input type="radio" name="available" value="0"> No
                        </div>

                        <button type="submit" class="btn btn-primary">Add Product</button>
                        <a href="{{ url()->previous() }}" class="btn btn-primary btn-close">Cancle</a>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>