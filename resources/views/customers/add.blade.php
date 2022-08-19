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

    <!-- include summernote css/js -->
    <link href="/asset/summernote-0.8.18-dist/summernote.min.css" rel="stylesheet">
    <script src="/asset/summernote-0.8.18-dist/summernote.min.js"></script>
    <style>
        .note-group-image-url {
            display: none;
        }
    </style>
    <style type="text/css">
        #table-2 {
            border: 1px solid #e3e3e3;
            background-color: #66A3FF;
                width: 874px;
            border-radius: 6px;
            -webkit-border-radius: 6px;
            -moz-border-radius: 6px;
        }
        #table-2 td, #table-2 th {
            padding: 5px;
            color: #333;
        }
         #table-2 th {
            padding: 5px;
            color: #ffffff;
        }
        #table-2 thead {
            font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
            padding: .2em 0 .2em .5em;
            text-align: left;
            color: #4B4B4B;
            background-color: #2EB8E6;
            background-image: -webkit-gradient(linear, left top, left bottom, from(#f2f2f2), to(#e3e3e3), color-stop(.6,#B3B3B3));
            background-image: -moz-linear-gradient(top, #D6D6D6, #B0B0B0, #B3B3B3 90%);
            border-bottom: solid 1px #999;
        }
        #table-2 th {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #00248F;
            font-size: 17px;
            line-height: 20px;
            font-style: normal;
            font-weight: normal;
            text-align: center;
            text-shadow: white 1px 1px 1px;
        }
        #table-2 td {
            line-height: 20px;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #B2D1FF;
            font-size: 14px;
            border-bottom: 1px solid #fff;
            border-top: 1px solid #fff;
        }


        }
        </style>
@endsection

@section('page_content')
    <div class="right_col" role="main">
        <div class="">

            <div class="clearfix"></div>

            <div class="row">
                <div class="col-md-12 col-sm-12 ">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>รายชื่อลูกค้า<small>กรุณากรอกข้อมูล</small></h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <!-- start form for validation -->
                            <form id="form-post" name="form-post" action="/{{ $doc_type }}/save" data-parsley-validate
                                enctype="multipart/form-data" method="POST">
                                @csrf
                                <input type="hidden" id="unid" name="unid" value="" />
                                <input type="hidden" id="doc_type" name="doc_type" value="{{ $doc_type }}" />

                                <div class="col-md-12 col-sm-12 ">
                                    <label for="cus_list">รายละเอียด  :</label>

                                    <textarea class="form-control" id="cus_list" name="cus_list" rows="5" placeholder="รายละเอียด" required></textarea>

                                </div>


                                <div class="col-md-12 col-sm-12 mt-2">

                                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>
                                    บันทึกข้อมูล</button>
                                </div>
                            </form>
                            <!-- end form for validations -->

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
        $(document).ready(function() {
            $('#cus_list').summernote({
                height: 550,
            });

        });
    </script>
@endsection
