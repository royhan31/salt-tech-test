<?php

namespace App\Http\Repositories;

use App\Models\Order;
use Auth;

interface OrderInterface {
    public function storeBalance(array $data);
    public function storeProduct(array $data);
    public function update($order);
    public function search($val);
    public function all();
}

class OrderRepository implements OrderInterface
{

  function __construct(Order $order)
  {
    $this->order = $order;
    $this->generateOrderNumber =  hexdec(substr(uniqid(),0,8));
    $this->generateShippingCode =  strtoupper(substr(uniqid(),0,8));
  }

  public function all(){
    return $this->order->where('user_id', Auth::user()->id)->orderBy('created_at','DESC')->paginate(20);
  }

  public function storeBalance(array $data){
    return $this->order->create([
            'order_number' => $this->generateOrderNumber,
            'balance_id' => $data['id'],
            'user_id' => Auth::user()->id
        ]);
  }

  public function storeProduct(array $data){
    return $this->order->create([
            'order_number' => $this->generateOrderNumber,
            'product_id' => $data['id'],
            'user_id' => Auth::user()->id
        ]);
  }

  public function update($order){
    if($order->product){
      $order->product->update(['shipping_code' => $this->generateShippingCode]);
    }

    return $order->update(['status' => true]);
  }

  public function search($val){
    $like = 'like';
    if(config('app.env') === 'production') {
      $like = 'ilike';
    }

    return $this->order->where('order_number', $like,'%'.$val.'%')->orderBy('created_at','DESC')->paginate(20);
  }

}
