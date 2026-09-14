@extends('admin.layouts.master')

@section('title')

@endsection

@section('css')

@endsection

@section('title_page1')

@endsection

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Coupon infomation</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{route('home.admin')}}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="#">
                            <div class="text-tiny">Coupons</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">New Coupon</div>
                    </li>
                </ul>
            </div>
            <div class="wg-box">
                <form class="form-new-product form-style-1" method="POST" action="{{ route('coupons.update', $coupons->id) }}">
                    @csrf
                    @method('PUT')
                    <fieldset class="name">
                        <div class="body-title">Coupon Code <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Coupon Code" name="code" tabindex="0" value="{{ old('code', $coupons->code) }}"
                            aria-required="true" required="">
                            @error('code')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror
                    </fieldset>
                    <fieldset class="category">
                        <div class="body-title">Coupon Type</div>
                        <div class="select flex-grow">
                            <select class="" name="type">
                                <option value="">Select</option>
                                <option value="fixed" @selected(old('type', $coupons->type) == 'fixed')>Fixed</option>
                                <option value="percentage" @selected(old('type', $coupons->type) == 'percentage')>Percent</option>
                            </select>
                            @error('type')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </fieldset>

                    <fieldset class="category">
                        <div class="body-title">Usage Limit</div>


                        <input type="number" name="usage_limit" class="form-control" min="1" value="{{ old('usage_limit', $coupons->usage_limit) }}"
                            placeholder="Example: 100">



                        @error('usage_limit')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </fieldset>

                    <fieldset class="category">
                        <div class="body-title">Status</div>
                        <div class="select flex-grow">
                            <select class="" name="status">
                                <option value="">Select</option>
                                <option value="1" @selected(old('status', $coupons->status) == '1')>Active</option>
                                <option value="0" @selected(old('status', $coupons->status) == '0')>Inactive</option>
                            </select>
                            @error('status')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Value <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Coupon Value" name="value" tabindex="0" value="{{ old('value', $coupons->value) }}"
                            aria-required="true" required="">
                            @error('value')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Cart Value <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Cart Value" name="cart_value" tabindex="0"
                            value="{{ old('cart_value', $coupons->cart_value) }}" aria-required="true" required="">
                            @error('cart_value')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title">Expiry Date <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="date" placeholder="Expiry Date" name="expiry_date" tabindex="0"
                            value="{{ old('expiry_date', $coupons->expiry_date) }}" aria-required="true" required="">
                            @error('expiry_date')
                                <div class="error">
                                    {{ $message }}
                                </div>
                            @enderror
                    </fieldset>



                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection