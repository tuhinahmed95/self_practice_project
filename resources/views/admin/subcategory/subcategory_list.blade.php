@extends('layouts.admin')
@section('content')
    <div class="row">
        <form action="{{ route('subcategory.check.delete') }}" method="POST">
            @csrf
            <div class="col-lg-8 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h3>SubCategory List</h3>
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    @if (session('check_delete'))
                        <div class="alert alert-success">{{ session('check_delete') }}</div>
                    @endif
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('subcategory.create') }}" class="btn btn-primary me-2">Add SubCategory</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th><input type="checkbox" id="chkSelectAll">Select All</th>
                                <th>SL</th>
                                <th>Category</th>
                                <th>SubCategory Name</th>
                                <th>SubCategory Icon</th>
                                <th>Action</th>
                            </tr>
                            @foreach ($subcategories as $key => $subcategory )
                            <tr>
                                <td><input type="checkbox" class="chkDel" name="subcategory_id[]" value="{{ $subcategory->id }}"></td>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $subcategory->category->category_name }}</td>
                                <td>{{ $subcategory->subcategory_name }}</td>
                                <td>
                                    <img width="70" src="{{ asset('uploads/subcategory') }}/{{ $subcategory->subcategory_icon }}" alt="">
                                </td>
                                <td>
                                    <a href="{{ route('subcategory.edit',$subcategory->id) }}" class="btn btn-warning"><i data-feather="edit"></i></a>
                                    <a href="{{ route('subcategory.soft.delete',$subcategory->id) }}" class="btn btn-danger"><i data-feather="trash"></i></a>
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
