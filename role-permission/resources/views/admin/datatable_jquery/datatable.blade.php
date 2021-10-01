@extends('layouts.app')

@section('content')

<div class="py-12">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">All Users
                    <a id="add" class="btn btn-info" style="margin-left: 850px;" data-toggle='modal' data-target='#createuser'>Add User</a>
                </div>
                <div class="card">
                    @if(session('success'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>{{ session('success') }}</strong>
                    </div>
                    @endif
                    <table id="myTable" class="table userTable">
                        <thead>
                            <tr>
                                <th scope="col">sr no.</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal create new user -->
<form class="newuser">
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
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input type="text" name="username" class="form-control" id="username" aria-describedby="emailHelp">
                                    <span class="text-danger" id="f_name_danger"></span>
                                    <h6 id="usernamecheck" class="text-danger">
                                        Username is required!
                                    </h6>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="useremail" class="form-control" id="useremail" aria-describedby="emailHelp">
                                    <span class="text-danger" id="email_danger"></span>
                                    <h6 id="emailcheck" class="text-danger">
                                        Your email is not valid!
                                    </h6>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="userpassword" class="form-control" id="userpassword" aria-describedby="emailHelp">
                                    <span class="text-danger" id="password_danger"></span>
                                    <h6 id="passwordcheck" class="text-danger">
                                        Password is required!
                                    </h6>
                                </div>
                                <div class="form-group">
                                    <label>Select Role: </label><br>
                                    @foreach($roles as $role)
                                    <div class="form-check">
                                        <input type="radio" name="userrole" value="{{ $role->id }}" name="{{ $role->name }}">
                                        <label for="role">{{ $role->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="" class="btn btn-primary userbtn">Submit</button>
                            <a type="submit" class="btn btn-secondary createcancle">Cancle</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- edit user modal -->
    <div class="modal fade" id="editdetails" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 700px!important;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit User Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="error_msg_show text-danger"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="id" id="id">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="username1" class="form-control" id="username1" aria-describedby="emailHelp">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="useremail1" class="form-control" id="useremail1" aria-describedby="emailHelp" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Select Role: </label><br>
                                    @foreach($roles as $role)
                                    <div class="form-check">
                                        <input type="radio" name="userrole1" id="userrole1" value="{{ $role->id }}" name="{{ $role->name }}">
                                        <label for="role">{{ $role->name }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary update">Update</button>
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
                    <button type="submit" class="btn btn-danger deletebtn">Delete</button>
                    <a type="submit" class="btn btn-secondary deletecancle">Cancle</a>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {
        // show data-table
        $('#myTable').DataTable({
            ajax: {
                "url": '{{route("showdatatable")}}',
                "type": "GET",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                },
                processData: false,
                contentType: false,
            },
            columns: [
                {data: 'id'},
                {data: 'first_name'},
                {data: 'email'},
                {data: 'created_at'},
                {data: 'action'},
            ],
            scrollY: 200,
            scroller: {
                loadingIndicator: true
            },
        });

        // add new user
        $(document).on("click", ".userbtn", function(e) {
            e.preventDefault();
            Username();
            Password();
            Email();
            if (unameError && passError && emailError) {
                return true;
            } else {
                let username = $("#username").val();
                let useremail = $("#useremail").val();
                let _token = $('meta[name="csrf-token"]').attr('content');
                var form = $(".newuser");
                var formData = new FormData(form[0]);
                $.ajax({
                    type: "POST",
                    url: "/create/newuser",
                    dataType: 'json',
                    data: {
                        username: username,
                        useremail: useremail,
                        _token: _token,
                    },
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response) {
                            $(".userTable tbody").prepend('<tr><td>' + response.id + '</td><td>' + response.name + '</td><td>' + response.email + '</td><td>' + response.created_at + '</td><td> <a href="" class="btn btn-info">Edit</a><a href="" class="btn btn-danger">Delete</a>' + '</td></tr>');
                            $(".newuser")[0].reset();
                            $("#createuser").modal('hide');
                        }
                        console.log('response', response);
                    }
                });
            }
        });

        // get id for update userdetails
        $(document).on("click", ".dataedit", function(e) {
            e.preventDefault();
            var id = $(this).data('user-id');
            var url = "{{ url('/data/edit/') }}" + '/' + id;
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
                        $("#id").val(response.id);
                        $("#username1").val(response.name);
                        $("#useremail1").val(response.email);
                        console.log('response', response);
                    }
                }
            });
        });

        //update user details
        $(document).on("click", ".update", function(e) {
            e.preventDefault();
            let id = $("#id").val();
            let username1 = $("#username1").val();
            var form = $(".newuser");
            var formData = new FormData(form[0]);
            let _token = $('meta[name="csrf-token"]').attr('content');
            var url = "{{ url('/update/user/') }}" + '/' + id;

            $.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                data: {
                    username1: username1,
                    _token: _token
                },
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response) {
                        $("#id").val(response.id);
                        $("#username1").val(response.name);
                        $(".newuser")[0].reset();
                        $("#editdetails").modal('hide');
                        console.log('response', response);
                    }
                }
            });
        });

        // get delete id
        $(document).on("click", ".datadelete", function(e) {
            e.preventDefault();
            var id = $(this).data('delete-id');
            var url = "{{ url('/delete/user/data/') }}" + '/' + id;
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

        // delete user
        $(document).on("click", ".deletebtn", function(e) {
            e.preventDefault();
            let id = $("#deletehidden").val();
            var form = $(".newuser");
            var formData = new FormData(form[0]);
            let _token = $('meta[name="csrf-token"]').attr('content');
            var url = "{{ url('/delete/user/details/') }}" + '/' + id;

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
                        $("#deletedetails").modal('hide');
                        console.log('response', response);
                    }
                }
            });
        });
        
        // cancle button 
        $('.createcancle').on('click', function() {
            $("#createuser").modal('hide');
        });
        $('.editcancle').on('click', function() {
            $("#editdetails").modal('hide');
        });
        $('.deletecancle').on('click', function() {
            $("#deletedetails").modal('hide');
        });

        // validation
        $('#usernamecheck').hide();
        let unameError = true;
        $('#username').focus(function() {
            Username();
        });

        // username validation
        function Username() {
            let usernameValue = $('#username').val();
            if (usernameValue.length == '') {
                $('#usernamecheck').show();
                unameError = false;
                return false;
            } else if (!usernameValue.trim('')) {
                $('#usernamecheck').show();
                $('#usernamecheck').html('Username not allowes space!');
                unameError = false;
                return false;
            } else {
                $('#usernamecheck').hide();
            }
        }

        // password validation
        $('#passwordcheck').hide();
        let passError = true;
        $('#userpassword').focus(function() {
            Password();
        });

        function Password() {
            let passValue = $('#userpassword').val();
            if (passValue.length == '') {
                $('#passwordcheck').show();
                passError = false;
                return false;
            }
            if ((passValue.length < 3) ||
                (passValue.length > 10)) {
                $('#passwordcheck').show();
                $('#passwordcheck').html("length of your password must be between 3 and 10");
                passError = false;
                return false;
            } else {
                $('#passwordcheck').hide();
            }
        }

        // email validation
        $('#emailcheck').hide();
        let emailError = true;
        $('#useremail').focus(function() {
            Email();
        });

        function Email() {
            let regex = /^([\-\.0-9a-zA-Z]+)@([\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
            let emailValue = $('#useremail').val();
            if (!regex.test(emailValue)) {
                $('#emailcheck').show();
                emailError = false;
                return false;
            } else {
                $('#emailcheck').hide();
            }
        }
    });
</script>
@endsection