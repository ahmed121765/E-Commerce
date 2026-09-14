<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $vat = Setting::where('key', 'vat')->first();

        return view('admin.settings.index', compact('vat'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'vat' => 'required|numeric|min:0|max:100',
        ]);

        Setting::updateOrCreate(
            ['key' => 'vat'],
            ['value' => $request->vat]
        );

        return back()->with('success', 'VAT updated successfully');
    }
}
