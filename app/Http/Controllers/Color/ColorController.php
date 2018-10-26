<?php

namespace App\Http\Controllers\Color;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Colors;

class ColorController extends Controller
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

  public function index(){

    $color = Colors::all();

    return view('admin.color.index',['color' => $color]);
  }

  public function store(Request $request){
    // dd($request);

    $color = new Colors;
    $color->name = $request->name;
    $color->status = $request->status;

    $color->save();

    alert()->success('Success Add New Color', 'Successfully');
    return redirect()->route('color.index');
  }

  public function create(){


  }

  public function update(Request $request, $id){

    $color = Colors::find($id);
    $color->name = $request->name;
    $color->status = $request->status;

    $color->save();

    alert()->success('Success Change Color', 'Successfully');
    return redirect()->route('color.index');
  }

  public function destroy($id){

    $color = Colors::find($id);
    $color->delete();

    alert()->success('Success Delete Color', 'Successfully');
    return redirect()->route('color.index');
  }

  public function show(){


  }

  public function edit(){


  }

}
