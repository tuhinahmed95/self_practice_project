@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>User Info Update</h3>
                </div>
                @if (session('update'))
                    <div class="alert alert-success">{{ session('update') }}</div>
                @endif
                <div class="card-body">
                    <form action="{{ route('user.profile.update') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Password Update</h3>
                </div>
                @if (session('password'))
                    <div class="alert alert-success">{{ session('password') }}</div>
                @endif
                <div class="card-body">
                    <form action="{{ route('user.password.update') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="" class="form-label">Current Password</label>
                            <input type="password" name="current_password" class="form-control" >
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Photo Update</h3>
                </div>
                @if (session('photo'))
                    <div class="alert alert-success">{{ session('photo') }}</div>
                @endif
                <div class="card-body">
                    <form action="{{ route('user.photo.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="" class="form-label">Upload Photo</label>
                            <input type="file" name="photo" class="form-control">
                            <div class="my-2">
                                <img width="70" src="{{ asset('uploads/user') }}/{{ Auth::user()->photo }}" alt="">
                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Update User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
