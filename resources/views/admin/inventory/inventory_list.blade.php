@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Inventory List, <strong></strong></h3>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('product.list') }}" class="btn btn-primary me-3 mb-3">Back To Product List</a>
                </div>
                <table class="table table-bordered">
                    <tr>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($inventoreis as $inventory)
                    <tr>
                        <td>{{ $inventory->rel_to_color->color_name }}</td>
                        <td>{{ $inventory->rel_to_size->size_name }}</td>
                        <td>{{ $inventory->quantity }}</td>
                        <td>
                            <a href="{{ route('inventory.delete',$inventory->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
