<x-guest-layout>
    <div class="flex justify-between">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $note->title }}
        </h2>
    </div>
    <p class="mt-2">{{ $note->body }}</p>
    <div class="flex items-center justify-end mt-12 gap-2">
        <h3 class="text-sm"><i>Send from <span class="font-bold">{{ $user->name }}</span></i> </h3>
        <livewire:heartreact :note="$note" />
    </div>
</x-guest-layout>