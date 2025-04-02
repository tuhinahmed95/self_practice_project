@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h2>Create Subcategory</h2>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('subcategory.list') }}" class="btn btn-primary me-2">Back To SubCategory List</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('subcategory.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="" class="form-label">Category</label>
                            <select name="category_id" class="form-control">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">SubCategory Name</label>
                            <input type="text" name="subcategory_name" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">SubCategory Icon</label>
                            <input type="file" name="subcategory_icon" class="form-control">
                        </div>

                        <div class="mb-3">
                           <button type="submit" class="btn btn-primary">Add SubCategory</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
