@extends('admin.layouts.master')

@section('title')
    Edit Categorie
@endsection

@section('css')
    <style>
        .categorie-page-title {
            margin-bottom: 4px;
        }

        .categorie-page-subtitle {
            color: #6b7280;
            font-size: 13px;
        }

        .categorie-form-box {
            border-radius: 12px;
        }

        .categorie-section-title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        .categorie-current-image {
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

        .categorie-current-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 7px;
        }

        .categorie-upload-box {
            border: 1px dashed #cbd5e1;
            border-radius: 10px;
            padding: 25px;
            background: #f8fafc;
            transition: all .2s ease;
        }

        .categorie-upload-box:hover {
            border-color: #4f46e5;
            background: #f8faff;
        }

        .categorie-upload-preview {
            width: 120px;
            height: 120px;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
            margin-bottom: 15px;
            background: #fff;
        }

        .categorie-upload-preview img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .categorie-file-input {
            margin-top: 12px;
        }

        .categorie-required {
            color: #dc2626;
        }

        .categorie-error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 6px;
        }

        .categorie-actions {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            justify-content: flex-end;
        }
    </style>


@endsection

@section('title_page1')
    Edit Categorie
@endsection

@section('content')


    <div class="main-content-inner">
        <div class="main-content-wrap">

            {{-- Page Header --}}
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">

                <div>
                    <h3 class="categorie-page-title">Edit Categorie</h3>
                    <div class="categorie-page-subtitle">
                        Update your categorie information and image
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
                            <div class="text-tiny">Categories</div>
                        </a>
                    </li>

                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>

                    <li>
                        <div class="text-tiny">Edit Categorie</div>
                    </li>
                </ul>

            </div>

            {{-- Categorie Form --}}
            <div class="wg-box categorie-form-box">

                <form class="form-new-product form-style-1" action="{{ route('Categories.update', $Categorie->id) }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    {{-- Basic Information --}}
                    <div class="categorie-section-title">
                        Categorie Information
                    </div>

                    <fieldset class="name">

                        <div class="body-title">
                            Categorie Name
                            <span class="categorie-required">*</span>
                        </div>

                        <input class="flex-grow" type="text" placeholder="Enter categorie name" name="name" tabindex="0"
                            value="{{ $Categorie->name }}" aria-required="true" required>

                        @error('name')
                            <div class="categorie-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </fieldset>

                    <fieldset class="name">

                        <div class="body-title">
                            Categorie Slug
                            <span class="categorie-required">*</span>
                        </div>

                        <input class="flex-grow" type="text" placeholder="Enter categorie slug" name="slug" tabindex="0"
                            value="{{ $Categorie->slug }}" aria-required="true" required>

                        @error('slug')
                            <div class="categorie-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </fieldset>


                    {{-- Categorie Image --}}
                    <div class="categorie-section-title" style="margin-top: 25px;">
                        Categorie Image
                    </div>

                    <fieldset>

                        <div style="margin-bottom: 20px;">

                            <div class="body-title" style="margin-bottom: 10px;">
                                Current Image
                            </div>

                            <div class="categorie-current-image">

                                <img src="{{ $Categorie->image ? asset('uploads/Categories/' . $Categorie->image) : asset('admin/assets/images/bg-menu/img-2.png') }}"
                                    alt="{{ $Categorie->name }}">


                            </div>

                        </div>


                        <div class="body-title" style="margin-bottom: 10px;">
                            Change Image
                            <span class="tf-color-1">*</span>
                        </div>

                        <div class="categorie-upload-box">

                            {{-- New Image Preview --}}
                            <div class="categorie-upload-preview" id="imgpreview" style="display:none;">

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

                                    <input type="file" id="myFile" name="image" accept="image/*" class="categorie-file-input">

                                </label>

                            </div>

                        </div>

                        @error('image')
                            <div class="categorie-error">
                                {{ $message }}
                            </div>
                        @enderror

                    </fieldset>


                    {{-- Actions --}}
                    <div class="categorie-actions">

                        <button class="tf-button w208" type="submit">

                            <i class="icon-save"></i>
                            Update Categorie

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