@extends('layouts.admin')
@section('content')
<div class="row">
    <form action="{{ route('brand.check.delete') }}" method="POST">
        @csrf
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Brand List</h3>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('update'))
                    <div class="alert alert-success">{{ session('update') }}</div>
                @endif

                @if (session('check_delete'))
                    <div class="alert alert-success">{{ session('check_delete') }}</div>
                @endif
                <div class="d-flex justify-content-end">
                    <a href="{{ route('brand.create') }}" class="btn btn-primary me-3">Add Brand</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th><input type="checkbox" id="chkSelectAll">Select All</th>
                            <th>SL</th>
                            <th>Brand Name</th>
                            <th>Brand Logo</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($brands as $key => $brand)
                        <tr>
                            <td><input type="checkbox" name="brand_id[]" class="chkDel" value="{{ $brand->id }}"></td>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $brand->brand_name }}</td>
                            <td>
                                <img width="70" src="{{ asset('uploads/brand') }}/{{ $brand->brand_logo }}" alt="">
                            </td>
                            <td>
                                <a href="{{ route('brand.edit',$brand->id) }}" class="btn btn-warning"><i data-feather="edit"></i></a>
                                <a href="{{ route('brand.soft.delete',$brand->id) }}" class="btn btn-danger"><i data-feather="trash"></i></a>
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
