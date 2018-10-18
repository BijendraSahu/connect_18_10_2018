<style>
    @media only screen and (max-width: 540px) {
        .chat-sidebar {
            display: none !important;
        }

        .chat-popup {
            display: none !important;
        }
    }

    .chat-sidebar {
        width: 100%;
        height: 100%;
        max-height: 100%;
        overflow: auto;
        background-color: #ffffff;
        padding: 5px 0px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.02), 0 1px 5px rgba(0, 0, 0, 0.05);
        transition: 1s all;
    }


    .sidebar-name {
        font-size: 12px;
        position: relative;
        padding: 0px 20px 3px 50px;
        border-bottom: solid thin #e1e1e1;
    }

    .sidebar-name a {
        display: block;
        text-decoration: none;
        color: inherit;
    }

    .chatbot_name {
        line-height: 30px;
        width: 100%;
        display: inline-block;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .chat_status {
        width: 10px;
        height: 10px;
        position: absolute;
        background: #ccc;
        border-radius: 50%;
        right: 10px;
        top: 13px;
    }

    .online {
        background: #43a747;
    }

    .sidebar-name img {
        width: 30px;
        height: 30px;
        position: absolute;
        left: 10px;
        top: 3px;
        border-radius: 30px;
    }

    .sidebar-name:hover {
        background-color: #f5f5f5;
    }

    .popup-box {
        display: none;
        position: fixed;
        bottom: 0px;
        right: 220px;
        height: 300px;
        background-color: rgb(237, 239, 244);
        width: 300px;
        border: 1px solid rgb(0, 0, 0);
        padding-bottom: 80px;
        z-index: 10;
    }

    .popup-head {
        background-color: #000000;
        padding: 5px;
        color: white;
        font-weight: bold;
        font-size: 12px;
        display: inline-block;
        width: 100%;
    }

    .popup-box .popup-head .popup-head-left {
        float: left;
    }

    .popup-box .popup-head .popup-head-right {
        float: right;
        opacity: 0.6;
    }

    .popup-box .popup-head .popup-head-right:hover {
        opacity: 1;
    }

    .popup-box .popup-head .popup-head-right a {
        text-decoration: none;
        color: inherit;
    }

    .popup-box .popup-messages {
        height: 100%;
        overflow-y: scroll;
    }

    /*----------------------Internal Chat-------------*/
    .base_sent {
        justify-content: flex-end;
        align-items: flex-end;
    }

    .msg_container {
        display: flex;
        margin-bottom: 10px;
    }

    .msg_sent {
        padding-bottom: 20px !important;
        margin-right: 0;
    }

    .messages {
        background: white;
        padding: 5px;
        border-radius: 2px;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        max-width: 100%;
    }

    .messages > p {
        font-size: 12px;
        margin: 0 0 0.2rem 0;
    }

    .msg_sent > time {
        float: right;
    }

    .messages > time {
        font-size: 11px;
        color: #ccc;
    }

    .avatar {
        position: relative;
    }

    .chatbot_img {
        display: block;
        max-width: 100%;
        height: auto;
        border-radius: 50%;
        border: 1px solid #fff;
        box-shadow: 5px 8px 20px rgba(199, 199, 199, 0.19), 0 2px 5px rgba(107, 100, 100, 0.23);
    }

    .base_sent > .avatar:after {
        content: "";
        position: absolute;
        bottom: 0;
        left: -10px;
        width: 0;
        height: 0;
        border: 5px solid #989898;
        border-right-color: transparent;
        border-top-color: transparent;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.11), 0 1px 5px rgba(0, 0, 0, 0.05);
    }

    .base_receive > .avatar:after {
        content: "";
        position: absolute;
        top: 0;
        right: -10px;
        width: 0;
        height: 0;
        border: 5px solid #989898;
        border-left-color: rgba(0, 0, 0, 0);
        border-bottom-color: rgba(0, 0, 0, 0);
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.11), 0 1px 5px rgba(0, 0, 0, 0.05);
    }

    .chatbot_typebox {
        position: absolute;
        bottom: 5px;
        width: 100%;
        padding: 0px 10px;
    }

    .chatbot_emoji {
        height: auto !important;
        min-height: 30px;
    }

    /*----------------Chat Scroller ----------*/
    .msg_container_base::-webkit-scrollbar {
        width: 12px;
        background-color: #F5F5F5;
    }

    .msg_container_base::-webkit-scrollbar-thumb {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, .3);
        background-color: #555;
    }

    .msg_container_base::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
        background-color: #F5F5F5;
    }
    .friend_chat_arrow
    {
        position: absolute;
        width: 40px;
        height: 40px;
        left: -40px;
        background: #007ac2;
        color: #fff;
        text-align: center;
        line-height: 40px;
        font-size: 20px;
        top: 0px;
        border-right: solid thin #e1e1e1;
        border-radius: 20px 0px 0px 20px;
        padding-left: 5px;
        transition: 1s all;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0), 0 1px 5px rgba(0, 0, 0, 0.05);
        cursor: pointer;
    }
    .friend_chat_arrow:hover {
        background-color: #fff;
        color: #007ac2;
    }
    .glo_chat_btn
    {
        position: fixed;
        right: 15px;
        cursor: pointer;
        text-align: center;
        bottom: 15px;
        width: 50px;
        height: 50px;
        z-index: 100;
        background: #007cc2;
        border-radius: 50%;
        color: #fff;
        line-height: 50px;
        font-size: 30px;
        transition: .1s all;
    }
    .glo_chat_btn_hide
    {
        right: -100%;
    }
    .glo_chat_btn:hover
    {
        background: #9b8a30;
    }
    .glo_chat_btn i{

    }
    .chat_scroll::-webkit-scrollbar
    {
        border: solid thin #ccc;
    }
    .chat_scroll::-webkit-scrollbar-thumb
    {
        background-color: rgb(9, 98, 148);
    }
    .chatlist_mainbox {
        position: fixed;
        transition: .5s all;
        z-index: 110;
        right: -100%;
        display: inline-block;
        width: 200px;
        bottom: 0px;
        height: -moz-calc(100% - (70px));
        height: -webkit-calc(100% - (70px));
        height: calc(100% - (80px));
        max-height: -webkit-calc(100% - (80px));
        max-height: -moz-calc(100% - (80px));
        max-height: calc(100% - (80px));
        padding: 5px 0px;
        background: #fff;
    }
    .chat_sidebar_show
    {
        right: 0;
    }
</style>
<script type="text/javascript">
   /* function Initilise_emoji() {
        $('.chat-popup').each(function () {
            var check_emoji_initialize = $(this).find('.chatbot_emoji').next().attr('class');
            if (check_emoji_initialize.indexOf('chatbot_emoji') != -1) {
                $(this).find('.emojionearea').remove();
                // $(this).find('.chatbot_emoji').show();
                $(this).find(".chatbot_emoji").text('');
                $(this).find(".chatbot_emoji").emojioneArea({
                    pickerPosition: "top"
                });
            } else {
                $(this).find(".chatbot_emoji").text('');
                $(this).find(".chatbot_emoji").emojioneArea({
                    pickerPosition: "top"
                });
            }
        });
    }*/
    function Initilise_emoji() {
        $('.chatbot_emoji').each(function () {
            if ($(this).parent().find('.emojionearea').length<1)
            {
                $(this).text('');
                $(this).emojioneArea({
                    pickerPosition: "top",
                    tonesStyle: "radio",
                    placeholder: "write a massage here"
                });
            }
        });
    }

    //this function can remove a array element.
    Array.remove = function (array, from, to) {
        var rest = array.slice((to || from) + 1 || array.length);
        array.length = from < 0 ? array.length + from : from;
        return array.push.apply(array, rest);
    };
    //this variable represents the total number of popups can be displayed according to the viewport width
    var total_popups = 0;
    //arrays of popups ids
    var popups = [];
    //this is used to close a popup
    function close_popup(id) {
        var addcontainer_id = id + "_scrollcontainer";
        for (var iii = 0; iii < popups.length; iii++) {
            if (id == popups[iii]) {
                Array.remove(popups, iii);
                document.getElementById(id).style.display = "none";
                calculate_popups(addcontainer_id);
                return;
            }
        }
    }

    //displays the popups. Displays based on the maximum number of popups that can be displayed on the current viewport width
    function display_popups(addcontainer_id) {
        var right = 220;
        var iii = 0;
        for (iii; iii < total_popups; iii++) {
            if (popups[iii] != undefined) {
                var element = document.getElementById(popups[iii]);
                element.style.right = right + "px";
                right = right + 320;
                element.style.display = "block";
            }
        }
        for (var jjj = iii; jjj < popups.length; jjj++) {
            var element = document.getElementById(popups[jjj]);
            element.style.display = "none";
        }
        $('.' + addcontainer_id).animate({scrollTop: $('.' + addcontainer_id).prop("scrollHeight")}, 500);
        Initilise_emoji();
    }
    //creates markup for a new popup. Adds the id to popups array.
    function register_popup(id, name) {
        var addcontainer_id = id + "_scrollcontainer";
        for (var iii = 0; iii < popups.length; iii++) {
            //already registered. Bring it to front.
            if (id == popups[iii]) {
                Array.remove(popups, iii);
                popups.unshift(id);
                calculate_popups(addcontainer_id);
                //Initilise_emoji();
                return;
            }
        }
        //


        var element = '<div class="popup-box chat-popup" id="' + id + '">';
        element = element + '<div class="popup-head">';
        element = element + '<div class="popup-head-left">' + name + '</div>';
        element = element + '<div class="popup-head-right"><a href="javascript:close_popup(\'' + id + '\');">&#10005;</a></div>';
        element = element + '</div><div class="popup-messages msg_container_base ' + addcontainer_id + '" id="' + addcontainer_id + '">';
        /*=------------Send By Current User Div Append-----------*/
        element = element + '<div class="msg_container base_sent"><div class="col-md-10 col-xs-10">';
        element = element + '<div class="messages msg_sent"><p>that mongodb thing looks good, huh? and huge document store</p>';
        element = element + '<time datetime="13-Feb-2018 5:30pm">13-Feb-2018 5:30pm</time></div></div>';
        element = element + ' <div class="col-md-2 col-xs-2 avatar">';
        element = element + '<img src="images/Frount_userpic1.jpeg" class="chatbot_img"></div></div>';
        /*=------------Send By connecter Div Append-----------*/
        element = element + '<div class="msg_container base_receive">';
        element = element + '<div class="col-md-2 col-xs-2 avatar">';
        element = element + '<img src="images/Frount_userpic2.jpeg" class="chatbot_img"></div>';
        element = element + '<div class="col-md-10 col-xs-10">';
        element = element + '<div class="messages msg_sent"><p>that mongodb thing looks good, huh? and huge document store</p>';
        element = element + '<time datetime="13-Feb-2018 5:30pm">13-Feb-2018 5:30pm</time></div></div></div>';
        /*=------------Send By Current User Div Append-----------*/
        element = element + '<div class="msg_container base_sent"><div class="col-md-10 col-xs-10">';
        element = element + '<div class="messages msg_sent"><p>that mongodb thing looks good, huh? and huge document store</p>';
        element = element + '<time datetime="13-Feb-2018 5:30pm">13-Feb-2018 5:30pm</time></div></div>';
        element = element + ' <div class="col-md-2 col-xs-2 avatar">';
        element = element + '<img src="images/Frount_userpic1.jpeg" class="chatbot_img"></div></div>';

        /*=------------Send By connecter Div Append-----------*/
        element = element + '<div class="msg_container base_receive">';
        element = element + '<div class="col-md-2 col-xs-2 avatar">';
        element = element + '<img src="images/Frount_userpic2.jpeg" class="chatbot_img"></div>';
        element = element + '<div class="col-md-10 col-xs-10">';
        element = element + '<div class="messages msg_sent"><p>that mongodb thing looks good, huh? and huge document store</p>';
        element = element + '<time datetime="13-Feb-2018 5:30pm">13-Feb-2018 5:30pm</time></div></div></div>';

        /*=------------Send By Current User Div Append-----------*/
        element = element + '<div class="msg_container base_sent"><div class="col-md-10 col-xs-10">';
        element = element + '<div class="messages msg_sent"><p>that mongodb thing looks good, huh? and huge document store</p>';
        element = element + '<time datetime="13-Feb-2018 5:30pm">13-Feb-2018 5:30pm</time></div></div>';
        element = element + ' <div class="col-md-2 col-xs-2 avatar">';
        element = element + '<img src="images/Frount_userpic2.jpeg" class="chatbot_img"></div></div>';

        /*=------------Send By connecter Div Append-----------*/
        element = element + '<div class="msg_container base_receive">';
        element = element + '<div class="col-md-2 col-xs-2 avatar">';
        element = element + '<img src="images/Frount_userpic1.jpeg" class="chatbot_img"></div>';
        element = element + '<div class="col-md-10 col-xs-10">';
        element = element + '<div class="messages msg_sent"><p>that mongodb thing looks good, huh? and huge document store</p>';
        element = element + '<time datetime="13-Feb-2018 5:30pm">13-Feb-2018 5:30pm</time></div></div></div>';

        /*--------------------------Massage Scroll div close-------------------------*/
        element = element + '</div>';
        /*--------------------------massage type box-------------------------*/
        element = element + '<div class="chatbot_typebox">';
        element = element + '<div class="input-group">';
        element = element + '<input type="text" class="form-control input-sm chatbot_emoji" placeholder="Write your message here..." />';
        element = element + '<span class="input-group-btn"><button class="btn btn-primary btn-sm" id="btn-chat">';
        element = element + '<i class="mdi mdi-send"></i></button></span></div></div>';

        element = element + '</div>';
        //document.getElementsByTagName("body")[0].innerHTML = document.getElementsByTagName("body")[0].innerHTML + element;
        document.getElementsByTagName("main")[0].innerHTML = document.getElementsByTagName("main")[0].innerHTML + element;

        popups.unshift(id);
        calculate_popups(addcontainer_id);

    }

    //calculate the total number of popups suitable and then populate the toatal_popups variable.
    function calculate_popups(addcontainer_id) {
        var width = window.innerWidth;
        if (width < 540) {
            total_popups = 0;
        }
        else {
            width = width - 200;
            //320 is width of a single popup box
            total_popups = parseInt(width / 320);
        }
        display_popups(addcontainer_id);
    }

    //recalculate when window is loaded and also when window is resized.
    window.addEventListener("resize", calculate_popups);
    window.addEventListener("load", calculate_popups);

</script>
<script type="text/javascript">
    function ShowLiveChatList() {
        $('#btn_livechat').addClass('glo_chat_btn_hide');
        $('#friend_chat_list').addClass('chat_sidebar_show');
    }
    function HideLiveChatList() {
        $('#friend_chat_list').removeClass('chat_sidebar_show');
        $('#btn_livechat').removeClass('glo_chat_btn_hide');
    }
</script>
<div class="chatlist_mainbox" id="friend_chat_list">
    <div class="friend_chat_arrow" onclick="HideLiveChatList();"><i class="mdi mdi-arrow-right-bold"></i></div>
<div class="chat-sidebar chat_scroll style-scroll" >
    <?php  $friendlist = \Illuminate\Support\Facades\DB::select("select u.id as fid, (select t.name from timelines t where t.id=u.timeline_id) as name,u.profile_pic,u.rc,u.email,u.header_colour,u.profession,u.profession_other,u.active from users u where u.id in (select f.friend_id from friends f where f.user_id=$user->id) or u.id in (select f.user_id from friends f where f.friend_id=$user->id)"); ?>
    @foreach($friendlist as $friend)
        <div class="sidebar-name">
            <a onclick="register_popup('{{str_slug($friend->name)}}', '{{$friend->name}}');">
                <img width="30" height="30" src="{{url('').'/'.$friend->profile_pic}}"/>
                <div class="chatbot_name">{{$friend->name}}</div>
                <div class="chat_status online"></div>
            </a>
        </div>
    @endforeach
    {{--<div class="sidebar-name">--}}
    {{--<a onclick="register_popup('bijendra-sahu', 'Bijendra Sahu');">--}}
    {{--<img width="30" height="30" src="images/Frount_userpic1.jpeg" />--}}
    {{--<div class="chatbot_name">Bijendra Sahu</div>--}}
    {{--<div class="chat_status online"></div>--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--<div class="sidebar-name">--}}
    {{--<a onclick="register_popup('amit-sharma', 'Amit Sharma');">--}}
    {{--<img width="30" height="30" src="images/Frount_userpic3.jpeg" />--}}
    {{--<div class="chatbot_name">Amit Sharma</div>--}}
    {{--<div class="chat_status online"></div>--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--<div class="sidebar-name">--}}
    {{--<a onclick="register_popup('juhi-soni', 'Juhi Soni');">--}}
    {{--<img width="30" height="30" src="images/Frount_userpic2.jpeg" />--}}
    {{--<div class="chatbot_name">Juhi Soni</div>--}}
    {{--<div class="chat_status online"></div>--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--<div class="sidebar-name">--}}
    {{--<a href="javascript:register_popup('himani-koacher', 'Himani koacher');">--}}
    {{--<img width="30" height="30" src="images/Frount_userpic1.jpeg" />--}}
    {{--<div class="chatbot_name">Himani Koacher</div>--}}
    {{--<div class="chat_status online"></div>--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--<div class="sidebar-name">--}}
    {{--<a onclick="register_popup('nikita-shukla', 'Nikita Shukla');">--}}
    {{--<img width="30" height="30" src="images/Male_default.png" />--}}
    {{--<div class="chatbot_name">Nikita Shukla</div>--}}
    {{--<div class="chat_status online"></div>--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--<div class="sidebar-name">--}}
    {{--<a href="javascript:register_popup('vatsala-bekhru', 'Vatsala Bekhru');">--}}
    {{--<img width="30" height="30" src="images/Frount_userpic4.jpeg" />--}}
    {{--<div class="chatbot_name">Vatsala Bekhru</div>--}}
    {{--<div class="chat_status online"></div>--}}
    {{--</a>--}}
    {{--</div>--}}
</div>
</div>
<div class="glo_chat_btn" onclick="ShowLiveChatList();">
    <i class="mdi mdi-wechat"></i>
</div>
<main class="chat_containner" id="allchat_container"></main>