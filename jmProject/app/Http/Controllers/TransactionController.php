<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\transaction;
use Carbon\Carbon;

class TransactionController extends Controller
{

    public function calKembalian(Request $request){
        $total = 0;

        $data = DB::table('transaction_detail')
                    ->join('stock', 'transaction_detail.product_id', 'stock.id')
                    ->join('transaction', 'transaction.id', 'transaction_detail.transaction_id')
                    ->where('transaction.status', '=', '0')
                    ->where('transaction.user_id', Auth::user()->id)
                    ->orderby('transaction_detail.product_id')
                    ->get();            

        foreach($data as $list){
            $total +=  $list->qty * $list->price;
        }

        $request->validate([
            'payment'  => ['required', 'numeric', 'gte:'.$total],
            'date'     => ['required', 'date']
        ]);

        $transaction = DB::table('transaction')->where('status', 0)->where('transaction.user_id', Auth::user()->id)->first();
        $user = Auth::user();

        $kembalian =  $request->payment - $total;

        $data = DB::table('transaction_detail')
            ->join('stock', 'transaction_detail.product_id', 'stock.id')
            ->join('transaction', 'transaction.id', 'transaction_detail.transaction_id')
            ->select('stock.nameProduct', 'transaction_detail.qty', 'stock.price', 'transaction_detail.product_id', 'transaction.date')
            ->where('transaction.status', '=', '0')
            ->where('transaction.user_id', Auth::user()->id)
            ->orderby('transaction_detail.product_id')
            ->get();    

        transaction::where('status', 0)->where('transaction.user_id', Auth::user()->id)->update([
            'pay'=>$request->payment,
            'status'=>1,
            'date'=>$request->date
        ]);

        $transaction = DB::table('transaction')->where('status', 1)->where('transaction.user_id', Auth::user()->id)->latest()->first();

        $total = 0;

        foreach($data as $list){
            $total +=  $list->qty * $list->price;
        }

        return view('transactionend', ['transaction' => $transaction, 'data'=>$data, 'totalPrice'=>$total]);
    }
}
