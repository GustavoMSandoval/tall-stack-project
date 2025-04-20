<?php

use Livewire\Volt\Component;

new class extends Component {
    public $noteTitle;
    public $noteBody;
    public $noteRecipient;
    public $noteSendDate;

    public function submit()
    {
        $validated = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5'],
            'noteBody' => ['required', 'string', 'min:15'],
            'noteRecipient' => ['required', 'email'],
            'noteSendDate' => ['required', 'date'],
        ]);

        Auth::user()
            ->notes()
            ->create([
                'title' => $this->noteTitle,
                'body'  => $this->noteBody,
                'recipient'  => $this->noteRecipient,
                'send_date'  => $this->noteSendDate,
                'is_published' => false
            ]);
        
        return to_route('notes.index');
    }

}; ?>

<div>
   <form wire:submit='submit' class="space-y-4">

    <x-input wire:model='noteTitle' label='Note Title' placeholder="it´s been a great day."/>
    <x-textarea wire:model='noteBody' label='Your Note' placeholder="Write your everything you have inside of you."/>
    <x-input icon="user" wire:model='noteRecipient' label='Recipient' placeholder="yourfriend@email.com"/>
    <x-input icon="calendar" wire:model='noteSendDate' type="date" label='Send Date'/>
    <div class="pt-4">
        <x-button wire:click='submit' right-icon='calendar'>Schedule a note</x-button>
    </div>
   </form>
</div>
