@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row d-flex justify-content-between">
        <div class="col-sm-6">
            <div class="card rounded col-sm-12 px-0 sticky-top" style="top: 30px">
                <div class="card-header">
                    Payment Details
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('kembalian')}}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="transaction_id"> Transaction ID </label>
                                <fieldset disabled>
                                    <input type="text" id="transaction_id" name="transaction_id" class="form-control" placeholder="{{$transaction->id}}">
                                </fieldset>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="staff_name"> Staff Name</label>
                                <fieldset disabled>
                                    <input type="text" id="staff_name" name="staff_name" class="form-control" placeholder="{{Auth::user()->name}}">
                                </fieldset>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="payment"> Payment Received </label>
                            <input type="number" id="payment" name="payment" class="form-control" placeholder="{{$totalPrice}}" value="{{$totalPrice}}">
                        </div>
                        <div class="form-group">
                            <label for="date"> Checkout Date </label>
                            <input type="date" id="date" name="date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                        </div>
                        <button type="submit" class="btn btn-primary form-control"> Complete Payment </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card rounded col-sm-12 p-0">
                <div class="card-header">
                    Order Details
                </div>
                <div class="card-body">
                    <table class="table table-md table-borderless">
                        <tbody>
                            @foreach($data as $list)
                                <tr>
                                    <td>{{$list->nameProduct}} ({{$list->qty}}x)</th>
                                    <td class="text-end">{{number_format($list->price * $list->qty, 0, ',', '.')}}</td>
                                </tr>
                            @endforeach
                            <tr style="border-top:1px solid !important;">
                                <th style="font-size:1.25em">Total</th>
                                <th class="text-end" style="font-size: 1.25em">{{number_format($totalPrice, 0, ',', '.')}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
