<?php

namespace App\Http\Repositories;

use App\Models\Balance;
use Auth;

interface BalanceInterface{
    public function store(array $data);
}

class BalanceRepository implements BalanceInterface
{

  function __construct(Balance $balance)
  {
      $this->balance = $balance;
  }

  public function store(array $data){
    return $this->balance->create([
            'mobile_number' => $data['mobile_number'],
            'value' => $data['value']
        ]);
  }
}
