<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsRequest;
use App\Http\Requests\UpdaateProductsRequest;
use App\Models\Brand;
use App\Models\Categorie;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Traits\FileHandler;

class ProductsController extends Controller
{
    use FileHandler;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();

        return view('admin.Product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all();
        $brands = Brand::all();
        $sizes = Size::all();
        $colors = Color::all();
        $product = new Product;

        return view('admin.Product.create', compact('brands', 'categories', 'product', 'sizes', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductsRequest $request)
    {
        $product = new Product;
        $data = $request->validated();
        $data['low_stock_threshold'] ??= 5;

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadFile($request, 'image', null, 'Products');
        }

        if ($request->hasFile('images')) {
            $data['images'] = $this->uploadFiles($request, 'images', [], 'Products');
        }

        $product->fill($data);
        $product->save();
        $product->sizes()->sync($request->sizes ?? []);
        $product->colors()->sync($request->colors ?? []);

        return redirect()->route('Products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $categories = Categorie::get();
        $sizes = Size::all();
        $colors = Color::all();
        $brands = Brand::get();

        return view('admin.Product.edit', compact('product', 'categories', 'colors', 'brands', 'sizes', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdaateProductsRequest $request, string $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->validated();
        $data['low_stock_threshold'] ??= $product->low_stock_threshold ?? 5;

        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadFile($request, 'image', $product->image, 'Products');
        }

        if ($request->hasFile('images')) {
            $data['images'] = $this->uploadFiles($request, 'images', $product->images ?? [], 'Products');
        }

        $product->update($data);

        $product->sizes()->sync($request->sizes ?? []);
        $product->colors()->sync($request->colors ?? []);

        return redirect()->route('Products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        // Delete the product image if it exists
        if ($product->image) {
            $this->deleteFile($product->image, 'Products');
        }

        foreach ($product->images ?? [] as $image) {
            $this->deleteFile($image, 'Products');
        }

        $product->delete();

        return redirect()->route('Products.index')->with('success', 'Product deleted successfully.');
    }
}
