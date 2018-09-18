@extends('layouts.app-admin')

@section('css-lessstyle')
<link rel="stylesheet" href="{{asset('js/lib/iziModal-master/css/iziModal.min.css')}}">
@stop

@section('css-afterstyle')
<style>
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
</style>
@stop

@section('content')
<!-- Bread crumb -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Product Images</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
            <li class="breadcrumb-item">Product</li>
            <li class="breadcrumb-item active">Image</li>
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
              <div class="card-title">
                  <h4>Table Product Images </h4>

              </div>
              <div class="button-action">
                <ul class="list-inline">
                  <li class="list-inline-item"><button class="btn btn-primary trigger" data-iziModal-open="#modal-add">Create Size</button></li>
                </ul>
              </div>
              <div class="card-body" style="margin-left:20px;margin-right:20px;">
                <div class="table-responsive m-t-40">
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
                                      <button class="btn btn-success trigger" data-iziModal-open="#modal-edit" onclick="edit({{$value->id}}, {{$value->id_product}},'{{$value->name}}','{{$value->status}}')">
                                        <i class="fa fa-edit"></i> Edit
                                      </button>
                                    </div>
                                    <div class="action">
                                      <form method="post" action="{{url('admin/size/delete')}}">
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
        </div>
    </div>
    <!-- End PAge Content -->
</div>
<!-- End Container fluid  -->

<!-- modal -->
<div id="modal-add" class="iziModal" data-izimodal-title="Create Size" data-izimodal-subtitle="create kategori">

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

<div id="modal-edit" class="iziModal" data-izimodal-title="Edit Size" data-izimodal-subtitle="edit kategori">

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
<script src="{{asset('js/lib/iziModal-master/js/iziModal.min.js')}}" type="text/javascript"></script>
<script>
$(document).ready(function(){
  $(".iziModal").iziModal({
   width: 700,
   radius: 5,
   padding: 20,
   loop: true
 });

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
