@extends('layouts.admin')
@section('content')
    <div class="row">
        <form action="{{ route('subcategory.bulk.action') }}" method="POST">
            @csrf

            <div class="col-lg-8 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h3>Trash List</h3>
                    </div>
                    @if (session('check_restore'))
                        <div class="alert alert-success">{{ session('check_restore') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-success">{{ session('error') }}</div>
                    @endif

                    @if (session('check_delete'))
                        <div class="alert alert-success">{{ session('check_delete') }}</div>
                    @endif
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('subcategory.list') }}" class="btn btn-primary me-2">Back to  SubCategory List</a>
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
                            @forelse ($subcategories as $key => $subcategory )
                            <tr>
                                <td><input type="checkbox" class="chkDel" name="subcategory_id[]" value="{{ $subcategory->id }}"></td>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $subcategory->category->category_name }}</td>
                                <td>{{ $subcategory->subcategory_name }}</td>
                                <td>
                                    <img width="70" src="{{ asset('uploads/subcategory') }}/{{ $subcategory->subcategory_icon }}" alt="">
                                </td>
                                <td>
                                    <a href="{{ route('subcategory.restore',$subcategory->id) }}" class="btn btn-primary"><i data-feather="rotate-cw"></i></a>
                                    <a href="{{ route('subcategory.permanent.delete',$subcategory->id) }}" class="btn btn-danger"><i data-feather="trash"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4"><h3 class="text-center text-info">No SubCategory Found</h3></td>
                            </tr>
                            @endforelse
                        </table>
                        <div class="d-flex">
                            <button type="submit" class="btn btn-primary me-2 mt-2" name="action" value="1">
                                Check Restore
                            </button>
                            <button type="submit" class="btn btn-danger mt-2" name="action" value="2">
                                Check Delete
                            </button>
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
