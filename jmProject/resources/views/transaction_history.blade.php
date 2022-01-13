@extends('layouts.app')

@section('content')

<div class="container">

    <div class="container text-center">
        <h2> Transaction History </h2>
        @if(empty($staff))
            <h5> Staff: {{Auth::user()->name}} </h5>
        @else
            <h5> Staff: {{$staff->name}} </h5>
        @endif
    </div>

    <div class="container">
        <div class="row">
            @foreach($transactions as $transaction)
            <div class="col-sm-6 my-2">
                <div class="card rounded col-sm-12 p-0">
                    <div class="card-header" data-bs-toggle="collapse" href="{{'#collapse'.$transaction->id}}" role="button">
                        <p class="card-text">
                            Transaction #{{$transaction->id}}
                            <br>
                            Paid at {{$transaction->date}}
                        </p>
                    </div>
                    <div class="collapse" id="{{'collapse'.$transaction->id}}">
                        <div class="card-body">
                            <table class="table table-md table-borderless">
                                <tbody>
                                    <?php $totalPrice = 0 ?>
                                    @foreach($transaction->transactionDetails as $detail)
                                        <tr>
                                            <td>{{$detail->stocks->nameProduct}} ({{$detail->qty}}x)</th>
                                            <td class="text-end">{{number_format($detail->stocks->price * $detail->qty, 0, ',', '.')}}</td>
                                        </tr>
                                        <?php $totalPrice += $detail->stocks->price * $detail->qty ?>
                                    @endforeach
                                    <tr style="border-top:1px solid !important;">
                                        <th style="font-size:1.25em">Total</th>
                                        <th class="text-end" style="font-size: 1.25em">{{number_format($totalPrice, 0, ',', '.')}}</td>
                                    </tr>
                                    <tr>
                                        <th>Paid</th>
                                        <th class="text-end">{{number_format($transaction->pay, 0, ',', '.')}}</td>
                                    </tr>
                                    <tr>
                                        <th>Change</th>
                                        <th class="text-end" style="border-top:1px solid !important;">{{number_format($transaction->pay - $totalPrice, 0, ',', '.')}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                </div>
            </div>  
            @endforeach
        </div>
    </div>
</div>
@endsection