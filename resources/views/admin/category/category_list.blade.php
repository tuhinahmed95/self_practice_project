@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Category List</h3>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('update'))
                    <div class="alert alert-success">{{ session('update') }}</div>
                @endif
                @if (session('delete'))
                    <div class="alert alert-success">{{ session('delete') }}</div>
                @endif

                <div class="d-flex justify-content-end">
                    <a href="{{ route('category.create') }}" class="btn btn-primary me-3">Add Category</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Category Icon</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($categories as $key => $category)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>
                                <img src="{{ asset('uploads/category') }}/{{ $category->category_icon }}" alt="">
                            </td>
                            <td >
                                <a href="{{ route('category.edit',$category->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                <a href="{{ route('category.delete',$category->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
