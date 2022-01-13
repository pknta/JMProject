<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transaction_detail extends Model
{
    use HasFactory;

    protected $table = 'transaction_detail';
    protected $guraded = [];
    public $timestamps = false;

    public function stocks(){
        return $this->belongsTo(stock::class, 'product_id');
    }

    public function transactions(){
        return $this->belongsTo(transaction::class, 'transaction_id');
    }
}
