<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::latest()->get();

        return view('admin.Coupons.coupons', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.Coupons.addCoupon');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:coupons,code',
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric|min:0',
            'cart_value' => 'required|numeric|min:0',
            'expiry_date' => 'required|date',
            'status' => 'required|boolean',
            'usage_limit' => 'nullable|integer|min:1',
        ]);
        DB::beginTransaction();

        try {

            $coupons = new Coupon;

            $coupons->code = $request->code;
            $coupons->type = $request->type;
            $coupons->value = $request->value;
            $coupons->cart_value = $request->cart_value;
            $coupons->expiry_date = $request->expiry_date;
            $coupons->usage_limit = $request->usage_limit;
            $coupons->status = $request->status;
            $coupons->save();
            DB::commit();
            toastr()->success('Coupon Added success');

            return redirect()->route('coupons.index');

        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
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
    public function edit($id)
    {
        $coupons = Coupon::findOrFail($id);

        return view('admin.Coupons.updateCoupon', compact('coupons'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:coupons,code,'.$id,
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric|min:0',
            'cart_value' => 'required|numeric|min:0',
            'expiry_date' => 'required|date',
            'status' => 'required|boolean',
            'usage_limit' => 'nullable|integer|min:1',
        ]);
        DB::beginTransaction();

        try {

            $coupons = Coupon::findOrFail($id);

            $coupons->code = $request->code;
            $coupons->type = $request->type;
            $coupons->value = $request->value;
            $coupons->cart_value = $request->cart_value;
            $coupons->expiry_date = $request->expiry_date;
            $coupons->usage_limit = $request->usage_limit;
            $coupons->status = $request->status;
            $coupons->save();
            DB::commit();
            toastr()->success('Coupon Updated success');

            return redirect()->route('coupons.index');

        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        try {
            $coupon = Coupon::findOrFail($id);
            $coupon->delete();

            DB::commit();

            toastr()->success('Coupon Deleted successfully');

            return redirect()->route('coupons.index');

        } catch (Exception $e) {
            DB::rollback();

            return redirect()->back()->withErrors([
                'error' => $e->getMessage(),
            ]);
        }
    }
}
