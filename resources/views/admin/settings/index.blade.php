@extends('admin.layouts.master')

@section('content')

    <div class="container">

        <h3>Settings</h3>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">
                    VAT (%)
                </label>

                <input type="number" name="vat" class="form-control" step="0.01" min="0" max="100"
                    value="{{ $vat->value ?? 0 }}">

                @error('vat')
                    <span class="text-danger">
                        {{ $message }}
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">
                Save VAT
            </button>

        </form>

    </div>

@endsection