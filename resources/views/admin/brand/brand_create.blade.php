@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Brand Create</h3>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('brand.list') }}" class="btn btn-primary me-2">Back To Brand List</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="" class="form-label">Brand Name</label>
                            <input type="text" name="brand_name" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Brand Logo</label>
                            <input type="file" name="brand_logo" class="form-control">
                        </div>

                        <div class="mb-3">
                           <button type="submit" class="btn btn-primary">Add Brand</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
