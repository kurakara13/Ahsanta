<?php

namespace App\Http\Controllers\Tag;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tags;

class TagController extends Controller
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

    // Begin Tag

    public function index(){

      $tag = Tags::all();

      return view('admin.tag',['tag' => $tag]);
    }

    public function tag_add($request){
      // dd($request);

      $tag = new Tags;
      $tag->name = $request->name;
      $tag->status = $request->status;

      $tag->save();

      alert()->success('Success Add New Tag', 'Successfully');
      return redirect('admin/tag');
    }

    public function tag_edit($request){
      // dd($request);

      $tag = Tags::find($request->id);
      $tag->name = $request->name;
      $tag->status = $request->status;

      $tag->save();

      alert()->success('Success Change Tag', 'Successfully');
      return redirect('admin/tag');
    }

    public function tag_delete(Request $request){

      $tag = Tags::find($request->id);
      $tag->delete();

      Alert::success('Success Delete Tag', 'Success Message');
      return redirect('admin/tag');
    }

    // End Tag

}
