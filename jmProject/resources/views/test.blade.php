@extends('layouts.app')

@section('content')

<div class="container">
    <div class="stock-list">
        <table class="table table-md">
            <thead>
                <tr>
                    <th scope="col">Product ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Order Quantity</th>
                    <th scope="col" class="text-end">Subtotal</th>
                </tr>
            </thead>

            <tbody>
                @foreach($stock as $list)
                <tr>
                    <th scope="row">{{$list->id}}</th>
                    <td>{{$list->nameProduct}}</td>
                    <td>{{$list->price}}</td>
                    <td class="w-25">
                        <input type="number form-control">
                    </td>
                    <td class="text-end">0</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="text-end">
            Total: 0
        </div>
    </div>

    <div class="product-input">
        <form action="{{route('transactiondetail')}}" method="POST">
            @csrf
            <div class="col-md-6 offset-md-4">
                <label for="ID Product">ID Product</label>
                <input type="number" id="product_id" name="product_id"  @error('product_id') is-invalid @enderror value="{{old('product_id')}}">
                @error('product_id') {{$message}} @enderror
                <br> <br>
                <label for="quantity">Quantity</label>
                <input type="number" id="quantity" name="quantity" value="quantity">
                <br>
                <button type="submit" class="btn btn-primary">
                    {{ __('Add') }}
                </button>
            </div>
        </form>
    </div>
    <br><br>
    <div class="product-summary">
        <table border="1">
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Sub Total</th>
                <th>Action</th>
            </tr>
            @forelse($data as $list)
            <tr>
                <td>{{$list->nameProduct}}</td>
                <td>{{$list->qty}}</td>
                <td>{{$list->price}}</td>
                <td>{{$list->subtotal}}</td>
                <td>
                    <form action="{{route('transaction.delete', ['transaction_detail' => $list->product_id])}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            No data
            @endforelse
        </table>
    </div>
    <br><br>
    <div class="bayar primary">
        <button type="submit"  class="btn btn-primary">
            <a href="{{route('viewTransaction')}}" style="text-decoration: none; color:white"> Payment </a>
        </button>
    </div>
</div>

@endsection
