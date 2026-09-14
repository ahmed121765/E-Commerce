@extends('admin.layouts.master')

@section('title')
    Edit Product
@endsection

@section('css')
    <style>
        html,
        body {
            height: auto !important;
            min-height: 100% !important;
            overflow-y: auto !important;
        }

        #wrapper,
        .main-content,
        .main-content-inner,
        .main-content-wrap {
            height: auto !important;
            min-height: 100vh !important;
            overflow: visible !important;
        }

        .tf-section-2 {
            height: auto !important;
            min-height: 0 !important;
            overflow: visible !important;
        }

        .wg-box {
            height: auto !important;
            min-height: 0 !important;
            overflow: visible !important;
        }

        form.form-add-product {
            height: auto !important;
            overflow: visible !important;
        }

        .current-image {
            margin-bottom: 15px;
        }

        .current-image img {
            max-width: 150px;
            max-height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }
    </style>
@endsection

@section('title_page1')
    Edit Product
@endsection

@section('content')

    <div class="main-content-wrap">

        {{-- Breadcrumb --}}
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">

            <h3>Edit Product</h3>

            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">

                <li>
                    <a href="{{ route('home.admin') }}">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>

                <li>
                    <i class="icon-chevron-right"></i>
                </li>

                <li>
                    <a href="{{ route('Products.index') }}">
                        <div class="text-tiny">Products</div>
                    </a>
                </li>

                <li>
                    <i class="icon-chevron-right"></i>
                </li>

                <li>
                    <div class="text-tiny">Edit Product</div>
                </li>

            </ul>

        </div>


        {{-- Form --}}
        <form
            class="tf-section-2 form-add-product"
            method="POST"
            enctype="multipart/form-data"
            action="{{ route('Products.update', $product->id) }}"
        >

            @csrf
            @method('PUT')


            {{-- =========================
                BASIC INFORMATION
            ========================== --}}
            <div class="wg-box">

                {{-- Product Name --}}
                <fieldset class="name">

                    <div class="body-title mb-10">
                        Product name
                        <span class="tf-color-1">*</span>
                    </div>

                    <input
                        class="mb-10"
                        type="text"
                        placeholder="Enter product name"
                        name="name"
                        value="{{ old('name', $product->name) }}"
                        required
                    >

                    <div class="text-tiny">
                        Do not exceed 255 characters when entering the product name.
                    </div>

                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </fieldset>


                {{-- Slug --}}
                <fieldset class="name">

                    <div class="body-title mb-10">
                        Slug
                        <span class="tf-color-1">*</span>
                    </div>

                    <input
                        class="mb-10"
                        type="text"
                        placeholder="Enter product slug"
                        name="slug"
                        value="{{ old('slug', $product->slug) }}"
                        required
                    >

                    <div class="text-tiny">
                        Enter a unique slug for the product.
                    </div>

                    @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </fieldset>


                {{-- Category + Brand --}}
                <div class="gap22 cols">

                    {{-- Category --}}
                    <fieldset class="category">

                        <div class="body-title mb-10">
                            Category
                            <span class="tf-color-1">*</span>
                        </div>

                        <div class="select">

                            <select name="category_id" required>

                                <option value="" disabled>
                                    Choose Category
                                </option>

                                @foreach ($categories as $category)

                                    <option
                                        value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                                    >
                                        {{ $category->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </fieldset>


                    {{-- Brand --}}
                    <fieldset class="brand">

                        <div class="body-title mb-10">
                            Brand
                            <span class="tf-color-1">*</span>
                        </div>

                        <div class="select">

                            <select name="brand_id" required>

                                <option value="" disabled>
                                    Choose Brand
                                </option>

                                @foreach ($brands as $brand)

                                    <option
                                        value="{{ $brand->id }}"
                                        {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}
                                    >
                                        {{ $brand->name }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        @error('brand_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </fieldset>



                </div>

                @foreach ($sizes as $size)

                <label class="form-check">

                    <input
                        type="checkbox"
                        name="sizes[]"
                        value="{{ $size->id }}"
                        class="form-check-input"

                        @if ($product->sizes->contains($size->id))
                            checked
                        @endif
                    >

                    <span class="form-check-label">
                        {{ $size->name }}
                    </span>

                </label>

                @endforeach      
                
                
                        {{-- Colors --}}
                    <fieldset class="name mt-3">

                        <div class="body-title mb-10">
                            Colors
                        </div>

                        <div class="flex items-center flex-wrap gap10">

                            @foreach ($colors as $color)

                                <label class="form-check">

                                    <input
                                        type="checkbox"
                                        name="colors[]"
                                        value="{{ $color->id }}"
                                        class="form-check-input"

                                        @if ($product->colors->contains($color->id))
                                            checked
                                        @endif
                                    >

                                    <span class="form-check-label">
                                        {{ $color->name }}
                                    </span>

                                </label>

                            @endforeach

                        </div>

                        @error('colors')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror

                        @error('colors.*')
                            <span class="text-danger">
                                {{ $message }}
                            </span>
                        @enderror

                    </fieldset>




                {{-- Description --}}
                <fieldset class="description">

                    <div class="body-title mb-10">
                        Description
                        <span class="tf-color-1">*</span>
                    </div>

                    <textarea
                        class="mb-10"
                        name="description"
                        placeholder="Description"
                        required
                    >{{ old('description', $product->description) }}</textarea>

                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </fieldset>

                <fieldset class="description">
                    <div class="body-title mb-10">Why choose product?</div>
                    <textarea class="mb-10" name="why_choose_product" placeholder="Add one item per line">{{ old('why_choose_product', $product->why_choose_product) }}</textarea>
                    @error('why_choose_product')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </fieldset>

                <fieldset class="description">
                    <div class="body-title mb-10">Sample Number List</div>
                    <textarea class="mb-10" name="sample_number_list" placeholder="Add one item per line">{{ old('sample_number_list', $product->sample_number_list) }}</textarea>
                    @error('sample_number_list')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </fieldset>

                <fieldset class="description">
                    <div class="body-title mb-10">Lining</div>
                    <textarea class="mb-10" name="lining" placeholder="Add lining details">{{ old('lining', $product->lining) }}</textarea>
                    @error('lining')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </fieldset>

                <fieldset class="name">
                    <div class="body-title mb-10">Weight</div>
                    <input class="mb-10" type="text" name="weight" placeholder="Example: 1.25 kg" value="{{ old('weight', $product->weight) }}">
                    @error('weight') <span class="text-danger">{{ $message }}</span> @enderror
                </fieldset>

                <fieldset class="name">
                    <div class="body-title mb-10">Dimensions</div>
                    <input class="mb-10" type="text" name="dimensions" placeholder="Example: 90 x 60 x 90 cm" value="{{ old('dimensions', $product->dimensions) }}">
                    @error('dimensions') <span class="text-danger">{{ $message }}</span> @enderror
                </fieldset>

            </div>
            


            {{-- =========================
                IMAGES + PRICES
            ========================== --}}
            <div class="wg-box">

                {{-- Main Image --}}
                <fieldset>
                    {{-- Current Image --}}
                    @if ($product->image)
                        <div class="current-image">
                            <div class="body-title mb-10">
                                Current Image
                            </div>
                            <img
                                src="{{ $product->image ? asset('uploads/products/' . $product->image) : asset('admin/assets/images/bg-menu/img-2.png') }}"
                                alt="{{ $product->name }}"
                            >
                        </div>
                    @endif
                    <div class="body-title mb-10">
                        New Product Image
                    </div>

                    {{-- Upload New Image --}}
                    <div class="upload-image flex-grow">

                        <div
                            class="item"
                            id="imgpreview"
                            style="display:none"
                        >
                            <img
                                id="previewImage"
                                src=""
                                class="effect8"
                                alt=""
                            >
                        </div>


                        <div
                            id="upload-file"
                            class="item up-load"
                        >

                            <label
                                class="uploadfile"
                                for="myFile"
                            >

                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>

                                <span class="body-text">
                                    Drop your image here or select
                                    <span class="tf-color">
                                        click to browse
                                    </span>
                                </span>

                                <input
                                    type="file"
                                    id="myFile"
                                    name="image"
                                    accept="image/*"
                                >

                            </label>

                        </div>

                    </div>

                    <div class="text-tiny">
                        Leave empty if you do not want to change the current image.
                    </div>

                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </fieldset>


                {{-- Gallery --}}
                <fieldset>

                    <div class="body-title mb-10">
                        Upload Gallery Images
                    </div>

                    <div class="upload-image mb-16">

                        <div
                            id="galUpload"
                            class="item up-load"
                        >

                            <label
                                class="uploadfile"
                                for="gFile"
                            >

                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>

                                <span class="text-tiny">
                                    Drop your images here or select
                                    <span class="tf-color">
                                        click to browse
                                    </span>
                                </span>

                                <input
                                    type="file"
                                    id="gFile"
                                    name="images[]"
                                    accept="image/*"
                                    multiple
                                >

                            </label>

                        </div>

                    </div>

                    @error('images')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    @error('images.*')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </fieldset>


                {{-- Regular Price + Sale Price --}}
                <div class="cols gap22">

                    {{-- Regular Price --}}
                    <fieldset class="name">

                        <div class="body-title mb-10">
                            Regular Price
                            <span class="tf-color-1">*</span>
                        </div>

                        <input
                            class="mb-10"
                            type="number"
                            step="0.01"
                            min="0"
                            placeholder="Enter regular price"
                            name="regular_price"
                            value="{{ old('regular_price', $product->regular_price) }}"
                            required
                        >

                        @error('regular_price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </fieldset>


                    {{-- Sale Price --}}
                    <fieldset class="name">

                        <div class="body-title mb-10">
                            Sale Price
                        </div>

                        <input
                            class="mb-10"
                            type="number"
                            step="0.01"
                            min="0"
                            placeholder="Enter sale price"
                            name="sale_price"
                            value="{{ old('sale_price', $product->sale_price) }}"
                        >

                        @error('sale_price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </fieldset>

                </div>


                {{-- SKU + Quantity --}}
                <div class="cols gap22">

                    {{-- SKU --}}
                    <fieldset class="name">

                        <div class="body-title mb-10">
                            SKU
                            <span class="tf-color-1">*</span>
                        </div>

                        <input
                            class="mb-10"
                            type="text"
                            placeholder="Enter SKU"
                            name="SKU"
                            value="{{ old('SKU', $product->SKU) }}"
                            required
                        >

                        @error('SKU')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </fieldset>


                    {{-- Quantity --}}
                    <fieldset class="name">

                        <div class="body-title mb-10">
                            Quantity
                            <span class="tf-color-1">*</span>
                        </div>

                        <input
                            class="mb-10"
                            type="number"
                            min="0"
                            placeholder="Enter quantity"
                            name="quantity"
                            value="{{ old('quantity', $product->quantity) }}"
                            required
                        >

                        @error('quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title mb-10">Low stock alert at</div>
                        <input class="mb-10" type="number" min="0" placeholder="5"
                            name="low_stock_threshold"
                            value="{{ old('low_stock_threshold', $product->low_stock_threshold) }}">
                        @error('low_stock_threshold')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </fieldset>

                </div>


                {{-- Stock + Featured --}}
                <div class="cols gap22">

                    {{-- Stock --}}
                    <fieldset class="name">

                        <div class="body-title mb-10">
                            Stock
                        </div>

                        <div class="select mb-10">

                            <select name="stock_status">

                                <option
                                    value="instock"
                                    {{ old('stock_status', $product->stock_status) == 'instock' ? 'selected' : '' }}
                                >
                                    In Stock
                                </option>

                                <option
                                    value="outofstock"
                                    {{ old('stock_status', $product->stock_status) == 'outofstock' ? 'selected' : '' }}
                                >
                                    Out of Stock
                                </option>

                            </select>

                        </div>

                        @error('stock_status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </fieldset>


                    {{-- Featured --}}
                    <fieldset class="name">

                        <div class="body-title mb-10">
                            Featured
                        </div>

                        <div class="select mb-10">

                            <select name="featured">

                                <option
                                    value="0"
                                    {{ old('featured', $product->featured) == '0' ? 'selected' : '' }}
                                >
                                    No
                                </option>

                                <option
                                    value="1"
                                    {{ old('featured', $product->featured) == '1' ? 'selected' : '' }}
                                >
                                    Yes
                                </option>

                            </select>

                        </div>

                        @error('featured')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror

                    </fieldset>

                </div>


                {{-- Update Button --}}
                <div class="cols gap10">

                    <button
                        class="tf-button w-full"
                        type="submit"
                    >
                        Update Product
                    </button>

                </div>

            </div>

        </form>

    </div>

@endsection


@section('scripts')

@endsection