@extends('layouts.app-admin')

@section('css-lessstyle')
<link rel="stylesheet" href="{{asset('js/lib/iziModal-master/css/iziModal.min.css')}}">
@stop

@section('content')
<!-- Bread crumb -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Category</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
            <li class="breadcrumb-item active">Category</li>
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
                  <h4>Table Category </h4>

              </div>
              <div class="button-action">
                <ul class="list-inline">
                  <li class="list-inline-item"><button class="btn btn-primary trigger" data-iziModal-open="#modal-add">Create Category</button></li>
                </ul>
              </div>
              <div class="card-body" style="margin-left:20px;margin-right:20px;">
                <div class="table-responsive m-t-40">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:100px">No</th>
                                <th>Category Name</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" style="width:150px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($category as $key=>$value)
                            <tr>
                                <td class="text-center">{{++$key}}</td>
                                <td>{{$value->name}}</td>
                                <td class="text-center">{{strtoupper($value->status)}}</td>
                                <td class="text-center">
                                  <ul class="list-inline">
                                    <li class="list-inline-item"><button class="btn btn-success trigger" data-iziModal-open="#modal-edit" onclick="edit({{$value->id}},'{{$value->name}}','{{$value->status}}')"><i class="fa fa-edit"></i></button></li>
                                    <li class="list-inline-item">
                                      <form method="post" action="{{url('admin/category/delete')}}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="id" value="{{$value->id}}">
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                      </form>
                                    </li>
                                  </ul>
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
<div id="modal-add" class="iziModal" data-izimodal-title="Create Category" data-izimodal-subtitle="create kategori">

  <div class="container">
    <div class="header-modal">
      <label>Add Category</label>
    </div>
    <div class="modal-body">
      <form method="post" action="{{url('admin/category/add')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row">
          <div class="col-sm-8">
            <input type="text" name="name" class="form-control" placeholder="Category Name">
          </div>
          <div class="col-sm-4">
            <select name="status" class="form-control">
              <option value="">-Status Category-</option>
              <option value="active">Active</option>
              <option value="non active">Non Active</option>
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

<div id="modal-edit" class="iziModal" data-izimodal-title="Edit Category" data-izimodal-subtitle="edit kategori">

  <div class="container">
    <div class="header-modal">
      <label>Add Category</label>
    </div>
    <div class="modal-body">
      <form method="post" action="{{url('admin/category/edit')}}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" id="id">
        <div class="row">
          <div class="col-sm-8">
            <input type="text" name="name" id="name" class="form-control" placeholder="Category Name">
          </div>
          <div class="col-sm-4">
            <select name="status" class="form-control" id="status">
              <option value="">-Status Category-</option>
              <option value="active">Active</option>
              <option value="non active">Non Active</option>
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
});

function edit(id,name,status){
  $("#name").val(name);
  $("#status").val(status);
  $("#id").val(id);
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
