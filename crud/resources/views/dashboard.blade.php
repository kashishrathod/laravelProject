<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           
            Hiii... <b>{{ Auth::user()->name }}</b>
            <b style="float: right;">Total users <span class="badge badge-danger">{{ count($users) }}</span></b>

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
        <div class="row">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">sr no.</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">date</th>
    </tr>
  </thead>
  <tbody>
    <tr>
    @php($i = 1)
    @foreach($users as $user)
      <th scope="row">{{ $i++ }}</th>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
    </tr>
    @endforeach
    
  </tbody>
</table>
        
        
        </div>
        </div>
    </div>
</x-app-layout>
