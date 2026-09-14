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
                <h3>Categorie</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{route('home.admin')}}" class="text-tiny">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Categorie</div>
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
                    <a class="tf-button style-1 w208" href="{{route('Categories.create')}}"><i class="icon-plus"></i>Add new</a>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Products</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Categories as $Categorie)

                                    <tr>
                                        <td>{{ $Categorie->id }}</td>
                                        <td class="pname">
                                            <div class="image">
                                                <img src="{{ $Categorie->image ? asset('uploads/Categories/' . $Categorie->image) : asset('admin/assets/images/bg-menu/img-2.png') }}"
                                                    alt="" class="image">
                                            </div>
                                            <div class="name">
                                                <a href="#" class="body-title-2">{{ $Categorie->name }}</a>
                                            </div>
                                        </td>
                                        <td>{{ $Categorie->slug }}</td>
                                        <td><a href="#" target="_blank">0</a></td>
                                        <td>
                                            <div class="list-icon-function">

                                                {{-- Edit --}}
                                                <a href="{{ route('Categories.edit', $Categorie->id) }}" class="item text-success">
                                                    <div class="item edit">
                                                        <i class="icon-edit-3"></i>
                                                    </div>
                                                </a>

                                                {{-- Delete --}}
                                                <a href="#" class="item text-danger delete" data-bs-toggle="modal"
                                                    data-bs-target="#delete{{ $Categorie->id }}">
                                                    <i class="icon-trash-2"></i>
                                                </a>


                                            </div>
                                        </td>
                                    </tr>
                                    @include('admin.Categorie.delete')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection