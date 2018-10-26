<?php

namespace App\Http\Controllers\Size;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sizes;

class SizeController extends Controller
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
  // Begin Size

  public function index(){

    $size = Sizes::all();

    return view('admin.size',['size' => $size]);
  }

  public function size_add($request){
    // dd($request);

    $size = new Sizes;
    $size->name = $request->name;
    $size->status = $request->status;

    $size->save();

    alert()->success('Success Add New Size', 'Successfully');
    return redirect('admin/size');
  }

  public function size_edit($request){
    // dd($request);

    $size = Sizes::find($request->id);
    $size->name = $request->name;
    $size->status = $request->status;

    $size->save();

    alert()->success('Success Change Size', 'Successfully');
    return redirect('admin/size');
  }

  public function size_delete($request){
    // dd($request);

    $size = Sizes::find($request->id);
    $size->delete();

    alert()->success('Success Delete Size', 'Successfully');
    return redirect('admin/size');
  }

  // End Size

}
