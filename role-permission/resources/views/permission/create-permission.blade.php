
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
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="card-header">Create Permission</div>
                    <div class="card">
                    <form action="{{ isset($permission_data) ? route('store.permission', $permission_data->id) : route('store.permission') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Permission Name</label>
                            <input type="text" name="name" class="form-control" value="{{ isset($permission_data) ? $permission_data->name : '' }}" id="exampleInputEmail1" aria-describedby="emailHelp">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Permission Route</label>
                            <input type="text" name="route" class="form-control" value="{{ isset($permission_data) ? $permission_data->route : '' }}" id="route" aria-describedby="emailHelp">
                            @error('route')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        @if(isset($permission_data))
                        <button type="submit" class="btn btn-primary">Update Permission</button>
                        @else
                        <button type="submit" class="btn btn-primary">Add Permission</button>
                        @endif
                    </form> 
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
@endsection    
</x-app-layout>