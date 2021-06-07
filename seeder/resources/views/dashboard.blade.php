<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hiii... <b>{{ Auth::user()->name }}</b>
            @if(session('status'))
                <strong>{{ session('status') }}</strong>
            @endif
        </h2>
    </x-slot>
</x-app-layout>