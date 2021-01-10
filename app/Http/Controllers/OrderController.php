<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Repositories\OrderRepository;
use App\Http\Resources\OrderResource;
use Carbon\Carbon;

class OrderController extends Controller
{
  public function __construct(Order $order){
    $this->middleware('auth');
    $this->order = new OrderRepository($order);
  }

  public function index(){
    $orders = $this->order->all();
    return view('home.order-history', compact('orders'));
  }

  public function show(Order $order){
    $message = $this->getMessage($order);
    return view('home.order', compact('order','message'));
  }

  public function pay(Order $order){
    if($order->status !== null){
      return redirect()->route('order');
    }
    return view('home.order-pay', compact('order'));
  }

  public function update(Order $order){
    if($this->rangeTime()){
      $this->order->update($order);
      return redirect()->route('order')->with('success', $order->balance ? 'Balance is successfully paid' : ' Product is successfully paid');
    }

    return back()->with('errors', 'Please pay with time 09:00 AM to 05:00 PM');
  }

  public function search(Request $request){
    $orders = $this->order->search($request->val);
    return view('home.order-history', compact('orders'));
  }

  public function rangeTime(){
    $now = Carbon::now();

    $start = Carbon::createFromTimeString('09:00');
    $end = Carbon::createFromTimeString('17:00');

    return $now->between($start, $end);
  }

  public function getMessage($order){

    if($order->balance){
      return '<p>Your mobile phone number <b>'.$order->balance->mobile_number.'</b> will receive
      <b>'.$order->balance->valueIdr().'</b></p>';
    }else {
      return '<p><b>'.$order->product->product_name.'</b> that costs
      <b>'.$order->product->priceIdr().'</b> will be shipped to : </p>
      <p><b>'.$order->product->shipping_address.'</b></p>
      <p>only after you pay</p>';
    }
  }
}
