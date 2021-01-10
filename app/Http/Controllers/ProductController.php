<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Http\Repositories\ProductRepository;
use App\Http\Repositories\OrderRepository;
use App\Http\Requests\ProductRequest;
use DB;

class ProductController extends Controller
{
  public function __construct(Product $product, Order $order){
    $this->middleware('auth');
    $this->product = new ProductRepository($product);
    $this->order = new OrderRepository($order);
  }

  public function index(){
    return view('home.product');
  }

  public function store(ProductRequest $request){

    DB::beginTransaction();

    try {
      $product = $this->product->store($request->all());
      $order = $this->order->storeProduct($product->toArray());

      DB::commit();
    } catch (\Exception $e) {
        DB::rollback();
        return back()->with('errors', 'Please try again');
    }

    $order->jobCancelOrder();
    return redirect()->route('order.show', $order);
  }
}
