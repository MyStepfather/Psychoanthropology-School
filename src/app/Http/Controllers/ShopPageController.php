<?php

namespace App\Http\Controllers;

use App\Constants\MediaTypes;
use App\Constants\ProductCategories;
use App\Constants\ProductVideoCategories;
use App\Models\Media;
use App\Models\Product;
use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\Course;
use Illuminate\View\View;

class ShopPageController extends Controller
{
    public function showDailyVideoPage()
    {
        return view('shop');
    }

    public function showTeachingPage(Request $request)
    {
        $activeTab = $request->input('category', 'all');

        if ($activeTab === 'all') {
            $products = Product::query()
                ->where('category', 'formation')
                ->orWhere('category', 'stage')
                ->get();
        } elseif ($activeTab === ProductVideoCategories::FORMATION) {
            $products = Product::query()
                ->where('category', 'formation')
                ->get();
        } elseif ($activeTab === ProductVideoCategories::STAGE) {
            $products = Product::query()
                ->where('category', 'stage')
                ->get();
        }

        return view('shop', compact('activeTab', 'products'));
    }

    public function showCollectionsPage()
    {
        $collections = Product::query()
            ->where('category', 'collection')
            ->get();

        return view('shop', compact('collections'));
    }

    public function showBooksPage()
    {
        $books = Product::query()
            ->join('artists', 'products.artist_id', '=', 'artists.id')
            ->select('products.*', 'artists.name as artist_name')
            ->where('products.category', '=', ProductCategories::BOOK)
            ->get();

        return view('shop', compact('books'));
    }

    public function showArchivePage()
    {
        return view('shop');
    }

    public function checkScreenWidth(Request $request)
    {
        $screenWidth = $request->width;
    }

    public function showProductItem($id)
    {
        $product = Product::find($id);
        if (!$product) {
            abort(404);
        }

        return view('partials.shop.item', compact('product'));
    }
    
}
