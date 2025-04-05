@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Color List</h3>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('color.create') }}" class="btn btn-primary me-3">Add Color</a>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('delete'))
                    <div class="alert alert-success">{{ session('delete') }}</div>
                @endif
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>SL</th>
                            <th>Color Name</th>
                            <th>Color Code</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($colors as $key => $color )
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $color->color_name }}</td>
                            <td>{{ $color->color_code }}</td>
                            <td>
                                <a href="{{ route('color.delete',$color->id) }}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
