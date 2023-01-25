<?php

namespace App\Http\Livewire\Stock\Adjustment;

use App\Models\Stock\AdjustmentProduct;
use Livewire\Component;

class EditAdjustmentDetail extends Component
{
    public AdjustmentProduct $adjustProd;

    public $product;

    public $type;

    public $qte;

    protected $listeners = ['refreshComponent' => '$refresh'];

    public function render()
    {
        return view('theme.livewire.stock.adjustment.edit-adjustment-detail');
    }

    public function mount()
    {
        $this->product = $this->adjustProd->product;
        $this->type = $this->adjustProd->type;
        $this->qte = $this->adjustProd->qte;
    }

    public function updateDetail()
    {
        $this->adjustProd->update([
            'qte' => $this->qte,
            'type' => $this->type,
        ]);

        return redirect(route('commercial:adjustments'))->with('success', 'modification success');
    }

    public function delete()
    {
        $this->adjustProd->delete();
        $this->emit('refreshComponent');

        return redirect(route('commercial:adjustments'))->with('success', 'modification success');
    }
}
