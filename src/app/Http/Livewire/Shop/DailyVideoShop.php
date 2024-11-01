<?php

namespace App\Http\Livewire\Shop;

use Livewire\Component;
use App\Models\Product;

class DailyVideoShop extends Component
{
    public $months_video = 1;
    public $months_zoom = 1;

    public $price_video;
    public $price_zoom;

    public $total_video;
    public $total_zoom;

    public function mount()
    {
        $this->price_video = Product::where('code', 'video')->first()->price;
        $this->price_zoom = Product::where('code', 'zoom')->first()->price;

        $this->updateTotal();
    }

    public function incrementVideo()
    {
        $this->months_video++;
        $this->updateTotal();
    }

    public function decrementVideo()
    {
        if ($this->months_video > 1) {
            $this->months_video--;
            $this->updateTotal();
        }
    }

    public function incrementZoom()
    {
        $this->months_zoom++;
        $this->updateTotal();
    }

    public function decrementZoom()
    {
        if ($this->months_zoom > 1) {
            $this->months_zoom--;
            $this->updateTotal();
        }
    }

    public function updateTotal()
    {
        $this->total_video = $this->price_video * $this->months_video;
        $this->total_zoom = $this->price_zoom * $this->months_zoom;
    }

    public function render()
    {
        return view('livewire.shop.daily-video-shop');
    }
}
