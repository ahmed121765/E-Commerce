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
            <h2 class="page-title">Wishlist</h2>
            <div class="checkout-steps">
                <a href="{{ route('wishlist.index') }}" class="checkout-steps__item active">
                    <span class="checkout-steps__item-number">01</span>
                    <span class="checkout-steps__item-title">
                        <span>Shopping Bag</span>
                        <em>Manage Your Items List</em>
                    </span>
                </a>
                <a href="{{ route('checkout.index') }}" class="checkout-steps__item">
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
            <div class="shopping-cart">
                <div class="cart-table__wrapper">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th></th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Action</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($wishlists as $wishlist)


                                <tr>
                                    <td>
                                        <div class="shopping-cart__product-item">
                                            @if ($wishlist->image)
                                                <img loading="lazy" src="{{ asset('uploads/Products/' . $wishlist->image) }}"
                                                    width="120" height="120" alt="{{ $wishlist->name }}" />
                                            @else
                                                <img loading="lazy" src="{{ asset('assets/images/cart-item-1.jpg') }}" width="120"
                                                    height="120" alt="{{ $wishlist->name }}" />
                                            @endif
                                        </div>
                                    </td>

                                    <td>
                                        <div class="shopping-cart__product-item__detail">
                                            <h4>{{ $wishlist->name }}</h4>

                                        </div>
                                    </td>
                                    {{-- Price --}}
                                    <td>
                                        <span class="shopping-cart__product-price">
                                            ${{ number_format($wishlist->sale_price, 2) }}
                                        </span>
                                    </td>
                                    <td>
                                        1
                                    </td>

                                    <td>
                                        @if ($wishlist->stock_status == 'outofstock')
                                            <button type="button" class="btn btn-danger" disabled>
                                                Out of Stock
                                            </button>

                                        @else
                                            <form action="{{ route('wishlist.update', $wishlist->id) }}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-info">Add To Cart</button>
                                            </form>
                                        @endif
                                    </td>

                                    {{-- Remove --}}
                                    <td>
                                        <form action="{{ route('wishlist.destroy', $wishlist->id) }}" method="POST">
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
                                        <h4>Your wishlist is empty.</h4>
                                        <br>

                                        <a href="{{ route('shops.index') }} " class="btn btn-info">
                                            Wishlist Now
                                        </a>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                    <form action="{{ route('wishlist.clear') }}" method="post">
                        @csrf
                        @method('DELETE')
                        <div class="cart-table-footer">
                            <button type="submit" class="btn btn-light">CLEAR Wishlist</button>
                        </div>

                    </form>
                </div>

            </div>
        </section>
    </main>
@endsection

@section('scripts')

@endsection