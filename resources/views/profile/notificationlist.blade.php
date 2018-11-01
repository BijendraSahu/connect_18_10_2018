<span class="mdi mdi-earth"></span>
@if(count($unread_notifications)>0)
    <div class="total_count" id="unread_noti_id">{{count($unread_notifications)}}</div>
@endif
<div class="menu_basic_popup effect scale0 notification_popbox">
    <div class="menu_popup_head">Notification</div>

    <div class="menu_popup_containner chat_scroll style-scroll" id="noti_row_container">
        @if(count($notifications)>0)
            @foreach($notifications as $notification)
                @php
                    $notify_by = \App\UserModel::find($notification->notified_by);
                @endphp
                <div class="menu_popup_row {{$notification->seen == 0 ?'unseen':''}}">
                    <div class="menu_popup_imgbox"><img src="{{url('').'/'.$notify_by->profile_pic}}"
                                                        class="profile_img"></div>
                    {{--<div class="menu_popup_text">--}}
                    {{--@if(isset($notification->post_id))--}}
                    {{--<div class="popup_text" onclick="show_notification_post('{{$notification->post_id}}')"--}}
                    {{--data-toggle="modal"--}}
                    {{--data-target="#Mymodal_notification">{!! $notification->description !!}</div>--}}
                    {{--@else--}}
                    {{--<div class="popup_text">{!! $notification->description !!}</div>--}}
                    {{--@endif--}}
                    {{--<div class="popup_iconwithtime"><i--}}
                    {{--class="mdi mdi-calendar-clock"></i> {{ date_format(date_create($notification->created_at), "d-M-Y h:i a")}}--}}
                    {{--</div>--}}
                    {{--</div>--}}

                    @if(isset($notification->post_id))
                        <div class="menu_popup_text" onclick="show_notification_post('{{$notification->post_id}}')"
                             data-toggle="modal"
                             data-target="#Mymodal_notification">
                            <div class="popup_text">{!! $notification->description !!}</div>
                            <div class="popup_iconwithtime"><i
                                        class="mdi mdi-calendar-clock"></i> {{ date_format(date_create($notification->created_at), "d-M-Y h:i a")}}
                            </div>
                        </div>
                    @else
                        <div class="menu_popup_text" title="view mode only">
                            <div class="popup_text">{!! $notification->description !!}</div>
                            <div class="popup_iconwithtime"><i
                                        class="mdi mdi-calendar-clock"></i> {{ date_format(date_create($notification->created_at), "d-M-Y h:i a")}}
                            </div>
                        </div>

                    @endif


                    <div class="noti_optionsbox">
                        <div class="btn-group dropleft">
                            <button type="button" class="btn noti_option_icon btn-secondary dropdown-toggle"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    onclick="showhide_notioption(this);">
                                <i class="mdi mdi-dots-horizontal"></i>
                            </button>
                            <div class="dropdown-menu show notifi_options scalenoti">
                                @if($notification->seen == 0)
                                    <div class="noti_opti_row" id="{{$notification->id}}" onclick="MarkRead(this);"><i
                                                class="mdi mdi-eye basic_icon_margin" style="color: #07d;"></i>Mark as
                                        read
                                    </div>
                                @endif
                                <div class="noti_opti_row" id="{{$notification->id}}"
                                     onclick="RemoveNotification(this);"><i
                                            class="mdi mdi-close color_red basic_icon_margin"
                                            style="color: #ff0000;"></i>Remove notification
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--<div class="menu_popup_row">--}}
                {{--<div class="menu_popup_imgbox"><img src="{{url('images/Male_default.png')}}"--}}
                {{--class="profile_img"></div>--}}
                {{--<div class="menu_popup_text">--}}
                {{--<p class="popup_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit,--}}
                {{--sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim--}}
                {{--veniam,</p>--}}
                {{--<div class="popup_iconwithtime"><i class="mdi mdi-calendar-clock"></i> 28-Dec-2017</div>--}}
                {{--</div>--}}
                {{--</div>--}}
            @endforeach
        @else
            <p class="alert"><b>< No Pending Notification ></b></p>
        @endif
    </div>
</div>
