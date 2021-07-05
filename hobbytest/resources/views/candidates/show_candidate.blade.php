<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            All Candidates

        </h2>
    </x-slot>
@section('content')    
    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">All Candidate
                        @if(Auth::user())
                        <a href="{{ route('newcandidate') }}" id="add" class="btn btn-info" style="margin-left: 850px;">Create Candidate</a>
                        @endif
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
                                    <th scope="col">SR NO</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Hobby</th>
                                    <th scope="col">Language</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php($i = 1) 
                                @foreach($candidate_details as $candidate)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{ $candidate->name. ' '.$candidate->surname }}</td>
                                    <td>
                                        @if(strlen($candidate->description) > 100)
                                        {{ Str::limit($candidate->description, 100) }}
                                        @else
                                        {{ $candidate->description }}
                                        @endif
                                    </td>
                                    <td><a href="{{ route('candidates.edit_candidate#candidate_hobby', $candidate->id) }}" class="btn" style="background-color: rebeccapurple; color: white;">Show Hobby</a></td>
                                    <td>{{ $candidate->language }}</td>
                                    <td>
                                        @if(Auth::user() && Auth::user()->id == $candidate->user_id)
                                        <a href="{{ route('edit.candidate', $candidate->id) }}" class="btn btn-info">Edit</a>
                                        <a href="{{ route('delete.candidate', $candidate->id) }}" class="btn btn-danger" onclick="return confirm('Are you Sure you want to delete?');">Delete</a>
                                        @else
                                        <button class=" mr-2 btn btn-info" disabled>Edit</a>
                                        <button class="btn btn-danger" disabled>Delete</a>
                                        @endif
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