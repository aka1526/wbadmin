@extends('theme.main')
@section('herder_jscss')
<!-- Bootstrap -->
<link href="/asset/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome -->
<link href="/asset/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- NProgress -->
<link href="/asset/nprogress/nprogress.css" rel="stylesheet">
<!-- iCheck -->
<link href="/asset/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- bootstrap-wysiwyg -->
<link href="/asset/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
<!-- Select2 -->
<link href="/asset/select2/dist/css/select2.min.css" rel="stylesheet">
<!-- Switchery -->
<link href="/asset/switchery/dist/switchery.min.css" rel="stylesheet">
<!-- starrr -->
<link href="/asset/starrr/dist/starrr.css" rel="stylesheet">
<!-- bootstrap-daterangepicker -->
<link href="/asset/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

<!-- Custom Theme Style -->
<link href="/custom/css/custom.min.css" rel="stylesheet">

<!-- jQuery -->
<script src="/asset/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="/asset/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/asset/sweetalert2/dist/sweetalert2.all.min.js"></script>
<link  href="/asset/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

@endsection

@section('page_content')
    <div class="right_col" role="main">
        <div class="">

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                  <div class="x_panel">
                        <div class="x_title">
                            <h2>รายชื่อลูกค้า/ Customer List</h2>
                            <ul class="nav navbar-right panel_toolbox">
								<li>
                                    <button type="button" class="btn btn-success btn-sm"
                                    onclick="location.href='/{{$doc_type}}/add';">
                                    <i class="fa fa-plus"></i> เพิ่มข้อมูล</button>
                                </li>

							</ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            @if(session()->get('msg'))
                                <script>
                                    Swal.fire({
                                    title: 'บันทึกข้อมูลสำเร็จ!',
                                    timer: 1300,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                    }).then(() => {
                                            location.reload();
                                        });
                                 </script>
                              @endif

                            <div class="table-responsive">
                                <table class="table table-striped jambo_table bulk_action">
                                  <thead>
                                    <tr class="headings">
                                        <th class="column-title">##</th>
                                      <th class="column-title">Logo</th>
                                      <th class="column-title">ชื่อลุกค้า</th>
                                      <th class="column-title" >URL </th>
                                      <th class="column-title">สถานะ</th>
                                      <th class="column-title" width="140px">Action</th>
                                    </tr>
                                  </thead>

                                  <tbody>

                                    @foreach ($dataset as $key => $row)



                                    <tr class="even pointer">
                                        <td class="">{{ $dataset->firstItem() + $key }}</td>
                                        <td class="">
                                            @if($row->customer_logo)
                                            <img src="{{ "/upload/customer/".$row->unid.'/'.$row->customer_logo }}" width="120px" />
                                            @else
                                            <img src="/upload/nopic.png"  width="120px"  />
                                            @endif

                                        </td>

                                        <td class="">{{ $row->customer_name}}</td>
                                        <td class="">{{ $row->customer_url}}</td>
                                        <td class="">
                                            <div class="fa-hover col-md-3 col-sm-4  ">
                                            @if($row->customer_status=="Y")
                                                <i class="fa fa-toggle-on text-info fa-2x" ></i><span class="text-muted">แสดง</span>
                                            @else
                                                <i class="fa fa-toggle-off  text-dark fa-2x"  ></i> <span class="text-muted">ซ่อน</span>
                                            @endif

                                            </div>
                                        </td>
                                        <td class=" last">

                                            <a href="/customer/edit/{{$row->unid}}" class="btn btn-info btn-sm" title="แก้ไข" >แก้ไข </a>
                                            <a href="#" class="btn btn-delete btn-sm btn-danger "

                                            data-unid="{{ $row->unid}}" title="ลบข้อมูล" > ลบ </a>
                                        </td>
                                      </tr>

							    	@endforeach



                                  </tbody>
                                </table>
                                {{ $dataset->links('pagination.default',
										[
											'paginator' => $dataset,
											'link_limit' => $dataset->perPage()
										]) }}
                              </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    @endsection

    @section('footer_jscss')

	<!-- FastClick -->
	<script src="/asset/fastclick/lib/fastclick.js"></script>
	<!-- NProgress -->
	<script src="/asset/nprogress/nprogress.js"></script>
	<!-- bootstrap-progressbar -->
	<script src="/asset/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
	<!-- iCheck -->
	<script src="/asset/iCheck/icheck.min.js"></script>
	<!-- bootstrap-daterangepicker -->
	<script src="/asset/moment/min/moment.min.js"></script>
	<script src="/asset/bootstrap-daterangepicker/daterangepicker.js"></script>
	<!-- bootstrap-wysiwyg -->
	<script src="/asset/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
	<script src="/asset/jquery.hotkeys/jquery.hotkeys.js"></script>
	<script src="/asset/google-code-prettify/src/prettify.js"></script>
	<!-- jQuery Tags Input -->
	<script src="/asset/jquery.tagsinput/src/jquery.tagsinput.js"></script>
	<!-- Switchery -->
	<script src="/asset/switchery/dist/switchery.min.js"></script>
	<!-- Select2 -->
	<script src="/asset/select2/dist/js/select2.full.min.js"></script>
	<!-- Parsley -->
	<script src="/asset/parsleyjs/dist/parsley.min.js"></script>
	<!-- Autosize -->
	<script src="/asset/autosize/dist/autosize.min.js"></script>
	<!-- jQuery autocomplete -->
	<script src="/asset/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
	<!-- starrr -->
	<script src="/asset/starrr/dist/starrr.js"></script>
	<!-- Custom Theme Scripts -->
    <script src="/custom/js/app.js"></script>


 <script>
$(document).ready(function() {
    init_sidebar();
    init_skycons();
    init_compose();
    init_autosize();

    $('#menu_toggle').click();
});


$(document).on("click", '.btn-delete', function(e) {
    e.preventDefault();

    Swal.fire({
  title: 'ยืนยันการลบข้อมูล?',
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
    if(result.isConfirmed){
        var unid = $(this).data('unid');

        var url = '/Customer/delete';
        $.ajax({
                type: "POST",
                url: url,
                data:{"_token" : "{{ csrf_token() }}",
                doc_type:"customer",
                unid:unid},
                success: function(data){

                    Swal.fire({
                    title: data.msg,
                    timer: 1300,
                    icon: data.result,
                    confirmButtonText: 'OK'
                    }).then((result) => {
                        location.reload();
                    });
                }
          });
    }

});

});

 </script>
@endsection
