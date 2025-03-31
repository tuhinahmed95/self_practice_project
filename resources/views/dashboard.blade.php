@extends('layouts.admin')
@section('content')
<div class="row">
   <h4>Welcome To Dashboard,<strong class="text-primary">{{ Auth::user()->name }}</strong></h4>
</div>
@endsection
