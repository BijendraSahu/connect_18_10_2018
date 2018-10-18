@extends('layout.master.master')

@section('title', 'Profession Members')

@section('head')
    <style type="text/css">

    </style>
    <section class="notofication_containner">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="all_left_brics_container">
                    <div class="left_common_block">
                        <div class="icon_circle" style="background-color: #f8c301;">
                            <i class="mdi mdi-currency-inr"></i>
                        </div>
                        <div class="basic_heading">
                            My Earning
                            <a href="{{url('my-earning')}}" class="btn btn-primary post_btn_photo"><i
                                        class="basic_icons mdi mdi-view-module"></i>View All
                            </a>
                        </div>
                        <div class="basic_count" style="color: #f8c301;">Rs {{$total_earning}} /-</div>
                    </div>
                    <div class="left_common_block">
                        <div class="icon_circle" style="background-color: #007cc2;">
                            <i class="mdi mdi-sitemap"></i>
                        </div>
                        <div class="basic_heading">
                            My Networks
                            <a href="{{url('my-network')}}" class="btn btn-primary post_btn_photo"><i
                                        class="basic_icons mdi mdi-view-module"></i>View All
                            </a>
                        </div>
                        <div class="basic_count" style="color: #007cc2;">{{$getMembersCount}} Members</div>
                    </div>
                    <div class="left_common_block about_common">
                            <div class="basic_heading">
                                About
                            </div>
                            {{--                        <div class="profile_name network_name">{{$timeline->fname}}</div>--}}
                            <div class="profile_follow"><i
                                        class="profile_icons mdi mdi-calendar"></i>{{ date_format(date_create($user->birthday), "d-M-Y")}}
                            </div>
                            <div class="profile_follow"><i class="profile_icons mdi mdi-phone"></i>{{$user->contact}}</div>
                            <div class="profile_follow" style="margin-bottom: 0px;border: none;"><i
                                        class="profile_icons mdi mdi-map-marker"></i>{{isset($user->address)?$user->address:'-'}}
                            </div>
                        </div>
                    </div>
                    <!--<div class="basic_thumb">
                        <div class="icon_circle" style="background-color: #07a20d;">
                            <i class="mdi mdi-chemical-weapon"></i>
                        </div>
                        <div class="basic_heading">
                            My Friends
                            <a href="AllMembers.php" class="btn btn-primary post_btn_photo"><i class="basic_icons mdi mdi-view-module"></i>View All
                            </a>
                        </div>
                        <div class="basic_count" style="color: #07a20d;">12,000</div>
                    </div>-->
                </div>
                <div class="col-sm-12 col-md-9">
                    <div class="network_block">
                        <div class="net_imgblk">
                            <div class="net_img">
                                {{--<img src="images/ConnectingOneAdmin.jpg" class="" />--}}
                                <img src="{{url('').'/'.$user->profile_pic}}" alt="UserProfile">
                            </div>
                        </div>
                        <!--  <div class="net_arrow_blk">
                              <div class="arrow_blk">
                                  <i class="mdi mdi-arrow-down-bold"></i>
                              </div>
                          </div>-->
                        <!-- <div class="net_long_line">
                         </div>-->
                        <!--<div class="level_caption">Level 0</div>-->
                        <div class="net_internaldiv">
                            <div class="user_image_containner">
                                @if(count($friendlist)>0)
                                    @foreach($friendlist as $friend)
                                        <a class="col-sm-3 col-xs-6" href="{{url('friend?search='.$friend->fid)}}">
                                            <div class="network_user_block">
                                                <div class="connected_imgbox"><img
                                                            src="{{url('').'/'.$friend->profile_pic}}">
                                                </div>
                                                <div class="connected_name">{{$friend->name}}</div>
                                                <?php
                                                $ff_count = \App\Friend::whereRaw("(user_id = $friend->fid or friend_id = $friend->fid) and (status = 'friends')")->count();
                                                ?>
                                                <div class="connected_totalmember"><i
                                                            class="mdi mdi-account-multiple"></i>{{$ff_count}}
                                                    Friends
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                @else
                                    <div class="adver_list_row">
                                        <span class="list_no_record">< No Record Available ></span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{--<div class="text-center">--}}
                        {{--<div class="more_btn btn btn-warning"><i class="basic_icon mdi mdi-arrow-right-bold"></i>--}}
                        {{--See More--}}
                        {{--</div>--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop