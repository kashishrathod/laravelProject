<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            User Profile

        </h2>
    </x-slot>

    <div class="py-12">
        <form action="{{ url('user/update/'.$user_details->user_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">First Name</label>
                            <input type="text" name="first_name" value="{{ $user_details->first_name }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('first_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hobby</label>
                            <input type="text" name="hobby" value="{{ $user_details->hobby }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('hobby')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Profile Picture</label>
                            <input type="file" name="profile" value="{{ $user_details->profile_pic }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <img src="{{ asset($user_details->profile_pic) }}" width="50px" height="50px" style="margin-top: 10px;" alt="kashish">
                            @error('profile')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Last Name</label>
                            <input type="text" name="last_name" value="{{ $user_details->last_name }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('last_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Address</label>
                            <input type="text" name="address" value="{{ $user_details->address }}" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Education</label>
                            <select name="education" class="form-control">
                                <option value="" selected disabled>select Education</option>
                                <option {{ $user_details->education =='Science' ? 'selected' : ''}} value="Science">Science</option>
                                <option {{ $user_details->education =='Biology' ? 'selected' : ''}} value="Biology">Biology</option>
                                <option {{ $user_details->education =='Maths' ? 'selected' : ''}} value="Maths">Maths</option>
                                <option {{ $user_details->education =='Physics' ? 'selected' : ''}} value="Physics">Physics</option>
                                <option {{ $user_details->education =='chemistry' ? 'selected' : ''}} value="chemistry">chemistry</option>
                            </select>
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancle</a>
                    </div>
                    <div class="col-md-6"></div>
                </div>
            </div>
        </form>

    </div>
</x-app-layout>