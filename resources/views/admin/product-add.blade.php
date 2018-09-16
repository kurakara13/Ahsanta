@extends('layouts.app-admin')

@section('css-lessstyle')
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

.uploader {
    float: left;
    margin-left: 20px;
    margin-top: 10px;
    overflow:hidden;
    width: 235px;
    height: 165px;
    background: #f3f3f3;
    border: 2px solid #e8e8e8;
    border-radius: 25px;
}

.uploader-detail {
    float: left;
    margin-left: 8px;
    margin-top: 10px;
    overflow:hidden;
    width: 200px;
    height: 165px;
    background: #f3f3f3;
    border: 2px solid #e8e8e8;
    border-radius: 25px;
}

.filePhoto{
    position:relative;
    width: 231px;
    height: 160px;
    top: -160px;
    left: 0px;
    z-index:2;
    opacity:0;
    cursor:pointer;
}

.uploader-detail img{
    /* position:absolute; */
    width: 190px;
    height: 155px;
    z-index: 1;
    border: none;
    margin-top: 3px;
    margin-left: 3px;
    border-radius: 25px;
}

.uploader img{
    /* position:absolute; */
    width: 225px;
    height: 155px;
    z-index: 1;
    border: none;
    margin-top: 3px;
    margin-left: 3px;
    border-radius: 25px;
}

.btn-delete{
  position: relative;
  top: -260px;
  left: 65px;
  background: none;
  color: white;
  border: 2px solid white;
  /* padding: 11px; */
  z-index: 3;
}

.btn-cover{
  position: relative;
  top: -280px;
  left: 25px;
  background: none;
  color: white;
  border: 2px solid white;
  /* padding: 11px; */
  z-index: 3;
}

.btn-remove{
  margin-left: 20px;
}
</style>
@stop

@section('content')
<!-- Bread crumb -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Product Add</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
            <li class="breadcrumb-item"><a href="{{url('admin/product')}}">Product</a></li>
            <li class="breadcrumb-item active">Product Add</li>
        </ol>
    </div>
</div>
<!-- End Bread crumb -->
<!-- Container fluid  -->
<div class="container-fluid">
    <!-- Start Page Content -->
    <div class="row">
      <div class="col-lg-12">
        <div class="card card-outline-primary">
            <div class="card-header">
                <h4 class="m-b-0 text-white">Product Add</h4>
            </div>
            <div class="card-body">
              <div class="form-validation">
                <form action="{{url('admin/product/add')}}" method="post" class="form-valide" style="margin:20px">
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-body" id="form-body-product">
                        <h3 class="card-title m-t-15">Product Info</h3>
                        <hr>
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="row p-t-20">
                                <div class="col-md-12">
                                  <div class="form-group" style="display:block">
                                      <label class="control-label" for="val-product-name">Product Name <span class="text-danger">*</span></label>
                                      <div class="input-validat">
                                        <input type="text" class="form-control" id="val-product-name" name="val-product-name" placeholder="Enter a product name..">
                                      </div>
                                  </div>
                                </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group" style="display:block">
                                    <label class="control-label" for="val-price">Price <span class="text-danger">*</span></label>
                                    <div class="input-validat">
                                      <input type="text" class="form-control" id="val-price" name="val-price">
                                    </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group" style="display:block">
                                    <label class="control-label" for="val-promo">Promotion <span class="text-danger">*</span></label>
                                    <div class="input-validat">
                                      <select class="form-control" id="val-promo" name="val-promo">
                                        <option value="">-Select Promotion-</option>
                                        @foreach($promotion as $key)
                                          <option value="{{$key->id}}">{{$key->name}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group" style="display:block">
                                    <label class="control-label" for="val-weight">Weight <span class="text-danger">*</span></label>
                                    <div class="input-validat">
                                      <input type="text" class="form-control" id="val-weight" name="val-weight">
                                    </div>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group" style="display:block">
                                    <label class="control-label" for="val-stok">Stok <span class="text-danger">*</span></label>
                                    <div class="input-validat">
                                      <input type="text" class="form-control" id="val-stok" name="val-stok">
                                    </div>
                                </div>
                              </div>
                            </div>
                            <!--/row-->
                            <div class="row">
                              <div class="col-md-12">
                                  <div class="form-group">
                                      <label class="control-label">Category</label>
                                      <select class="js-example-basic-multiple form-control" name="category[]" multiple="multiple">
                                        @foreach($category as $key)
                                          <option value="{{$key->id}}">{{$key->name}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                              </div>
                            </div>
                            <div class="row">
                                <!--/span-->
                                <div class="col-md-12">
                                  <div class="form-group">
                                      <label class="control-label">Tags</label>
                                      <select class="js-example-basic-multiple form-control" name="tags[]" multiple="multiple">
                                        @foreach($tag as $key)
                                          <option value="{{$key->id}}">{{$key->name}}</option>
                                        @endforeach
                                      </select>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="row p-t-20">
                                <div class="col-md-12">
                                  <div class="form-group" style="display:block">
                                      <label class="control-label" for="val-detail">Product Color <span class="text-danger">*</span></label>
                                      <hr>
                                      <div class="input-validat">
                                        <div class="row">
                                          <div class="col-sm-3">
                                            <label class="control-label" for="val-detail">All Color</label>
                                            <label class="switch">
                                              <input type="checkbox">
                                              <span class="slider round"></span>
                                            </label>
                                          </div>
                                          <div class="col-sm-3">
                                            <label class="control-label" for="val-detail">No Color</label>
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
                                            <label class="control-label" for="val-detail">{{$key->name}}</label>
                                            <label class="switch">
                                              <input type="checkbox color-input" value="{{$key->name}}" name="color[]">
                                              <span class="slider round"></span>
                                            </label>
                                          </div>
                                          @endforeach
                                        </div>
                                      </div>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group" style="display:block">
                                      <label class="control-label" for="val-detail">Product Size <span class="text-danger">*</span></label>
                                      <hr>
                                      <div class="input-validat">
                                        <div class="row">
                                          <div class="col-sm-3">
                                            <label class="control-label" for="val-detail">All Size</label>
                                            <label class="switch">
                                              <input type="checkbox">
                                              <span class="slider round"></span>
                                            </label>
                                          </div>
                                          <div class="col-sm-3">
                                            <label class="control-label" for="val-detail">No Size</label>
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
                                            <label class="control-label" for="val-detail">{{$key->name}}</label>
                                            <label class="switch">
                                              <input type="checkbox size-input" name="size[]" value="{{$key->name}}">
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
                        <div class="image" id="image" style="    margin-bottom: 40px;">
                          <h3 class="box-title m-t-40 number">Product Image</h3>
                          <hr>
                          <div class="row">
                            <div class="col-md-12 ">
                              <div class="nopadding col-sm-12 images-space">
                                <br>
                                <b style="margin-left:15px">Photo</b> (Max 1 mb per image)
                                <br>
                                <div class="col-sm-12 images-upload">
                                  <div class="uploader">
                                      <img class="img" src="{{asset('assets-admin/images/add.png')}}"/>
                                      <input type="file" name="userprofile_picture[]" class="filePhoto"  id="filePhoto"/>
                                      <button type="button" class="btn  btn-cover last hidden"><i class="fa fa-image"></i> Make Cover Photo</button>
                                      <button type="button" class="btn  btn-delete last hidden"><i class="fa fa-trash"></i> Delete</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="product-detail" id="product-detail" style="    margin-bottom: 40px;">
                          <h3 class="box-title m-t-40 number">Product Detail</h3>
                          <hr>
                          <div class="row">
                            <div class="col-md-12 ">
                              <textarea id="textarea-froala" style="min-height:300px"></textarea>
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
        </div>
      </div>
    </div>
    <!-- End PAge Content -->
</div>
<!-- End Container fluid  -->
@stop

@section('script-lesscustom')
<!-- Form validation -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<!-- Include Editor JS files. -->
<script type="text/javascript" src="{{asset('assets-admin/js/lib/froala-editor/js/froala_editor.pkgd.min.js')}}"></script>

@stop

@section('script-aftercustom')
<script>
var image = $('#image .images-space .images-upload .uploader').clone()

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

$(document).ready(function() {
  $('.js-example-basic-multiple').select2();
});

$(document).on('change', '.filePhoto', function(e) {
  var fileUpload = $(this);
  var img = $(this).siblings('.img');
  var btn_cover = $(this).siblings('.btn-cover');
  var btn_delete = $(this).siblings('.btn-delete');
  var reader = new FileReader();
  var imageContainer = $(this).parent().parent();
  reader.onload = function (event) {

          img.attr('src',event.target.result);
          imageContainer.append(image.clone());
  }
  reader.readAsDataURL(e.target.files[0]);

  btn_cover.removeClass('hidden');
  btn_cover.removeClass('last');
  btn_delete.removeClass('hidden');
  btn_delete.removeClass('last');

});

$('#image .images-space').on('click', '.btn-delete', function(event) {

  let uploader = $(this).parents('.uploader');
  let img = $(this).closest(".uploader").find(".img");
  console.log("image element", img);

      console.log('sukses');
      uploader.detach().remove();
});
</script>
@stop
