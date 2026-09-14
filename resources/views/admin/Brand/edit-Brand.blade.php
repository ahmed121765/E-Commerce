@extends('admin.layouts.master')

@section('title')
    Edit Brand
@endsection

@section('css')
    <style>
        .brand-page-title {
            margin-bottom: 4px;
        }

        .brand-page-subtitle {
            color: #6b7280;
            font-size: 13px;
        }

        .brand-form-box {
            border-radius: 12px;
        }

        .brand-section-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        .brand-current-image {
            width: 180px;
            height: 180px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 10px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .brand-current-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 7px;
        }

        .brand-upload-box {
            border: 1px dashed #cbd5e1;
            border-radius: 10px;
            padding: 25px;
            background: #f8fafc;
            transition: all .2s ease;
        }

        .brand-upload-box:hover {
            border-color: #4f46e5;
            background: #f8faff;
        }

        .brand-upload-preview {
            width: 120px;
            height: 120px;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
            margin-bottom: 15px;
            background: #fff;
        }

        .brand-upload-preview img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .brand-file-input {
            margin-top: 12px;
        }

        .brand-required {
            color: #dc2626;
        }

        .brand-error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 6px;
        }

        .brand-actions {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
        }
    </style>


@endsection

@section('title_page1')
    Edit Brand
@endsection

@section('content')


    <div class="main-content-inner">
        <div class="main-content-wrap">

            {{-- Page Header --}}
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">

                <div>
                    <h3 class="brand-page-title">Edit Brand</h3>
                    <div class="brand-page-subtitle">
                        Update your brand information and image
                    </div>
                </div>

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
                            <div class="text-tiny">Brands</div>
                        </a>
                    </li>

                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>

                    <li>
                        <div class="text-tiny">Edit Brand</div>
                    </li>
                </ul>

            </div>

            {{-- Brand Form --}}
            <div class="wg-box brand-form-box">

                <form class="form-new-product form-style-1" action="{{ route('brands.update', $brand->id) }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    {{-- Basic Information --}}
                    <div class="brand-section-title">
                        Brand Information
                    </div>

                    <fieldset class="name">

                        <div class="body-title">
                            Brand Name
                            <span class="brand-required">*</span>
                        </div>

                        <input class="flex-grow" type="text" placeholder="Enter brand name" name="name" tabindex="0"
                            value="{{ $brand->name }}" aria-required="true" required>

                        @error('name')
                            <div class="brand-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </fieldset>

                    <fieldset class="name">

                        <div class="body-title">
                            Brand Slug
                            <span class="brand-required">*</span>
                        </div>

                        <input class="flex-grow" type="text" placeholder="Enter brand slug" name="slug" tabindex="0"
                            value="{{ $brand->slug }}" aria-required="true" required>

                        @error('slug')
                            <div class="brand-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </fieldset>


                    {{-- Brand Image --}}
                    <div class="brand-section-title" style="margin-top: 25px;">
                        Brand Image
                    </div>

                    <fieldset>

                        <div style="margin-bottom: 20px;">

                            <div class="body-title" style="margin-bottom: 10px;">
                                Current Image
                            </div>

                            <div class="brand-current-image">

                                <img src="{{ $brand->image ? asset('uploads/brands/' . $brand->image) : asset('admin/assets/images/bg-menu/img-2.png') }}"
                                    alt="{{ $brand->name }}">


                            </div>

                        </div>


                        <div class="body-title" style="margin-bottom: 10px;">
                            Change Image
                            <span class="tf-color-1">*</span>
                        </div>

                        <div class="brand-upload-box">

                            {{-- New Image Preview --}}
                            <div class="brand-upload-preview" id="imgpreview" style="display:none;">

                                <img id="preview-image" src="" alt="Preview">

                            </div>

                            <div id="upload-file" class="item up-load">

                                <label class="uploadfile" for="myFile" style="cursor:pointer;">

                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>

                                    <span class="body-text">
                                        Drop your image here or
                                        <span class="tf-color">
                                            click to browse
                                        </span>
                                    </span>

                                    <input type="file" id="myFile" name="image" accept="image/*" class="brand-file-input">

                                </label>

                            </div>

                        </div>

                        @error('image')
                            <div class="brand-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </fieldset>


                    {{-- Actions --}}
                    <div class="brand-actions">

                        <button class="tf-button w208" type="submit">

                            <i class="icon-save"></i>
                            Update Brand

                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>


@endsection

@section('scripts')


    <script>
        document.getElementById('myFile').addEventListener('change', function (event) {

            const file = event.target.files[0];

            if (!file) {
                return;
            }

            const preview = document.getElementById('imgpreview');
            const previewImage = document.getElementById('preview-image');

            previewImage.src = URL.createObjectURL(file);

            preview.style.display = 'block';

        });
    </script>


@endsection