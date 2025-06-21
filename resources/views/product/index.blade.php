@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h4>Product List</h4>
        <div>
            <ul class="navbar-nav flex-row">
                <li class="nav-item me-3">
                    <a class="btn btn-success" href="{{ route('product.create') }}">Add Product</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-primary" href="{{route('product.import') }}">Import Product</a>
                </li>
            </ul>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price (₹)</th>
                <th>Stock</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="text" name="name" id="name" class="form-control filters" value="" autocomplete="off" placeholder="Search Product">
                </td>
                <td></td>  
                <td></td>  
                <td></td>  
                <td></td>  
                <td></td>  
            </tr>
        </thead>
        <tbody id="tbody">
            @include('product.records')
        </tbody>
    </table>
</div>
@endsection
