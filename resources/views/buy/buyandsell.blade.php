@extends('layout.master.master')

@section('title', 'Buy And Sell')

@section('head')
    <section class="notofication_containner">
        <div class="container">
            <div class="row">
                <div class="advertiselist_block">
                    <div class="advertise_withhead">
                        <div class="col-sm-4 col-xs-12 head_caption">Buy & Sell List</div>
                        <div class="col-sm-8 col-md-5 col-xs-12 pull-right search_withview">

                            <div class="viewtype_block">
                                <div class="viewtype_txt">View</div>
                                <div class="type_brics brics_selected" onclick="show_listview(this);"><i
                                            class="mdi mdi-view-list"></i></div>
                                <div class="type_brics" onclick="showthumbview(this);"><i class="mdi mdi-view-grid"></i>
                                </div>
                            </div>
                            <div class="input-group add-on glo_searchbox">
                                <input class="form-control" placeholder="Search by title, city" name="srch-term"
                                       id="Search" type="text" onkeyup="getBuyItem()">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i
                                                class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(session()->has('message'))
                        <script type="text/javascript">
                            setTimeout(function () {
                                ShowSuccessPopupMsg('{{ session()->get('message') }}');
                            }, 500);
                        </script>
                    @endif
                    <div class="advertise_list_res" id="adver_responsive">
                        <div class="res_adver_type">
                            <i class="res_adver_icon mdi mdi-briefcase-check"></i>
                            Advertise Category
                            <i class="res_adver_arrow mdi mdi-chevron-double-right"></i>
                        </div>
                    </div>
                    <div class="advertise_category" id="advertise_category_block">
                        @foreach($ad_category as $category)
                            <a class="adver_brics" href="{{url('bsc').'/'.encrypt($category->id)}}">
                                <span class="brics_icon"><i><img src="{{url('').'/'.$category->icon_url}}"
                                                                 alt=""></i></span>
                                <span class="brics_txt">{{$category->category}}</span>
                            </a>
                        @endforeach
                        <a class="adver_brics" href="{{url('buy')}}">
                                <span class="brics_icon"><i><img src="{{url('cat_icon/other.png')}}"
                                                                 alt=""></i></span>
                            <span class="brics_txt">All</span>
                        </a>
                        {{--<a class="adver_brics" href="advertise_list.php">--}}
                        {{--<span class="brics_icon"><i class="mdi mdi-bike"></i></span>--}}
                        {{--<span class="brics_txt">Bike</span>--}}
                        {{--</a>--}}
                        {{--<a class="adver_brics" href="advertise_list.php">--}}
                        {{--<span class="brics_icon"><i class="mdi mdi-television"></i></span>--}}
                        {{--<span class="brics_txt">Electronics</span>--}}
                        {{--</a>--}}
                        {{--<a class="adver_brics" href="advertise_list.php">--}}
                        {{--<span class="brics_icon"><i class="mdi mdi-cellphone-iphone"></i></span>--}}
                        {{--<span class="brics_txt">Mobile</span>--}}
                        {{--</a>--}}
                        {{--<a class="adver_brics" href="advertise_list.php">--}}
                        {{--<span class="brics_icon"><i class="mdi mdi-home-automation"></i></span>--}}
                        {{--<span class="brics_txt">Property</span>--}}
                        {{--</a>--}}
                        {{--<a class="adver_brics" href="advertise_list.php">--}}
                        {{--<span class="brics_icon"><i class="mdi mdi-chair-school"></i></span>--}}
                        {{--<span class="brics_txt">Furniture</span>--}}
                        {{--</a>--}}
                        {{--<a class="adver_brics" href="advertise_list.php">--}}
                        {{--<span class="brics_icon"><i class="mdi mdi-wrench"></i></span>--}}
                        {{--<span class="brics_txt">Services</span>--}}
                        {{--</a>--}}
                        {{--<a class="adver_brics" href="advertise_list.php">--}}
                        {{--<span class="brics_icon"><i class="mdi mdi-account-network"></i></span>--}}
                        {{--<span class="brics_txt">Jobs</span>--}}
                        {{--</a>--}}

                        {{--<a class="adver_brics" href="advertise_list.php">--}}
                        {{--<span class="brics_icon"><i class="mdi mdi-human-child"></i></span>--}}
                        {{--<span class="brics_txt">Fashion</span>--}}
                        {{--</a>--}}
                        {{--<a class="adver_brics" href="advertise_list.php">--}}
                        {{--<span class="brics_icon"><i class="mdi mdi-briefcase-check"></i></span>--}}
                        {{--<span class="brics_txt">Other</span>--}}
                        {{--</a>--}}
                    </div>
                    <div class="advertise_list_containner" id="list_container">

                        @if(count($ads) > 0)
                            @foreach($ads as $ad)
                                <div class="adver_list_row target">
                                    <div class="list_imgbox">
                                        <?php $cat_img = \App\AdsImages::where(['ad_id' => $ad->id])->first(); ?>
                                        @if(isset($cat_img->image_url))
                                            <img src="{{url('').'/'.$cat_img->image_url}}"/>
                                            <div class="pics_counter_box"><i class="mdi mdi-camera"></i>
                                                <span class="addver_cunter">+3</span>
                                                <a class="example-image-link"
                                                   href="{{url('').'/'.$cat_img->image_url}}"
                                                   data-lightbox="feed_post{{$ad->id}}">
                                                    <img class="example-image"
                                                         src="{{url('').'/'.$cat_img->image_url}}"></a>
                                                <a class="example-image-link"
                                                   href="{{url('images/Adver_mainimg1.jpg')}}"
                                                   data-lightbox="feed_post{{$ad->id}}">
                                                    <img class="example-image"
                                                         src="{{url('images/Adver_mainimg1.jpg')}}"></a>
                                                <a class="example-image-link"
                                                   href="{{url('images/Adver_mainimg3.jpg')}}"
                                                   data-lightbox="feed_post{{$ad->id}}">
                                                    <img class="example-image"
                                                         src="{{url('images/Adver_mainimg3.jpg')}}"></a>
                                            </div>
                                        @else
                                            <img src="{{url('images/Adver_mainimg1.jpg')}}"/>
                                        @endif
                                        {{--<ul class="lightgallery list-unstyled" lg-uid="lg6">--}}
                                        {{--<li data-src="http://lagnphere.com/user_images/uuimg.png"--}}
                                        {{--lg-event-uid="&amp;7">--}}
                                        {{--<img src="http://lagnphere.com/uuimg1.png">--}}
                                        {{--</li>--}}
                                        {{--</ul>--}}

                                        {{--<a class="example-image-link"--}}
                                        {{--href="{{url('').'/'.$media->media_url}}"--}}
                                        {{--data-lightbox="feed_post{{$post[$i]['id']}}">--}}
                                        {{--<img class="example-image"--}}
                                        {{--src="{{url('').'/'.$media->media_url}}"></a>--}}
                                    </div>
                                    <div class="list_details">
                                        <div class="list_title" onclick="ShowAdvertiseDetails(this);"
                                             href="#Modal_ViewDetails_LatestNews" data-toggle="modal">
                                            @if(isset($ad->ad_title))
                                                {{$ad->ad_title}}
                                            @else
                                                -
                                            @endif
                                        </div>
                                        <div class="list_price"><i class="mdi mdi-currency-inr"></i>15000</div>
                                        <div class="list_description">
                                            @if(isset($ad->ad_description))
                                                {{$ad->ad_description}}
                                            @else
                                                -
                                            @endif
                                        </div>
                                        <div class="list_address"><i
                                                    class="mdi mdi-map-marker"></i>
                                            @if(isset($ad->city))
                                                {{$ad->city}}
                                            @else
                                                -
                                            @endif
                                            </div>
                                        <div class="list_contact"><i
                                                    class="mdi mdi-phone-incoming basic_icon_margin"></i>9589883533 </div>
                                        <div class="list_email"><i
                                                    class="mdi mdi-email basic_icon_margin"></i>pinkukesharwani89@gmail.com</div>
                                        <input type="hidden" class="list_adver_type"
                                               value=" @if(isset($ad->ad_category_id))
                                               {{$ad->ad_cat->category}}
                                               @else
                                                       -
                                                   @endif"/>

                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="adver_list_row" id="no_record_found_block">
                                <span class="list_no_record">< No Record Available ></span>
                            </div>
                        @endif
                        {{--<div class="adver_list_row">--}}
                        {{--<div class="list_imgbox">--}}
                        {{--<img src="images/Adver_img2.jpg"/>--}}
                        {{--</div>--}}
                        {{--<div class="list_details">--}}
                        {{--<div class="list_title" href="#Modal_ViewDetails_LatestNews" data-toggle="modal">--}}
                        {{--SPACIOUS 3 BED RESIDENCIES AT OUR FLAGSHIP PROJECT--}}
                        {{--</div>--}}
                        {{--<div class="list_description">--}}
                        {{--Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor--}}
                        {{--incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud--}}
                        {{--exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.--}}
                        {{--</div>--}}
                        {{--<div class="list_address"><i class="mdi mdi-map-marker"></i>Jabalpur</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="adver_list_row">--}}
                        {{--<div class="list_imgbox">--}}
                        {{--<img src="images/Adver_img3.jpg"/>--}}
                        {{--</div>--}}
                        {{--<div class="list_details">--}}
                        {{--<div class="list_title" href="#Modal_ViewDetails_LatestNews" data-toggle="modal">--}}
                        {{--SPACIOUS 3 BED RESIDENCIES AT OUR FLAGSHIP PROJECT--}}
                        {{--</div>--}}
                        {{--<div class="list_description">--}}
                        {{--Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor--}}
                        {{--incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud--}}
                        {{--exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.--}}
                        {{--</div>--}}
                        {{--<div class="list_address"><i class="mdi mdi-map-marker"></i>Jabalpur</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="adver_list_row">--}}
                        {{--<div class="list_imgbox">--}}
                        {{--<img src="images/Adver_img4.jpg"/>--}}
                        {{--</div>--}}
                        {{--<div class="list_details">--}}
                        {{--<div class="list_title" href="#Modal_ViewDetails_LatestNews" data-toggle="modal">--}}
                        {{--SPACIOUS 3 BED RESIDENCIES AT OUR FLAGSHIP PROJECT--}}
                        {{--</div>--}}
                        {{--<div class="list_description">--}}
                        {{--Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor--}}
                        {{--incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud--}}
                        {{--exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.--}}
                        {{--</div>--}}
                        {{--<div class="list_address"><i class="mdi mdi-map-marker"></i>Jabalpur</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        var append_norecord = '<div class="adver_list_row no_block" id="no_record_found_block"><span class="list_no_record">' +
            '< No Record Available ></span></div>';
        function getBuyItem() {
            var check_rowcount = $('.adver_list_row').length;
            if (check_rowcount > 0) {
                var input = document.getElementById("Search");
                var filter = input.value.toLowerCase();
                var nodes = document.getElementsByClassName('target');
                for (i = 0; i < nodes.length; i++) {
                    if (nodes[i].innerText.toLowerCase().includes(filter)) {
                        nodes[i].style.display = "block";
                        $('#no_record_found_block').remove();
                    } else {
                        nodes[i].style.display = "none";
                    }
                }
                if ($('.target:visible').length == 0) {
                    $('.no_block').remove();
                    $('#list_container').append(append_norecord);
                } else {
                    $('#list_container').find('.no_block').remove();
                }
            }
        }

        function show_listview(dis) {
            $('.adver_list_row').removeClass('adver_list_thumbview');
            $('.type_brics').removeClass('brics_selected');
            $(dis).addClass('brics_selected');
        }
        function showthumbview(dis) {
            $('.adver_list_row').addClass('adver_list_thumbview');
            $('.type_brics').removeClass('brics_selected');
            $(dis).addClass('brics_selected');
        }
    </script>
@stop