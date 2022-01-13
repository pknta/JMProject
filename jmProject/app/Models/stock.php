<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock extends Model
{

    use HasFactory;

    protected $table = 'stock';
    protected $guraded = [];

    public function transactionDetails(){
        return $this->hasMany(transaction_detail::class);
    }

}
