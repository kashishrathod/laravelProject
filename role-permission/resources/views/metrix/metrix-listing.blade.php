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
                    </div>
                    <form action="{{ route('permission.store') }}" method="post">
                    @csrf
                    <div class="card">
                        <table class="table document-table">
                            <thead>
                                <tr>
                                    <th scope="col">sr no.</th>
                                    <th scope="col">Title</th>
                                    @foreach($role as $data)
                                    <div id="test">
                                        <th scope="col">{{ $data->name }}&nbsp;<input id="header_{{$data->id}}" type="checkbox" name="role"></th>
                                    </div>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                            @php $i=1; @endphp
                            @foreach($permission as $data_per)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $data_per->name }}</td>
                                    @foreach($role as $data)
                                        <td class="accordion-toggle">
                                            <input type="checkbox" id="column_{{$data->id}}" value="{{ $data->id }},{{ $data_per->id }}" name="role[]">
                                        </td>
                                    @endforeach
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                        <button type="submit" style="margin-top: 10px;" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection    
</x-app-layout>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
var role = {!! json_encode($role) !!};
var array = $.map(role, function(value, index){
    return [value];
});
$(document).ready(function() {
    $.each(array, function(index, value) {
    $('#header_'+role[index].id).click(function(e) {
        $('.document-table tbody .accordion-toggle #column_'+role[index].id).prop('checked', this.checked);
    });
});
});  
</script>