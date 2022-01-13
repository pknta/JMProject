<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';
    protected $guraded = [];

    public function transactionDetails(){
        return $this->hasMany(transaction_detail::class);
    }

    public function users(){
        return $this->belongsTo(users::class);
    }
}
