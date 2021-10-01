<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hiii... <b>{{ Auth::user()->name }}</b>
            @if(Auth::user()->role_id == '1')
                <strong>You logged in as super admin!</strong>
            @endif
            @if(Auth::user()->role_id == '2')
            <strong>You logged in as admin!</strong>
            @endif
            @if(Auth::user()->role_id == '3')
            <strong>You logged in as user!</strong>
            @endif
        </h2>
    </x-slot>
</x-app-layout>