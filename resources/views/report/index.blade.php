@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Transaction Report</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('report.generate') }}" class="mb-4">
        @csrf
        <div class="row mb-3">
            <div class="col-md-3">
                <label>Start Date</label>
                <input type="date" name="start_date" class="form-control" value="{{ old('start_date') }}">
            </div>
            <div class="col-md-3">
                <label>End Date</label>
                <input type="date" name="end_date" class="form-control" value="{{ old('end_date') }}">
            </div>
            <div class="col-md-3">
                <label>Product</label>
                <select name="product_id" class="form-control">
                    <option value="">All Products</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Consumer</label>
                <select name="consumer_id" class="form-control">
                    <option value="">All Consumers</option>
                    @foreach ($consumers as $consumer)
                        <option value="{{ $consumer->id }}" {{ old('consumer_id') == $consumer->id ? 'selected' : '' }}>
                            {{ $consumer->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <label>Transaction Type</label>
                <select name="type" class="form-control">
                    <option value="">All</option>
                    <option value="Issue" {{ old('type') == 'Issue' ? 'selected' : '' }}>Issue</option>
                    <option value="Return" {{ old('type') == 'Return' ? 'selected' : '' }}>Return</option>
                </select>
            </div>
            <div class="col-md-3 align-self-end">
                <button class="btn btn-primary" type="submit">Generate Report</button>
            </div>
        </div>
    </form>

    @if(isset($transactions))
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Date & Time</th>
                        <th>Type</th>
                        <th>Product</th>
                        <th>Consumer</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $txn)
                        <tr>
                            <td>{{ $txn->transaction_date }}</td>
                            <td>{{ $txn->type }}</td>
                            <td>{{ $txn->product->name ?? '-' }}</td>
                            <td>{{ $txn->consumer->name ?? '-' }}</td>
                            <td>{{ $txn->quantity }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No transactions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
