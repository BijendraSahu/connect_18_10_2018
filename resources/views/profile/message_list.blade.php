<span class="mdi mdi-email"></span>
@if(count($friendrqst)>0)
    <div class="total_count">{{count($friendrqst)}}</div>
@endif
<div class="menu_basic_popup effect scale0 notification_popbox">
    <div class="menu_popup_head">Messages <div class="basic_popup_close" onclick="Hidepopup('hide');"><i class="mdi mdi-close"></i></div></div>

    <div class="menu_popup_containner  chat_scroll style-scroll">
        @if(count($friendrqst)>0)
            @foreach($friendrqst as $notification)
                <div class="menu_popup_row">
                    <div class="menu_popup_imgbox"><img src="{{url('images/Male_default.png')}}"
                                                        class="profile_img"></div>
                    <div class="menu_popup_text">
                        <p class="popup_text">You have one friend request</p>
                        <div class="popup_iconwithtime"><i
                                    class="mdi mdi-calendar-clock"></i> {{ date_format(date_create($notification->date), "d-M-Y")}}
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
            <p class="alert">< No Pending Notification ></p>
        @endif
    </div>
</div>