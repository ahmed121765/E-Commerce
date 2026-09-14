@extends('admin.layouts.master')

@section('title')

@endsection

@section('css')

@endsection

@section('title_page1')

@endsection

@section('content')


    <style>
        .text-danger {
            font-size: initial;
            line-height: 36px;
        }

        .alert {
            font-size: initial;
        }
    </style>

    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Settings</h3>
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        Password updated successfully.
                    </div>
                @endif
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
                        <div class="text-tiny">Settings</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="col-lg-12">
                    <div class="page-content my-account__edit">
                        <div class="my-account__edit-form">
                            <form name="account_edit_form" action="{{route('myAccount.update', $user->id)}}" method="POST"
                                class="form-new-product form-style-1 needs-validation" novalidate="">

                                @csrf
                                @method('put')

                                <fieldset class="name">
                                    <div class="body-title">Name <span class="tf-color-1">*</span>
                                    </div>
                                    <input class="flex-grow" type="text" placeholder="Full Name" name="name" tabindex="0"
                                        value="{{ $user->name }}" aria-required="true" required="">
                                    @error('name')
                                        <small class="text-danger d-block mt-1">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </fieldset>

                                <fieldset class="name">
                                    <div class="body-title">Phone Number <span class="tf-color-1">*</span></div>
                                    <input class="flex-grow" type="text" placeholder="Phone Number" name="phone"
                                        tabindex="0" value="{{ $user->phone }}" aria-required="true" required="">
                                    @error('phone')
                                        <small class="text-danger d-block mt-1">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </fieldset>

                                <fieldset class="name">
                                    <div class="body-title">Email Address <span class="tf-color-1">*</span></div>
                                    <input class="flex-grow" type="text" placeholder="Email Address" name="email"
                                        tabindex="0" value="{{ $user->email }}" aria-required="true" required="">
                                    @error('email')
                                        <small class="text-danger d-block mt-1">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </fieldset>

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="my-3">
                                            <button type="submit" class="btn btn-primary tf-button w208">Save
                                                Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <form name="account_update_form" action="{{ route('account.password.update.admin') }}" method="POST"
                                class="form-new-product form-style-1 needs-validation" novalidate="">
                                @csrf
                                @method('put')>
                                <div class="col-md-12">
                                    <div class="my-3">
                                        <h5 class="text-uppercase mb-0">Password Change</h5>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <fieldset class="name">
                                        <div class="body-title pb-3">Old password <span class="tf-color-1">*</span>
                                        </div>
                                        <input class="flex-grow" type="password" placeholder="current_password"
                                            id="current_password" name="current_password" aria-required="true" required="">
                                        @error('current_password')
                                            <small class="text-danger d-block mt-1">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </fieldset>

                                </div>
                                <div class="col-md-12">
                                    <fieldset class="name">
                                        <div class="body-title pb-3">New password <span class="tf-color-1">*</span>
                                        </div>
                                        <input class="flex-grow" type="password" placeholder="new_password"
                                            id="new_password" name="new_password" aria-required="true" required="">
                                        @error('new_password')
                                            <small class="text-danger d-block mt-1">
                                                {{ $message }}
                                            </small>
                                        @enderror
                                    </fieldset>

                                </div>
                                <div class="col-md-12">
                                    <fieldset class="name">
                                        <div class="body-title pb-3">Confirm new password <span class="tf-color-1">*</span>
                                        </div>
                                        <input class="flex-grow" type="password" placeholder="Confirm new password" cfpwd=""
                                            data-cf-pwd="#new_password" id="new_password_confirmation"
                                            name="new_password_confirmation" aria-required="true" required="">
                                        @error('new_password_confirmation')
                                            <small class="text-danger d-block mt-1">
                                                {{ $message }}
                                            </small>
                                        @enderror

                                        <div class="invalid-feedback">Passwords did not match!
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-md-12">
                                    <div class="my-3">
                                        <button type="submit" class="btn btn-primary tf-button w208">Update
                                            Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="bottom-page">
        <div class="body-text">Copyright © 2024 SurfsideMedia</div>
    </div>

@endsection

@section('scripts')

@endsection