@extends('layout.master.master')

@section('title', 'Dashboard')

@section('head')
    <style type="text/css">
        .exis_msg {
            margin-left: -15px;
        }
    </style>
    <section class="container-fluid overall_containner">
        <div class="row">
            <div class="col-md-2">
                <div class="profile_basic_menu_block">
                    <div class="profile_img_block">
                        <img src="{{url('').'/'.$user->profile_pic}}"/>
                    </div>
                    <div class="profile_name">{{$timeline->name}}</div>
                    {{--<div class="profile_follow"><i class="profile_icons mdi mdi-chemical-weapon"></i>100 Friends</div>--}}

                    <ul class="profile_ul">
                        <li><a href="{{url('my-earning')}}"><i class="profile_icons mdi mdi-currency-inr"></i>My Earning</a>
                        </li>
                        <li><a href="{{url('my-profile')}}"><i class="profile_icons mdi mdi-account-edit"></i>My Profile</a>
                        </li>
                        <li data-toggle="modal" data-target="#Mymodal_AddNewMamber">
                            <a><i class="profile_icons mdi mdi-account-multiple-plus"></i>Add Members</a></li>
                        <li><a href="{{url('myads')}}"><i class="profile_icons mdi mdi-chemical-weapon"></i>My Advertise</a>
                        </li>
                        <li><a href="{{url('my-network')}}"><i class="profile_icons mdi mdi-sitemap"></i>My Network</a>
                        </li>
                        <li><a href="{{url('member')}}"><i class="profile_icons mdi mdi-account-multiple"></i>All
                                Members</a></li>
                        <li>
                            <a target="_blank" href="{{url('buy')}}"><i class="profile_icons mdi mdi-cart-outline"></i>Buy
                                & Sell</a>
                        </li>
                        <li style="border-bottom: none;">
                            <a target="_blank" href="{{url('item_list')}}"><i
                                        class="profile_icons mdi mdi-wallet-giftcard"></i>E-Commerce</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-7">
                <div class="dynamic_overlay overlay_all">
                    <div class="post_block">
                        <form enctype="multipart/form-data" id="userpostForm">
                            <div class="post_head">


                                <span class="post_title"><i class="mdi mdi-pencil"></i>Make Post</span>
                                <a class="btn btn-primary post_btn_video">
                                    {{--<input class="profile-upload-pic" accept=".mp4, .3gp, .ogg, .avi, .wmv, media_type " type="file"
                                           id="upload_file_video" name="upload_file_video[]"
                                           onchange="PreviewVideo(this);"/>--}}

                                    <input class="profile-upload-pic" accept=".mp4, .3gp" type="file"
                                           id="upload_file_video" name="upload_file_video[]"
                                           onchange="PreviewVideo(this);" data-toggle="tooltip" data-placement="bottom"
                                           title="You can upload maximum 1 Video of 15 MB" />
                                    <i class="basic_icons mdi mdi-video"></i>Video
                                    Album
                                </a>
                                <a class="btn btn-primary post_btn_photo">
                                    <input class="profile-upload-pic" accept=".png,.jpg, .jpeg, .gif, media_type"
                                           type="file" data-toggle="tooltip" data-placement="bottom"
                                           title="You can upload maximum 10 images of 3MB each"
                                           id="upload_file_image" name="upload_file[]" onchange="PreviewImage();"
                                           multiple/>


                                    <i class="basic_icons mdi mdi-image"></i>Photo
                                </a>
                                {{--<input class="-upload-pic" accept=".png,.jpg, .jpeg, .gif" type="file"--}}
                                {{--id="post_file_image" name="post_upload_file[]"--}}
                                {{--multiple/>--}}
                                {{--<input class="profile-" accept=".png,.jpg, .jpeg, .gif" type="file"--}}
                                {{--id="upload_file_image" name="upload_file[]" onchange="PreviewImage();" multiple>--}}
                            </div>
                            <div class="post_textblock">
                                <div class="post_imgblock">
                                    <img src="{{url('').'/'.$user->profile_pic}}"/>
                                </div>
                                <div class="post_text_block emoji_div" placeholder="CREATE YOUR POST {{strtoupper($timeline->fname)}}...🙂"
                                     id="post_text_emoji">
                                    <!--<textarea class="post_textarea" id="ta1" placeholder="What's on your mind"></textarea>-->
                                    <!-- <div class="post_textarea txtwithemoji_block" contenteditable="true" id="ta"
                                          placeholder="What's on your mind">
                                     </div>-->
                                </div>
                                <input type="hidden" name="posttext" id="posttext">
                                <!--<div class="post_emoji"><i class="mdi mdi-emoticon"></i></div>-->
                            </div>
                            <div class="files_block" id="files_block">
                                <div class="upload_limittxt">You can Upload Maximum 10 images of 3MB each & 1 Video of 15 MB.
                                </div>
                                <!--   <div class="all_thumbcontainner style-scroll">-->
                                <div class="upload_imgbox" id="image_preview">
                                    <!--<div class='upimg_box'><i class='mdi mdi-close' onclick='Remove_uploadimg(this);'></i><img class='up_img' src='images/NoPreview_Img.png' /></div>-->

                                </div>
                            </div>
                            <div class="post_footer_btn">
                                {{--<button class="btn btn-primary btn_post" onclick="publish()">Publish</button>--}}
                                <input type="submit" name="submit" class="btn btn-primary btn_post" id="publish"
                                       value="Publish"/>

                            </div>
                            <span id="err1"></span>
                        </form>
                    </div>
                </div>
                <div class="advertise_category dashbord_category" id="advertise_category_block">
                    <a href="{{url('buy')}}" class="category_more btn btn-danger">
                        <i class="mdi mdi-more"></i> More</a>
                    @foreach($ad_category as $category)
                        <a class="adver_brics" href="{{url('bsc').'/'.(encrypt($category->id))}}">
                                <span class="brics_icon"><i><img src="{{url('').'/'.$category->icon_url}}"
                                                                 alt=""></i></span>
                            <span class="brics_txt">{{$category->category}}</span>
                        </a>
                    @endforeach
                </div>
                <div class="post_existing_slider">
                    <div class="row">
                        <div class="col-sm-12 mob_width100">
                            <div id="carousel-main" class="carousel slide dash_adver_mainslider" data-ride="carousel"
                                 data-interval="5000">
                                <!-- Carousel items1 -->
                                <div class="carousel-inner">
                                    <?php $counter = 0; ?>
                                    @foreach($homeslider as $slider)
                                        @if($counter ==0)
                                            <div class="active item">
                                                <img src="{{url('').'/'.$slider->ad_img}}"
                                                     class="img-responsive adver_mainslider_img"/>
                                                <a href="#Modal_ViewDetails_LatestNews" data-toggle="modal">
                                                    <div class="adver_txtblock"
                                                         onclick="ShowAdminAdvertiseDetails(this);">
                                                        {{$slider->ad_title}}
                                                    </div>
                                                    <input type="hidden" class="list_description"
                                                           value=" @if(isset($slider->ad_description))
                                                           {{$slider->ad_description}}
                                                           @else
                                                                   -
                                                               @endif"/>

                                                </a>
                                            </div>
                                            <?php $counter++; ?>
                                        @else
                                            <div class="item">
                                                <img src="{{url('').'/'.$slider->ad_img}}"
                                                     class="img-responsive adver_mainslider_img"/>
                                                <a href="#Modal_ViewDetails_LatestNews" data-toggle="modal">
                                                    <div class="adver_txtblock"
                                                         onclick="ShowAdminAdvertiseDetails(this);">
                                                        {{$slider->ad_title}}
                                                    </div>
                                                    <input type="hidden" class="list_description"
                                                           value=" @if(isset($slider->ad_description))
                                                           {{$slider->ad_description}}
                                                           @else
                                                                   -
                                                               @endif"/>
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                                <!-- Controls -->
                                <a class="carousel_arrow left_arrow" href="#carousel-main" role="button"
                                   data-slide="prev">
                                    <span class="mdi mdi-chevron-left" aria-hidden="true"></span>
                                </a>
                                <a class="carousel_arrow right_arrow" href="#carousel-main" role="button"
                                   data-slide="next">
                                    <span class="mdi mdi-chevron-right" aria-hidden="true"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{--------------------Load Dashboard Post------------------------}}
                <div id="dashboard_post">
                    {{--@include('post.new_dashboard_posts')--}}
                </div>
                {{--------------------Load Dashboard Post------------------------}}
                <input type="hidden" id="see_id" value="1"/>
                {{--<button class="more_btn btn btn-warning" onclick="getmorepost();">See more</button>--}}
            </div>
            <div class="col-sm-4 col-md-3">
                <div class="all_right_block">
                    <div class="panel top_earner_block panel-default">
                        <div class="panel-heading basic_headgradian">
                            <b>Top 10 Earners</b>
                            <div class="button_head glo_headbtn" id="earner_clkbtn"></div>
                        </div>
                        <div class="panel-body">
                            <ul id="earners_block" class="news-ticker-images earner_ui">
                                {!!$top10earners_list!!}
                            </ul>
                        </div>
                    </div>
                    <div class="followers_block">
                        <div class="panel panel-default" style="margin-bottom: 5px;">
                            <div class="panel-heading basic_headgradian"><b>Our Followers </b></div>
                        </div>
                        <div class="panel-body folllowers_body">
                            <div class="follower_box">
                                <a class="follow_a engi_color" href="{{url('member-profession/Engineer')}}"><i
                                            class="mdi mdi-domain"></i><span
                                            class="engi_arrow engi_color">Engineer</span></a>
                                <a class="follow_a doctor_color" href="{{url('member-profession/Doctor')}}"><i
                                            class="mdi mdi-hospital"></i><span
                                            class="doctor_arrow doctor_color">Doctor</span></a>
                                <a class="follow_a enterprise_color" href="{{url('member-profession/Entreprener')}}"><i
                                            class="mdi mdi-account-star"></i><span
                                            class="enterprise_color enterprise_arrow">Entrepreneur</span></a>
                                <a class="follow_a other_color" href="{{url('member-profession/Others')}}"><i
                                            class="mdi mdi-link-variant"></i><span
                                            class="other_color other_arrow">Others</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="advertiseall_block">
                        <div class="panel panel-default">
                            <div class="panel-heading basic_headgradian">
                                <b>Advertisement</b>
                                <div class="button_head glo_headbtn" id="adver_clkbtn">
                                </div>
                            </div>
                            <div class="panel-body">
                                @php
                                    $affiliates = DB::table('affiliates')->get();
                                @endphp
                                <ul id="advertise_block" class="news-ticker-images advertise_ui">
                                    @if(count($affiliates)>0)
                                        @foreach($affiliates as $affiliate)
                                            <li>
                                                <div class="adver_imgbox">
                                                    {!! $affiliate->affiliate_link !!}
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="res_footermenu">
        <div class="footer_fixicon" onclick="Show_Topearner();"><i class="mdi mdi-currency-inr"></i></div>
        <div class="footer_fixicon" onclick="Show_Followers();"><i class="mdi mdi-chemical-weapon"></i></div>
        <div class="footer_fixicon" onclick="Show_LinkOptions();"><i class="mdi mdi-account-settings-variant"></i></div>
    </footer>
    {{------------------------Ads modal----------------}}
    <div id="Modal_Survey" class="modal fade" data-easein="bounceIn" role="dialog">
        <div class="modal-dialog survey_model">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button>-->
                    <h4 class="modal-title">Online Survey</h4>
                </div>
                <div class="modal-body">
                    <div class="servey_caption">
                        <div class="servey_txtleft" id="countads">Please Like Atleast
                            <span class="counter_remain">4</span>
                        </div>
                        <div class="servey_txtright">Remaining Like <span class="counter_remain"
                                                                          id="servey_remain_cut">4</span>
                        </div>
                    </div>
                    <div id="myCarousel_advertise_survey" class="carousel slide">
                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <?php $i = 0;?>
                                @foreach($admin_ads as $ads)
                                    <div class="col-sm-4 col-xs-6 adver_slidebox">
                                        <div class="servey_imgbox">
                                            <div class="slider_imgcontainner">
                                                <img src="{{url('').'/'.$ads->ad_img}}" alt="Image"
                                                     class="img-responsive">
                                                <div class="adver_txtblock">
                                                    {{$ads->ad_description}}
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" class="hidden_ad_id" id="ad_id" value="{{$ads->id}}"/>
                                    </div>

                                    <?php $i++; ?>
                                    @if($i%3 == 0 && count($admin_ads) !=$i )
                                        <?php echo '</div><div class="item">'; ?>
                                    @endif
                                @endforeach
                            </div>
                            <!--/carousel-inner-->
                            <a class="carousel_arrow left_arrow" href="#myCarousel_advertise_survey"
                               data-slide="prev">
                                <span class="mdi mdi-chevron-left" aria-hidden="true"></span>
                            </a>
                            <a class="carousel_arrow right_arrow" href="#myCarousel_advertise_survey"
                               data-slide="next">
                                <span class="mdi mdi-chevron-right" aria-hidden="true"></span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" disabled="disabled" class="btn btn-primary"
                            onclick="getallads()"
                            id="advertise_btn">Submit
                    </button>
                </div>
            </div>
        </div>
    </div>

    @php $clicks = \App\AdsClick::where(['user_id' => $user->id, 'clicked_date' => date_format(date_create(\Carbon\Carbon::now()), "Y-m-d")])->get();
          $announcement = \App\NotificationClicked::where(['user_id' => $user->id, 'clicked_date' => date_format(date_create(\Carbon\Carbon::now()), "Y-m-d")])->get();
    @endphp
    <input type="hidden" value="{{count($clicks)}}" id="adsclickcounts"/>
    <input type="hidden" value="{{count($announcement)}}" id="announcement_id"/>
    {{------------------------Ads modal----------------}}

    @if(isset($notification))
        <script type="text/javascript">
            ShowAnnouncement('{{$notification->notification}}');
        </script>
    @endif
    <script type="text/javascript">
        function getmorepost() {
            $("#load_img").remove();
            append_loading_img = '<div class="feed_loadimg_block" id="load_img">' +
                '<img height="50px" class="center-block" src="{{ url('images/loading.gif') }}"/></div>';
            cp = 1;
            cp += parseFloat($('#see_id').val());
            $('#see_id').val(cp);
            $.ajax({
                type: "POST",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('dashboard_post') }}",
//                data: '{"data":"' + endid + '"}',
                data: '{"currentpage":"' + cp + '"}',
                beforeSend: function () {
                    // $('#dashboard_post').html('<img height="50px" class="center-block" src="{{ url('images/loading.gif') }}"/>');
                    $('#dashboard_post').append(append_loading_img);
                    // $('#dashboard_post').insertAfter().append(append_loading_img);
                },
                success: function (data) {
                    $("#load_img").remove();
                    $("#dashboard_post").append(data);
                },
                error: function (xhr, status, error) {
                    $('#dashboard_post').html(xhr.responseText);
//                    ShowErrorPopupMsg('Error in uploading...');
                }
            });
        }
        var append_loading_img = '<div class="feed_loadimg_block" id="load_img">' +
            '<img height="50px" class="center-block" src="{{ url('images/loading.gif') }}"/></div>';
        function latest_dashboardpostload() {
//            var formData = '_token=' + $('.token').val();
//            var search_user_id = $('.search-user').val();
//            var limit = Number($('#see_id').val());
            $.ajax({
                type: "POST",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('latest_dashboard_post') }}",
//                data: '{"data":"' + endid + '"}',
//                data: '{"limit":"' + limit + '"}',
                beforeSend: function () {
                    $('#dashboard_post').prepend(append_loading_img);
                },
                success: function (data) {
                    $("#load_img").remove();
//                    setTimeout(function () {
                    $("#dashboard_post").prepend(data);
//                    dashboardpostload();
//                    }, 500);
                },
                error: function (xhr, status, error) {
                    $('#dashboard_post').html(xhr.responseText);
                }
            });
        }
        function dashboardpostload() {
            var formData = '_token=' + $('.token').val();
//            var search_user_id = $('.search-user').val();
            var limit = Number($('#see_id').val());
            $.ajax({
                type: "POST",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('dashboard_post') }}",
//                data: '{"data":"' + endid + '"}',
                data: '{"formData":"' + formData + '", "currentpage":"' + limit + '"}',
                beforeSend: function () {
                    {{--$('#dashboard_post').html('<img height="50px" class="center-block" src="{{ url('images/loading.gif') }}"/>');--}}
                    $('#dashboard_post').append(append_loading_img);
                },
                success: function (data) {
                    $("#load_img").remove();
                    $("#dashboard_post").append(data);
                },
                error: function (xhr, status, error) {
                    $('#dashboard_post').html(xhr.responseText);
//                    ShowErrorPopupMsg('Error in uploading...');
                }
            });
        }

        //        $('body').on('click', '.btn_post', function () {
        //            dashboardpostload();
        //        });
        //        setInterval(dashboardpostload, 100000);
        $(window).on('load', function () {
            var clickscount = $('#adsclickcounts').val();
            var announcement_clicks = $('#announcement_id').val();
            if (clickscount == 0) {
                $("#Modal_Survey").modal({
                    backdrop: 'static',
                    show: true
                });
            }
            if (announcement_clicks != 0) {
                $('#announcement').removeClass('animate_announcement_show');
            }
            globalloaderhide();
            if ($(document).width() < 470) {
                // alert('call');
                getmorepost();
                setTimeout(function () {
                    //alert('call470');
                    getmorepost();
                }, 2000);

            }
        });
        //        $(window).scroll(function () {
        //            if ($(window).scrollTop() + $(window).height() == $(document).height()) {
        //                debugger;
        //                var limit = Number($('#see_id').val());
        //                if (limit <= $('#p_count').val()) {
        //                    dashboardpostload();
        //                }
        //            }
        //        });
        function getallads() {
            ad_ids = new Array();
            $('.servey_imgbox_selector').each(function () {
                var ad_id = $(this).parent().find('.hidden_ad_id').val();
                ad_ids.push(ad_id);
            });
            var adids = ad_ids;
            $.ajax({
                type: "POST",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('postadsclick') }}",
                data: '{"adids":"' + adids + '"}',
//                beforeSend: function () {
//                    $('.advertise_btn').attr("disabled", "disabled");
//                    $('#Modal_Survey').css("opacity", ".5");
//                },
                success: function (data) {
                    $('#Modal_Survey').modal('hide');
                },
                error: function (xhr, status, error) {
                    $('#Modal_Survey').html(xhr.responseText);
                }
            });
        }
        function gmfn() {
            var a = 0;
            $.ajax({
                type: "get",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('gmbrs') }}",
//                data: '{"a":"' + a + '"}',
                data: {a: a},
                success: function (data) {
                    $('#non_paid_rfrls').html(data.t);
                    $('#rndmrfrls').html(data.r);
                    $('.lb_internalmemberbox').each(function () {
                        if ($(this).find('.add_user_block').length < 1) {
                            $(this).append(append_norecord);
                        }
                    });
                },
                error: function (xhr, status, error) {
//                    alert(xhr.responseText);//
                }
            });
        }
        gmfn();
        $(window).scroll(function (event) {
            var chk_scroll = $(window).scrollTop();
            if (chk_scroll > 70) {
                $('.top_manubar').addClass('top_manubar_fixed');
//                    $('.overall_containner').addClass('overall_margin');
                $('.profile_basic_menu_block').addClass('left_menu_fixed');
                $('.all_right_block').addClass('right_menu_fixed');
            }
            if ($(window).scrollTop() + $(window).height() == $(document).height()) {
                if (parseFloat($('#see_id').val()) <= parseFloat($('#pcount').val())) {
                    getmorepost();
                }
            }
        });
        $(document).ready(function () {
            // globalloadershow();
            $("#userpostForm").on('submit', function (e) {
                var textval = $('#post_text_emoji').text();
                $('#posttext').val(textval);
                e.preventDefault();
                var files = $('#upload_file_image').val();
                var videos = $('#upload_file_video').val();
                if (textval == '' && files == '' && videos == '') {
//                    swal("Required", "You can't post without any text or image or video", "info");
                    warning_noti("You can't post without any text or image or video");
                    HideOnpageLoopader1();
                } else {
                    swal({
                        title: "Are you sure?",
                        text: "You want to submit this post...!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((okk) => {
                        if (okk) {
                            $.ajax({
                                type: 'POST',
                            url: "{{ url('userpost') }}",
                                data: new FormData(this),
                                contentType: false,
                                cache: false,
                                processData: false,
                                beforeSend: function () {
                                    $('#userpostForm').css("opacity", ".5");
                                    $("#publish").attr("disabled", "disabled");
                                    $('#loader').css('display', 'block');
                                    round_info_noti("WE ARE UPLOADING YOUR POST QUICKLY");
                                },
                                success: function (data) {
                                    $('#loader').css('display', 'none');
                                    HideOnpageLoopader1();
//                                    swal("Success!", "Your post has been uploaded...", "success");
                                    success_noti("SUCESSFULLY POSTED,KEEP GOING");
                                    // ShowSuccessPopupMsg('Your post has been uploaded...');
                                    $('#image_preview').text('');
                                    $('.emojionearea-editor').empty();
                                    $('#post_text_emoji').text('');
                                    $('#posttext').val('');
                                    $('#upload_file_image').val('');
                                    $('#upload_file_video').val('');
                                    $('.upload_limittxt').text('');
                                    $('#userpostForm').css("opacity", "");
                                    $("#publish").removeAttr("disabled", "disabled");
                                    latest_dashboardpostload();
                                },
                                error: function (xhr, status, error) {
                                    $('#err1').html(xhr.responseText);
                                    $('#userpostForm').css("opacity", "");
                                    $("#publish").removeAttr("disabled", "disabled");
//                                    swal("Oops!", "Post has not been finished...Please try again", "info");
                                    warning_noti("Post has not been finished...Please try again");
                                }
                            });
                        }
                    });

                }
            });
            dashboardpostload();
            //debugger;

        });
    </script>
@stop