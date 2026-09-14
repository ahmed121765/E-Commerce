<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        $sliders = slider::where('status', 'active')->get()->take(3);
        $categories = Categorie::orderBy('name')->get();
        $products = Product::whereNotNull('sale_price')->where('sale_price', '!=', '')->inRandomOrder()->get()->take(8);
        $fproducts = Product::where('featured', 1)->get()->take(8);

        return view('frontend.home', compact('sliders', 'categories', 'products', 'fproducts'));

    }

    public function myAccount()
    {

        return view('frontend.My Account.my-accout');

    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $results = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('slug', 'LIKE', "%{$query}%")
            ->take(8)
            ->get();

        return response()->json($results);
    }
}
