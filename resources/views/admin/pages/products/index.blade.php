@extends('admin.layout.master')

@section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        Products List
        @can('product-add-new')
        <a class="btn btn-small btn-outline-primary" href="{{route('products.create')}}">Add New</a>
        @endcan
        @can('product-trash-list')
        <a class="btn btn-small btn-outline-info" href="{{route('products.trash')}}">Trash</a>
        @endcan
        @can('product-pdf-list')
        <a class="btn btn-small btn-outline-primary" href="{{route('products.pdf')}}">Pdf</a>
        @endcan
    </div>
    <div class="card-body">

        @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>SKU Number</th>
                    <th>Description</th>
                    <th>price</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tfoot>
            </tfoot>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{$product->title}}</td>
                    <td>{{$product->sku_number}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->is_active ? 'Active':'Inactive'}}</td>
                    <td><img src="{{ asset('images/' . $product->image) }}" width="50" height="50">
                    </td>
                    <td>
                        @can('product-edit')
                        <a href="{{route('products.edit', ['product' => $product->id])}}"
                            class="btn btn-outline-primary">Edit</a>
                        @endcan
                        <a href="{{route('products.show', ['product' => $product->id])}}"
                            class="btn btn-outline-info">Show</a>
                        @can('delete-product')
                        <form action="{{route('products.destroy', ['product' => $product->id])}}" method="POST"
                            style="display: inline">
                            @csrf
                            @method('delete')
                            <button class="btn btn-outline-danger">Delete</button>
                        </form>
                        @endcan
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
</div>
@endsection
@section('title')
Products List
@endsection