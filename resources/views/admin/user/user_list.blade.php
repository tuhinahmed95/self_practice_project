@extends('layouts.admin')
@section('content')
 <div class="row">
    <div class="col-lg-10 m-auto">
        <div class="card">
            <div class="card-header">
                <h3>User List</h3>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route('user.create') }}" class="btn btn-primary me-3">Add New User</a>
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
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($users as $key => $user )
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>
                            @if ($user->photo == null)
                                 <img src="{{ Avatar::create($user->name)->toBase64() }}" />
                            @else
                                <img width="70" src="{{ asset('uploads/user') }}/{{ $user->photo }}" alt="">
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('user.delete',$user->id) }}" class="btn btn-danger"><i data-feather="trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
 </div>
@endsection
