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
@section('content')
        <div class="py-12">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">All Customer
                            <a id="add" class="btn btn-info" style="margin-left: 850px;" data-toggle='modal' data-target='#createuser'>Add Customer</a>
                        </div>
                        <div class="card">
                            <table class="table userTable">
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
                                    @php $i = 1; @endphp
                                    @foreach($user_all_details as $customer)
                                    <tr id="row_{{$customer->id}}">
                                        <th scope="row">{{ $i++ }}</th>
                                        <td><img src="{{ asset($customer->profile_pic) }}" width="50px" height="50px" alt=""></td>
                                        <td></td>
                                        <td>{{ $customer->first_name. " " .$customer->last_name  }}</td>
                                        <td>{{ $customer->hobby }}</td>
                                        <td>{{ $customer->address }}</td>
                                        <td>{{ $customer->education }}</td>
                                        <td>
                                            <a href="" class="btn btn-secondary viewbtn" data-id="{{ $customer->id }}" data-toggle='modal' data-target='#showdetails'>Show Details</a>
                                            <a href="" class="btn btn-info editbtn" data-customer-id="{{ $customer->id }}" data-toggle='modal' data-target='#editdetails'>Edit</a>
                                            <a href="" class="btn btn-danger deleteid" data-delete-id="{{ $customer->id }}" data-toggle='modal' data-target='#deletedetails'>Delete</a>
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
    </x-app-layout>

    <!-- Modal create new user -->
    <form class="newuser" enctype="multipart/form-data">
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
                        <div class="error_msg_show text-danger"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
                                        <span class="text-danger" id="email_danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" name="first_name" class="form-control" id="firstname" aria-describedby="emailHelp">
                                        <span class="text-danger" id="f_name_danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Hobby</label>
                                        <input type="text" name="hobby" class="form-control" id="hobby" aria-describedby="emailHelp">
                                        <span class="text-danger" id="hobby_danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Profile Picture</label>
                                        <input type="file" name="profile" class="form-control" id="profile" aria-describedby="emailHelp">
                                        <span class="text-danger" id="profile_danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Select Role: </label><br>
                                        @foreach($roles as $role)
                                        <div class="form-check">
                                            <input type="radio" name="role" value="{{ $role->id }}" name="{{ $role->name }}">
                                            <label for="role">{{ $role->name }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="password" class="form-control" id="password" aria-describedby="emailHelp">
                                        <span class="text-danger" id="password_danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" name="last_name" class="form-control" id="lastname" aria-describedby="emailHelp">
                                        <span class="text-danger" id="l_name_danger"></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address" class="form-control" id="address" aria-describedby="emailHelp">
                                        <span class="text-danger" id="address_danger"></span>
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
                                        <span class="text-danger" id="education_danger"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" id="submitbtn" class="btn btn-primary">Submit</button>
                                <a type="submit" class="btn btn-secondary createcancle">Cancle</a>
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
                    </div>
                    <div class="modal-footer">
                        <a type="submit" id="" class="btn btn-secondary showcancle">Cancle</a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>

        <!-- edit details -->

        <div class="modal fade" id="editdetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                    <input type="hidden" name="id" id="id">

                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" name="first_name1" class="form-control" id="firstname1" aria-describedby="emailHelp">
                                        @error('first_name1')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Hobby</label>
                                        <input type="text" name="hobby1" class="form-control" id="hobby1" aria-describedby="emailHelp">
                                        @error('hobby1')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Profile Picture</label>
                                        <input type="file" name="profile1" class="form-control" id="profile1" aria-describedby="emailHelp">
                                        @error('profile1')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div id="preview_img"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" name="last_name1" class="form-control" id="lastname1" aria-describedby="emailHelp">
                                        @error('last_name1')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" name="address1" class="form-control" id="address1" aria-describedby="emailHelp">
                                        @error('address1')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Education</label>
                                        <select name="education1" id="education1" class="form-control">
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
                                <button type="submit" id="submitbtn1" class="btn btn-primary">Update</button>
                                <a type="submit" class="btn btn-secondary editcancle">Cancle</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- delete model -->

        <div class="modal fade" id="deletedetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="max-width: 700px!important;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Customer Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="delete" id="deletehidden">
                        <h6>Are you sure you want to delete?</h6>
                        <button type="submit" id="deletebtn" class="btn btn-danger">Delete</button>
                        <a type="submit" class="btn btn-secondary deletecancle">Cancle</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(".newuser").submit(function(e) {
            e.preventDefault();
            let firstname = $("#firstname").val();
            let email = $("#email").val();
            let lastname = $("#lastname").val();
            let hobby = $("#hobby").val();
            let profile = $("#profile").val();
            let education = $("#education").val();
            let address = $("#address").val()
            var form = $(".newuser");
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
                    // role1: role1,
                    // role2: role2,
                    _token: _token
                },
                data: formData,
                cache: false,
                contentType: false,
                processData: false,

                success: function(response) {
                    if (response) {
                        if (response.errors) {
                            $('.error_msg_show').html(response.errors);
                        }
                        var imagePath = "{{asset('')}}";
                        var connector_option_icon_url = imagePath + response.profile_pic;
                        $(".userTable tbody").prepend('<tr><td>' + response.id + '</td><td> <i><img src="' + connector_option_icon_url + '" alt="" width="50" height="50"></i>' + '</td><td>' + response.user_data.email + '</td><td>' + response.first_name + ' ' + response.last_name + '</td><td>' + response.hobby + '</td><td>' + response.address + '</td><td>' + response.education +
                            '</td><td><a href="" class="btn btn-secondary viewbtn" data-id="' + response.id + '" data-toggle="modal" data-target="#showdetails">Show Details</a>' + '' +
                            '<a href="" class="btn btn-info editbtn" data-customer-id="' + response.id + '" data-toggle="modal" data-target="#editdetails">Edit</a>' + '' +
                            '<a href="" class="btn btn-danger deleteid " data-delete-id="' + response.id + '" data-toggle="modal" data-target="#deletedetails">Delete</a></td></tr>');
                        $(".newuser")[0].reset();
                        $("#createuser").modal('hide');
                        // location.reload();
                    }
                    console.log('response', response);
                }
            });
        });

        $('.viewbtn').on('click', function() {
            var id = $(this).data('id');
            // var id = $("#inputhidden").val($(this).data('id'));
            var url = "{{ url('show/user/') }}" + '/' + id;
            let _token = $('meta[name="csrf-token"]').attr('content');
            var form = $(".newuser");
            var formData = new FormData(form[0]);
            console.log('customer', url);

            $.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                data: {
                    id: id,
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
                        console.log(connector_option_icon_url);
                        $("#showdetails .modal-body").html('<i><img src="' + connector_option_icon_url + '" alt="kashish" width="150" height="150" style="margin-left: 260px; margin-bottom: 20px"></i><h5 class="text-center"> Name:' + response.first_name + ' ' + response.last_name + '</h5><h5 class="text-center"> Email:' + response.user_data.email + '</h5><h5 class="text-center"> Education:' + response.education + '</h5><h5 class="text-center"> Hobby:' + response.hobby + '</h5>');
                        console.log('response', response);
                    }
                }
            });
        });

        //edit data

        $(document).on("click", ".editbtn", function(e) {
            e.preventDefault();
            var id = $(this).data('customer-id');
            var url = "{{ url('/get/customer/data/') }}" + '/' + id;
            let _token = $('meta[name="csrf-token"]').attr('content');
            var form = $(".newuser");
            var formData = new FormData(form[0]);
            $.ajax({
                type: "GET",
                url: url,
                dataType: 'json',
                data: {
                    id: id,
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

                        $("#id").val(response.id);
                        //$("#email1").val(response.user_data.email);
                        $("#hobby1").val(response.hobby);
                        $("#lastname1").val(response.last_name);
                        $("#firstname1").val(response.first_name);
                        $("#education1").val(response.education);
                        $("#address1").val(response.address);
                        // $("#password1").val(response.user_data.password);
                        //$("#profile1").val(connector_option_icon_url);
                        $('#preview_img').html("<img src='" + response.profile_pic + "' width='70' height='70'>");
                        console.log('response', response);

                    }

                }

            });
        });

        // update 

        $(document).on("click", "#submitbtn1", function(e) {
            e.preventDefault();
            let id = $("#id").val();
            let firstname = $("#firstname").val();
            let lastname = $("#lastname").val();
            let hobby = $("#hobby").val();
            let profile = $("#profile").val();
            let education = $("#education").val();
            let address = $("#address").val();
            var form = $(".newuser");
            var formData = new FormData(form[0]);
            let _token = $('meta[name="csrf-token"]').attr('content');
            var url = "{{ url('/update/customer/details/') }}" + '/' + id;

            $.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                data: {
                    firstname: firstname,
                    lastname: lastname,
                    hobby: hobby,
                    education: education,
                    address: address,
                    profile: profile,
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

                        $("#id").val(response.id);
                        $("#hobby1").val(response.hobby);
                        $("#lastname1").val(response.last_name);
                        $("#firstname1").val(response.first_name);
                        $("#education1").val(response.education);
                        $("#address1").val(response.address);
                        // $("#password1").val(response.user_data.password);
                        // $("#profile1").val(connector_option_icon_url);

                        //$(".userTable tbody").html('<tr><td>' + ' ' + '</td><td>' + '' + '</td><td>' + '' + '</td><td>' + response.first_name + ' ' + response.last_name + '</td><td>' + response.hobby + '</td><td>' + response.address + '</td><td>' + response.education + '</td></td>');
                        $(".newuser")[0].reset();
                        $("#editdetails").modal('hide');
                        console.log('response', response);
                    }
                }
            });
        });

        $(document).on("click", ".deleteid", function(e) {
            e.preventDefault();
            var id = $(this).data('delete-id');
            var url = "{{ url('/get/delete/data/') }}" + '/' + id;
            let _token = $('meta[name="csrf-token"]').attr('content');
            var form = $(".newuser");
            var formData = new FormData(form[0]);
            $.ajax({
                type: "GET",
                url: url,
                dataType: 'json',
                data: {
                    id: id,
                    _token: _token
                },
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response) {
                        $("#deletehidden").val(response.id);
                        console.log('response', response);
                    }
                }
            });
        });

        //delete 

        $(document).on("click", "#deletebtn", function(e) {
            e.preventDefault();
            let id = $("#deletehidden").val();
            var form = $(".newuser");
            var formData = new FormData(form[0]);
            let _token = $('meta[name="csrf-token"]').attr('content');
            var url = "{{ url('/delete/customer/details/') }}" + '/' + id;

            $.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                data: {
                    _token: _token
                },
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response) {
                        $("#row_" + id).remove();
                        $("#deletedetails").modal('hide');
                        //location.reload();
                        console.log('response', response);
                    }
                }
            });
        });

        // cancle button 

        $('.createcancle').on('click', function() {
            $("#createuser").modal('hide');
        });
        $('.showcancle').on('click', function() {
            $("#showdetails").modal('hide');
        });
        $('.editcancle').on('click', function() {
            $("#editdetails").modal('hide');
        });
        $('.deletecancle').on('click', function() {
            $("#deletedetails").modal('hide');
        });
    </script>
</body>

</html>