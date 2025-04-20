<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {

    

    public function delete($noteId)
    {
        $note = Note::where('id', $noteId)->first();
        $this->authorize('delete', $note);
        if($note != null)
        {
            $note->delete();
        }
        else
        {
            return redirect()->back();
        }
        
    }

    public function with(): array
    {
        return [
            'notes' => Auth::user()
                ->notes()
                ->orderBy('send_date' , 'asc')
                ->get(),
        ];
    }
}; ?>

<div>
    <div class="space-y-2">
        @if ($notes->isEmpty())
            <div class="text-center">
                <p class="text-xl font-bol">No notes yet.</p>
                <p class="text-sm">Let´s create your first note to send!</p>
            </div>
            <x-button right-icon="plus" href="{{ route('notes.create') }}" wire:navigate>Create note</x-button>
        @else
            <x-button right-icon="plus" href="{{ route('notes.create') }}" wire:navigate class="mb-12">Create note</x-button>
            <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-4 mt-12">
                @foreach ($notes as $note)
                <x-card wire:key='{{ $note->id }}'>
                    <div class="class flex justify-between">
                    <div>
                        <a href="{{ route('notes.edit', $note) }}" wire:navigate
                        class="text-xl font-bold hover:underline hover:text-blue-500">
                            {{ $note->title }}
                        </a>
                        <p class="text-sm mt-2">{{ Str::limit($note->body, 30) }}</p>
                    </div>
                    <div class="class text-xs text-gray-500">
                        {{ \Carbon\Carbon::parse($note->send_date)->format('d/m/Y') }}
                    </div>
                </div>
                <div class="flex items-end justify-between mt-4 space-x-1">
                    <p class="text-xs">Recipient: <span class="font-semibold">{{ $note->recipient }}</span></p>
                    <div class="">
                            <x-mini-button rounded flat icon="eye"/>
                            <x-mini-button rounded flat icon="trash" wire:click="delete('{{ $note->id }}')"/>
                        </div>
                    </div>
                </x-card>
                @endforeach
            </div>
        @endif
    </div>
</div>
    