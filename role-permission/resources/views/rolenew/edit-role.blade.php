
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            Role
            
        </h2>
    </x-slot>
@section('content')
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="card-header">Create Role</div>
                    <div class="card">
                    <form action="{{ route('store.role', $role_data->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Role Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $role_data->name }}" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Update Role</button>
                    </form> 
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
@endsection    
</x-app-layout>