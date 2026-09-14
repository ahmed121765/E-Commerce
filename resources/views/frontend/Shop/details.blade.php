@extends('frontend.layouts.master')

@section('title')
    @php
use Wearepixel\Cart\Facades\CartFacade as Cart;
    @endphp
@endsection

@section('css')
        <style>
            .add-to-wishlist-remove {
                color: red;

            }

            .add-to-wishlist {
                background: none;
                border: 0;
                padding: 0;
            }

            .add-to-wishlist.active {
                color: red;
            }
            .text-danger {
                color: #000000 !important;
            }
        </style>
@endsection

@section('title_page1')

@endsection

@section('content')
                    <main class="pt-90">
                        <div class="mb-md-1 pb-md-3"></div>
                        <section class="product-single container">
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="product-single__media" data-media-type="vertical-thumbnail">
                                        <div class="product-single__image">
                                            <div class="swiper-container">
                                                <div class="swiper-wrapper">

                                                    @if ($product->image)
                                                        <div class="swiper-slide product-single__image-item">
                                                            <img loading="lazy" class="h-auto"
                                                                src="{{ asset('uploads/Products/' . $product->image) }}" width="674"
                                                                height="674" alt="{{ $product->name }}" />
                                                        </div>
                                                    @endif

                                                    @foreach ($product->images ?? [] as $gimg)
                                                        <div class="swiper-slide product-single__image-item">
                                                            <img loading="lazy" class="h-auto" src="{{ asset('uploads/Products/' . $gimg) }}"
                                                                width="674" height="674" alt="{{ $product->name }}" />
                                                            <a data-fancybox="gallery" href="../images/products/product_0.html"
                                                                data-bs-toggle="tooltip" data-bs-placement="left" title="Zoom">
                                                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <use href="#icon_zoom" />
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    @endforeach


                                                </div>
                                                <div class="swiper-button-prev"><svg width="7" height="11" viewBox="0 0 7 11"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_prev_sm" />
                                                    </svg></div>
                                                <div class="swiper-button-next"><svg width="7" height="11" viewBox="0 0 7 11"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_next_sm" />
                                                    </svg></div>
                                            </div>
                                        </div>
                                        <div class="product-single__thumbnail">
                                            <div class="swiper-container">
                                                <div class="swiper-wrapper">
                                                    @if ($product->image)
                                                        <div class="swiper-slide product-single__image-item">
                                                            <img loading="lazy" class="h-auto"
                                                                src="{{ asset('uploads/Products/' . $product->image) }}" width="104"
                                                                height="104" alt="{{ $product->name }}" />
                                                        </div>
                                                    @endif

                                                    @foreach ($product->images ?? [] as $gimg)
                                                        <div class="swiper-slide product-single__image-item">
                                                            <img loading="lazy" class="h-auto" src="{{ asset('uploads/Products/' . $gimg) }}"
                                                                width="104" height="104" alt="{{ $product->name }}" />
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="d-flex justify-content-between mb-4 pb-md-2">
                                        <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                                            <a href="{{ route('home.user') }}"
                                                class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
                                            <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                                            <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">The Shop</a>
                                        </div><!-- /.breadcrumb -->

                                        <div
                                            class="product-single__prev-next d-flex align-items-center justify-content-between justify-content-md-end flex-grow-1">
                                            <a href="#" class="text-uppercase fw-medium"><svg width="10" height="10" viewBox="0 0 25 25"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <use href="#icon_prev_md" />
                                                </svg><span class="menu-link menu-link_us-s">Prev</span></a>
                                            <a href="#" class="text-uppercase fw-medium"><span
                                                    class="menu-link menu-link_us-s">Next</span><svg width="10" height="10"
                                                    viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                                                    <use href="#icon_next_md" />
                                                </svg></a>
                                        </div><!-- /.shop-acs -->
                                    </div>
                                    <h1 class="product-single__name">{{ $product->name }}</h1>
                                    <div class="product-single__rating">
                                        <div class="reviews-group d-flex">
                                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                            <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_star" />
                                            </svg>
                                        </div>
                                        <span class="reviews-note text-lowercase text-secondary ms-1">8k+ reviews</span>
                                    </div>
                                    <div class="product-single__price">
                                        <span class="current-price">@if($product->sale_price)
                                            <s>${{ $product->regular_price }}</s>${{ $product->sale_price }}
                                        @else
                                                ${{ $product->regular_price }}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="product-single__short-desc">
                                        <p>{{$product->short_description}}</p>
                                    </div>

                                    @if ($product->stock_status == 'outofstock')

                                        <div class="product-single__addtocart">

                                            <button type="button" class="btn btn-danger btn-addtocart" disabled>
                                                Out of Stock
                                            </button>

                                        </div>

                                    @else

                                        <form name="addtocart-form" method="POST" action="{{ route('cart.store') }}" id="add-to-cart-form">
                                            @csrf

                                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                                            {{-- Sizes --}}
                                            @if ($product->sizes->count() > 0)

                                                <div class="product-single__swatches mb-4">

                                                    <label class="form-label fw-medium">
                                                        Size:
                                                    </label>

                                                    <div class="d-flex flex-wrap">

                                                        @foreach ($product->sizes as $size)

                                                            <button type="button" class="swatch-size btn btn-sm btn-outline-light mb-3 me-3 size-option"
                                                                data-size="{{ $size->id }}">

                                                                {{ $size->name }}

                                                            </button>

                                                        @endforeach

                                                    </div>

                                                    {{-- هنا هنخزن ID المقاس المختار --}}
                                                    <input type="hidden" name="size_id" id="selected-size" value="">

                                                    @error('size_id')
                                                        <span class="text-danger">
                                                            {{ $message }}
                                                        </span>
                                                    @enderror

                                                </div>

                                            @endif

                                            {{-- Color --}}
                                            @if ($product->colors->count() > 0)

                                                <div class="product-single__swatches mb-4">

                                                    <label class="form-label fw-medium">
                                                        Color:
                                                    </label>

                                                    <div class="d-flex flex-wrap">

                                                        @foreach ($product->colors as $color)

                                                            <button type="button" class="color-option" data-color="{{ $color->id }}"
                                                                data-color-name="{{ $color->name }}" title="{{ $color->name }}" style="
                                                                                                                    width: 35px;
                                                                                                                    height: 35px;
                                                                                                                    border-radius: 50%;
                                                                                                                    background-color: {{ $color->hex_code }};
                                                                                                                    border: 2px solid #ddd;
                                                                                                                    margin-right: 10px;
                                                                                                                    margin-bottom: 10px;
                                                                                                                    cursor: pointer;
                                                                                                                "></button>

                                                        @endforeach

                                                    </div>

                                                    <input type="hidden" name="color_id" id="selected-color" {{ $product->colors->count() > 0 ? 'required' : '' }}>

                                                    <div id="selected-color-name" class="mt-2"></div>

                                                    @error('color_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </div>

                                            @endif


                                            <div class="product-single__addtocart">

                                                <div class="qty-control position-relative">

                                                    <input type="number" name="quantity" value="1" min="1"
                                                        class="qty-control__number text-center">

                                                    <div class="qty-control__reduce">
                                                        -
                                                    </div>

                                                    <div class="qty-control__increase">
                                                        +
                                                    </div>

                                                </div>

                                                <button type="submit" class="btn btn-primary btn-addtocart" data-aside="cartDrawer">

                                                    Add to Cart

                                                </button>

                                            </div>

                                        </form>
                                    @endif
                                    <div class="product-single__addtolinks">


                                        @php
$wishlistIds = session('wishlist', []);
                                        @endphp
                                        @if(in_array($product->id, $wishlistIds))
                                            <form method="POST" action="{{ route('wishlist.destroy', $product->id) }}">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="menu-link menu-link_us-s add-to-wishlist active"><svg width="16"
                                                        height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_heart" />
                                                    </svg><span>Remove from Wishlist</span>
                                                </button>
                                            </form>
                                        @else
                                            <form method="POST" action="{{ route('wishlist.store') }}">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="menu-link menu-link_us-s add-to-wishlist"><svg width="16"
                                                        height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_heart" />
                                                    </svg><span>Add to Wishlist</span>
                                                </button>
                                            </form>
                                        @endif


                                        <share-button class="share-button">
                                            <button
                                                class="menu-link menu-link_us-s to-share border-0 bg-transparent d-flex align-items-center">
                                                <svg width="16" height="19" viewBox="0 0 16 19" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <use href="#icon_sharing" />
                                                </svg>
                                                <span>Share</span>
                                            </button>
                                            <details id="Details-share-template__main" class="m-1 xl:m-1.5" hidden="">
                                                <summary class="btn-solid m-1 xl:m-1.5 pt-3.5 pb-3 px-5">+</summary>
                                                <div id="Article-share-template__main"
                                                    class="share-button__fallback flex items-center absolute top-full left-0 w-full px-2 py-4 bg-container shadow-theme border-t z-10">
                                                    <div class="field grow mr-4">
                                                        <label class="field__label sr-only" for="url">Link</label>
                                                        <input type="text" class="field__input w-full" id="url"
                                                            value="https://uomo-crystal.myshopify.com/blogs/news/go-to-wellness-tips-for-mental-health"
                                                            placeholder="Link" onclick="this.select();" readonly="">
                                                    </div>
                                                    <button class="share-button__copy no-js-hidden">
                                                        <svg class="icon icon-clipboard inline-block mr-1" width="11" height="13"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                                            focusable="false" viewBox="0 0 11 13">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M2 1a1 1 0 011-1h7a1 1 0 011 1v9a1 1 0 01-1 1V1H2zM1 2a1 1 0 00-1 1v9a1 1 0 001 1h7a1 1 0 001-1V3a1 1 0 00-1-1H1zm0 10V3h7v9H1z"
                                                                fill="currentColor"></path>
                                                        </svg>
                                                        <span class="sr-only">Copy link</span>
                                                    </button>
                                                </div>
                                            </details>
                                        </share-button>
                                        <script src="js/details-disclosure.html" defer="defer"></script>
                                        <script src="js/share.html" defer="defer"></script>
                                    </div>
                                    <div class="product-single__meta-info">
                                        <div class="meta-item">
                                            <label>SKU:</label>
                                            <span>{{ $product->SKU }}</span>
                                        </div>
                                        <div class="meta-item">
                                            <label>Categories:</label>
                                            <span>{{ $product->category->name }}</span>
                                        </div>
                                        <div class="meta-item">
                                            <label>Tags:</label>
                                            <span>NA</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-single__details-tab">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link nav-link_underscore active" id="tab-description-tab" data-bs-toggle="tab"
                                            href="#tab-description" role="tab" aria-controls="tab-description"
                                            aria-selected="true">Description</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link nav-link_underscore" id="tab-additional-info-tab" data-bs-toggle="tab"
                                            href="#tab-additional-info" role="tab" aria-controls="tab-additional-info"
                                            aria-selected="false">Additional Information</a>
                                    </li>
                                    
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="tab-description" role="tabpanel"
                                        aria-labelledby="tab-description-tab">
                                        <div class="product-single__description">
                                            {{ $product->description }}
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <h3 class="block-title">Why choose product?</h3>
                                                    <ul class="list text-list">
                                                        @foreach (explode("\n", $product->why_choose_product ?? '') as $item)
                                                            @if (trim($item))
                                                                <li>{{ $item }}</li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                </div>
                                                <div class="col-lg-6">
                                                    <h3 class="block-title">Sample Number List</h3>
                                                    <ol class="list text-list">
                                                        @foreach (explode("\n", $product->sample_number_list ?? '') as $item)
                                                            @if (trim($item))
                                                                <li>{{ $item }}</li>
                                                            @endif
                                                        @endforeach
                                                    </ol>
                                                </div>
                                            </div>
                                            <h3 class="block-title mb-0">Lining</h3>
                                            <p class="content">{{ $product->lining }}</p>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="tab-additional-info" role="tabpanel"
                                        aria-labelledby="tab-additional-info-tab">
                                        <div class="product-single__addtional-info">
                                            <div class="item">
                                                <label class="h6">Weight</label>
                                                <span>{{ $product->weight }}</span>
                                            </div>
                                            <div class="item">
                                                <label class="h6">Dimensions</label>
                                                <span>{{ $product->dimensions }}</span>
                                            </div>
                                            <div class="item">
                                                <label class="h6">Size</label>

                                                <span>
                                                    @foreach ($product->sizes as $size)
                                                        {{ $size->name }}{{ !$loop->last ? ', ' : '' }}
                                                    @endforeach
                                                </span>
                                            </div>
                                            <div class="item">
                                                <label class="h6">Color</label>
                                                <span>
                                                    @foreach ($product->colors as $color)
                                                        {{ $color->name }}{{ !$loop->last ? ', ' : '' }}
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </section>
                        <section class="products-carousel container">
                            <h2 class="h3 text-uppercase mb-4 pb-xl-2 mb-xl-4">Related <strong>Products</strong></h2>

                            <div id="related_products" class="position-relative">
                                <div class="swiper-container js-swiper-slider" data-settings='{
                                                                        "autoplay": false,
                                                                        "slidesPerView": 4,
                                                                        "slidesPerGroup": 4,
                                                                        "effect": "none",
                                                                        "loop": true,
                                                                        "pagination": {
                                                                            "el": "#related_products .products-pagination",
                                                                            "type": "bullets",
                                                                            "clickable": true
                                                                        },
                                                                        "navigation": {
                                                                            "nextEl": "#related_products .products-carousel__next",
                                                                            "prevEl": "#related_products .products-carousel__prev"
                                                                        },
                                                                        "breakpoints": {
                                                                            "320": {
                                                                            "slidesPerView": 2,
                                                                            "slidesPerGroup": 2,
                                                                            "spaceBetween": 14
                                                                            },
                                                                            "768": {
                                                                            "slidesPerView": 3,
                                                                            "slidesPerGroup": 3,
                                                                            "spaceBetween": 24
                                                                            },
                                                                            "992": {
                                                                            "slidesPerView": 4,
                                                                            "slidesPerGroup": 4,
                                                                            "spaceBetween": 30
                                                                            }
                                                                        }
                                                                        }'>
                                    <div class="swiper-wrapper">

                                        @foreach ($rproducts as $rproduct)

                                            <div class="swiper-slide product-card">

                                                <div class="pc__img-wrapper">

                                                    <a href="{{ route('shops.show', $rproduct->slug) }}">

                                                        {{-- الصورة الأساسية --}}
                                                        <img loading="lazy" src="{{ asset('uploads/Products/' . $rproduct->image) }}"
                                                            width="330" height="400" alt="{{ $rproduct->name }}" class="pc__img">

                                                        {{-- الصورة الثانية --}}
                                                        @foreach ($rproduct->images ?? [] as $gimg)

                                                            <img loading="lazy" src="{{ asset('uploads/Products/' . $gimg) }}" width="330"
                                                                height="400" alt="{{ $rproduct->name }}" class="pc__img pc__img-second">

                                                        @endforeach

                                                    </a>

                                                    @php
    $cartItems = Cart::getContent();
                                                    @endphp

                                                    @if ($rproduct->stock_status == 'outofstock')

                                                        <button type="button"
                                                            class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium btn-danger"
                                                            disabled>
                                                            Out of Stock
                                                        </button>


                                                    @elseif ($cartItems->has($rproduct->id))

                                                        <a href="{{ route('cart.index') }}"
                                                            class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium js-add-cart btn-warning">
                                                            Go to Cart
                                                        </a>

                                                    @else

                                                        <form name="addtocart-form" method="POST" action="{{ route('cart.store') }}">
                                                            @csrf

                                                            <div class="product-single__addtocart">

                                                                <input type="hidden" name="product_id" value="{{ $rproduct->id }}">

                                                                <input type="hidden" name="quantity" value="1">

                                                                <button type="submit"
                                                                    class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium js-add-cart">
                                                                    Add to Cart
                                                                </button>

                                                            </div>

                                                        </form>

                                                    @endif

                                                </div>

                                                <div class="pc__info position-relative">

                                                    <p class="pc__category">
                                                        {{ $rproduct->category->name }}
                                                    </p>

                                                    <h6 class="pc__title">
                                                        <a href="{{ route('shops.show', $rproduct->slug) }}">
                                                            {{ $rproduct->name }}
                                                        </a>
                                                    </h6>

                                                    <div class="product-card__price d-flex">

                                                        <span class="money price">

                                                            @if ($rproduct->sale_price)

                                                                <s>${{ $rproduct->regular_price }}</s>
                                                                ${{ $rproduct->sale_price }}

                                                            @else

                                                                ${{ $rproduct->regular_price }}

                                                            @endif

                                                        </span>

                                                    </div>

                                                    <button
                                                        class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist"
                                                        title="Add To Wishlist">

                                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">

                                                            <use href="#icon_heart" />

                                                        </svg>

                                                    </button>

                                                </div>

                                            </div>

                                        @endforeach

                                    </div><!-- /.swiper-wrapper -->
                                </div><!-- /.swiper-container js-swiper-slider -->

                                <div
                                    class="products-carousel__prev position-absolute top-50 d-flex align-items-center justify-content-center">
                                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_prev_md" />
                                    </svg>
                                </div><!-- /.products-carousel__prev -->
                                <div
                                    class="products-carousel__next position-absolute top-50 d-flex align-items-center justify-content-center">
                                    <svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
                                        <use href="#icon_next_md" />
                                    </svg>
                                </div><!-- /.products-carousel__next -->

                                <div class="products-pagination mt-4 mb-5 d-flex align-items-center justify-content-center"></div>
                                <!-- /.products-pagination -->
                            </div><!-- /.position-relative -->

                        </section><!-- /.products-carousel container -->
                    </main>
@endsection

@section('scripts')

    <script>

        document.querySelectorAll('.size-option').forEach(function (button) {

            button.addEventListener('click', function () {

                // نشيل active من كل المقاسات
                document.querySelectorAll('.size-option').forEach(function (item) {
                    item.classList.remove('active');
                });

                // نحط active على المقاس المختار
                this.classList.add('active');

                // نحفظ ID المقاس
                document.getElementById('selected-size').value = this.dataset.size;

            });

        });

        // Color
        document.querySelectorAll('.color-option').forEach(function (button) {

            button.addEventListener('click', function () {

                document.querySelectorAll('.color-option').forEach(function (item) {
                    item.style.border = '2px solid #ddd';
                });

                this.style.border = '3px solid #000';

                document.getElementById('selected-color').value =
                    this.dataset.color;

                document.getElementById('selected-color-name').innerText =
                    this.dataset.colorName;

            });

        });

        document.getElementById('add-to-cart-form')?.addEventListener('submit', function (event) {
            const hasColors = document.querySelectorAll('.color-option').length > 0;
            const selectedColor = document.getElementById('selected-color')?.value;

            if (hasColors && !selectedColor) {
                event.preventDefault();
                const message = document.getElementById('selected-color-name');
                message.innerText = 'Please select a color.';
                message.classList.add('text-danger');
            }
        });

    </script>

@endsection