@extends('frontend.layouts.master')

@section('title')
Check Out
@endsection

@section('css')

@endsection

@section('title_page1')

@endsection

@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="shop-checkout container">
            <h2 class="page-title">Shipping and Checkout</h2>
            <div class="checkout-steps">
                <a href="{{ route('cart.index') }}" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
                        <span>Shopping Bag</span>
                        <em>Manage Your Items List</em>
                    </span>
                </a>
                <a href="{{ route('checkout.index') }}" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">02</span>
                    <span class="checkout-steps__item-title">
                        <span>Shipping and Checkout</span>
                        <em>Checkout Your Items List</em>
                    </span>
                </a>
                <div class="checkout-steps__item">
                    <span class="checkout-steps__item-number">03</span>
                    <span class="checkout-steps__item-title">
                        <span>Confirmation</span>
                        <em>Review And Submit Your Order</em>
                    </span>
                </div>
            </div>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form name="checkout-form" method="post" action="{{ route('checkout.store') }}">
                @csrf
                <div class="checkout-form">
                    <div class="billing-info__wrapper">
                        <div class="row">
                            <div class="col-6">
                                <h4>SHIPPING DETAILS</h4>
                            </div>
                            <div class="col-6">
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="name" required
                                    value="{{ old('name', auth()->user()->name ?? '') }}">
                                    <label for="name">Full Name *</label>
                                    @error('name')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="phone" required="" value="{{ old('phone') }}">
                                    <label for="phone">Phone Number *</label>
                                    @error('phone')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="zip" required="" value="{{ old('zip') }}">
                                    <label for="zip">Pincode *</label>
                                    @error('zip')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mt-3 mb-3">
                                    <input type="text" class="form-control" name="state" required="" value="{{ old('state') }}">
                                    <label for="state">State *</label>
                                    @error('state')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="city" required="" value="{{ old('city') }}">
                                    <label for="city">Town / City *</label>
                                    @error('city')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="address" required="" value="{{ old('address') }}">
                                    <label for="address">House no, Building Name *</label>
                                    @error('address')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="locality" required="" value="{{ old('locality') }}">
                                    <label for="locality">Road Name, Area, Colony *</label>
                                    @error('locality')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="landmark" value="{{ old('landmark') }}">
                                    <label for="landmark">Landmark *</label>
                                    @error('landmark')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="checkout__totals-wrapper">
                        <div class="sticky-content">
                            <div class="checkout__totals">
                                <h3>Your Order</h3>
                                <table class="checkout-cart-items">
                                    <thead>
                                        <tr>
                                            <th>PRODUCT</th>
                                            <th align="right">SUBTOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($checkItems as $check)
                                            <tr>
                                                <td>
                                                    {{$check->name}} x {{ $check->quantity }}
                                                </td>
                                                <td align="right">
                                                    ${{ number_format($check->price * $check->quantity, 2) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <table class="checkout-totals">
                                    <tbody>
                                        <tr>
                                            <th>SUBTOTAL</th>
                                            <td align="right">
                                                ${{ number_format($subtotal, 2) }}
                                            </td>
                                        </tr>
                                        {{-- Discount --}}
                                        @if($coupon && $discount > 0)

                                            <tr>
                                                <th>
                                                    Discount ({{ $coupon['code'] }})
                                                </th>

                                                <td>
                                                    -${{ number_format($discount, 2) }}
                                                </td>
                                            </tr>

                                            {{-- Subtotal After Discount --}}
                                            <tr>
                                                <th>
                                                    Subtotal After Discount
                                                </th>

                                                <td>
                                                    ${{ number_format($subtotalAfterDiscount, 2) }}
                                                </td>
                                            </tr>

                                        @endif
                                        <tr>
                                            <th>SHIPPING</th>
                                            <td align="right">Free shipping</td>
                                        </tr>
                                        <tr>
                                            <th>VAT ({{ $vatRate }}%)</th>
                                            <td align="right">${{ number_format($vat, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>TOTAL</th>
                                            <td align="right">${{ number_format($total, 2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="checkout__payment-methods">
                            {{-- COD --}}
                            <div class="form-check">
                                <input
                                    class="form-check-input form-check-input_fill"
                                    type="radio"
                                    name="checkout_payment_method"
                                    id="checkout_payment_method_1"
                                    value="cod"
                                    {{ old('checkout_payment_method', 'cod') === 'cod' ? 'checked' : '' }}
                                >
                                <label
                                    class="form-check-label"
                                    for="checkout_payment_method_1"
                                >
                                    Cash on delivery
                                </label>
                            </div>
                            {{-- Card --}}
                            <div class="form-check">
                                <input
                                    class="form-check-input form-check-input_fill"
                                    type="radio"
                                    name="checkout_payment_method"
                                    id="checkout_payment_method_2"
                                    value="card"
                                    {{ old('checkout_payment_method') === 'card' ? 'checked' : '' }}
                                >
                                <label
                                    class="form-check-label"
                                    for="checkout_payment_method_2"
                                >
                                    Credit / Debit Card
                                </label>
                            </div>
                            {{-- Paypal --}}
                            <div class="form-check">
                                <input
                                    class="form-check-input form-check-input_fill"
                                    type="radio"
                                    name="checkout_payment_method"
                                    id="checkout_payment_method_3"
                                    value="paypal"
                                    {{ old('checkout_payment_method') === 'paypal' ? 'checked' : '' }}
                                >
                                <label
                                    class="form-check-label"
                                    for="checkout_payment_method_3"
                                >
                                    Paypal
                                </label>
                            </div>
                            <div class="policy-text">
                                Your personal data will be used to
                                process your order and support your
                                experience throughout this website.
                            </div>
                        </div>
                            <button type="submit" class="btn btn-primary btn-checkout">PLACE ORDER</button>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
@endsection

@section('scripts')

@endsection