@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row d-flex justify-content-between">
        <div class="col-sm-6">
            <div class="card rounded col-sm-12 px-0 sticky-top" style="top: 30px">
                <div class="card-body text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill my-3" viewBox="0 0 16 16" style="color: green; height: 5em !important; width:auto !important;">
                      <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </svg>
                    <h4 class="card-title mb-5"> Payment Completed </h4>
                    <a href="{{route('stocklist')}}" class="btn btn-success form-control mb-3"> New Transaction </a>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="card rounded col-sm-12 p-0">
                <div class="card-header">
                    Payment Details
                </div>
                <div class="card-body">
                    <table class="table table-md table-borderless">
                        <tbody>
                            <tr>
                                <th> Transaction #{{$transaction->id}} </th>
                                <th class="text-end"> Staff: {{Auth::user()->name}} </th>
                            </tr>
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
                            <tr>
                                <th>Paid</th>
                                <th class="text-end">{{number_format($transaction->pay, 0, ',', '.')}}</td>
                            </tr>
                            <tr>
                                <th>Change</th>
                                <th class="text-end" style="border-top:1px solid !important;">{{number_format($transaction->pay - $totalPrice, 0, ',', '.')}}</td>
                            </tr>
                            <tr>
                                <th>Paid at</th>
                                <td class="text-end">{{$transaction->date}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection