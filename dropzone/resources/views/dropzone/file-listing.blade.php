<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
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
                            <th scope="col">file</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_data as $data)
                        <tr>
                            <th scope="row">1</th>
                            <td>{{ $data->file_url }}</td>
                            <td>
                                <a href="{{ url('edit/'.$data->id) }}" class="btn btn-info">Edit</a>
                                <a href="{{ url('delete/'.$data->id) }}" onclick="return alert('are you sure you want to delete?')" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>      
   