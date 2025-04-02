@extends('layouts.admin')
@section('content')
<div class="row">
    <form action="{{ route('brand.bulk.action') }}" method="POST">
        @csrf
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Trash List List</h3>
                </div>
                @if (session('check_restore'))
                    <div class="alert alert-success">{{ session('check_restore') }}</div>
                @endif

                @if (session('check_delete'))
                    <div class="alert alert-danger">{{ session('check_delete') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-success">{{ session('error') }}</div>
                @endif
                <div class="d-flex justify-content-end">
                    <a href="{{ route('brand.list') }}" class="btn btn-primary me-3">Back To Brand List</a>
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
                                <a href="{{ route('brand.restore',$brand->id) }}" class="btn btn-primary"><i data-feather="rotate-cw"></i></a>
                                <a href="{{ route('brand.permanenet.delete',$brand->id) }}" class="btn btn-danger"><i data-feather="trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    <div class="d-flex">
                        <button type="submit" name="action" value="1" class="btn btn-primary me-2 mt-2">Check Restore</button>
                        <button type="submit" name="action" value="2" class="btn btn-danger mt-2">Check Delete</button>
                    </div>
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
