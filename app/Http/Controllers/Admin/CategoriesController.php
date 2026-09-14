<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Traits\FileHandler;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use FileHandler;

    public function index()
    {

        $Categories = Categorie::orderBy('id', 'DESC')->paginate(10);

        return view('admin.Categorie.index', compact('Categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Categorie.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $categorie = new Categorie;

        $categorie->name = $request->name;
        $categorie->slug = $request->slug;

        $categorie->image = $this->uploadFile($request, 'image', null, 'Categories');

        $categorie->save();

        return redirect()
            ->route('Categories.index')
            ->with('success', 'Category created successfully.');
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
        $Categorie = Categorie::findOrFail($id);

        return view('admin.Categorie.edit', compact('Categorie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $Categorie = Categorie::findOrFail($id);

        $Categorie->name = $request->name;
        $Categorie->slug = $request->slug;

        $Categorie->image = $this->uploadFile($request, 'image', $Categorie->image ?? null, 'Categories');

        $Categorie->save();

        return redirect()
            ->route('Categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $Categorie = Categorie::findOrFail($id);

            if ($Categorie->image) {
                $this->deleteFile($Categorie->image, 'Categories');
            }

            $Categorie->delete();

            return redirect()->route('Categories.index')->with('success', 'Category deleted successfully.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the category.');
        }
    }
}
