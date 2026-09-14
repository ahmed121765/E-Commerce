@extends('admin.layouts.master')

@section('title')

@endsection

@section('css')

@endsection

@section('title_page1')

@endsection

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Slider</h3>
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
                        <div class="text-tiny">Slider</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." class="" name="name" tabindex="2" value=""
                                    aria-required="true" required="">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('sliders.create') }}"><i class="icon-plus"></i>Add
                        new</a>
                </div>
                <div class="wg-table table-all-user">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Tagline</th>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th>Link</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sliders as $slider)
                                <tr>
                                    <td>{{ $slider->id }}</td>

                                    <td class="pname">
                                        <div class="image">
                                            <img src="{{ asset('uploads/sliders/' . $slider->image) }}"
                                                alt="{{ $slider->title }}" class="image">
                                        </div>
                                    </td>


                                    <td>{{ $slider->tagline }}</td>

                                    <td>{{ $slider->title }}</td>

                                    <td>{{ $slider->subtitle }}</td>

                                    <td>
                                        <a href="{{ $slider->link }}" target="_blank">
                                            {{ $slider->link }}
                                        </a>
                                    </td>

                                    <td class="text-center">
                                        @if ($slider->status === 'active')
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-warning">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="list-icon-function">

                                            <a href="{{ route('sliders.edit', $slider->id) }}">
                                                <div class="item edit">
                                                    <i class="icon-edit-3"></i>
                                                </div>
                                            </a>

                                            <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this slider?');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="item text-danger delete">
                                                    <i class="icon-trash-2"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">
                                        No sliders found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="divider"></div>
                <div class="d-flex justify-content-center mt-4">
                        {{ $sliders->links('pagination::bootstrap-5') }}
                    </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection