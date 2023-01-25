<?php

namespace App\Http\Livewire\Commercial\Invoice\Create;

use App\Repositories\Client\ClientInterface;
use Livewire\Component;

class Info extends Component
{
    public $clients;

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function render()
    {
        return view('theme.livewire.commercial.invoice.create.info');
    }

    public function mount()
    {
        $this->clients = app(ClientInterface::class)->getClients(['id', 'entreprise', 'contact']);
    }
}
