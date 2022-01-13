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
                    <th scope="col">Action</th>
                    <th scope="col" class="text-end">Subtotal (Rp)</th>
                </tr>
            </thead>

            <tbody>
                @foreach($data as $list)
                    <tr>
                        <th scope="row">{{$list->product_id}}</th>
                        <td>{{$list->nameProduct}}</td>
                        <td>{{number_format($list->price, 0, ',', '.')}}</td>
                        <td class="w-25">
                            <input type="number form-control" value="{{$list->qty}}" id="quantity" name="quantity" form="{{'update'.$list->product_id}}">
                        </td>
                        <td>
                            <button class="btn btn-primary" form="{{'update'.$list->product_id}}">Update</button>
                            <button class="btn btn-danger" form="{{'delete'.$list->product_id}}">Delete</button>
                        </td>
                        <td class="text-end">{{number_format($list->price * $list->qty, 0, ',', '.')}}</td>
                    </tr>
                    <form method="POST" action="{{route('transaction.update', ['prodid'=>$list->product_id])}}" id="{{'update'.$list->product_id}}">
                        @csrf
                    </form>
                    <form method="POST" action="{{route('transaction.delete', ['transaction_detail'=>$list->product_id])}}" id="{{'delete'.$list->product_id}}">
                        @method('DELETE')
                        @csrf
                    </form>
                @endforeach

                <tr>
                    <td colspan="2">
                        <select class="form-control" id="id" name="id" form="add_form">
                            @foreach($stock as $prod)
                                <option value="{{$prod->id}}"> {{$prod->id}} | {{$prod->nameProduct}} </option>
                            @endforeach
                        </select>
                    </td>
                    <td></td>
                    <td>
                        <input type="number form-control" value="1" id="quantity" name="quantity" form="add_form">
                    </td>
                    <td>
                        <button class="btn btn-success" form="add_form"> Add </button>
                    </td>
                    <td></td>
                    <form method="POST" action="{{route('transaction.add')}}" id="add_form">
                        @csrf
                    </form>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="container bg-dark text-light d-flex justify-content-between rounded p-3">
        <h3>
            Total : {{number_format($total, 0, ',', '.')}}
        </h3>
        <a class="btn btn-light text-dark" href="{{route('viewTransaction')}}"> Payment </a>
    </div>
</div>

@endsection
