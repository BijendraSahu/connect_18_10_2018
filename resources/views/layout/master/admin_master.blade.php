<?php
if (!isset($_SESSION)) {
    session_start();
}
if (is_null($_SESSION['admin_master'])) {
    //echo 'Please Login';
    return redirect('/admin');
}
?>
        <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <link rel="shortcut icon" type="images/png" href="{{url('images/fav.png')}}"/>
    <link rel="stylesheet" href="{{url('css/bootstrap.css')}}"/>
    <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{url('css/materialdesignicons.min.css')}}"/>
    <link rel="stylesheet" href="{{url('css/datepicker.css')}}"/>
    <link rel="stylesheet" href="{{url('css/timepicker.css')}}"/>
    <link rel="stylesheet" href="{{url('css/Autocomplete.css')}}"/>
    <link rel="stylesheet" href="{{url('css/Dashboard.css')}}"/>
    <link rel="stylesheet" href="{{url('css/media.css')}}"/>
    <link rel="stylesheet" href="{{url('css/my.css')}}"/>
    <script src="{{url('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{url('js/bootstrap.min.js')}}"></script>
    <script src="{{url('js/Datepicker.js')}}"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script src="{{url('js/sweetalert.min.js')}}"></script>
    <script src="{{url('js/Global.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
        });
    </script>
    <style>
        .coloruser {
            color: #000000;
        }
    </style>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet" />
    <script type="text/javascript">
        function HideTranparent() {
            $('.overlay_res').fadeOut();
            $('.dash_sidemenu').removeClass('dash_sidemenu_show');
            $('body').css('overflow', 'auto');
        }
        function ResponsiveMenuClick() {

            $('.overlay_res').fadeIn();
            $('.dash_sidemenu').addClass('dash_sidemenu_show');
            $('body').css('overflow', 'hidden');
        }
        $(document).ready(function () {
            /*date Picker*/
            $('.glo_date').datepicker({
                format: 'dd-M-yyyy', autoclose: true
            }).on('changeDate', function (event) {
                if ($('#date_of_birth').val() != "") {
                    $("#date_of_birth").removeClass('vErrorRed');
                }
            });
            /*-----Time Picker-----*/
            $('.glo_timepicker').timepicker();
            /*--------Autocomplete ------*/
            $('.Glo_autocomplete').select2();
            /*----Header Tooltip--------*/
            // Tooltip jquery
            $('.grid_title').hover(function () {
                var headtxt = $(this).text();
                var left = $(this).offset().left;
                var top = $(this).offset().top;
                $('.icon_tp').css('margin', '0px');
                $('.icon_tp').show();
                $('.icon_txt').text(headtxt);
                $('.icon_tp').css("top", top - 30);
                $('.icon_tp').css("left", left);
            });
            $('.grid_title').mouseout(function () {
                $('.icon_tp').hide();
            });
        });
        function MenuClick(dis) {
            $('.dash_sub_menu').slideUp();
            $('.right_menu_li').find('i').removeClass('mdi-chevron-down');
            $('.right_menu_li').find('i').addClass('mdi-chevron-right');
            if ($(dis).find('.dash_sub_menu').is(':visible')) {
                $(dis).find('.dash_sub_menu').slideUp();
                $(dis).find('i').removeClass('mdi-chevron-down');
                $(dis).find('i').addClass('mdi-chevron-right');
            }
            else {
                $(dis).find('.dash_sub_menu').slideDown();
                $(dis).find('i').removeClass('mdi-chevron-right');
                $(dis).find('i').addClass('mdi-chevron-down');
            }
        }
        function GridHeaderCheck(dis) {
            $('input[type="checkbox"]').prop("checked", $(dis).prop("checked"));
        }
    </script>
</head>
<body class="body_color">
@include('admin.admin_header')
<section class="box_containner">
    @yield('content')
</section>
<div class="modal popup_bgcolor" id="conformation_popup">
    <div class="popup_box">
        <div class="alert_popup conformation_bg">
            <div class="popup_verified"><i class="mdi mdi-close"></i></div>
            <h4 class="popup_mainhead">Confirmation Massage!</h4>
            <p class="popup-text dynamic_popuptxt">Do you really want to delete this record.t</p>
        </div>
        <div class="popup_submit">
            <a class="popup_submitbtn conformation_bg conformation_btn" type="submit" id="ConfirmBtn"
                    onclick="HidePopoupMsg();">Yes
            </a>
            <a class="popup_submitbtn conformation_nobtn" type="submit" onclick="HidePopoupMsg();">No</a>
        </div>
    </div>
</div>
<div class="modal fade-scale" id="Modal_ViewDetails_advertiselist" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog survey_model" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">View Details</h4>
            </div>
            <div class="modal-body">
                <div class="news_containner style-scroll">
                    {{--<div class="latest_update_title">SPACIOUS 3 BED RESIDENCIES AT OUR FLAGSHIP PROJECT</div>
                    <div class="latest_updatetxt">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    </div>
                    <div class="latest_otr_details">
                        <span><i class="mdi mdi-map-marker"></i>Jabalpur</span>
                        <span><i class="mdi mdi-home-automation"></i>Property</span>
                    </div>--}}
                    <table class="table table-bordered white_bgcolor">
                        <tbody><tr>
                            <td class="width_35 title-more">Advertise Title :</td>
                            <td class="width_65" id="adver_title">-</td>
                        </tr>
                        <tr>
                            <td class="width_35 title-more">Type :</td>
                            <td class="width_65" id="adver_type">-</td>
                        </tr>
                        <tr>
                            <td class="width_35 title-more">Add By :</td>
                            <td class="width_65" id="adver_by">-</td>
                        </tr>
                        <tr>
                            <td class="width_35 title-more">City :</td>
                            <td class="width_65" id="adver_city">-</td>
                        </tr>

                        <tr>
                            <td class="width_35 title-more">Date :</td>
                            <td class="width_65" id="adver_date">-</td>
                        </tr>
                        <tr>
                            <td class="width_35 title-more">Status :</td>
                            <td class="width_65" id="adver_status">-</td>
                        </tr>
                        <tr>
                            <td class="width_35 title-more">Contact No. :</td>
                            <td class="width_65" id="adver_contact">
                               {{-- <div class="status excepted">Excepted</div>--}}
                            </td>
                        </tr>

                        </tbody></table>
                    <div class="latest_updateimg">
                        <img src="{{url('images/Adver_mainimg1.jpg')}}" id="adver_image"/>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!------Popup Box -->
<div class="modal popup_bgcolor" id="sucess_popup">
    <div class="popup_box">
        <div class="alert_popup success_bg">
            <div class="popup_verified"><i class="mdi mdi-check"></i></div>
            <h4 class="popup_mainhead">Thank You!</h4>
            <p class="popup-text dynamic_popuptxt">You have successfully Submit</p>
        </div>
        <div class="popup_submit">
            <button class="popup_submitbtn success_bg sucess_btn" type="submit" onclick="HidePopoupMsg();">Ok
            </button>
        </div>
    </div>
</div>
<div class="modal popup_bgcolor" id="error_popup">
    <div class="popup_box">
        <div class="alert_popup error_bg">
            <div class="popup_verified"><i class="mdi mdi-close"></i></div>
            <h4 class="popup_mainhead">Error Massage!</h4>
            <p class="popup-text dynamic_popuptxt">You have entered wrong text</p>
        </div>
        <div class="popup_submit">
            <button class="popup_submitbtn error_bg error_btn" type="submit" onclick="HidePopoupMsg();">ok</button>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modal_title">Title</h4>
            </div>
            <div class="modal-body" id="modal_body">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer">
                <div class=" pull-right">
                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
                </div>
                <div id="modalBtn" class="pull-right">&nbsp;</div>
                {{--<button id="extraBtn1" type="button" class="btn btn-primary" style="display:none">Save changes</button>--}}
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="overlay_res" onclick="HideTranparent();"></div>

<!--<script type="text/javascript" href="https://gurayyarar.github.io/AdminBSBMaterialDesign/plugins/node-waves/waves.js"></script>-->
@if(session()->has('message'))
    <script type="text/javascript">
        setTimeout(function () {
            {{--            ShowSuccessPopupMsg('{{ session()->get('message') }}');--}}
            swal("Success!", "{{ session()->get('message') }}", "success");

        }, 500);
    </script>
@endif
@if($errors->any())
    <script>
        setTimeout(function () {
            swal("Oops!", "{{$errors->first()}}", "error");
            {{--ShowErrorPopupMsg('{{$errors->first()}}');--}}
        }, 500);
    </script>
@endif
<script type="text/javascript">
    //Set Waves
    /* Waves.attach('.dash_menu_ul li a', ['waves-block']);
     Waves.init();*/

    window.setTimeout(function () {
        $(".alert").fadeTo(3000, 0).slideUp(300, function () {
            $(this).remove();
        });
    }, 6000);

    $('.glo_menuclick_admin').click(function (e) {
        var chkopen = $(this).find('.menu_basic_popup').attr('class');
        $('#setting_box_slide').removeClass('show_setting');
        if (chkopen != 'menu_basic_popup effect') {
            if (chkopen != 'menu_basic_popup menu_popup_setting effect') {
                $('.menu_basic_popup').addClass('scale0');
                $(this).find('.menu_basic_popup').removeClass('scale0');
            } else {
                $('.menu_basic_popup').addClass('scale0');
            }
        } else {
            $('.menu_basic_popup').addClass('scale0');
        }
        e.stopPropagation();
    });
    $("#countdown").dsCountDown(options);
    $(document).click(function (e) {
        $('.menu_basic_popup').addClass('scale0');
        e.stopPropagation();
    });
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
</body>
</html>