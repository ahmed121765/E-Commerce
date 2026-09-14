@extends('admin.layouts.master')

@section('title')
    Add Slider
@endsection

@section('css')

@endsection

@section('title_page1')

@endsection

@section('content')
    <div class="main-content-wrap">

        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>New Slide</h3>

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
                    <a href="{{ route('sliders.index') }}">
                        <div class="text-tiny">Slider</div>
                    </a>
                </li>

                <li>
                    <i class="icon-chevron-right"></i>
                </li>

                <li>
                    <div class="text-tiny">New Slide</div>
                </li>
            </ul>
        </div>

        <div class="wg-box">

            <form action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data"
                class="form-new-product form-style-1">

                @csrf

                <fieldset class="name">
                    <div class="body-title">
                        Title <span class="tf-color-1">*</span>
                    </div>

                    <input class="flex-grow" type="text" placeholder="Title" name="title" value="{{ old('title') }}"
                        required>
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">
                        Tagline <span class="tf-color-1">*</span>
                    </div>

                    <input class="flex-grow" type="text" placeholder="Tagline" name="tagline" value="{{ old('tagline') }}"
                        required>
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">
                        Subtitle <span class="tf-color-1">*</span>
                    </div>

                    <input class="flex-grow" type="text" placeholder="Subtitle" name="subtitle"
                        value="{{ old('subtitle') }}" required>
                </fieldset>
                <fieldset class="name">
                    <div class="body-title">
                        Status <span class="tf-color-1">*</span>
                        <select name="status" class="form-control">
                            <option value="active" @selected(old('status') == 'active')>Active</option>
                            <option value="inactive" @selected(old('status') == 'inactive')>Inactive</option>
                        </select>
                    </div>
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">
                        Link
                    </div>

                    <input class="flex-grow" type="url" placeholder="https://example.com" name="link"
                        value="{{ old('link') }}">
                </fieldset>

                <fieldset>

                    <div class="body-title">
                        Upload Image <span class="tf-color-1">*</span>
                    </div>

                    <div class="upload-image flex-grow">
                        <div class="item up-load">

                            <label class="uploadfile" for="myFile">

                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>

                                <span class="body-text">
                                    Drop your image here or select
                                    <span class="tf-color">click to browse</span>
                                </span>

                                <input type="file" id="myFile" name="image" accept="image/*" required>
                                <img id="imagePreview" src="" alt="Image Preview" style="display: none; width: 200px; margin-top: 15px;">

                            </label>

                        </div>
                    </div>
                </fieldset>

                <div class="bot">
                    <div></div>

                    <button class="tf-button w208" type="submit">
                        Save
                    </button>
                </div>

            </form>

        </div>

    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('myFile').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');

            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        });
    </script>
@endsection