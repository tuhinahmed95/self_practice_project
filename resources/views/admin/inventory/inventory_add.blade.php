@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Add Inventory</h3>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('inventory.list') }}" class="btn btn-primary me-3">Back To Inventory List</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('inventory.store',$product->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label  class="form-label">Product Name</label>
                            <input name="product_id" disabled type="text" class="form-control" value="{{ $product->product_name }}">
                        </div>

                        <div class="mb-3">
                            <label  class="form-label">Color</label>
                            <select name="color_id" class="form-control">
                                <option value="">Select Color</option>
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label  class="form-label">Size</label>
                            <select name="size_id" class="form-control">
                                <option value="">Select Size</option>
                                @foreach (App\Models\Size::where('category_id', $product->category_id)->get() as $size)
                                    <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label  class="form-label">Quantity</label>
                            <input type="number" name="quantity" class="form-control">
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Add Inventory</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
