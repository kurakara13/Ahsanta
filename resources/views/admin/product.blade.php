@extends('layouts.app-admin')

@section('css-lessstyle')
<link rel="stylesheet" href="{{asset('js/lib/iziModal-master/css/iziModal.min.css')}}">
@stop

@section('content')
<!-- Bread crumb -->
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-primary">Product</h3> </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
            <li class="breadcrumb-item active">Product</li>
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
                  <h4>Table Product </h4>

              </div>
              <div class="button-action">
                <ul class="list-inline">
                  <li class="list-inline-item"><a href="{{url('admin/product/add')}}"><button class="btn btn-primary">Create Product</button></a></li>
                </ul>
              </div>
              <div class="card-body" style="margin-left:20px;margin-right:20px;">
                <div class="table-responsive m-t-40">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center" style="width:80px">No</th>
                                <th>Promotion Name</th>
                                <th>Min Order</th>
                                <th>Min Price</th>
                                <th class="text-center">Type</th>
                                <th>Ammount</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" style="width:150px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($promotion as $key=>$value)
                            <tr>
                                <td class="text-center">{{++$key}}</td>
                                <td>{{$value->name}}</td>
                                <td class="text-center">{{$value->minimum_order}}</td>
                                <td>IDR {{$value->minimum_price}}</td>
                                <td>{{strtoupper($value->type)}}</td>
                                <td>
                                  @if($value->type == 'percent')
                                    {{$value->ammount}} %
                                  @elseif($value->type == 'get item')
                                    {{$value->ammount}} Item
                                  @elseif($value->type == 'price')
                                    IDR {{$value->ammount}}
                                  @endif
                                </td>
                                <td class="text-center">{{strtoupper($value->status)}}</td>
                                <td class="text-center">
                                  <ul class="list-inline">
                                    <li class="list-inline-item">
                                      <button class="btn btn-success trigger" data-iziModal-open="#modal-edit" onclick="edit({{$value->id}},{{$value->minimum_order}},'{{$value->minimum_price}}',{{$value->ammount}},'{{$value->type}}','{{$value->name}}','{{$value->status}}')">
                                        <i class="fa fa-edit"></i>
                                      </button>
                                    </li>
                                    <li class="list-inline-item">
                                      <form method="post" action="{{url('admin/promotion/delete')}}">
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

 $(".type-change").change(function(){
   var type = $(this).val();
   if(type == "get item"){
     $(".icon-item").removeClass('hidden');
     $(".icon-idr").addClass('hidden');
     $(".icon-percent").addClass('hidden');
   }else if (type == "price") {
     $(".icon-item").addClass('hidden');
     $(".icon-idr").removeClass('hidden');
     $(".icon-percent").addClass('hidden');
   }else if (type == "percent") {
     $(".icon-item").addClass('hidden');
     $(".icon-idr").addClass('hidden');
     $(".icon-percent").removeClass('hidden');
   }
 });
});

function edit(id,minimum_order,minimum_price,ammount,type,name,status){
  $("#name").val(name);
  $("#minimum_order").val(minimum_order);
  $("#minimum_price").val(minimum_price);
  $("#ammount").val(ammount);
  $("#type-create-edit").val(type);
  $("#status").val(status);
  $("#id").val(id);

  if(type == "get item"){
    $(".icon-item").removeClass('hidden');
    $(".icon-idr").addClass('hidden');
    $(".icon-percent").addClass('hidden');
  }else if (type == "price") {
    $(".icon-item").addClass('hidden');
    $(".icon-idr").removeClass('hidden');
    $(".icon-percent").addClass('hidden');
  }else if (type == "percent") {
    $(".icon-item").addClass('hidden');
    $(".icon-idr").addClass('hidden');
    $(".icon-percent").removeClass('hidden');
  }
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
