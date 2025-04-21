<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Note;

new #[Layout('layouts.app')] class extends Component {
    public Note $note;

    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;
    public $noteIsPublished;

    public function mount(Note $note) 
    {
        $this->authorize('update', $note);
        $this->fill($note);
        $this->noteTitle = $note->title;
        $this->noteBody = $note->body;
        $this->noteRecipient = $note->recipient;
        $this->noteSendDate = $note->send_date ;
        $this->noteIsPublished = $note->is_published;
    }

    public function saveNote()
    {
        $validated = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5'],
            'noteBody' => ['required', 'string', 'min:15'],
            'noteRecipient' => ['required', 'email'],
            'noteSendDate' => ['required', 'date'],
            'noteIsPublished' => ['boolean']
        ]);

        $this->note->update([
            'title' => $this->noteTitle,
            'body'  => $this->noteBody,
            'recipient'  => $this->noteRecipient,
            'send_date'  => $this->noteSendDate,
            'is_published' => $this->noteIsPublished
        ]);

        $this->dispatch('note-saved');

    }
}; ?>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-96 md:max-w-2xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <form wire:submit='saveNote' class="space-y-4">
            <x-input wire:model='noteTitle' label='Note Title' placeholder="it´s been a great day."/>
            <x-textarea wire:model='noteBody' label='Your Note' placeholder="Write your everything you have inside of you."/>
            <x-input icon="user" wire:model='noteRecipient' label='Recipient' placeholder="yourfriend@email.com"/>
            <x-input icon="calendar" wire:model='noteSendDate' type="date" label='Send Date'/>
            <x-checkbox wire:model='noteIsPublished' label="Note published" />
            <div class="pt-4 flex justify-between items-center gap-2">
                <div>
                    <x-action-message class="text-white bg-green-500 rounded py-2 px-4" on="note-saved"/>
                </div>
                <div>
                    <x-button secondary flat href="{{ route('notes.index') }}">Cancel</x-button>
                    <x-button type="submit" right-icon='pencil'>Save note</x-button>
                </div>
            </div>
            </form>
        </div>
    </div>
