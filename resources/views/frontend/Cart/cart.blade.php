@extends('frontend.layouts.master')

@section('title')

@endsection

@section('css')

@endsection

@section('title_page1')

@endsection

@section('content')

    <main class="pt-90">
        <div class="mb-4 pb-4"></div>

        <section class="shop-checkout container">
            <h2 class="page-title">
                Cart
            </h2>

            {{-- Checkout Steps --}}
            <div class="checkout-steps">
                <a href="{{ route('cart.index') }}" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">
                        01
                    </span>

                    <span class="checkout-steps__item-title">
                        <span>
                            Shopping Bag
                        </span>

                        <em>
                            Manage Your Items List
                        </em>
                    </span>
                </a>

                <a href="{{ route('checkout.index') }}" class="checkout-steps__item">
                    <span class="checkout-steps__item-number">
                        02
                    </span>

                    <span class="checkout-steps__item-title">
                        <span>
                            Shipping and Checkout
                        </span>

                        <em>
                            Checkout Your Items List
                        </em>
                    </span>
                </a>

                <div class="checkout-steps__item">
                    <span class="checkout-steps__item-number">
                        03
                    </span>

                    <span class="checkout-steps__item-title">
                        <span>
                            Confirmation
                        </span>

                        <em>
                            Review And Submit Your Order
                        </em>
                    </span>
                </div>
            </div>

            {{-- Shopping Cart --}}
            <div class="shopping-cart">

                {{-- Cart Table --}}
                <div class="cart-table__wrapper">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>
                                    Product
                                </th>

                                <th></th>

                                <th>
                                    Price
                                </th>

                                <th>
                                    Quantity
                                </th>

                                <th>
                                    Subtotal
                                </th>

                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($cartItems as $item)
                                <tr>

                                    {{-- Product Image --}}
                                    <td>
                                        <div class="shopping-cart__product-item">
                                            @if ($item->attributes->image)
                                                <img loading="lazy"
                                                    src="{{ asset('uploads/Products/' . $item->attributes->image) }}" width="120"
                                                    height="120" alt="{{ $item->name }}" />
                                            @else
                                                <img loading="lazy" src="{{ asset('assets/images/cart-item-1.jpg') }}" width="120"
                                                    height="120" alt="{{ $item->name }}" />
                                            @endif
                                        </div>
                                    </td>

                                    {{-- Product Details --}}
                                    <td>
                                        <div class="shopping-cart__product-item__detail">
                                            <h4>
                                                {{ $item->name }}
                                            </h4>
                                            @if ($item->attributes->size_name ?? false)

                                                <div class="text-muted mt-1">
                                                    Size: {{ $item->attributes->size_name }}
                                                </div>

                                            @endif

                                            @if ($item->attributes->color_name ?? false)
                                                <div class="text-muted mt-1">
                                                    Color: {{ $item->attributes->color_name }}
                                                </div>
                                            @endif

                                            <ul class="shopping-cart__product-item__options">
                                                @if ($item->attributes->color ?? false)
                                                    <li>
                                                        Color:
                                                        {{ $item->attributes->color }}
                                                    </li>
                                                @endif

                                                @if ($item->attributes->size ?? false)
                                                    <li>
                                                        Size:
                                                        {{ $item->attributes->size }}
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>

                                    {{-- Price --}}
                                    <td>


                                        <span class="shopping-cart__product-price">
                                            ${{ number_format($item->price, 2) }}
                                        </span>
                                    </td>

                                    {{-- Quantity --}}
                                    <td>
                                        <div class="qty-control position-relative">
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1"
                                                class="qty-control__number text-center" data-cart-id="{{ $item->id }}">

                                            <div class="qty-control__reduce">
                                                -
                                            </div>

                                            <div class="qty-control__increase">
                                                +
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Subtotal --}}
                                    <td>
                                        <span class="shopping-cart__subtotal">
                                            ${{ number_format($item->getPriceSum(), 2) }}
                                        </span>
                                    </td>

                                    {{-- Remove --}}
                                    <td>
                                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="remove-cart border-0 bg-transparent p-0">
                                                <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />

                                                    <path
                                                        d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <h4>Your cart is empty.</h4>
                                        <br>

                                        <a href="{{ route('shops.index') }} " class="btn btn-info">
                                            Shop Now
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Cart Footer --}}
                    <div class="cart-table-footer">
                        @if(!session()->has('coupon'))
                            <form action="{{ route('cart.coupon.apply') }}" method="POST" class="position-relative bg-body">
                                @csrf
                                <input class="form-control" type="text" name="coupon_code" placeholder="Coupon Code">
                                <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4" type="submit"
                                    value="APPLY COUPON">
                            </form>
                        @else
                            <form action="{{ route('cart.coupon.remove') }}" method="POST" class="position-relative bg-body">
                                @csrf
                                @method('DELETE')
                                <input class="form-control coupon-code-applied" type="text"
                                    value="{{ session('coupon')['code'] }} Applied!" readonly>
                                <input class="btn-link coupon-remove-button fw-medium position-absolute top-0 end-0 h-100 px-4"
                                    type="submit" value="REMOVE COUPON">
                            </form>
                        @endif
                    </div>
                </div>

                {{-- Cart Totals --}}
                <div class="shopping-cart__totals-wrapper">
                    <div class="sticky-content">
                        <div class="shopping-cart__totals">
                            <h3>
                                Cart Totals
                            </h3>

                            <table class="cart-totals">
                                <tbody>

                                    {{-- Subtotal --}}
                                    <tr>
                                        <th>
                                            Subtotal
                                        </th>

                                        <td>
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

                                    {{-- Shipping --}}
                                    <tr>
                                        <th>
                                            Shipping
                                        </th>

                                        <td>
                                            Free
                                        </td>
                                    </tr>

                                    {{-- VAT --}}
                                    <tr>
                                        <th>
                                            VAT ({{ $vatRate }}%)
                                        </th>

                                        <td>
                                            ${{ number_format($vat, 2) }}
                                        </td>
                                    </tr>

                                    {{-- Total --}}
                                    <tr class="cart-total">
                                        <th>
                                            Total
                                        </th>

                                        <td>
                                            ${{ number_format($total, 2) }}
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                        {{-- Checkout Button --}}
                        <div class="mobile_fixed-btn_wrapper">
                            <div class="button-wrapper container">
                                <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-checkout">
                                    PROCEED TO CHECKOUT
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection

@section('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            /*
            |--------------------------------------------------------------------------
            | Increase / Reduce Quantity
            |--------------------------------------------------------------------------
            */

            document.addEventListener('click', function (e) {

                const increaseButton =
                    e.target.closest('.qty-control__increase');

                const reduceButton =
                    e.target.closest('.qty-control__reduce');

                if (!increaseButton && !reduceButton) {
                    return;
                }

                const control =
                    e.target.closest('.qty-control');

                if (!control) {
                    return;
                }

                const input =
                    control.querySelector('.qty-control__number');

                if (!input) {
                    return;
                }

                /*
                |--------------------------------------------------------------------------
                | مهم:
                | نسيب كود الثيم يشتغل الأول
                |--------------------------------------------------------------------------
                */

                setTimeout(function () {

                    let quantity =
                        parseInt(input.value);

                    if (isNaN(quantity) || quantity < 1) {

                        quantity = 1;

                        input.value = 1;

                    }

                    updateCart(
                        input,
                        quantity
                    );

                }, 200);

            });

            /*
            |--------------------------------------------------------------------------
            | Manual Quantity Change
            |--------------------------------------------------------------------------
            */

            document.addEventListener('change', function (e) {

                if (!e.target.classList.contains('qty-control__number')) {
                    return;
                }

                const input = e.target;

                let quantity =
                    parseInt(input.value);

                if (isNaN(quantity) || quantity < 1) {

                    quantity = 1;

                    input.value = 1;

                }

                updateCart(
                    input,
                    quantity
                );

            });

            /*
            |--------------------------------------------------------------------------
            | Update Cart
            |--------------------------------------------------------------------------
            */

            function updateCart(input, quantity) {

                const cartId =
                    input.dataset.cartId;

                if (!cartId) {

                    console.error(
                        'Cart ID is missing'
                    );

                    return;

                }

                fetch(
                    "{{ url('/cart') }}/" + cartId,
                    {

                        method: "PUT",

                        headers: {

                            "Content-Type":
                                "application/json",

                            "Accept":
                                "application/json",

                            "X-CSRF-TOKEN":
                                "{{ csrf_token() }}"

                        },

                        body: JSON.stringify({

                            quantity: quantity

                        })

                    }
                )

                    .then(function (response) {

                        if (!response.ok) {

                            throw new Error(
                                'Failed to update cart'
                            );

                        }

                        return response.json();

                    })

                    .then(function (data) {

                        console.log(
                            'Cart updated:',
                            data
                        );

                        if (data.success) {

                            /*
                            |--------------------------------------------------------------------------
                            | تحديث الصفحة بعد نجاح الطلب
                            |--------------------------------------------------------------------------
                            */

                            location.reload();

                        }

                    })

                    .catch(function (error) {

                        console.error(
                            'Cart Update Error:',
                            error
                        );

                    });

            }

        });
    </script>

@endsection