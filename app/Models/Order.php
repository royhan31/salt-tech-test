<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'order_number';

    public $incrementing = false;

    protected $guarded = [];


    public function balance(){
      return $this->belongsTo(Balance::class);
    }

    public function product(){
      return $this->belongsTo(Product::class);
    }

    public function balanceTotal(){
      return 'Rp. '.number_format($this->balance->value + ($this->balance->value * 5/100), 0,',','.');
    }

    public function productTotal(){
      return 'Rp. '.number_format($this->product->price + 10000, 0,',','.');
    }
}
