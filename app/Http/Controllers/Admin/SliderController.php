<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\slider;
use App\Traits\FileHandler;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    use FileHandler;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = slider::orderBy('id', 'DESC')->paginate(10);

        return view('admin.Slider.slider', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.Slider.addSlider');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'tagline' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'link' => 'nullable|url|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $sliders = new slider;

        $sliders->create(
            [
                'title' => $request->title,
                'tagline' => $request->tagline,
                'subtitle' => $request->subtitle,
                'status' => $request->status,
                'link' => $request->link,
                'image' => $this->uploadFile($request, 'image', null, 'Sliders'),
            ]
        );

        return redirect()
            ->route('sliders.index')
            ->with('success', 'Slider created successfully!');
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
        $sliders = slider::findOrFail($id);

        return view('admin.Slider.editSlider', compact('sliders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'tagline' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'status' => 'required|in:active,inactive',
            'link' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $sliders = slider::findOrFail($id);
        $oldImage = $sliders->image;

        $sliders->update(
            [
                'title' => $request->title,
                'tagline' => $request->tagline,
                'subtitle' => $request->subtitle,
                'status' => $request->status,
                'link' => $request->link,
                'image' => $this->uploadFile($request, 'image', $oldImage, 'Sliders'),
            ]
        );

        return redirect()
            ->route('sliders.index')
            ->with('success', 'Slider updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sliders = slider::findOrFail($id);

        $this->deleteFile($sliders->image, 'Sliders');

        $sliders->delete();

        return redirect()
            ->route('sliders.index')
            ->with('success', 'Slider deleted successfully!');
    }
}
