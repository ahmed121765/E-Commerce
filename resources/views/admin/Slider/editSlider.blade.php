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

            <form action="{{ route('sliders.update', $sliders->id) }}" method="POST" enctype="multipart/form-data"
                class="form-new-product form-style-1">

                @csrf
                @method('put')

                <fieldset class="name">
                    <div class="body-title">
                        Title <span class="tf-color-1">*</span>
                    </div>

                    <input class="flex-grow" type="text" placeholder="Title" name="title"
                        value="{{ old('title', $sliders->title) }}" required>
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">
                        Tagline <span class="tf-color-1">*</span>
                    </div>

                    <input class="flex-grow" type="text" placeholder="Tagline" name="tagline"
                        value="{{ old('tagline', $sliders->tagline) }}" required>
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">
                        Subtitle <span class="tf-color-1">*</span>
                    </div>

                    <input class="flex-grow" type="text" placeholder="Subtitle" name="subtitle"
                        value="{{ old('subtitle', $sliders->subtitle) }}" required>
                </fieldset>

                <fieldset class="name">
                    <div class="body-title">
                        Status <span class="tf-color-1">*</span>
                        <select name="status" class="form-control">
                            <option value="active" @selected(old('status', $sliders->status) == 'active')>Active</option>
                            <option value="inactive" @selected(old('status', $sliders->status) == 'inactive')>Inactive
                            </option>
                        </select>
                    </div>
                </fieldset>


                <fieldset class="name">
                    <div class="body-title">
                        Link
                    </div>

                    <input class="flex-grow" type="url" placeholder="https://example.com" name="link"
                        value="{{ old('link', $sliders->link) }}">
                </fieldset>


                <fieldset>
                    @if ($sliders->image)
                        <div class="current-image">
                            <div class="body-title mb-10">
                                Current Image
                            </div>
                            <img src="{{ $sliders->image ? asset('uploads/Sliders/' . $sliders->image) : asset('admin/assets/images/bg-menu/img-2.png') }}"
                                alt="{{ $sliders->name }}">
                        </div>
                    @endif

                    <div class="body-title">
                        Update Image <span class="tf-color-1">*</span>
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

                                <input type="file" id="myFile" name="image" accept="image/*">

                            </label>

                        </div>
                    </div>
                </fieldset>

                <div class="bot">
                    <div></div>

                    <button class="tf-button w208" type="submit">
                        Update
                    </button>
                </div>

            </form>

        </div>

    </div>
@endsection

@section('scripts')

@endsection