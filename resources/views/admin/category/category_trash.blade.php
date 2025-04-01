@extends('layouts.admin')
@section('content')
    <div class="row">
        <form action="{{ route('category.bulk.action') }}" method="POST">
            @csrf
            <div class="col-lg-8 m-auto">
                <div class="card">
                    <div class="card-header">
                        <h3>Trash List</h3>
                    </div>
                    @if (session('restore'))
                        <div class="alert alert-success">{{ session('restore') }}</div>
                    @endif
                    @if (session('permanent_delete'))
                        <div class="alert alert-success">{{ session('permanent_delete') }}</div>
                    @endif
                    @if (session('soft_delete'))
                        <div class="alert alert-success">{{ session('soft_delete') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-success">{{ session('error') }}</div>
                    @endif

                    @if (session('check_delete'))
                        <div class="alert alert-success">{{ session('check_delete') }}</div>
                    @endif

                    <div class="d-flex justify-content-end">
                        <a href="{{ route('category.list') }}" class="btn btn-primary me-3">Back to Category List</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th><input type="checkbox" id="chkSelectAll">Ceheck All</th>
                                <th>SL</th>
                                <th>Category Name</th>
                                <th>Category Icon</th>
                                <th>Action</th>
                            </tr>
                            @forelse ($categories as $key => $category)
                            <tr>
                                <td><input type="checkbox" class="chkDel" name="category_id[]" value="{{ $category->id }}"></td>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $category->category_name }}</td>
                                <td>
                                    <img src="{{ asset('uploads/category') }}/{{ $category->category_icon }}" alt="">
                                </td>
                                <td >
                                    <a href="{{ route('category.restore',$category->id) }}" class="btn btn-primary"><i data-feather="rotate-cw"></i></a>
                                    <a href="{{ route('category.permanent.delete',$category->id) }}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4"><h4 class="text-center text-info">No Trash Category Found</h4></td>
                            </tr>
                            @endforelse
                        </table>
                       <div class="d-flex">
                        <button name="action" value="1" class="btn btn-primary mt-2 me-2">Check Restore</button>
                        <button name="action" value="2" class="btn btn-danger mt-2">Check Delete</button>
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
