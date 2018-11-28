@extends('layout.master.master')

@section('title', 'Dashboard')
<link href="{{url('css/cropper.min.css')}}" type="text/css" rel="stylesheet"/>
<style type="text/css">


</style>
@section('head')
    {{--<link href="http://widgets.freestockcharts.com/WidgetServer/WBITickerblue.css"--}}
    {{--rel="stylesheet" type="text/css"/>--}}
    {{--<script src="http://widgets.freestockcharts.com/script/WBIHorizontalTicker2.js?ver=12334"--}}
    {{--type="text/javascript"></script>--}}

    <section class="container-fluid overall_containner dash_respad">
        <div class="row">
            <div class="col-md-2 dashboard_fixed menu_left">
                <div class="profile_basic_menu_block">
                    <div class="profile_img_block">
                        <img src="{{url('').'/'.$user->profile_pic}}"/>
                    </div>

                    <div class="profile_name">
                        @if($user->member_type=='paid')
                            <svg class="paid_img" viewBox="0 0 24 24" data-toggle="tooltip"
                                 data-placement="top" title="Paid User">
                                <path fill="#007cc2"
                                      d="M9.04,21.54C10,21.83 10.97,22 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2A10,10 0 0,0 2,12C2,16.25 4.67,19.9 8.44,21.34C8.35,20.56 8.26,19.27 8.44,18.38L9.59,13.44C9.59,13.44 9.3,12.86 9.3,11.94C9.3,10.56 10.16,9.53 11.14,9.53C12,9.53 12.4,10.16 12.4,10.97C12.4,11.83 11.83,13.06 11.54,14.24C11.37,15.22 12.06,16.08 13.06,16.08C14.84,16.08 16.22,14.18 16.22,11.5C16.22,9.1 14.5,7.46 12.03,7.46C9.21,7.46 7.55,9.56 7.55,11.77C7.55,12.63 7.83,13.5 8.29,14.07C8.38,14.13 8.38,14.21 8.35,14.36L8.06,15.45C8.06,15.62 7.95,15.68 7.78,15.56C6.5,15 5.76,13.18 5.76,11.71C5.76,8.55 8,5.68 12.32,5.68C15.76,5.68 18.44,8.15 18.44,11.43C18.44,14.87 16.31,17.63 13.26,17.63C12.29,17.63 11.34,17.11 11,16.5L10.33,18.87C10.1,19.73 9.47,20.88 9.04,21.57V21.54Z"/>
                            </svg>
                        @endif
                        {{$timeline->name}}</div>
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
            <div class="col-md-8 col-sm-12 dashboard_center_padding">
                <div class="col-sm-12 dashboard_fixed_first" id="market_line">
                {{--<script type="text/javascript">--}}
                {{--var gainTicker = new WBIHorizontalTicker('gainers');--}}
                {{--gainTicker.start();--}}
                {{--</script>--}}
                <!-- TradingView Widget BEGIN -->
                {{--<div class="tradingview-widget-container">--}}
                {{--<div class="tradingview-widget-container__widget"></div>--}}
                {{--<div class="tradingview-widget-copyright"><span class="blue-text">Stock Market Update</span> By--}}
                {{--Connecting-One--}}
                {{--</div>--}}
                {{--<script type="text/javascript"--}}
                {{--src="https://s3.tradingview.com/external-embedding/embed-widget-tickers.js" async>--}}
                {{--</script>--}}
                {{--</div>--}}
                <!-- TradingView Widget END -->

                    <!-- TradingView Widget BEGIN -->
                    <div class="market_container">
                        <div class="tradingview-widget-container">
                            <div class="tradingview-widget-container__widget"></div>
                            {{--<div class="tradingview-widget-copyright"><span class="blue-text">Stock Market Update</span>--}}
                            {{--By--}}
                            {{--Connecting-One--}}
                            {{--</div>--}}
                            <script type="text/javascript"
                                    src="https://s3.tradingview.com/external-embedding/embed-widget-tickers.js" async>
                                {
                                    "symbols"
                                :
                                    [
                                        {
                                            "description": "BSE",
                                            "proName": "NSE:BSE"
                                        },
                                        {
                                            "description": "BANK NIFTY",
                                            "proName": "NSE:BANKNIFTY"
                                        },
                                        {
                                            "description": "BSE SENSEX",
                                            "proName": "BSE:SENSEX"
                                        },
                                        {
                                            "description": "NIFTY 50",
                                            "proName": "NSE:NIFTY"
                                        }
                                    ],
                                        "locale"
                                :
                                    "in"
                                }
                            </script>
                        </div>
                    </div>
                    <!-- TradingView Widget END -->
                </div>
                <div class="col-md-8 col-sm-12">
                    <div class="dynamic_overlay">
                        <div class="post_block">
                            <div class="loader" id="loader">
                                <div class="internal_bg">
                                    <img src="{{url('images/logo.png')}}" class="top_loader"/>
                                    <img class="loader_main" src="{{url('images/1L.gif')}}"/>
                                </div>
                            </div>
                            <form enctype="multipart/form-data" id="userpostForm">
                                <div class="post_head">
                                    <span class="post_title"><i class="mdi mdi-pencil"></i>Make Post</span>
                                    <button type="button" class="btn btn-primary post_btn_video"
                                            onclick="checkin_click();">
                                        <i class="basic_icons mdi mdi-map-marker"></i>Check In
                                    </button>
                                    <a class="btn btn-primary post_btn_video">
                                        {{--<input class="profile-upload-pic" accept=".mp4, .3gp, .ogg, .avi, .wmv, media_type " type="file"
                                               id="upload_file_video" name="upload_file_video[]"
                                               onchange="PreviewVideo(this);"/>--}}

                                        <input class="profile-upload-pic" accept=".mp4, .3gp" type="file"
                                               id="upload_file_video" name="upload_file_video"
                                               onchange="PreviewVideo(this);"/>
                                        <i class="basic_icons mdi mdi-video"></i>Video
                                    </a>
                                    <a class="btn btn-primary post_btn_photo">
                                        <input class="profile-upload-pic" accept=".png,.jpg, .jpeg, .gif, media_type"
                                               type="file"
                                               id="upload_file_image" name="upload_file[]"
                                               onchange="UploadPostImage(this);"
                                               multiple/>
                                        <i class="basic_icons mdi mdi-image"></i>Photo
                                    </a>
                                    <input type="hidden" id="post_img_src" name="post_img_src">
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

                                    <div class="location_block" id="checkin_block">
                                        <div class="location_icon">
                                            <i class="mdi mdi-map-marker"></i>
                                        </div>

                                        <input id="location-input" class="placepicker form-control" name="checkin"
                                               type="text"
                                               placeholder="Enter a location">
                                    </div>


                                    <div class="post_text_block emoji_div"
                                         placeholder="CREATE YOUR POST {{strtoupper($timeline->fname)}}...🙂"
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
                                    <div class="upload_limittxt">You can upload maximum 10 images at a time & 1 video at
                                        a
                                        time. Video file size must not exceed 10 MB.
                                    </div>
                                    <!--   <div class="all_thumbcontainner style-scroll">-->
                                    <div class="upload_imgbox" id="image_preview">
                                        <!--<div class='upimg_box'><i class='mdi mdi-close' onclick='Remove_uploadimg(this);'></i><img class='up_img' src='images/NoPreview_Img.png' /></div>-->

                                    </div>
                                </div>
                                <div class="post_footer_btn">
                                    <div class="btn-group pull-left" data-toggle="tooltip" title="Post Privacy">
                                        <button type="button" class="btn btn-default" id="set_privacy_txt">Public
                                        </button>
                                        <button type="button" class="btn btn-primary dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a onclick="setprivacy('Public');">Public</a></li>
                                            <li><a onclick="setprivacy('Friends');">Friends</a></li>
                                        </ul>
                                        <input type="hidden" id="post_privacy_set" name="post_privacy_set"
                                               value="Public">
                                    </div>
                                    {{--<button class="btn btn-primary btn_post" onclick="publish()">Publish</button>--}}
                                    <button type="submit" name="submit" class="btn btn-primary btn_post" id="publish"
                                            value="Publish">
                                        <i class="mdi basic_icon_margin mdi-send"></i>Publish
                                    </button>

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
                                <div id="carousel-main" class="carousel slide dash_adver_mainslider"
                                     data-ride="carousel"
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
                    <div id="dashboard_post" class="dash_post_main_container">
                        {{--@include('post.new_dashboard_posts')--}}
                    </div>
                    {{--------------------Load Dashboard Post------------------------}}
                    <input type="hidden" id="see_id" value="1"/>
                    {{--<button class="more_btn btn btn-warning" onclick="getmorepost();">See more</button>--}}
                </div>
                <div class="col-md-4 col-sm-10 dashboard_fixed_second">
                    <div class="all_right_block">
                        <div class="servey_block">
                            <div class="panel panel-default">
                                <div class="panel-heading basic_headgradian">
                                    <b>Online Survey</b>
                                    <div class="button_head glo_headbtn"></div>
                                </div>
                                <div class="panel-body servey_ul style-scroll">
                                    @php
                                        $surveys = \App\Survey::GetSurveys();
                                    @endphp
                                    <ul>
                                        @foreach($surveys as $survey)
                                            @php
                                                $total_ans=0;
                                                    $survey_count = \App\SurveyCount::where(['survey_id'=>$survey->id])->first();
                                            @endphp
                                            <li>
                                                <div class="servey_row" data-toggle="modal"
                                                     data-target="#Modal_serveydetails" id="{{$survey->id}}"
                                                     onclick="view_survey(this);">
                                                    <div class="servey_title">{{$survey->question}}</div>
                                                    <div class="progress">
                                                        @if($survey->question_type == 2)
                                                            @php
                                                                $total_ans += $survey_count->option1_count + $survey_count->option2_count;
                                                            @endphp
                                                            @if($total_ans > 0)
                                                                <div class="progress-bar progress-bar-info progress-bar-striped active"
                                                                     role="progressbar"
                                                                     aria-valuenow="{{round($survey_count->option1_count/$total_ans*100,2)}}"
                                                                     aria-valuemin="0"
                                                                     aria-valuemax="100" data-toggle="tooltip"
                                                                     data-placement="top"
                                                                     title="{{$survey->option1}}({{round($survey_count->option1_count/$total_ans*100,2)}}%)"
                                                                     style="width:{{round($survey_count->option1_count/$total_ans*100,2)}}%">
                                                                </div>
                                                                <div class="progress-bar progress-bar-danger progress-bar-striped active"
                                                                     role="progressbar"
                                                                     aria-valuenow="{{round($survey_count->option1_count/$total_ans*100,2)}}"
                                                                     aria-valuemin="0"
                                                                     aria-valuemax="100" data-toggle="tooltip"
                                                                     data-placement="top"
                                                                     title="{{$survey->option2}}({{round($survey_count->option2_count/$total_ans*100,2)}}%)"
                                                                     style="width:{{round($survey_count->option2_count/$total_ans*100,2)}}%">
                                                                </div>
                                                            @endif
                                                        @elseif($survey->question_type == 3)
                                                            @php
                                                                $total_ans += $survey_count->option1_count + $survey_count->option2_count+ $survey_count->option3_count;
                                                            @endphp

                                                            @if($total_ans > 0)
                                                                <div class="progress-bar progress-bar-info progress-bar-striped active"
                                                                     role="progressbar"
                                                                     aria-valuenow="{{round($survey_count->option1_count/$total_ans*100,2)}}"
                                                                     aria-valuemin="0"
                                                                     aria-valuemax="100" data-toggle="tooltip"
                                                                     data-placement="top"
                                                                     title="{{$survey->option1}}({{round($survey_count->option1_count/$total_ans*100,2)}}%)"
                                                                     style="width:{{round($survey_count->option1_count/$total_ans*100,2)}}%">
                                                                </div>
                                                                <div class="progress-bar progress-bar-danger progress-bar-striped active"
                                                                     role="progressbar"
                                                                     aria-valuenow="{{round($survey_count->option2_count/$total_ans*100,2)}}"
                                                                     aria-valuemin="0"
                                                                     aria-valuemax="100" data-toggle="tooltip"
                                                                     data-placement="top"
                                                                     title="{{$survey->option2}}({{round($survey_count->option2_count/$total_ans*100,2)}}
                                                                             %)"
                                                                     style="width:{{round($survey_count->option2_count/$total_ans*100,2)}}%">
                                                                </div>
                                                                <div class="progress-bar progress-bar-warning progress-bar-striped active"
                                                                     role="progressbar"
                                                                     aria-valuenow="{{round($survey_count->option3_count/$total_ans*100,2)}}"
                                                                     aria-valuemin="0"
                                                                     aria-valuemax="100" data-toggle="tooltip"
                                                                     data-placement="top"
                                                                     title="{{$survey->option3}}({{round($survey_count->option3_count/$total_ans*100,2)}}%)"
                                                                     style="width:{{round($survey_count->option3_count/$total_ans*100,2)}}%">
                                                                </div>
                                                            @else
                                                                @php
                                                                    $total_ans += $survey_count->option1_count + $survey_count->option2_count + $survey_count->option3_count + $survey_count->option4_count;
                                                                @endphp
                                                                @if($total_ans > 0)
                                                                    <div class="progress-bar progress-bar-success progress-bar-striped active"
                                                                         role="progressbar"
                                                                         aria-valuenow="{{round($survey_count->option1_count/$total_ans*100,2)}}"
                                                                         data-toggle="tooltip" data-placement="top"
                                                                         title="{{$survey->option1}}({{round($survey_count->option1_count/$total_ans*100,2)}}%)"
                                                                         aria-valuemin="0"
                                                                         aria-valuemax="100"
                                                                         style="width:{{round($survey_count->option1_count/$total_ans*100,2)}}%">
                                                                    </div>

                                                                    <div class="progress-bar progress-bar-info progress-bar-striped active"
                                                                         role="progressbar"
                                                                         aria-valuenow="{{round($survey_count->option2_count/$total_ans*100,2)}}"
                                                                         data-toggle="tooltip" data-placement="top"
                                                                         title="{{$survey->option2}}({{round($survey_count->option2_count/$total_ans*100,2)}}%)"
                                                                         aria-valuemin="0"
                                                                         aria-valuemax="100"
                                                                         style="width:{{round($survey_count->option2_count/$total_ans*100,2)}}%">
                                                                    </div>
                                                                    <div class="progress-bar progress-bar-danger progress-bar-striped active"
                                                                         role="progressbar"
                                                                         aria-valuenow="{{round($survey_count->option3_count/$total_ans*100,2)}}"
                                                                         data-toggle="tooltip" data-placement="top"
                                                                         title="{{$survey->option3}}({{round($survey_count->option3_count/$total_ans*100,2)}}%)"
                                                                         aria-valuemin="0"
                                                                         aria-valuemax="100"
                                                                         style="width:{{round($survey_count->option3_count/$total_ans*100,2)}}%">
                                                                    </div>
                                                                    <div class="progress-bar progress-bar-warning progress-bar-striped active"
                                                                         role="progressbar"
                                                                         aria-valuenow="{{round($survey_count->option4_count/$total_ans*100,2)}}"
                                                                         data-toggle="tooltip" data-placement="top"
                                                                         title="{{$survey->option4}}({{round($survey_count->option4_count/$total_ans*100,2)}}%)"
                                                                         aria-valuemin="0"
                                                                         aria-valuemax="100"
                                                                         style="width:{{round($survey_count->option4_count/$total_ans*100,2)}}%">
                                                                    </div>
                                                                @endif
                                                            @endif
                                                        @endif

                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                        {{--<li>--}}
                                        {{--<div class="servey_row" data-toggle="modal" data-target="#Modal_serveydetails">--}}
                                        {{--<div class="servey_title">क्या अयोध्या में राम की मूर्ति से मान जाएंगे नाराज--}}
                                        {{--साधु-संत?--}}
                                        {{--</div>--}}
                                        {{--<div class="progress">--}}
                                        {{--<div class="progress-bar progress-bar-success progress-bar-striped"--}}
                                        {{--role="progressbar"--}}
                                        {{--aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"--}}
                                        {{--style="width:40%">--}}
                                        {{--40% (yes)--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                        {{--</li>--}}
                                        {{--<li>--}}
                                        {{--<div class="servey_row" data-toggle="modal" data-target="#Modal_serveydetails">--}}
                                        {{--<div class="servey_title">क्या अयोध्या में राम की मूर्ति से मान जाएंगे नाराज--}}
                                        {{--साधु-संत?--}}
                                        {{--</div>--}}
                                        {{--<div class="progress">--}}
                                        {{--<div class="progress-bar progress-bar-success progress-bar-striped"--}}
                                        {{--role="progressbar"--}}
                                        {{--aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"--}}
                                        {{--style="width:40%">--}}
                                        {{--40% (yes)--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                        {{--</li>--}}
                                    </ul>

                                </div>
                            </div>
                        </div>
                        <div class="followers_block panel panel-default">
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
                                    <a class="follow_a enterprise_color"
                                       href="{{url('member-profession/Entreprener')}}"><i
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
            <div class="col-sm-2 dashboard_fixed earner_right">
                <div class="panel top_earner_block panel-default">
                    <div class="panel-heading basic_headgradian">
                        <b>Top Earners</b>
                        <div class="button_head glo_headbtn" id="earner_clkbtn"></div>
                    </div>
                    <div class="panel-body earn_body style-scroll">
                        <ul id="earners_block" class="news-ticker-images earner_ui">
                            {!!$top10earners_list!!}
                        </ul>
                    </div>


                </div>
            {{--<a href="https://www.accuweather.com/en/in/jabalpur/204410/weather-forecast/204410" class="aw-widget-legal">--}}
            {{--<!----}}
            {{--By accessing and/or using this code snippet, you agree to AccuWeather’s terms and conditions (in English) which can be found at https://www.accuweather.com/en/free-weather-widgets/terms and AccuWeather’s Privacy Statement (in English) which can be found at https://www.accuweather.com/en/privacy.--}}
            {{---->--}}
            {{--</a><div id="awcc1542631765607" class="aw-widget-current"  data-locationkey="204410" data-unit="c" data-language="en-us" data-useip="true" data-uid="awcc1542631765607"></div><script type="text/javascript" src="https://oap.accuweather.com/launch.js"></script>--}}
            <!-- weather widget start -->

                {{--<a target="_blank" href="https://www.booked.net/weather/jabalpur-36029"><img--}}
                {{--src="https://w.bookcdn.com/weather/picture/3_36029_1_1_3a618c_250_ffffff_333333_08488D_1_ffffff_333333_0_6.png?scode=124&domid=w209&anc_id=68429"--}}
                {{--alt="booked.net"/></a><!-- weather widget end -->--}}
                <script type="text/javascript" src="{{url('js/yahoo-weather-jquery-plugin.js')}}"></script>
                <div class="panel top_earner_block panel-default">
                    <div class="panel-heading basic_headgradian">
                        <b>Weather Forecast</b>
                        <div class="button_head glo_headbtn" id="earner_clkbtn"></div>
                    </div>
                    <div class="panel-body weather_forecast style-scroll">
                        {{--<div class="icon sun-shower">--}}
                            {{--<div class="cloud"></div>--}}
                            {{--<div class="sun">--}}
                                {{--<div class="rays"></div>--}}
                            {{--</div>--}}
                            {{--<div class="rain"></div>--}}
                            {{--<div class="lightning">--}}
                                {{--<div class="bolt"></div>--}}
                                {{--<div class="bolt"></div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="weat_temp">27°C</div>--}}
                        {{--<div class="weat_location">Jabalpur, India</div>--}}
                    </div>
                </div>
                <script type="text/javascript">
                    const main =()=> {
                        $('.weather_forecast').yahooWeather();
                    }
                    $(document).ready(main);
                </script>
            </div>
        </div>
    </section>
    <footer class="res_footermenu">
        <div class="footer_fixicon" onclick="Show_Topearner();"><i class="mdi mdi-currency-inr"></i></div>
        <div class="footer_fixicon" onclick="Show_Followers();"><i class="mdi mdi-chemical-weapon"></i></div>
        <div class="footer_fixicon" onclick="Show_LinkOptions();"><i class="mdi mdi-account-details"></i></div>
        <div class="footer_fixicon" onclick="Show_Survey();"><i class="mdi mdi-account-question"></i></div>
    </footer>
    {{------------------------Ads modal----------------}}
    <div id="Modal_Survey" class="modal fade" data-easein="bounceIn" role="dialog">
        <div class="modal-dialog survey_model">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
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
    <div id="modal_crop_forpost" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Crop and Download your image</h4>
                </div>
                <div class="modal-body">
                    <main class="page row">
                        <div class="box" style="display:none">
                            <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                    Browse… <input type="file" id="file-input"/>
                </span>
            </span>
                                <input type="text" id="file_text_crop" class="form-control" readonly=""/>
                            </div>
                            <p class="note_forcrop">
                                You can easily rotate, move and crop the image. double click are used to change the
                                event like move to 360 degree. ( image and crop frame )
                            </p>
                        </div>
                        <div class="box-2">
                            <div class="result">
                                <img class="cropped" id="image_frout" src="{{url('images/NoPreview_CropImg.png')}}"
                                     alt="">
                            </div>
                        </div>
                        <div class="box-2 img-result hide">
                            <img class="cropped" id="image_frout" src="" alt="">
                        </div>
                        <div class="box" id="cropbtn_setting">
                            {{--<div class="options hide">--}}
                            {{--<label> Width</label>--}}
                            {{--<input type="text" class="img-w" value="300" min="100" max="1200"/>--}}
                            {{--</div>--}}
                            <button class="btn btn-info btn-sm" disabled="disabled" id="btn_RotateLeft">
                                <i class="mdi mdi-format-rotate-90 basic_icon_margin"></i>Rotate Left
                            </button>
                            <button class="btn btn-warning btn-sm center_btnmargin" disabled="disabled"
                                    id="btn_RotateRight">
                                <i class="mdi mdi-rotate-right basic_icon_margin"></i>Rotate Right
                            </button>
                            <button class="btn btn-danger btn-sm" disabled="disabled" id="btn_RotateReset">
                                <i class="mdi mdi-rotate-3d basic_icon_margin"></i>Reset
                            </button>
                            <!-- <button class="btn btn-success" id="btn_getRounded">
                                 <i class="mdi mdi-rotate-3d basic_icon_margin"></i>Rounded</button>-->
                        </div>
                    </main>
                </div>
                <div class="modal-footer">
                    <a href="" target="_blank" class="btn btn-default download" disabled="disabled"
                       id="btncrop_download" download="imagename.png" style="display: none;">
                        <i class="mdi mdi-folder-download basic_icon_margin"></i>Download</a>
                    <button class="btn btn-primary save" id="save" onclick="Cropped_image();" disabled="disabled"><i
                                class="mdi mdi-crop basic_icon_margin"></i>Cropped
                    </button>
                    <button class="btn btn-success upload-result" disabled="disabled" id="save_toserver"
                            data-dismiss="modal"
                            onclick="UpdateImage();"><i class="mdi mdi-account-check basic_icon_margin"></i>
                        Save
                    </button>
                </div>
            </div>

        </div>
    </div>
    <div class="modal fade-scale in" id="Modal_serveydetails" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lb" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Please share your opinion</h4>
                </div>
                <div class="modal-body" id="survey_body">
                    {{--<div class="servey_question"><i class="mdi mdi-help-circle basic_icon_margin"></i>--}}
                    {{--<span id="view_survey_question">क्या अयोध्या में राम की मूर्ति से मान जाएंगे नाराज साधु-संत?</span>--}}
                    {{--</div>--}}
                    {{--<div class="servey_ans">--}}
                    {{--<div class="radio">--}}
                    {{--<input id="radio-1" value="yes" class="gender" name="servey_radio" type="radio" checked="">--}}
                    {{--<label for="radio-1" class="radio-label">Yes</label>--}}
                    {{--</div>--}}
                    {{--<div class="radio">--}}
                    {{--<input id="radio-2" value="no" class="gender" name="servey_radio" type="radio">--}}
                    {{--<label for="radio-2" class="radio-label">No</label>--}}
                    {{--</div>--}}

                    {{--</div>--}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="save_survey();" {{--data-dismiss="modal"--}}>
                        Submit
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        /*******************Survey 09-11-2018*********************/
        function save_survey() {
            var ckbox = $("input[name='servey_radio']");
            var survey_ans = '';
            $("input[name='servey_radio']:checked").each(function () {
                survey_ans = $(this).val();
            });
            var survey_id = $("#servey_id").val();

            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: '{{ url('save_survey') }}',
                data: {survey_id: survey_id, survey_ans: survey_ans},
                success: function (data) {
                    $('#Modal_serveydetails').modal('hide');
                    if (data == 'Success') {
                        success_noti("Survey has been successful")
                    }
                },
                error: function (xhr, status, error) {
                    $('#modal_body').html(xhr.responseText);
                }
            });
        }
        function view_survey(dis) {
            var survey_id = $(dis).attr('id');
            var editurl = '{{ url('view_survey') }}';
            $('#modal_body').html('<img height="50px" class="center-block" src="{{url('images/loading.gif')}}"/>');
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: editurl,
                data: {survey_id: survey_id},
                success: function (data) {
                    $('#survey_body').html(data);
                },
                error: function (xhr, status, error) {
                    $('#survey_body').html(xhr.responseText);
                }
            });
        }
        /*******************Survey 09-11-2018*********************/
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
                // $('.profile_basic_menu_block').addClass('left_menu_fixed');
                // $('.all_right_block').addClass('right_menu_fixed');
            }
//            if ($(window).scrollTop() + $(window).height() == $(document).height()) {
            if ($(window).scrollTop() + window.innerHeight == $(document).height()) {
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
                img_ids = [];
                var i = 0;
                $('.up_img').each(function () {
                    var getimg_id = $(this).attr('src');
//                    img_ids.push([getimg_id.replace('data:image/png;base64,', '')]);
                    img_ids[i] = $(this).attr('src');
                    i++;
                });

                var files = img_ids;
//                alert(img_ids);
//                console.log(img_ids);
//                var files = $('#upload_file_image').val();
//                alert(img_ids.length);
//                (img_ids.length > 0) ? $('#post_img_src').val(JSON.stringify(img_ids)) : $('#post_img_src').val('');
                var videos = $('#upload_file_video').val();
                var adverimg_length = $('.upimg_box').length;
                if (textval.trim() == '' && files == '' && videos == '') {
                    warning_noti("You can't post without any text or image or video");
                    HideOnpageLoopader1();
                } else if (adverimg_length > 10) {
                    warning_noti("You can upload maximum 10 images for post");
                    HideOnpageLoopader1();
                } else {
//                    $('#post_img_src').val(JSON.stringify(files));
                    swal({
                        title: "Are you sure?",
                        text: "You want to submit this post...!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    }).then((okk) => {
                            if (okk) {
                                //$('#post_img_src').val(JSON.stringify(files));


//                                alert($('#post_img_src').val());
                                $('#post_img_src').val(JSON.stringify(files));
                                $.ajax({
                                    type: 'POST',
                                    url: "{{ url('new_user_post') }}",
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
                                        console.log(data);
                                        $('#loader').css('display', 'none');
                                        HideOnpageLoopader1();
                                        success_noti("Your post has been uploaded...");
                                        //setprivacy('Public');
                                        $('#post_img_src').val('');
                                        $('#location-input').val('');
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
                                        $('#loader').css('display', 'none');
//                                        $('#err1').html(xhr.responseText);
                                        $('#userpostForm').css("opacity", "");
                                        $("#publish").removeAttr("disabled", "disabled");
                                        console.log(xhr.responseText);
                                        //                                    swal("Oops!", "Post has not been finished...Please try again", "info");
                                        warning_noti("Post has not been finished...Please try again");
                                    }
                                });
                            }
                        }
                    );

                }
            });
            dashboardpostload();
//            $('.scrollingtext span').each(function () {
//                debugger;
//                var checktxt = $(this).text();
//                if (checktxt == "Add this widget to your site") {
//                    $(this).remove();
//                }
//            });
        });
    </script>
    <script type="text/javascript" src="{{url('js/cropper.min.js')}}"></script>
    <script type="text/javascript" src="{{url('js/post-crop.js')}}"></script>

@stop