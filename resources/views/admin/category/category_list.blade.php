@extends('layouts.admin')
@section('content')
    <div class="row">
       <form action="{{ route('category.check.delete') }}" method="POST">
        @csrf

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
                @if (session('soft_delete'))
                    <div class="alert alert-success">{{ session('soft_delete') }}</div>
                @endif

                <div class="d-flex justify-content-end">
                    <a href="{{ route('category.create') }}" class="btn btn-primary me-3">Add Category</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th><input type="checkbox" id="chkSelectAll">Check All</th>
                            <th>SL</th>
                            <th>Category Name</th>
                            <th>Category Icon</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($categories as $key => $category)
                        <tr>
                            <td><input type="checkbox" class="chkDel" name="category_id[]" value="{{ $category->id }}"></td>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $category->category_name }}</td>
                            <td>
                                <img src="{{ asset('uploads/category') }}/{{ $category->category_icon }}" alt="">
                            </td>
                            <td >
                                <a href="{{ route('category.edit',$category->id) }}" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                <a href="{{ route('category.soft.delete',$category->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <button class="btn btn-danger mt-2">Check Delete</button>
                </div>
            </div>
        </div>
       </form>
    </div>
@endsection

@section('footer_script')
    <script>
       $("#chkSelectAll").on('click', function(){
            this.checked ? $(".chkDel").prop("checked",true) : $(".chkDel").prop("checked",false);
        })
    </script>
@endsection
