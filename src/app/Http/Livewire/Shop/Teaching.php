<?php

namespace App\Http\Livewire\Shop;

use App\Constants\ProductVideoCategories;
use App\Models\Product;
use Livewire\Component;

class Teaching extends Component
{
    public $activeTab = 'all';
    public $categories = [
        'formation' => 'Обучения',
        'stage' => 'Стажи'
    ];
    public $products;
    public $filteredProducts;
    public $selectedYear = 'all';
    public $uniqueYears;

    public function mount()
    {
        $this->getProducts();
        $this->getYears();
    }

    public function getProducts()
    {
        $this->products = Product::whereIn('category', array_keys($this->categories))->get();
        $this->filteredProducts = $this->products;
    }

    public function getYears()
    {
        $this->uniqueYears = $this->products->pluck('year')->unique()->sort()->values()->toArray();
    }

    public function setSelectedYear($year)
    {
        $this->selectedYear = $year;
        $this->sortByYear();
    }

    public function sortByYear()
    {
        if ($this->selectedYear == 'all') {
            $this->filteredProducts = $this->products;
        } else {
            $this->filteredProducts = collect($this->products)->filter(function ($product) {
                return $product->year == $this->selectedYear;
            });
        }
    }

    public function setActiveTab($category)
    {
        $this->activeTab = $category;
    }

    public function sortByCategory($category)
    {
        if ($category == 'all') {
            $this->filteredProducts = $this->products;
        } else {
            $this->filteredProducts = collect($this->products)->filter(function ($product) use ($category) {
                return $product->category == $category;
            });
        }
    }

    public function tabClickHandler($category)
    {
        $this->sortByCategory($category);
        $this->setActiveTab($category);
    }

    public function render()
    {
        return view('livewire.shop.teaching');
    }
}