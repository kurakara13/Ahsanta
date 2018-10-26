<?php

namespace App\Http\Controllers\Promotion;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Promotion;

class PromotionController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth:admin');
  }

  // Begin Promotion

  public function index(){

    $promotion = Promotion::all();

    return view('admin.promotion',['promotion' => $promotion]);
  }

  public function promotion_add($request){
    // dd($request);

    $promotion = new Promotion;
    $promotion->name = $request->name;
    $promotion->type = $request->type;
    $promotion->ammount = $request->ammount;
    $promotion->minimum_order = $request->minimum_order;
    $promotion->minimum_price = $request->minimum_price;
    $promotion->status = $request->status;

    $promotion->save();

    alert()->success('Success Add New Promotion', 'Successfully');
    return redirect('admin/promotion');
  }

  public function promotion_edit($request){
    // dd($request);

    $promotion = Promotion::find($request->id);
    $promotion->name = $request->name;
    $promotion->type = $request->type;
    $promotion->ammount = $request->ammount;
    $promotion->minimum_order = $request->minimum_order;
    $promotion->minimum_price = $request->minimum_price;
    $promotion->status = $request->status;

    $promotion->save();

    alert()->success('Success Change Promotion', 'Successfully');
    return redirect('admin/promotion');
  }

  public function promotion_delete($request){

    $promotion = Promotion::find($request->id);
    if($promotion->product_use != 0){
      alert()->warning('Promotion Contain '.$promotion->product_use.' Product', 'Warning');
    }else {
      $promotion->delete();
      alert()->success('Success Delete Promotion', 'Successfully');
    }

    return redirect('admin/promotion');
  }

  // End Promotion

}
