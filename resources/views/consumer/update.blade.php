@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Edit Consumer</h4>
        </div>
        <div class="card-body">

            <form action="{{ route('consumer.update' , ['consumer' => $consumer->id]) }}" method="POST" id="save-frm">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Consumer Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ $consumer->name }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" step="0.01" name="email" class="form-control" value="{{ $consumer->email }}">
                </div>
                
                <div class="mb-3">
                    <label for="type" class="form-label">Select Type</label>
                    <select name="type" class="form-control">
                        <option value="">-- Choose Type --</option>
                       <option value="Person" {{ $consumer->type == 'Person' ? 'selected' : '' }}>Person</option>
                        <option value="Department" {{ $consumer->type == 'Department' ? 'selected' : '' }}>Department</option>
                        <option value="BusinessUnit" {{ $consumer->type == 'BusinessUnit' ? 'selected' : '' }}>Business Unit</option>
                    </select>
                </div>

                
                <div class="mb-3">
                    <label for="contact_info" class="form-label">Contact Info</label>
                    <textarea name="contact_info" class="form-control" rows="3">{{ $consumer->contact_info }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update Product</button>
                <a href="{{ route('consumer.index') }}"><button class="btn btn-danger" type="button">Cancel</button></a>
            </form>
        </div>
    </div>
</div>
@endsection
