@extends('layout.master.master')

@section('title', 'My Profile')

@section('head')
    <section class="member_profileblk">
        <div class="container">
            <div class="member_profile_imgcontainner">
                <div class="member_profile_imgbox">
                    <div class="member_profile_img_block">
                        <img src="{{url('').'/'.$user->profile_pic}}"/>
                    </div>
                    <div class="member_profile_right">
                        <div class="member_nameblk">
                            {{$timeline->name}}
                        </div>
                        <div class="referal_noblk">
                            <i class="mdi mdi-account-switch"></i>
                            {{$user->member_type == 'paid' ?$user->rc:''}}
                        </div>
                        <div class="member_btnblk">
                            {{--<button class="member_btn btn btn-default">Timeline</button>--}}
                            {{--<button class="member_btn btn btn-default">About</button>--}}
                            <a href="{{url('member')}}" class="member_btn btn btn-default">Members</a>
                            {{--<button class="member_btn btn btn-default">Media</button>--}}
                            {{--<button class="member_btn btn btn-default">Status</button>--}}


                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="my_about_container">
                        <div class="basic_heading">
                            About
                        </div>
                        <div class="profile_follow"><i
                                    class="profile_icons mdi mdi-calendar"></i>{{ date_format(date_create($user->birthday), "d-M-Y")}}
                        </div>
                        <div class="profile_follow"><i class="profile_icons mdi mdi-phone"></i>{{$user->contact}}</div>
                        <div class="profile_follow" style="margin-bottom: 0px;border: none;"><i
                                    class="profile_icons mdi mdi-map-marker"></i>{{isset($user->address) ? $user->address:'-'}}
                        </div>
                    </div>
                    <div class="all_left_brics_container">
                    <div class="left_common_block">
                        <div class="icon_circle" style="background-color: #007cc2;">
                            <i class="mdi mdi-currency-inr"></i>
                        </div>
                        <div class="basic_heading">
                            My Earning
                            <a class="btn btn-primary post_btn_photo" href="{{url('my-earning')}}"><i
                                        class="basic_icons mdi mdi-view-module"></i>View
                                All
                            </a>
                        </div>
                        <div class="basic_count" style="color: #007cc2;">Rs {{$total_earning}} /-</div>
                    </div>
                    <div class="left_common_block">
                        <div class="icon_circle" style="background-color: #f8c301;">
                            <i class="mdi mdi-sitemap"></i>
                        </div>
                        <div class="basic_heading">
                            My Networks
                            <a href="{{url('my-network')}}" class="btn btn-primary post_btn_photo"><i
                                        class="basic_icons mdi mdi-view-module"></i>View
                                All
                            </a>
                        </div>
                        <div class="basic_count" style="color: #f8c301;">{{$member_count}}</div>
                    </div>
                    <div class="left_common_block">
                            <div class="icon_circle" style="background-color: #ff003b;">
                                <i class="mdi mdi-account-multiple"></i>
                            </div>
                            <div class="basic_heading">
                                All Members
                                <a href="{{url('member')}}" class="btn btn-primary post_btn_photo"><i
                                            class="basic_icons mdi mdi-view-module"></i>View
                                    All
                                </a>
                            </div>
                            <div class="basic_count" style="color: #ff003b;">{{$friend_count}}</div>
                        </div>
                    {{--<div class="basic_thumb">--}}
                        {{--<div class="icon_circle" style="background-color: #07a20d;">--}}
                            {{--<i class="mdi mdi-chemical-weapon"></i>--}}
                        {{--</div>--}}
                        {{--<div class="basic_heading">--}}
                            {{--Followers--}}
                            {{--<button class="btn btn-primary post_btn_photo"><i--}}
                            {{--class="basic_icons mdi mdi-view-module"></i>View--}}
                            {{--All--}}
                            {{--</button>--}}
                        {{--</div>--}}
                        {{--<div class="basic_count" style="color: #07a20d;">{{$friend_count}}</div>--}}
                    {{--</div>--}}
                    </div>
                </div>
                <div class="col-sm-12 col-md-9">
                    <!--<div class="post_block">
                        <div class="post_text_block emoji_div">
                        </div>
                    </div>-->
                    <div class="statusMsg"></div>
                    <div class="post_block">
                        {{--<form role="form" name="userpostForm" id="userpostForm" action="" method="post"--}}
                        {{--enctype="multipart/form-data">--}}
                        <form enctype="multipart/form-data" id="userpostForm">
                            <div class="post_head">


                                <span class="post_title"><i class="mdi mdi-pencil"></i>Make Post</span>
                                <button class="btn btn-primary post_btn_video">
                                    <input class="profile-upload-pic" accept=".mp4, .3gp, .ogg, .avi, .wmv" type="file"
                                           id="upload_file_video" name="upload_file_video[]"
                                           onchange="PreviewVideo(this);"/>
                                    <i class="basic_icons mdi mdi-video"></i>Video
                                    Album
                                </button>
                                <button class="btn btn-primary post_btn_photo">
                                    <input class="profile-upload-pic" accept=".png,.jpg, .jpeg, .gif" type="file"
                                           id="upload_file_image" name="upload_file[]" onchange="PreviewImage();"
                                           multiple/>


                                    <i class="basic_icons mdi mdi-image"></i>Photo
                                </button>
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
                                <div class="post_text_block emoji_div" placeholder="CREATE YOUR POST {{strtoupper($timeline->fname)}}..."
                                     id="post_text">
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
                                <input type="submit" name="submit" class="btn btn-primary btn_post" value="Publish"/>
                            </div>
                            <p id="err1"></p>
                        </form>

                    </div>
                    <div id="userpost">

                    </div>
                    {{--<div class="text-center">--}}
                    {{--<div class="more_btn btn btn-warning btn_sm" onclick="postload();"><i--}}
                    {{--class="basic_icon mdi mdi-arrow-right-bold"></i>--}}
                    {{--See More--}}
                    {{--</div>--}}
                    {{--</div>--}}
                    <input type="hidden" id="see_id" value="0"/>

                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        function Gatcommenttxt(dis) {
            var comment_txt = $(dis).text();
            if (comment_txt.length > 0) {
                $(dis).parent().parent().find('.comment_postbtn').removeAttr('disabled', 'disabled');
            } else {
                $(dis).parent().parent().find('.comment_postbtn').attr('disabled', 'disabled');
            }
        }

        /**********Bijendra************/
        var append_loading_img = '<div class="feed_loadimg_block" id="load_img">' +
            '<img height="50px" class="center-block" src="{{ url('images/loading.gif') }}"/></div>';
        function postload() {
            var search_user_id = $('.search-user').val();
            var limit = Number($('#see_id').val());
            $.ajax({
                type: "POST",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('postload') }}",
//                data: '{"data":"' + endid + '"}',
                data: '{"search_user_id":"' + search_user_id + '", "currentpage":"' + limit + '"}',
                beforeSend: function () {
                    {{--$('#userpost').html('<img height="50px" class="center-block" src="{{ url('images/loading.gif') }}"/>');--}}
                    $('#userpost').append(append_loading_img);
                },
                success: function (data) {
                    $("#load_img").remove();
                    $("#userpost").html(data);
                },
                error: function (xhr, status, error) {
//                    alert('xhr.responseText');
                    $('#userpost').html(xhr.responseText);
                }
            });
        }

        postload();
        //        setInterval(postload, 1000000);
        function getmorepost() {
            $("#load_img").remove();
            cp = 1;
            cp += parseFloat($('#see_id').val());
            $('#see_id').val(cp);
            $.ajax({
                type: "POST",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('morepostload') }}",
//                data: '{"data":"' + endid + '"}',
                data: '{"currentpage":"' + cp + '"}',
                beforeSend: function () {
                    $('#userpost').append(append_loading_img);
                    // $('#dashboard_post').insertAfter().append(append_loading_img);
                },
                success: function (data) {
                    $("#load_img").remove();
                    $("#userpost").append(data);
                },
                error: function (xhr, status, error) {
                    $('#userpost').html(xhr.responseText);
//                    ShowErrorPopupMsg('Error in uploading...');
                }
            });
        }


        $(document).ready(function (e) {
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

            // Gatcommenttxt();
            $("#userpostForm").on('submit', function (e) {
                var textval = $('#post_text').text();
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
                                    $(".btn_post").attr("disabled");
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
                                    $('#post_text').val('');
                                    $('.emojionearea-editor').empty();
                                    $('#posttext').text('');
                                    $('#upload_file_image').val('');
                                    $('#upload_file_video').val('');
                                    //console.log(data);
                                    $('#userpostForm').css("opacity", "");
                                    $(".btn_post").removeAttr("disabled");
                                    latest_dashboardpostload();
                                },
                                error: function (xhr, status, error) {
//                                    ShowErrorPopupMsg('Error in uploading...');
                                    warning_noti("Error in uploading...");
                                }
                            });
                        }
                    });
                }
            });
        });
        function latest_dashboardpostload() {
            $.ajax({
                type: "POST",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('latest_dashboard_post') }}",
//                beforeSend: function () {
//                    $('#userpost').prepend(append_loading_img);
//                },
                success: function (data) {
//                    $("#load_img").remove();
//                    setTimeout(function () {
                    $("#userpost").prepend(data);
//                    }, 100);
                },
                error: function (xhr, status, error) {
                    $('#userpost').html(xhr.responseText);
                }
            });
        }

        /**********Bijendra************/


    </script>
@stop