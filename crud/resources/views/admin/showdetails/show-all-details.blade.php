<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>

<body>
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
                        <div class="card-header">All Customer
                            <a id="add" class="btn btn-info" style="margin-left: 850px;" data-toggle='modal' data-target='#createuser'>Add Customer</a>
                        </div>

                        <div class="card">
                            <table id="userTable" class="table">
                                @if(session('success'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <strong>{{ session('success') }}</strong>

                                </div>


                                @endif
                                <thead>
                                    <tr>
                                        <th scope="col">sr no.</th>
                                        <th scope="col">Profile picture</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Hobby</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Education</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php($i = 1)
                                    @foreach($user_all_details as $customer)
                                    <tr>
                                        <th scope="row">{{ $i++ }}</th>
                                        <td><img src="{{ asset($customer->profile_pic) }}" width="50px" height="50px" alt=""></td>
                                        <td>{{ $customer->UserData->email }}</td>
                                        <td>{{ $customer->first_name. " " .$customer->last_name  }}</td>
                                        <td>{{ $customer->hobby }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td>{{ $customer->education }}</td>
                                        <td>
                                            <a href="" id="viewbtn" class="btn btn-secondary" data-id="{{ $customer->id }}" data-toggle='modal' data-target='#showdetails'>Show Details</a>
                                            <a href="" class="btn btn-info">Edit</a>
                                            <a href="" class="btn btn-danger">Delete</a>
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

    <!-- Modal create new user -->
    <form id="newuser" enctype="multipart/form-data">
        @csrf
        <div class="modal fade" id="createuser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 700px!important;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Customer Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" name="first_name" class="form-control" id="firstname" aria-describedby="emailHelp">
                                        @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Hobby</label>
                                        <input type="text" name="hobby" class="form-control" id="hobby" aria-describedby="emailHelp">
                                        @error('hobby')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Profile Picture</label>
                                        <input type="file" name="profile" class="form-control" id="profile" aria-describedby="emailHelp">
                                        @error('profile')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" name="password" class="form-control" id="password" aria-describedby="emailHelp">
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" name="last_name" class="form-control" id="lastname" aria-describedby="emailHelp">
                                        @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" class="form-control" id="address" aria-describedby="emailHelp">
                                        @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Education</label>
                                        <select name="education" id="education" class="form-control">
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

                            <div class="modal-footer">
                                <button type="submit" id="submitbtn" class="btn btn-primary">Submit</button>
                                <a type="submit" href="" class="btn btn-secondary">Cancle</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- show details -->
        <div class="modal fade" id="showdetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 700px!important;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Show Customer Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <img src="" alt="" width="40px" height="40px">
                        <!-- <h1>Name:</h1> -->
                        <input type="text" value="">
                        <input type="text" id="inputhiden" name="customerid">

                    </div>

                    <div class="modal-footer">
                        <a type="submit" href="" class="btn btn-secondary">Cancle</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>


    </form>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $("#newuser").submit(function(e) {
            e.preventDefault();
            let firstname = $("#firstname").val();
            let email = $("#email").val();
            let lastname = $("#lastname").val();
            let hobby = $("#hobby").val();
            let profile = $("#profile").val();
            let education = $("#education").val();
            let address = $("#address").val();
            var form = $("#newuser");
            var formData = new FormData(form[0]);
            let _token = $('meta[name="csrf-token"]').attr('content');


            $.ajax({
                type: "POST",
                url: "/add/user",
                dataType: 'json',
                data: {
                    firstname: firstname,
                    email: email,
                    lastname: lastname,
                    hobby: hobby,
                    profile: profile,
                    education: education,
                    address: address,
                    _token: _token
                },
                data: formData,
                cache: false,
                contentType: false,
                processData: false,

                success: function(response) {
                    if (response) {
                        var imagePath = "{{asset('')}}";
                        var connector_option_icon_url = imagePath + response.profile_pic;
                        $("#userTable tbody").prepend('<tr><td>' + ' ' + '</td><td> <i><img src="' + connector_option_icon_url + '" alt=""></i>' + '</td><td>' + response.user_data.email + '</td><td>' + response.first_name + ' ' + response.last_name + '</td><td>' + response.hobby + '</td><td>' + response.address + '</td><td>' + response.education + '</td></tr>');
                        $("#newuser")[0].reset();
                        $("#createuser").modal('hide');
                    }
                    console.log('response', response);

                }

            });
        });

        $(document).ready(function() {
            $('#viewbtn').on('click', function() {
                let _token = $('meta[name="csrf-token"]').attr('content');
                var id = $("#inputhiden").val($(this).data('id'));
                console.log(id);
                
                $.ajax({
                    type: "POST",
                    url: "/show/user/id",
                    dataType: 'json',
                    data: {
                        id: id,
                        _token: _token
                    },
                    success: function(response){
                        if(response){
                           // $("#showdetails").modal('hide');
                        }
                        
                    }
                    
                });
                
            });
        });
    </script>

</body>


</html>