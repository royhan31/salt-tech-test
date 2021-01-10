<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Balance extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function valueIdr(){
      return 'Rp. '.number_format($this->value, 0,',','.');
    }


}
