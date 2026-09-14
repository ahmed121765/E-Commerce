`@extends('admin.layouts.master')

@section('title')

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
    </style>
@endsection

@section('title_page1')

@endsection

@section('content')
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Add Product</h3>
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
                    <a href="{{route('Products.index')}}">
                        <div class="text-tiny">Products</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Add product</div>
                </li>
            </ul>
        </div>
        <!-- form-add-product -->
        <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data"
            action="{{route('Products.store')}}">
            @csrf


            <div class="wg-box">
                <fieldset class="name">
                    <div class="body-title mb-10">Product name <span class="tf-color-1">*</span>
                    </div>
                    <input class="mb-10" type="text" placeholder="Enter product name" name="name" tabindex="0" value="{{ old('name') }}"
                        aria-required="true" required="">
                    <div class="text-tiny">Do not exceed 100 characters when entering the
                        product name.</div>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </fieldset>

                <fieldset class="name">
                    <div class="body-title mb-10">Slug <span class="tf-color-1">*</span></div>
                    <input class="mb-10" type="text" placeholder="Enter product slug" name="slug" tabindex="0" value="{{ old('slug') }}"
                        aria-required="true" required="">
                    <div class="text-tiny">Do not exceed 100 characters when entering the
                        product name.</div>
                    @error('slug')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </fieldset>

                <div class="gap22 cols">
                     {{-- Category --}}
                      <fieldset class="category">
                        <div class="body-title mb-10"> Category <span class="tf-color-1">*</span> </div>
                        <div class="select"> <select name="category_id" required>
                                <option value="" disabled {{ old('category_id') ? '' : 'selected' }}> Choose Category
                                </option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                </option>
                                 @endforeach
                            </select> </div>
                             @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </fieldset> 
                    {{-- Brand --}} 
                    <fieldset class="brand">
                        <div class="body-title mb-10"> Brand <span class="tf-color-1">*</span> </div>
                        <div class="select"> <select name="brand_id" required>
                                <option value="" disabled {{ old('brand_id') ? '' : 'selected' }}> Choose Brand </option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                </option> 
                                @endforeach
                            </select>
                         </div> @error('brand_id') <span class="text-danger">{{ $message }}</span> 
                         @enderror
                    </fieldset>
                </div>

                <div class="gap22 cols">
                                {{-- Sizes --}}
                <fieldset class="name mt-3">
                    <div class="body-title mb-10">
                        Sizes
                    </div>
                    <div class="flex items-center flex-wrap gap10">
                        @foreach ($sizes as $size)
                            <label class="form-check">
                                <input
                                    type="checkbox"
                                    name="sizes[]"
                                    value="{{ $size->id }}"
                                    class="form-check-input"
                                    {{ in_array($size->id, old('sizes', [])) ? 'checked' : '' }}
                                >
                                <span class="form-check-label">
                                    {{ $size->name }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                    @error('sizes')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    @error('sizes.*')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </fieldset>

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
                                    {{ in_array($color->id, old('colors', [])) ? 'checked' : '' }}
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
                </div>
                <fieldset class="description">
                    <div class="body-title mb-10"> Description <span class="tf-color-1">*</span> </div> <textarea
                        class="mb-10" name="description" placeholder="Description" tabindex="0" aria-required="true"
                        required>{{ old('description') }}</textarea>
                    <div class="text-tiny"> Do not exceed 100 characters when entering the description. </div>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </fieldset>

                <fieldset class="description">
                    <div class="body-title mb-10">Why choose product?</div>
                    <textarea class="mb-10" name="why_choose_product" placeholder="Add one item per line">{{ old('why_choose_product') }}</textarea>
                    @error('why_choose_product')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </fieldset>

                <fieldset class="description">
                    <div class="body-title mb-10">Sample Number List</div>
                    <textarea class="mb-10" name="sample_number_list" placeholder="Add one item per line">{{ old('sample_number_list') }}</textarea>
                    @error('sample_number_list')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </fieldset>

                <fieldset class="description">
                    <div class="body-title mb-10">Lining</div>
                    <textarea class="mb-10" name="lining" placeholder="Add lining details">{{ old('lining') }}</textarea>
                    @error('lining')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </fieldset>

                <fieldset class="name">
                    <div class="body-title mb-10">Weight</div>
                    <input class="mb-10" type="text" name="weight" placeholder="Example: 1.25 kg" value="{{ old('weight') }}">
                    @error('weight') <span class="text-danger">{{ $message }}</span> @enderror
                </fieldset>

                <fieldset class="name">
                    <div class="body-title mb-10">Dimensions</div>
                    <input class="mb-10" type="text" name="dimensions" placeholder="Example: 90 x 60 x 90 cm" value="{{ old('dimensions') }}">
                    @error('dimensions') <span class="text-danger">{{ $message }}</span> @enderror
                </fieldset>
                

            </div>
            <div class="wg-box">
                <fieldset>
                    <div class="body-title">Upload images <span class="tf-color-1">*</span>
                    </div>
                    <div class="upload-image flex-grow">
                        <div class="item" id="imgpreview" style="display:none">
                        <img id="previewImage" src="" class="effect8" alt="">
                    </div>
                        <div id="upload-file" class="item up-load">
                            <label class="uploadfile" for="myFile">
                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>
                                <span class="body-text">Drop your images here or select <span class="tf-color">click to
                                        browse</span></span>
                                <input type="file" id="myFile" name="image" accept="image/*" required>
                            </label>
                        </div>
                    </div>
                    @error('image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </fieldset>

                <fieldset>
                    <div class="body-title mb-10">Upload Gallery Images</div>
                    <div class="upload-image mb-16">
                        <!-- <div class="item">
                            <img id="previewImage" src="" class="effect8" alt="">
                    </div>                                                 -->
                        <div id="galUpload" class="item up-load">
                            <label class="uploadfile" for="gFile">
                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>
                                <span class="text-tiny">Drop your images here or select <span class="tf-color">click to
                                        browse</span></span>
                                <input type="file" id="gFile" name="images[]" accept="image/*" multiple="">
                            </label>
                        </div>
                    </div>
                </fieldset>

                <div class="cols gap22">
                    <fieldset class="name">
                        <div class="body-title mb-10">Regular Price <span class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" placeholder="Enter regular price" name="regular_price" tabindex="0"
                            value="{{ old('regular_price') }}" aria-required="true" required="">
                            @error('regular_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title mb-10">Sale Price</div>
                        <input class="mb-10" type="text" placeholder="Enter sale price" name="sale_price" tabindex="0"
                            value="{{ old('sale_price') }}">
                            @error('sale_price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </fieldset>
                </div>


                <div class="cols gap22">
                    <fieldset class="name">
                        <div class="body-title mb-10">SKU <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10" type="text" placeholder="Enter SKU" name="SKU" tabindex="0" value="{{ old('SKU') }}"
                            aria-required="true" required="">
                            @error('SKU')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title mb-10">Quantity <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10" type="text" placeholder="Enter quantity" name="quantity" tabindex="0" value="{{ old('quantity') }}"
                            aria-required="true" required="">
                            @error('quantity')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title mb-10">Low stock alert at</div>
                        <input class="mb-10" type="number" min="0" placeholder="5" name="low_stock_threshold"
                            value="{{ old('low_stock_threshold', 5) }}">
                        @error('low_stock_threshold')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </fieldset>
                </div>

                <div class="cols gap22">
                    <fieldset class="name">
                        <div class="body-title mb-10">Stock</div>
                        <div class="select mb-10">
                            <select class="" name="stock_status">
                                <option value="instock" {{ old('stock_status', 'instock') == 'instock' ? 'selected' : '' }}>
                                    In Stock
                                </option>
                                <option value="outofstock" {{ old('stock_status') == 'outofstock' ? 'selected' : '' }}>
                                    Out of Stock
                                </option>
                            </select>
                        </div>
                        @error('stock_status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </fieldset>
                    <fieldset class="name">
                        <div class="body-title mb-10">Featured</div>
                        <div class="select mb-10">
                            <select class="" name="featured">
                                <option value="0" {{ old('featured', '0') == '0' ? 'selected' : '' }}>
                                    No
                                </option>

                                <option value="1" {{ old('featured') == '1' ? 'selected' : '' }}>
                                    Yes
                                </option>
                            </select>
                        </div>
                        @error('featured')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </fieldset>
                </div>
                <div class="cols gap10">
                    <button class="tf-button w-full" type="submit">Add product</button>
                </div>
            </div>
        </form>
        <!-- /form-add-product -->
    </div>
@endsection

@section('scripts')

@endsection`