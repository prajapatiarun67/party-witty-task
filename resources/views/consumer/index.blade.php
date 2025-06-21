@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h4>Product List</h4>
        <div>
            <ul class="navbar-nav flex-row">
                <li class="nav-item me-3">
                    <a class="btn btn-success" href="{{ route('consumer.create') }}">Add Consumer</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-primary" href="{{route('consumer.import') }}">Import Consumer</a>
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
                <th>Email</th>
                <th>Type</th>
                <th>Contact Info</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="text" name="name" id="name" class="form-control filters" value="" autocomplete="off" placeholder="Search Consumer">
                </td>
                <td>
                    <input type="text" name="email" id="email" class="form-control filters" value="" autocomplete="off" placeholder="Search Email">
                </td>  
                <td></td>  
                <td></td>  
                <td></td>  
                <td></td>  
            </tr>
        </thead>
        <tbody id="tbody">
            @include('consumer.records')
        </tbody>
    </table>
</div>
@endsection
