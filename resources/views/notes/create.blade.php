<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-96 md:max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <x-button outline secondary icon="arrow-left" class="mb-12" href="{{ route('notes.index') }}">All notes</x-button>
            <livewire:notes.create-note/>                
        </div>
    </div>
</x-app-layout>
