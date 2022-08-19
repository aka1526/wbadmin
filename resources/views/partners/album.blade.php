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
    <link href="/asset/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
@endsection

@section('page_content')
    <div class="right_col" role="main">
        <div class="">

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>รายละเอียด<small>กรุณากรอกข้อมูล</small></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <!-- start form for validation -->
                            <form id="form-post" name="form-post" action="/{{ $datarow->doc_type }}/album/save"
                                data-parsley-validate enctype="multipart/form-data" method="POST">
                                @csrf
                                <input type="hidden" id="unid" name="unid" value="{{ $datarow->unid }}" />
                                <input type="hidden" id="doc_type" name="doc_type" value="{{ $datarow->doc_type }}" />

                                <div class="col-md-12 col-sm-12 ">
                                    <label for="new_date">วันที่ :</label>
                                    <input type="date" id="new_date" class="form-control" name="new_date"
                                        value="{{ $datarow->new_date }}" placeholder="วันที่" readonly />
                                </div>
                                <div class="col-md-12 col-sm-12 ">
                                    <label for="new_th_title">หัวข้อ(ไทย) :</label>
                                    <textarea class="form-control" id="new_th_title" name="new_th_title" rows="2" placeholder="หัวข้อ" readonly>{!! $datarow->new_th_title !!}</textarea>

                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlFile1">upload รูปกิจกรรม</label>
                                        <input type="file" class="form-control-file" id="img_thumb" name="img_thumb[]"
                                            data-show-preview="true" multiple>
                                    </div>

                                </div>


                                <br />
                                <a href="/{{ $datarow->doc_type }}" class="btn btn-secondary"> <i
                                        class="fa fa-arrow-left"></i> กลับ </a>
                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>
                                    บันทึกข้อมูล</button>

                            </form>
                            <!-- end form for validations -->

                        </div>

                    </div>
                </div>
            </div>

            @if ($dataAlbum)
                <div class="row">
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2> ประมวลภาพกิจกรรม</h2>
                                <div class="clearfix"></div>
                            </div>

                            <div class="x_content">
                                <div class="row">
                                    <!-- start form for validation -->
                                    @foreach ($dataAlbum as $key => $row)
                                        <div class="col-md-55">
                                            <div class="thumbnail">
                                                <div class="image view view-first">
                                                    <img style="width: 100%; display: block;"
                                                        src="/upload/{{ $datarow->doc_type }}/{{ $datarow->unid }}/{{ $row->img_name }}"
                                                        alt="image" />
                                                    <div class="mask">
                                                        {{-- <p>Your Text</p> --}}
                                                        <div class="tools tools-bottom">
                                                            <a href="/upload/{{ $datarow->doc_type }}/{{ $datarow->unid }}/{{ $row->img_name }}"><i class="fa fa-search-plus"></i></a>
                                                            {{-- <a href="#"><i class="fa fa-pencil"></i></a> --}}
                                                            <a href="#" class=" img-delete"
                                                                data-ref_unid="{{ $row->ref_unid }}"
                                                                data-img_unid="{{ $row->unid }}">
                                                                <i class="fa fa-times"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="caption">
                                      <p>Snow and Ice Incoming for the South</p>
                                    </div> --}}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!-- end form for validations -->

                            </div>

                        </div>
                    </div>
                </div>
            @endif
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

            init_sparklines();
            init_flot_chart();
            init_sidebar();
            init_InputMask();
            init_daterangepicker();
            init_daterangepicker_right();
            init_daterangepicker_single_call();
            init_daterangepicker_reservation();
            init_skycons();
            init_select2();
            init_PNotify();
            init_compose();
            init_CustomNotification();
            init_autosize();
            init_autocomplete();
            $('#menu_toggle').click();
        });
    </script>
    <script>
        $(document).on("click", '.img-delete', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'ยืนยันการลบข้อมูล?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var img_unid = $(this).data('img_unid');
                    var ref_unid = $(this).data('ref_unid');
                    var url = '/{{ $datarow->doc_type }}/album/delete';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            "_token": "{{ csrf_token() }}",
                            doc_type: "{{ $datarow->doc_type }}",
                            ref_unid: ref_unid,
                            img_unid: img_unid
                        },
                        success: function(data) {

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
