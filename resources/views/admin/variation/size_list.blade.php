@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Size List</h3>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('delete'))
                    <div class="alert alert-success">{{ session('delete') }}</div>
                @endif
                <div class="d-flex justify-content-end">
                    <a href="{{ route('size.create') }}" class="btn btn-primary me-3">Add Size</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Size</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($sizes as $key => $size)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $size->category->category_name }}</td>
                            <td>{{ $size->size_name }}</td>
                            <td>
                                <a href="{{ route('size.delete',$size->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
