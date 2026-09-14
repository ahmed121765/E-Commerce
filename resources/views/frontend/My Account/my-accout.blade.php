@extends('frontend.layouts.master')

@section('title')

@endsection

@section('css')
    <style>
        .text-danger {
        color: #f01200 !important;
    }
    </style>
@endsection

@section('title_page1')

@endsection

@section('content')
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">My Account</h2>
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    Password updated successfully.
                </div>
            @endif
            <div class="row">
                <div class="col-lg-3">
                    <ul class="account-nav">
                        <li><a href="{{route('home.user')}}" class="menu-link menu-link_us-s">Dashboard</a></li>
                        <li><a href="{{route('order.index')}}" class="menu-link menu-link_us-s">Orders</a></li>
                        
                        <li><a href="{{ route('myaccount.index') }}" class="menu-link menu-link_us-s">Account Details</a>
                        </li>
                        <li><a href="{{ route('wishlist.index') }}" class="menu-link menu-link_us-s">Wishlist</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="menu-link menu-link_us-s border-0 bg-transparent"> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-9">
                    <div class="page-content my-account__edit">
                        <div class="my-account__edit-form">
                            <form name="account_edit_form" action="{{ route('myaccount.update', $user->id) }}" method="POST"
                                class="needs-validation" novalidate="">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-floating my-3">
                                            <input type="text" class="form-control" placeholder="Full Name" name="name"
                                                value="{{ $user->name }}" required="">
                                            <label for="name">Full Name</label>
                                            @error('name')
                                                <small class="text-danger d-block mt-1">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating my-3">
                                            <input type="text" class="form-control" placeholder="Mobile Number" name="phone"
                                                value="{{ $user->phone }}" required="">
                                            <label for="phone">Mobile Number</label>
                                            @error('phone')
                                                <small class="text-danger d-block mt-1">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating my-3">
                                            <input type="email" class="form-control" placeholder="Email Address"
                                                name="email" value="{{ $user->email }}" required="">
                                            <label for="account_email">Email Address</label>
                                            @error('email')
                                                <small class="text-danger d-block mt-1">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="my-3">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form action="{{ route('account.password.update') }}" method="post">
                                @csrf
                                @method('put')
                                <div class="col-md-12">
                                    <div class="my-3">
                                        <h5 class="text-uppercase mb-0">Password Change</h5>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating my-3">
                                        <input type="password" class="form-control" id="current_password"
                                            name="current_password" placeholder="Old password" required="">
                                        <label for="current_password">Old password</label>
                                        @error('current_password')
                                            <small class="text-danger d-block mt-1">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating my-3">
                                        <input type="password" class="form-control" id="new_password" name="new_password"
                                            placeholder="New password" required="">
                                        <label for="new_password">New password</label>
                                        @error('new_password')
                                            <small class="text-danger d-block mt-1">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating my-3">
                                        <input type="password" class="form-control" cfpwd="" data-cf-pwd="#new_password"
                                            id="new_password_confirmation" name="new_password_confirmation"
                                            placeholder="new_password_confirmation" required="">
                                        <label for="new_password_confirmation">Confirm new password</label>
                                        @error('new_password_confirmation')
                                            <small class="text-danger d-block mt-1">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                        <div class="invalid-feedback">Passwords did not match!</div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="my-3">
                                        <button type="submit" class="btn btn-primary">Update Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')

@endsection