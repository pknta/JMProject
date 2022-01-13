<?php

namespace App\Http\Controllers;

use App\Models\transaction_detail;
use App\Models\transaction;
use App\Models\stock;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function upload(Request $request)
    {
        if($request->hasFile('image')){
            $filename = $request->image->getClientOriginalName();
            $request->image->storeAs('images',$filename,'public');
            Auth()->user()->update(['image'=>$filename]);
        }
        return redirect()->back();
    }

    public function editprofile(){
        return view('editprofile');
    }

    public function viewHistory(){
        $transaction = transaction::where('status', 1)->where('user_id', Auth::user()->id)->orderby('id')->get();
        return view('transaction_history', ['transactions' => $transaction]);
    }

    public function viewTransaction(){

        $data = DB::table('transaction_detail')
                    ->join('stock', 'transaction_detail.product_id', 'stock.id')
                    ->join('transaction', 'transaction.id', 'transaction_detail.transaction_id')
                    ->select('stock.nameProduct', 'transaction_detail.qty', 'stock.price', 'transaction_detail.product_id')
                    ->where('transaction.status', '=', '0')
                    ->where('transaction.user_id', Auth::user()->id)
                    ->orderby('transaction_detail.product_id')
                    ->get();

        if(!$data->first()){
            return redirect()->route('stocklist');
        }

        $total = 0;

        foreach($data as $list){
            $total +=  $list->qty * $list->price;
        }

        $transaction = transaction::where('status', 0)->where('user_id', Auth::user()->id)->first();

        return view('transaction', ['data' => $data, 'transaction' => $transaction, 'totalPrice' => $total]);
    }

    public function getStock(){
        $stock = DB::table('stock')
                ->get();

        $data = DB::table('transaction_detail')
                    ->join('stock', 'transaction_detail.product_id', 'stock.id')
                    ->join('transaction', 'transaction.id', 'transaction_detail.transaction_id')
                    ->select('stock.nameProduct', 'transaction_detail.qty', 'stock.price', 'transaction_detail.product_id')
                    ->where('transaction.status', '=', '0')
                    ->where('transaction.user_id', Auth::user()->id)
                    ->orderby('transaction_detail.product_id')
                    ->get();

        $total = 0;

        foreach($data as $list){
            $total +=  $list->qty * $list->price;
        }

        return view('home', ['stock' => $stock, 'data' => $data, 'total'=>$total]);
    }

    public function addTransaction(Request $request){
        $request->validate([
            'id'       => ['required'],
            'quantity' => ['required', 'gte:1']
        ]);

        $transaction = transaction::where('status', 0)->where('user_id', Auth::user()->id)->first();

        if(!$transaction){
            $transaction = new transaction;
            $transaction->user_id = Auth::user()->id;
            $transaction->pay = 0;
            $transaction->status = 0;
            $transaction->date = Carbon::now();
            $transaction->save();
        }

        $transaction = transaction::where('status', 0)->where('user_id', Auth::user()->id)->first();

        $details = DB::table('transaction_detail')
                       ->where('transaction_id', $transaction->id)
                       ->where('product_id', $request->id)
                       ->first();

        if($details){
            transaction_detail::where('transaction_id', $transaction->id)->where('product_id', $request->id)->increment('qty', $request->quantity);
        }
        else{
            $details = new transaction_detail;
            $details->transaction_id = $transaction->id;
            $details->product_id = $request->id;
            $details->qty = $request->quantity;
            $details->save();
        }

        return redirect()->route('stocklist');
    }

    public function updateTransaction(Request $request, $prodid){
        $request->validate([
            'quantity' => ['required', 'gte:1']
        ]);

        $transaction = transaction::where('status', 0)->where('user_id', Auth::user()->id)->first();

        transaction_detail::where('transaction_id', $transaction->id)->where('product_id', $prodid)->update(['qty'=>$request->quantity]);

        return redirect()->route('stocklist');
    }

    public function delete($productid){
        $transaction = transaction::where('status', 0)->where('user_id', Auth::user()->id)->first();
        DB::table('transaction_detail')->where('product_id', $productid)->where('transaction_id', $transaction->id)->delete();

        return redirect()->route('stocklist');
    }
}
