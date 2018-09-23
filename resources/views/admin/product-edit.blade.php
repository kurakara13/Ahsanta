@extends('layouts.app-admin')

@section('css-lessstyle')
<link href="{{asset('js/lib/iziModal-master/css/iziModal.min.css')}}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<link href="{{asset('assets-admin/js/lib/froala-editor/css/froala_editor.pkgd.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets-admin/js/lib/froala-editor/css/froala_style.min.css')}}" rel="stylesheet" type="text/css" />
@stop

@section('css-afterstyle')
<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

.action{
  margin-bottom: 10px
}

.uploader {
  overflow: hidden;
  width: 100%;
  height: 300px;
  border: 1px solid #ced4da;
  border-radius: 0;
  box-shadow: none;
  border-color: #e7e7e7;
}

.uploader img{
  /* position: relative; */
  width: 100%;
  height: 290px;
  z-index: 1;
  border: none;
  margin-top: 3px;
  margin-left: 3px;
  border-radius: 25px;
  /* left: 140px; */
  padding-right: 20%;
  padding-left: 20%;
  border-radius: 25px;
}

.filePhoto{
    position:relative;
    width: 100%;
    height: 100%;
    top: -301px;
    left: 0px;
    z-index:2;
    opacity:0;
    cursor:pointer;
}

.select2-container--default .select2-selection--multiple {
    /* background-color: white; */
    border: 1px solid #aaa;
    /* border-radius: 4px; */
    cursor: text;
    border-radius: 0;
    box-shadow: none;
    border-color: #e7e7e7;
    font-family: 'Poppins', sans-serif;
}
</style>
@stop

@section('content')
<!-- Bread crumb -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Product Edit</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
            <li class="breadcrumb-item">Product</li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </div>
</div>
<!-- End Bread crumb -->
<!-- Container fluid  -->
<div class="container-fluid">
    <!-- Start Page Content -->
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body p-b-0">
                <h4 class="card-title">Product Edit</h4>
                <!-- Nav tabs -->
                <ul class="nav nav-tabs customtab" role="tablist">
                    <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#detail" role="tab"><span class="hidden-sm-up"><i class="ti-home"></i></span> <span class="hidden-xs-down">Detail</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#image" role="tab"><span class="hidden-sm-up"><i class="ti-user"></i></span> <span class="hidden-xs-down">Image</span></a> </li>
                    <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#review" role="tab"><span class="hidden-sm-up"><i class="ti-email"></i></span> <span class="hidden-xs-down">Review</span></a> </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="detail" role="tabpanel">
                        <div class="p-20">
                            <form action="{{url('admin/product/editProduct')}}" method="post" class="form-valide" enctype="multipart/form-data" style="margin:20px">
                              <input type="hidden" name="_token" value="{{ csrf_token() }}">
                              <input type="hidden" name="id" value="{{$product->id}}">
                                <div class="form-body" id="form-body-product">
                                    <h3 class="card-title m-t-15">Product Detail</h3>
                                    <hr>
                                    <div class="row">
                                      <div class="col-sm-12">
                                        <div class="row p-t-20">
                                            <div class="col-md-12">
                                              <div class="form-group" style="display:block">
                                                  <label class="control-label" for="name">Product Name <span class="text-danger">*</span></label>
                                                  <div class="input-validat">
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter a product name.." value="{{$product->name}}" required>
                                                  </div>
                                              </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="row">
                                          <div class="col-md-6">
                                            <div class="form-group" style="display:block">
                                                <label class="control-label" for="price">Price <span class="text-danger">*</span></label>
                                                <div class="input-validat">
                                                  <input type="text" class="form-control" id="price" name="price" value="{{$product->price}}" required>
                                                </div>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group" style="display:block">
                                                <label class="control-label" for="promo">Promotion <span class="text-danger">*</span></label>
                                                <div class="input-validat">
                                                  <select class="form-control" id="promo" name="promo" value="{{$product->id_promotion}}" selected required>
                                                    <option value="">-Select Promotion-</option>
                                                    <option value="null">No Promotion</option>
                                                    @foreach($promotion as $key)
                                                    @if($product->id_promotion == $key->id)
                                                      <?php $selected = "selected" ?>
                                                    @else
                                                      <?php $selected = "" ?>
                                                    @endif
                                                      <option value="{{$key->id}}" {{$selected}}>{{$key->name}}</option>
                                                    @endforeach
                                                  </select>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                            <!--/span-->
                                            <div class="col-md-12">
                                              <div class="form-group">
                                                <input type="hidden" id="product-tags" value="{{$product->tags}}">
                                                  <label class="control-label">Tags</label>
                                                  <select class="js-example-data-array-tags form-control" name="tags[]" multiple="multiple">
                                                  </select>
                                                </div>
                                            </div>
                                            <!--/span-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                              <div class="form-group" style="display:block">
                                                  <label class="control-label" for="color">Product Color <span class="text-danger">*</span></label>
                                                  <hr>
                                                  <div class="input-validat">
                                                    <div class="row">
                                                      <div class="col-sm-3">
                                                        <label class="control-label" for="all-color">All Color</label>
                                                        <label class="switch">
                                                          <input type="checkbox">
                                                          <span class="slider round"></span>
                                                        </label>
                                                      </div>
                                                      <div class="col-sm-3">
                                                        <label class="control-label" for="no-color">No Color</label>
                                                        <label class="switch">
                                                          <input type="checkbox">
                                                          <span class="slider round"></span>
                                                        </label>
                                                      </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                      @foreach($color as $key)
                                                      <div class="col-sm-2">
                                                        <label class="control-label" for="color">{{$key->name}}</label>
                                                        <label class="switch">
                                                          <?php
                                                            foreach (json_decode($product->color) as $keyColor) {
                                                              $cek = "";
                                                              if($keyColor == $key->name){
                                                                $cek = "checked";
                                                                break;
                                                              }else {
                                                                $cek = "";
                                                              }
                                                            }
                                                           ?>
                                                          <input type="checkbox" class="color-input" value="{{$key->name}}" name="color[]" {{$cek}}>
                                                          <span class="slider round"></span>
                                                        </label>
                                                      </div>
                                                      @endforeach
                                                    </div>
                                                  </div>
                                              </div>
                                            </div>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="row">
                                          <div class="col-md-3">
                                            <div class="form-group" style="display:block">
                                                <label class="control-label" for="weight">Weight <span class="text-danger">*</span></label>
                                                <div class="input-validat">
                                                  <input type="text" class="form-control" id="weight" value="{{$product->weight}}" name="weight">
                                                </div>
                                            </div>
                                          </div>
                                          <div class="col-md-3">
                                            <div class="form-group" style="display:block">
                                                <label class="control-label" for="stok">Stok <span class="text-danger">*</span></label>
                                                <div class="input-validat">
                                                  <input type="text" class="form-control" id="stok" value="{{$product->stock}}" name="stok">
                                                </div>
                                            </div>
                                          </div>
                                          <div class="col-md-6">
                                            <div class="form-group" style="display:block">
                                                <label class="control-label" for="stok">Status <span class="text-danger">*</span></label>
                                                <div class="input-validat">
                                                  <?php
                                                    $show = "";
                                                    $disable = "";
                                                    if($product->status == 'Show'){
                                                      $show = "selected";
                                                    }else {
                                                      $disable = "selected";
                                                    }
                                                   ?>
                                                  <select name="status" class="form-control">
                                                    <option value="">-Status Product-</option>
                                                    <option value="Show" {{$show}}>Show</option>
                                                    <option value="Disable" {{$disable}}>Disable</option>
                                                  </select>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <!--/row-->
                                        <div class="row">
                                          <div class="col-md-12">
                                              <div class="form-group">
                                                <input type="hidden" id="product-category" value="{{$product->category}}">
                                                  <label class="control-label">Category</label>
                                                  <select class="js-example-data-array-category form-control" name="category[]" multiple="multiple">
                                                  </select>
                                                </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group" style="display:block">
                                                <label class="control-label" for="size">Product Size <span class="text-danger">*</span></label>
                                                <hr>
                                                <div class="input-validat">
                                                  <div class="row">
                                                    <div class="col-sm-3">
                                                      <label class="control-label" for="all-size">All Size</label>
                                                      <label class="switch">
                                                        <input type="checkbox">
                                                        <span class="slider round"></span>
                                                      </label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                      <label class="control-label" for="no-size">No Size</label>
                                                      <label class="switch">
                                                        <input type="checkbox" name="size[]" value="nosize">
                                                        <span class="slider round"></span>
                                                      </label>
                                                    </div>
                                                  </div>
                                                  <hr>
                                                  <div class="row">
                                                    @foreach($size as $key)
                                                    <div class="col-sm-2">
                                                      <label class="control-label" for="size">{{$key->name}}</label>
                                                      <label class="switch">
                                                        <?php
                                                          foreach (json_decode($product->size) as $keySize) {
                                                            $cek = "";
                                                            if($keySize == $key->name){
                                                              $cek = "checked";
                                                              break;
                                                            }else {
                                                              $cek = "";
                                                            }
                                                          }
                                                         ?>
                                                        <input type="checkbox" class="size-input" name="size[]" value="{{$key->name}}" {{$cek}}>
                                                        <span class="slider round"></span>
                                                      </label>
                                                    </div>
                                                    @endforeach
                                                  </div>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <!--/row-->
                                    <div class="product-detail" id="product-detail" style="    margin-bottom: 40px;">
                                      <h3 class="box-title m-t-40 number">Product Description</h3>
                                      <hr>
                                      <div class="row">
                                        <div class="col-md-12 ">
                                          <textarea id="textarea-froala" name="description" style="min-height:300px">{{$product->description}}</textarea>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                    <button type="button" class="btn btn-inverse">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane  p-20" id="image" role="tabpanel">
                      <div class="p-20">
                        <h4>Table Product Images </h4>
                        <hr>
                        <div class="button-action">
                            <button class="btn btn-primary trigger" data-iziModal-open="#modal-add-image">Create Image</button>
                        </div>
                        <div class="table-responsive m-t-20">
                            <table id="myTable" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width:100px">No</th>
                                        <th>Image</th>
                                        <th class="text-center">Cover</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center" style="width:150px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($productImages as $key=>$value)
                                    <tr>
                                        <td class="text-center">{{++$key}}</td>
                                        <td>
                                          <img src="{{asset('images/product/'.$value->name)}}" width="200px" height="200px">
                                          <span style="margin-left:20px">{{substr($value->name,11)}}</span>
                                        </td>
                                        @if($value->cover == 1)
                                        <td class="text-center">Yes</td>
                                        @else
                                        <td class="text-center">No</td>
                                        @endif
                                        <td class="text-center">{{strtoupper($value->status)}}</td>
                                        <td class="text-center">
                                            <div class="action">
                                              <button class="btn btn-success trigger" data-iziModal-open="#modal-edit-image" onclick="edit({{$value->id}}, {{$value->id_product}},'{{$value->name}}','{{$value->status}}')">
                                                <i class="fa fa-edit"></i> Edit
                                              </button>
                                            </div>
                                            <div class="action">
                                              <form method="post" action="{{url('admin/product/deleteImage')}}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="id" value="{{$value->id}}">
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                                              </form>
                                            </div>
                                            @if($value->cover != 1)
                                            <div class="action">
                                              <form method="post" action="{{url('admin/product/cover')}}">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="id_product" value="{{$value->id_product}}">
                                                <input type="hidden" name="id" value="{{$value->id}}">
                                                <button type="submit" class="btn btn-primary"><i class="fa fa-image"></i> Cover</button>
                                              </form>
                                            </div>
                                            @endif
                                        </td>
                                    </tr>
                                  @endforeach
                                </tbody>
                            </table>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane p-20" id="review" role="tabpanel">3</div>
                </div>
            </div>
          </div>
        </div>
    </div>
    <!-- End PAge Content -->
</div>
<!-- End Container fluid  -->

<!-- modal -->
<div id="modal-add-image" class="iziModal" data-izimodal-title="Create Size" data-izimodal-subtitle="create kategori">

  <div class="container">
    <div class="header-modal">
      <label>Add Size</label>
    </div>
    <div class="modal-body">
      <form method="post" action="{{url('admin/size/add')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
          <div class="col-sm-8">
            <div class="uploader">
                <img class="img" src="{{asset('assets-admin/images/add.png')}}"/>
                <input type="file" name="userprofile_picture" class="filePhoto"  id="filePhoto"/>
            </div>
          </div>
          <div class="col-sm-4">
            <select name="status" class="form-control">
              <option value="">-Status Size-</option>
              <option value="Show">Show</option>
              <option value="Disable">Disable</option>
            </select>
          </div>
        </div>
        <div class="submit-btn">
          <input type="submit" class="btn btn-success" value="Add" style="float:right;margin-top:20px">
        </div>
      </form>
    </div>
  </div>
</div>

<div id="modal-edit-image" class="iziModal" data-izimodal-title="Edit Size" data-izimodal-subtitle="edit kategori">

  <div class="container">
    <div class="header-modal">
      <label>Add Size</label>
    </div>
    <div class="modal-body">
      <form method="post" action="{{url('admin/product/imageEdit')}}" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id_product" id="idProduct">
        <input type="hidden" name="id" id="id">
        <input type="hidden" name="img_change" id="imgChanged">
        <div class="row">
          <div class="uploader">
            <img class="img" id="img" src="{{asset('assets-admin/images/add.png')}}"/>
            <input type="file" name="userprofile_picture" class="filePhoto"  id="filePhoto"/>
          </div>
        </div>
        <div class="row" style="margin-top:10px">
          <select name="status" class="form-control" id="status">
            <option value="">-Status Size-</option>
            <option value="Show">Show</option>
            <option value="Disable">Disable</option>
          </select>
        </div>
        <div class="submit-btn">
          <input type="submit" class="btn btn-success" value="Add" style="float:right;margin-top:20px">
        </div>
      </form>
    </div>
  </div>
</div>
@stop

@section('script-lesscustom')
<!-- Form validation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<!-- Include Editor JS files. -->
<script type="text/javascript" src="{{asset('assets-admin/js/lib/froala-editor/js/froala_editor.pkgd.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/lib/iziModal-master/js/iziModal.min.js')}}"></script>
<script>
$(function() {
  $('#textarea-froala').froalaEditor({
    // Set custom buttons with separator between them.
    toolbarButtons: ['undo', 'redo' , '|',
                     'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', '|',
                     'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', '|', 'clearFormatting', 'insertTable', 'html'],
    toolbarButtonsXS: ['undo', 'redo' , '-', 'bold', 'italic', 'underline'],
    heightMin: 200
  })
});

$(document).ready(function(){
  $(".iziModal").iziModal({
   width: 700,
   radius: 5,
   padding: 20,
   loop: true
 });

 var dataTags = <?php echo json_encode($tagsSelect) ?>;
 var dataCategory = <?php echo json_encode($categorySelect) ?>;

$(".js-example-data-array-category").select2({
  data: dataCategory
})

$(".js-example-data-array-tags").select2({
  data: dataTags
})


 $(document).on('change', '.filePhoto', function(e) {
   var fileUpload = $(this);
   var img = $(this).siblings('.img');
   var reader = new FileReader();
   var imageContainer = $(this).parent().parent();
   reader.onload = function (event) {
           img.attr('src',event.target.result);
   }
   reader.readAsDataURL(e.target.files[0]);

 });
});

function edit(id,id_product,name,status){
  $("#img").attr('src', '{{asset('images/product/')}}/'+name);
  $("#status").val(status);
  $("#imgChanged").val(name);
  $("#id").val(id);
  $("#idProduct").val(id_product);
}
</script>
@stop

@section('script-aftercustom')
<script src="{{asset('assets-admin/js/lib/datatables/datatables.min.js')}}"></script>
<script src="{{asset('assets-admin/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('assets-admin/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('assets-admin/js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js')}}"></script>
<script src="{{asset('assets-admin/js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js')}}"></script>
<script src="{{asset('assets-admin/js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js')}}"></script>
<script src="{{asset('assets-admin/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('assets-admin/js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js')}}"></script>
<script src="{{asset('assets-admin/js/lib/datatables/datatables-init.js')}}"></script>
@stop
