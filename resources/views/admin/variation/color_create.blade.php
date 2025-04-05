@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Color Create</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('color.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Color Name</label>
                            <input type="text" class="form-control" name="color_name">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Color Code</label>
                            <input type="text" class="form-control" name="color_code">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add Color</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
