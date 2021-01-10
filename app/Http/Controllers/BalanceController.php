<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Balance;
use App\Models\Order;
use App\Http\Repositories\BalanceRepository;
use App\Http\Repositories\OrderRepository;
use App\Http\Requests\BalanceRequest;
use App\Jobs\CancelOrderJob;
use Carbon\Carbon;
use DB;

class BalanceController extends Controller
{
    public function __construct(Balance $balance, Order $order){
      $this->middleware('auth');
      $this->balance = new BalanceRepository($balance);
      $this->order = new OrderRepository($order);
    }

    public function index(){
      return view('home.balance');
    }

    public function store(BalanceRequest $request){

      DB::beginTransaction();

      try {
        $balance = $this->balance->store($request->all());
        $order = $this->order->storeBalance($balance->toArray());

        DB::commit();
      } catch (\Exception $e) {
          DB::rollback();
          return back()->with('errors', 'Please try again');
      }
      $delay = Carbon::now()->addMinutes(5);
      dispatch(new CancelOrderJob($order))->delay($delay);
      return redirect()->route('order.show', $order);
    }
}
