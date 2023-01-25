<?php

namespace App\Http\Livewire\Commercial\Estimate\Create;

use App\Repositories\Client\ClientInterface;
use Livewire\Component;

class Info extends Component
{
    protected $listeners = [
        //'selectedClientItem',
        'selectedCompanyItem',
    ];

    public $clients;

    public $estimateCode;

    public $estimatePrefix;

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function render()
    {
        return view('theme.livewire.commercial.estimate.create.info');
    }

    public function mount()
    {
        $this->clients = app(ClientInterface::class)->getClients(['id', 'entreprise', 'contact']);

        $this->estimateCode = '00000';

        $this->estimatePrefix = 'DEVIS-';
    }
}
