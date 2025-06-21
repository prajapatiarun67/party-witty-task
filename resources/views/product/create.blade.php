@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Add New Product</h4>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('product.store') }}" method="POST" id="save-frm">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price (₹) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Product Code <span class="text-danger">*</span></label>
                    <input type="text" name="product_code" class="form-control" value="{{ old('product_code') }}">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Enter Unit (Stock) <span class="text-danger">*</span></label>
                    <input type="number" name="available_units" class="form-control" value="{{ old('available_units') }}">
                </div>

                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save Product</button>
                <a href="{{ route('product.index') }}"><button class="btn btn-danger" type="button">Cancel</button></a>
            </form>
        </div>
    </div>
</div>
@endsection
