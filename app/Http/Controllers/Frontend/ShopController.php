<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Categorie;
use App\Models\Product;
use App\Models\slider;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $sliders = slider::where('status', 'active')->get()->take(3);
        $categories = Categorie::withCount('products')
            ->orderBy('name', 'ASC')
            ->get();

        $brands = Brand::withCount('products')
            ->orderBy('name', 'ASC')
            ->get();

        $query = Product::query();

        $f_categories = $request->query('categories', '');
        $f_brands = $request->query('brands', '');
        $f_price_range = $request->query('price_range', '');
        $search = trim($request->query('query', ''));

        // Filter by brands
        if ($f_brands != '') {
            $brandIds = explode(',', $f_brands);

            $query->whereIn('brand_id', $brandIds);
        }

        // Filter by categories
        if ($f_categories != '') {
            $categoryIds = explode(',', $f_categories);

            $query->whereIn('category_id', $categoryIds);
        }

        // Filter by price
        if ($f_price_range != '') {

            $price = explode(',', $f_price_range);

            $minPrice = $price[0];
            $maxPrice = $price[1];

            $query->whereBetween('sale_price', [$minPrice, $maxPrice]);
        }

        // Sorting
        switch ($request->sort) {

            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;

            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;

            case 'price_low':
                $query->orderBy('sale_price', 'asc');
                break;

            case 'price_high':
                $query->orderBy('sale_price', 'desc');
                break;

            default:
                $query->latest();
                break;
        }

        $products = $query->paginate(12)->withQueryString();

        return view(
            'frontend.Shop.index',
            compact(
                'products',
                'brands',
                'categories',
                'f_categories',
                'f_brands',
                'f_price_range',
                'sliders'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $product_slug)
    {
        $product = Product::where('slug', $product_slug)->firstOrFail();
        $rproducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        if ($rproducts->isEmpty()) {
            $rproducts = Product::latest()
                ->take(4)
                ->get();
        }

        return view('frontend.Shop.details', compact('product', 'rproducts'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
