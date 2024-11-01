<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ShopItemModal extends Component
{
    public $product;

    protected $listeners = 'loadProduct';

    public function loadProduct($id)
    {
        $this->product = Product::find($id);
    }

    public function render()
    {
        $product = $this->product;

        return view('livewire.shop-item-modal');
    }
}
