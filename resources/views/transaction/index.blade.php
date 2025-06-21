@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h4>Transaction List</h4>
        <div>
                <ul class="navbar-nav flex-row">
                <li class="nav-item me-3">
                    <a class="btn btn-primary" href="{{ url('/transaction/issue') }}">Issue</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-secondary" href="{{ url('/transaction/return') }}">Return</a>
                </li>
            </ul>
        </div>
    </div>
   
    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Consumer Name</th>
                <th>Consumer Email</th>
                <th>Product Name</th>
                <th>Transaction Type</th>
                <th>Quantity</th>
                <th>Contact Info</th>
                <th>Created Date</th>
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
            @include('transaction.records')
        </tbody>
    </table>
</div>
@endsection
