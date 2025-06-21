@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Record Issue Transaction</h2>

    <form method="POST" action="{{ route('transaction.store-issue') }}" id="save-frm">
        @csrf

        <div class="mb-3">
            <label for="consumer_id" class="form-label">Select Consumer</label>
            <select name="consumer_id" class="form-control">
                <option value="">-- Choose Consumer --</option>
                @foreach($consumers as $consumer)
                    <option value="{{ $consumer->id }}">{{ $consumer->name }} ({{ $consumer->type }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="product_id" class="form-label">Select Product</label>
            <select name="product_id" class="form-control">
                <option value="">-- Choose Product --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">
                        {{ $product->name }} - Available: {{ $product->inventory->available_units ?? 0 }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Number of Units to Issue</label>
            <input type="number" name="quantity" class="form-control" min="1">
        </div>

        <button type="submit" class="btn btn-primary">Submit Transaction</button>
                        <a href="{{ route('transaction.index') }}"><button class="btn btn-danger" type="button">Cancel</button></a>

    </form>
</div>
@endsection