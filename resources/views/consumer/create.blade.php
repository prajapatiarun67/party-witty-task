@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Add New Consumer</h4>
        </div>
        <div class="card-body">
           
            <form action="{{ route('consumer.store') }}" method="POST" id="save-frm">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Consumer Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Consumer Email <span class="text-danger">*</span></label>
                    <input type="text" name="email" class="form-control" value="{{ old('email') }}">
                </div>
                
                <div class="mb-3">
                    <label for="type" class="form-label">Select Type</label>
                    <select name="type" class="form-control">
                        <option value="">-- Choose Type --</option>
                       <option value="Person" {{ old('type') == 'Person' ? 'selected' : '' }}>Person</option>
                        <option value="Department" {{ old('type') == 'Department' ? 'selected' : '' }}>Department</option>
                        <option value="BusinessUnit" {{ old('type') == 'BusinessUnit' ? 'selected' : '' }}>Business Unit</option>
                    </select>
                </div>
              
                <div class="mb-3">
                    <label for="contact_info" class="form-label">Contact Info</label>
                    <textarea name="contact_info" class="form-control" rows="3">{{ old('contact_info') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save Consumer</button>
                <a href="{{ route('consumer.index') }}"><button class="btn btn-danger" type="button">Cancel</button></a>
            </form>
        </div>
    </div>
</div>
@endsection
