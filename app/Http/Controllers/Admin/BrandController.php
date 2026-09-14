<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Traits\FileHandler;

use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    use FileHandler;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderBy('id', 'DESC')->paginate(10);

        return view('admin.Brand.brands', compact('brands'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Brand.add-Brand');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        DB::beginTransaction();
        try {
            $brand = new Brand;
            $brand->name = $request->name;
            $brand->slug = $request->slug;

            $brand->image = $this->uploadFile($request, 'image', $brand->image ?? null, 'brands');

            $brand->save();
            DB::commit();

            return redirect()->route('brands.index')->with('success', 'Brand created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Failed to create brand. Please try again.')->withInput();
        }
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
        $brand = Brand::findOrFail($id);

        return view('admin.Brand.edit-Brand', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, string $id)
    {
        DB::beginTransaction();
        try {
            $brand = Brand::findOrFail($id);
            $brand->name = $request->name;
            $brand->slug = $request->slug;

            if ($request->hasFile('image')) {
                if ($brand->image) {
                    $this->deleteFile($brand->image, 'brands');
                }

                $brand->image = $this->uploadFile($request, 'image', null, 'brands');
            }

            $brand->save();
            DB::commit();

            return redirect()->route('brands.index')->with('success', 'Brand updated successfully.');

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Failed to update brand. Please try again.')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $brand = Brand::findOrFail($id);

            if ($brand->image) {
                $this->deleteFile($brand->image, 'brands');
            }

            $brand->delete();
            toastr()->success('Brand deleted successfully.');

            return redirect()->route('brands.index');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete brand. Please try again.');
        }
    }
}
