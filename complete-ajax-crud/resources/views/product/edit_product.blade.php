<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            update Product

        </h2>
    </x-slot>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">Update Product</div>
                <div class="card-body">
                    <form action="{{ url('update/product/'.$products->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Name</label>
                            <input type="text" name="Product_name" value="{{ $products->product_name }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Description</label>
                            <textarea name="description" id="" cols="80" rows="3" class="form-control">{{ $products->description }}</textarea>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Rating</label>
                                    <select name="rating" class="form-control">
                                        
                                        <option {{ $products->rating =='5' ? 'selected' : ''}} value="5">5</option>
                                        <option {{ $products->rating =='4' ? 'selected' : ''}} value="4">4</option>
                                        <option {{ $products->rating =='3' ? 'selected' : ''}} value="3">3</option>
                                        <option {{ $products->rating =='2' ? 'selected' : ''}} value="2">2</option>
                                        <option {{ $products->rating =='1' ? 'selected' : ''}} value="1">1</option>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label for="exampleInputEmail1">Price</label>
                                    <input type="text" name="price" value="{{ $products->price }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                        <label>Available</label><br>
                        <input type="radio" {{ $products->available == '1' ? 'checked' : '' }} name="available" value="1"> Yes
                        <input type="radio" {{ $products->available == '0' ? 'checked' : '' }} name="available" value="0"> No
                        </div>

                        <button type="submit" class="btn btn-primary">Update Product</button>
                        <a href="{{ url()->previous() }}" class="btn btn-primary btn-close">Cancle</a>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>