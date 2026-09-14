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
                <h3>All Products</h3>
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
                        <div class="text-tiny">All Products</div>
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
                    <a class="tf-button style-1 w208" href="{{ route('Products.create') }}"><i class="icon-plus"></i>Add
                        new</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>SalePrice</th>
                                <th>SKU</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>Featured</th>
                                <th>Stock</th>
                                <th>Quantity</th>
                                <th>Alert At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td class="pname">
                                        <div class="image">
                                            <img src="{{ $product->image ? asset('uploads/products/' . $product->image) : asset('admin/assets/images/bg-menu/img-2.png') }}"
                                                alt="" class="image">
                                        </div>
                                        <div class="name">
                                            <a href="#" class="body-title-2">{{ $product->name }}</a>
                                            <div class="text-tiny mt-3">{{$product->slug}}</div>
                                        </div>
                                    </td>
                                    <td>{{ $product->regular_price }}</td>
                                    <td>{{ $product->sale_price }}</td>
                                    <td>{{ $product->SKU }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->brand->name }}</td>
                                    <td>{{ $product->featured == 0 ? "No" : "Yes" }}</td>
                                    <td>{{ $product->stock_status}}</td>
                                    <td>{{ $product->quantity}}</td>
                                    <td>
                                        @if ($product->quantity <= $product->low_stock_threshold)
                                            <span class="badge bg-danger">Low stock</span>
                                        @else
                                            {{ $product->low_stock_threshold }}
                                        @endif
                                    </td>

                                    <td>
                                        <div class="list-icon-function">

                                            <a href="{{ route('Products.edit', $product->id) }}">
                                                <div class="item edit">
                                                    <i class="icon-edit-3"></i>
                                                </div>
                                            </a>


                                            <div class="item text-danger delete" data-bs-toggle="modal"
                                                data-bs-target="#delete{{ $product->id }}"> <i class="icon-trash-2"></i>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                @include('admin.Product.delete')
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

@endsection

@section('scripts')

@endsection