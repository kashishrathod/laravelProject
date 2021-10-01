<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            User Profile

        </h2>
    </x-slot>
@section('content')
    <div class="py-12">
        <form action="{{ route('add_details') }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">First Name</label>
                            <input type="text" name="first_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hobby</label>
                            <input type="text" name="hobby" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('hobby')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Profile Picture</label>
                            <input type="file" name="profile" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('profile')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Last Name</label>
                            <input type="text" name="last_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Address</label>
                            <input type="text" name="address" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Education</label>
                            <select name="education" class="form-control">
                                <option value="" selected disabled>select Education</option>
                                <option value="Science">Science</option>
                                <option value="Biology">Biology</option>
                                <option value="Maths">Maths</option>
                                <option value="Physics">Physics</option>
                                <option value="chemistry">chemistry</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancle</a>
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>
        </form>
    </div>
@endsection    
</x-app-layout>