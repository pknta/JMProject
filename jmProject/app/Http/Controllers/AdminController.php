<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\transaction;
use App\Models\User;

class AdminController extends Controller
{
    public function manage_user(){
        $users = DB::table('users')->where('id', '<>', Auth::user()->id)->get();

        return view('manageuser', ['users'=>$users]);
    }

    public function delete_user($user_id){
        if($user_id == Auth::user()->id){
            return redirect()->route('user.manage');
        }

        DB::table('users')->where('id', $user_id)->delete();

        return redirect()->route('user.view');
    }

    public function view_user_history($staff_id){
        $transaction = transaction::where('status', 1)->where('user_id', $staff_id)->orderby('id')->get();
        $staff = User::where('id', $staff_id)->first();
        return view('transaction_history', ['transactions' => $transaction, 'staff'=>$staff]);
    }
}
