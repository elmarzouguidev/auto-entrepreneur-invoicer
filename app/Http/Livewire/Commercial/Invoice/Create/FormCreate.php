<?php

namespace App\Http\Livewire\Commercial\Invoice\Create;

use App\Models\Catalog\Product;
use App\Models\Finance\Invoice;
use App\Repositories\Client\ClientInterface;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class FormCreate extends Component
{
    public ?Invoice $invoice;

    public $clients;

    public $invoiceCode;

    public $invoicePrefix;

    public Collection $products;

    public $totalPrice;

    public $orderProducts = [];

    public bool $hasProducts;

    public function render()
    {
        return view('theme.livewire.commercial.invoice.create.form-create');
    }

    public function mount()
    {
        $this->orderProducts = [
            [
                'product_id' => '',
                'quantity' => 0,
                'designation' => '',
                'prix_unitaire' => '',
                'remise' => 0,
                'prix_total' => 0,
                'readonly' => '',
            ],
        ];
        $this->totalPrice = 0;

        $this->hasProducts = false;

        $this->products = Product::all();

        $this->clients = app(ClientInterface::class)->getClients(['id', 'entreprise', 'contact']);

        $this->invoiceCode = '0000';

        $this->invoicePrefix = getDocument()->invoice_prefix;
    }

    public function updatedHasProducts()
    {
    }

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function addProduct()
    {
        if (count($this->orderProducts) <= $this->products->count()) {
            $this->orderProducts[] = [
                'product_id' => '',
                'quantity' => 0,
                'designation' => '',
                'prix_unitaire' => '',
                'remise' => 0,
                'prix_total' => 0,
                'readonly' => '',
            ];
        }
    }

    public function updated($property, $value)
    {
        $key = substr($property, strrpos($property, '.') + 1);
        $array = explode('.', $property);

        if ($key === 'quantity' && ! is_null($value) && is_numeric($value)) {
            $prod = $this->products->firstWhere('id', $this->orderProducts[$array[1]]['product_id']);

            $this->orderProducts[$array[1]]['prix_unitaire'] = $prod->price_sell;
            $this->orderProducts[$array[1]]['prix_total'] = number_format($this->orderProducts[$array[1]]['prix_unitaire'] * (int) $value, 2);
            //$this->orderProducts[$array[1]]['prix_total'] = $prod->price_sell * (int)$value;
        }
    }

    public function removeProduct($index)
    {
        unset($this->orderProducts[$index]);
        $this->orderProducts = array_values($this->orderProducts);
    }
}
