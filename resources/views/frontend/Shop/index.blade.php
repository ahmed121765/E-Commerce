@extends('frontend.layouts.master')

@section('title')
    @php
        use Wearepixel\Cart\Facades\CartFacade as Cart;
    @endphp
@endsection

@section('css')
    <style>
        .category-list .list-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
        }

        .category-list .menu-link {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .category-list .text-right {
            margin-left: auto;
            padding-left: 20px;
            white-space: nowrap;
        }

        .filled-heart {
            color: red;
        }
    </style>
@endsection

@section('title_page1')

@endsection

@section('content')
    <main class="pt-90">
        <section class="shop-main container d-flex pt-4 pt-xl-5">
            <div class="shop-sidebar side-sticky bg-body" id="shopFilter">
                <div class="aside-header d-flex d-lg-none align-items-center">
                    <h3 class="text-uppercase fs-6 mb-0">Filter By</h3>
                    <button class="btn-close-lg js-close-aside btn-close-aside ms-auto"></button>
                </div>

                <div class="pt-4 pt-lg-0"></div>

                <div class="accordion" id="categories-list">
                    <div class="accordion-item mb-4 pb-3">
                        <h5 class="accordion-header" id="accordion-heading-1">
                            <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button"
                                data-bs-toggle="collapse" data-bs-target="#accordion-filter-1" aria-expanded="true"
                                aria-controls="accordion-filter-1">
                                Product Categories
                                <svg class="accordion-button__icon type2" viewBox="0 0 10 6"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                        <path
                                            d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        <div id="accordion-filter-1" class="accordion-collapse collapse show border-0"
                            aria-labelledby="accordion-heading-1" data-bs-parent="#categories-list">
                            <div class="accordion-body px-0 pb-0 pt-3">
                                <form id="frmfilter" action="{{ route('shops.index') }}" method="GET">

                                    <input type="hidden" name="categories" id="hdnCategories" value="{{ $f_categories }}">
                                    <ul class="list list-inline mb-0 category-list">
                                        @foreach ($categories as $category)
                                            <li class="list-item">
                                                <span class="menu-link py-1">
                                                    <input type="checkbox" value="{{ $category->id }}" class="chk-category"
                                                        @if(in_array($category->id, explode(',', $f_categories))) checked
                                                        @endif>
                                                    {{ $category->name }}
                                                </span>
                                                <span class="text-right float-right">
                                                    {{ $category->products_count }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                



                <div class="accordion" id="brand-filters">
                    <div class="accordion-item mb-4 pb-3">
                        <h5 class="accordion-header" id="accordion-heading-brand">
                            <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button"
                                data-bs-toggle="collapse" data-bs-target="#accordion-filter-brand" aria-expanded="true"
                                aria-controls="accordion-filter-brand">
                                Brands
                                <svg class="accordion-button__icon type2" viewBox="0 0 10 6"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                        <path
                                            d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        <div id="accordion-filter-brand" class="accordion-collapse collapse show border-0"
                            aria-labelledby="accordion-heading-brand" data-bs-parent="#brand-filters">
                            <div class="search-field multi-select accordion-body px-0 pb-0">
                                <select class="d-none" multiple name="total-numbers-list">
                                    <option value="1">Adidas</option>
                                    <option value="2">Balmain</option>
                                    <option value="3">Balenciaga</option>
                                    <option value="4">Burberry</option>
                                    <option value="5">Kenzo</option>
                                    <option value="5">Givenchy</option>
                                    <option value="5">Zara</option>
                                </select>
                                <div class="search-field__input-wrapper mb-3">
                                    <input type="text" name="search_text"
                                        class="search-field__input form-control form-control-sm border-light border-2"
                                        placeholder="Search" />
                                </div>



                                <form id="frmfilter1" action="{{ route('shops.index') }}" method="GET">

                                    <input type="hidden" name="brands" id="hdnbrands" value="{{ $f_brands }}">
                                    <ul class="list list-inline mb-0 category-list">
                                        @foreach ($brands as $brand)
                                            <li class="list-item">
                                                <span class="menu-link py-1">
                                                    <input type="checkbox" value="{{ $brand->id }}" class="chk-brand"
                                                        @if(in_array($brand->id, explode(',', $f_brands))) checked @endif>
                                                    {{ $brand->name }}
                                                </span>
                                                <span class="text-right float-right">
                                                    {{ $brand->products_count }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>


                <div class="accordion" id="price-filters">
                    <div class="accordion-item mb-4">
                        <h5 class="accordion-header mb-2" id="accordion-heading-price">
                            <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button"
                                data-bs-toggle="collapse" data-bs-target="#accordion-filter-price" aria-expanded="true"
                                aria-controls="accordion-filter-price">
                                Price
                                <svg class="accordion-button__icon type2" viewBox="0 0 10 6"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                        <path
                                            d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                    </g>
                                </svg>
                            </button>
                        </h5>
                        @php
                            if ($f_price_range != '') {
                                $priceValues = explode(',', $f_price_range);
                                $minPrice = $priceValues[0];
                                $maxPrice = $priceValues[1];
                            } else {
                                $minPrice = 100;
                                $maxPrice = 450;
                            }
                        @endphp

                        <div id="accordion-filter-price" class="accordion-collapse collapse show border-0"
                            aria-labelledby="accordion-heading-price" data-bs-parent="#price-filters">

                            <input id="price-slider" class="price-range-slider" type="text" value="" data-slider-min="10"
                                data-slider-max="1000" data-slider-step="5"
                                data-slider-value="[{{ $minPrice }},{{ $maxPrice }}]" data-currency="$" />

                            <div class="price-range__info d-flex align-items-center mt-2">

                                <div class="me-auto">
                                    <span class="text-secondary">Min Price: </span>
                                    <span class="price-range__min">
                                        ${{ $minPrice }}
                                    </span>
                                </div>

                                <div>
                                    <span class="text-secondary">Max Price: </span>
                                    <span class="price-range__max">
                                        ${{ $maxPrice }}
                                    </span>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="shop-list flex-grow-1">
                <div class="swiper-container js-swiper-slider slideshow slideshow_small slideshow_split" data-settings='{
                                        "autoplay": {
                                            "delay": 5000
                                        },
                                        "slidesPerView": 1,
                                        "effect": "fade",
                                        "loop": true,
                                        "pagination": {
                                            "el": ".slideshow-pagination",
                                            "type": "bullets",
                                            "clickable": true
                                        }
                                        }'>
                    <div class="swiper-wrapper">
                        @foreach ($sliders as $slider)
                            <div class="swiper-slide">
                                <div class="slide-split h-100 d-block d-md-flex overflow-hidden">
                                    <div class="slide-split_text position-relative d-flex align-items-center"
                                        style="background-color: #f5e6e0;">
                                        <div class="slideshow-text container p-3 p-xl-5">
                                            <h2
                                                class="text-uppercase section-title fw-normal mb-3 animate animate_fade animate_btt animate_delay-2">
                                                {{$slider->title}}
                                            </h2>
                                            <p class="mb-0 animate animate_fade animate_btt animate_delay-5">
                                                {{$slider->subtitle}}</h6>
                                        </div>
                                    </div>
                                    <div class="slide-split_media position-relative">
                                        <div class="slideshow-bg" style="background-color: #f5e6e0;">
                                            <img loading="lazy" src="{{ asset('uploads/sliders/' . $slider->image) }}"
                                                width="630" height="450" alt="Women's accessories"
                                                class="slideshow-bg__img object-fit-cover" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <div class="container p-3 p-xl-5">
                        <div class="slideshow-pagination d-flex align-items-center position-absolute bottom-0 mb-4 pb-xl-2">
                        </div>

                    </div>
                </div>

                <div class="mb-3 pb-2 pb-xl-3"></div>

                <div class="d-flex justify-content-between mb-4 pb-md-2">
                    <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                        <a href="{{ route('home.user') }}"
                            class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
                        <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                        <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">The Shop</a>
                    </div>

                    <div
                        class="shop-acs d-flex align-items-center justify-content-between justify-content-md-end flex-grow-1">
                        <form action="{{ route('shops.index') }}" method="get">
                            <select class="shop-acs__select form-select w-auto border-0 py-0 order-1 order-md-0"
                                aria-label="Sort Items" name="sort" onchange="this.form.submit()">
                                <option value="" {{ request('sort') == '' ? 'selected' : '' }}>Default Sorting</option>
                                <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Date, old to new
                                </option>
                                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : ''}}>Date, new to old
                                </option>
                                <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price, low to
                                    high</option>
                                <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price, high
                                    to low</option>
                            </select>
                        </form>

                        <div class="shop-asc__seprator mx-3 bg-light d-none d-md-block order-md-0"></div>

                        <div class="col-size align-items-center order-1 d-none d-lg-flex">
                            <span class="text-uppercase fw-medium me-2">View</span>
                            <button class="btn-link fw-medium me-2 js-cols-size" data-target="products-grid"
                                data-cols="2">2</button>
                            <button class="btn-link fw-medium me-2 js-cols-size" data-target="products-grid"
                                data-cols="3">3</button>
                            <button class="btn-link fw-medium js-cols-size" data-target="products-grid"
                                data-cols="4">4</button>
                        </div>

                        <div class="shop-filter d-flex align-items-center order-0 order-md-3 d-lg-none">
                            <button class="btn-link btn-link_f d-flex align-items-center ps-0 js-open-aside"
                                data-aside="shopFilter">
                                <svg class="d-inline-block align-middle me-2" width="14" height="10" viewBox="0 0 14 10"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <use href="#icon_filter" />
                                </svg>
                                <span class="text-uppercase fw-medium d-inline-block align-middle">Filter</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="products-grid row row-cols-2 row-cols-md-3" id="products-grid">
                    @foreach ($products as $product)
                        <div class="product-card-wrapper">
                            <div class="product-card mb-3 mb-md-4 mb-xxl-5">
                                <div class="pc__img-wrapper">
                                    blade
                                    <div class="swiper-container background-img js-swiper-slider"
                                        data-settings='{"resizeObserver": true}'>

                                        <div class="swiper-wrapper">

                                            {{-- Main Product Image --}}
                                            @if ($product->image)
                                                <div class="swiper-slide">
                                                    <a href="{{ route('shops.show', $product->slug) }}">
                                                        <img loading="lazy" src="{{ asset('uploads/Products/' . $product->image) }}"
                                                            width="330" height="400" alt="{{ $product->name }}" class="pc__img">
                                                    </a>
                                                </div>
                                            @endif

                                            {{-- Gallery Images --}}
                                            @foreach ($product->images ?? [] as $gimg)
                                                <div class="swiper-slide">
                                                    <a href="{{ route('shops.show', $product->slug) }}">
                                                        <img loading="lazy" src="{{ asset('uploads/Products/' . $gimg) }}"
                                                            width="330" height="400" alt="{{ $product->name }}" class="pc__img">
                                                    </a>
                                                </div>
                                            @endforeach

                                        </div>

                                        <span class="pc__img-prev">
                                            <svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_prev_sm" />
                                            </svg>
                                        </span>

                                        <span class="pc__img-next">
                                            <svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                                                <use href="#icon_next_sm" />
                                            </svg>
                                        </span>

                                    </div>

                                    @php
                                        $cartItems = Cart::getContent();
                                    @endphp

                                    @if ($product->stock_status == 'outofstock')

                                        <button type="button"
                                            class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium btn-danger"
                                            disabled>
                                            Out of Stock
                                        </button>

                                    @elseif ($cartItems->has($product->id))

                                        <a href="{{ route('cart.index') }}"
                                            class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium js-add-cart btn-warning">
                                            Go to Cart
                                        </a>
                                    @else

                                        <form name="addtocart-form" method="POST" action="{{ route('cart.store') }}">
                                            @csrf

                                            <div class="product-single__addtocart">

                                                <input type="hidden" name="product_id" value="{{ $product->id }}">

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
                                    <p class="pc__category">{{ $product->category->name }}</p>
                                    <h6 class="pc__title"><a href="details.html">{{ $product->name }}</a></h6>
                                    <div class="product-card__price d-flex">
                                        <span class="money price">@if($product->sale_price)
                                            <s>${{ $product->regular_price }}</s>${{ $product->sale_price }}
                                        @else
                                                ${{ $product->regular_price }}
                                            @endif
                                        </span>
                                    </div>
                                    <div class="product-card__review d-flex align-items-center">
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

                                    @php
                                        $wishlistIds = session('wishlist', []);
                                    @endphp
                                    @if(in_array($product->id, $wishlistIds))
                                        <form method="POST" action="{{ route('wishlist.destroy', $product->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 filled-heart"
                                                title="Remove from Wishlist">
                                                <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <use href="#icon_heart" />
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('wishlist.store') }}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit"
                                                class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0"
                                                title="Add To Wishlist">
                                                <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <use href="#icon_heart" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <nav class="shop-pages d-flex justify-content-between mt-3" aria-label="Page navigation">

                    {{-- PREV --}}
                    @if ($products->onFirstPage())
                        <span class="btn-link d-inline-flex align-items-center text-muted">
                            <svg class="me-1" width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_prev_sm" />
                            </svg>
                            <span class="fw-medium">PREV</span>
                        </span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" class="btn-link d-inline-flex align-items-center">
                            <svg class="me-1" width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_prev_sm" />
                            </svg>
                            <span class="fw-medium">PREV</span>
                        </a>
                    @endif

                    {{-- NUMBER OF PAGES --}}
                    <ul class="pagination mb-0">
                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                            <li class="page-item">
                                <a href="{{ $url }}"
                                    class="btn-link px-1 mx-2 {{ $page == $products->currentPage() ? 'btn-link_active' : '' }}">
                                    {{ $page }}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    {{-- NEXT --}}
                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" class="btn-link d-inline-flex align-items-center">
                            <span class="fw-medium me-1">NEXT</span>
                            <svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_next_sm" />
                            </svg>
                        </a>
                    @else
                        <span class="btn-link d-inline-flex align-items-center text-muted">
                            <span class="fw-medium me-1">NEXT</span>
                            <svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_next_sm" />
                            </svg>
                        </span>
                    @endif
                </nav>
            </div>
        </section>
    </main>
@endsection
@section('scripts')

    <script>
        $(function () {
            $('.chk-category').on('change', function () {

                var categories = [];

                $('.chk-category:checked').each(function () {
                    categories.push($(this).val());
                });

                $('#hdnCategories').val(categories.join(','));

                $('#frmfilter').submit();

            });

        });
    </script>

    <script>
        $(function () {

            $('.chk-brand').on('change', function () {

                var brands = [];

                $('.chk-brand:checked').each(function () {
                    brands.push($(this).val());
                });

                $('#hdnbrands').val(brands.join(','));

                $('#frmfilter1').submit();

            });

        });
    </script>

    <script>
        $(function () {
            $('#price-slider').on('slide', function (event) {
                var values = event.value;
                $('.price-range__min').text('$' + values[0]);
                $('.price-range__max').text('$' + values[1]);
            });
            $('#price-slider').on('slideStop', function (event) {
                var values = event.value;
                var url = new URL(window.location.href);
                url.searchParams.set(
                    'price_range',
                    values[0] + ',' + values[1]
                );
                window.location.href = url.toString();
            });
        });
    </script>

@endsection