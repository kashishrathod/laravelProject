<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            Permission
            
        </h2>
    </x-slot>
@section('content')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">permission
                        <a href="{{ route('create.permission') }}" class="btn btn-info" style="margin-left: 850px;">Add Permission</a>
                    </div>
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
                                    <th scope="col">Permission Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($permission_data as $data)
                                <tr>
                                    <th scope="row">1</th>
                                    <td>{{ $data->name }}</td>
                                    <td>
                                        <a href="{{ url('edit/permission/'.$data->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ url('delete/permission/'.$data->id) }}" onclick="return alert('are you sure you want to delete?')" class="btn btn-danger">Delete</a>
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