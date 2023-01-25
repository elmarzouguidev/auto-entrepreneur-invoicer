<?php

namespace App\Http\Livewire\Stock\Adjustment;

use App\Models\Stock\Adjustment;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Adjustments extends Component
{
    public Collection $adjustments;

    public Collection $warehouses;

    public Collection $products;

    public $adjustmentEdit;

    public bool $showEdit = false;

    public $product;

    public $type;

    public $qte;

    public function render()
    {
        return view('theme.livewire.stock.adjustment.adjustments');
    }

    public function edit(Adjustment $adjustment)
    {
        $this->showEdit = true;
        $adjustment->load('adjustmentsProducts');
        $this->adjustmentEdit = $adjustment;
        $this->dispatchBrowserEvent('show-edit');
    }

    public function addProduct(Adjustment $adjustment)
    {
        $data = [
            'product_id' => $this->product,
            'type' => $this->type,
            'qte' => $this->qte,
            'date' => now(),
        ];

        $product = $adjustment->adjustmentsProducts()->create($data);

        $historyMessage = $product->type === 'add' ? "a ajouter une quantité de  {$product->qte}({$product->product?->unite?->name}) pour le produit ({$product->product?->name}) sur l'entrepôt {$adjustment->warehouse?->name}"
            : "a soustraire une quantité de {$product->qte}({$product->product?->unite?->name}) pour le produit ({$product->product?->name}) depuis l'entrepôt {$adjustment->warehouse?->name}";
        $history = [
            'user_id' => auth()->id(),
            'user' => auth()->user()->full_name,
            'detail' => $historyMessage,
            'action' => $product->type,
        ];

        $adjustment->histories()->create($history);

        return redirect(route('commercial:adjustments'))->with('success', 'modification success');
    }
}
