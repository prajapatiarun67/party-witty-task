@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Import Consumer</h2>
    <p class="text-muted">File Column Structure (Consumer Name | Consumer Email | Type | Contact Info)</p>

    <form method="POST" action="{{ route('consumer.store_import') }}" enctype="multipart/form-data" id="save-frm">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Choose CSV or Excel File</label>
            <input type="file" name="csv_file" class="form-control" accept=".csv">
        </div>

        <button type="submit" class="btn btn-success">Import</button>
        <a href="{{ route('consumer.index') }}"><button class="btn btn-danger" type="button">Cancel</button></a>

    </form>
</div>
@endsection
