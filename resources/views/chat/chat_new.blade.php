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

    .friend_chat_arrow {
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

    .glo_chat_btn {
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

    .glo_chat_btn_hide {
        right: -100%;
    }

    .glo_chat_btn:hover {
        background: #9b8a30;
    }

    .glo_chat_btn i {

    }

    .chat_scroll::-webkit-scrollbar {
        border: solid thin #ccc;
    }

    .chat_scroll::-webkit-scrollbar-thumb {
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

    .chat_sidebar_show {
        right: 0;
    }
</style>

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
<html>


<head>

    <link href="{{url('chat/style.css')}}" rel="stylesheet">
    <script src="{{url('chat/script.js')}}"></script>

    <script>

        getallusers();


        function getallusers() {


            var srch_name = $("#srch_name").val();
            //alert(srch_name);
            // return;
            $.ajax({
                type: "get",
                url: "{{url('getallusers')}}",
                data: "srch_name=" + srch_name,

                success: function (msg) {
                    $("#Rtable").html(msg);
                    //alert(msg);
                }
            });
        }


    </script>


</head>

<body>
<script>

    function testjsss(idsssss) {
        var comid = '';
        arr = new Array();
        $.ajax({
            type: "get",
            url: "{{url('checkdata')}}",
            data: "idsssss=" + idsssss,

            success: function (msg) {
                comid = msg;
                var id = idsssss;
                if (jQuery.inArray(id, arr) !== -1) {
                    console.log("is in array");
                } else {
                    arr.push(id);
                    var chatbox = ("<div class='msg_box' id='msg_box_" + id + "'  style='right:270px' >" +
                    "<div class='msg_head' id='minim_" + id + "' onclick='slowdown(" + id + ");'>" +
                    "<span id='username_" + id + "'> </span>" +
                    "<a href='http://52.14.96.248/Video-Call-App/caller.html?room=" + comid + "' id='open_" + id + "' data-id='" + comid + "' style='color:#fffa90;'>Video Call</a>" +
                    "<div class='close' id='close_" + id + "'>x</div>" +
                    "</div>" +
                    "<div class='msg_wrap' id='minimize_" + id + "'>" +
                    " <iframe src='http://52.14.96.248/Video-Call-App/textchat.html?room=dev" + comid + "' scrolling='no' frameborder='0' width='250px' height='400px' style='border:0; margin:0; padding: 0;'> <div class='msg_footer'><textarea class='msg_input' rows='4'></textarea> </div>" +
                    "</div>" +
                    "</div>");

                    $("#boxxxx").append(chatbox);
                    var user_name = $("#" + id).html();
                    $('#username_' + id).html(user_name);
                    setInfo();
                }
                $('#close_' + id).click(function () {
                    $('#msg_box_' + id).remove();
                    var index = arr.indexOf(id);
                    if (index > -1) {
                        arr.splice(index, 1);
                    }
                    setInfo();
                });

                $('#open_' + id).click(function () {
                    //window.open(this.href);
                    clearInterval(intervalId); // stop the interval
                    var idsssss = $('#open_' + id).data("id");
                    $.ajax({
                        type: "get",
                        url: "{{url('updatecall')}}",
                        data: "idsssss=" + idsssss,

                        success: function (msg) {


                        }
                    }).done(function () {


                    });
                    window.open(this.href, "_blank", "scrollbars=1,resizable=1,height=300,width=450");
                    return false;
                });

            }
        });/*.done(function () {


            //alert(comid);





        });*/


    }

    function slowdown(idss)
    {
        $('#minimize_'+ idss).slideToggle('slow');

    }
    function slowdownChatBox()
    {
        $('#chatbox').slideToggle('slow');

    }

    function setInfo() {
        var number = 270;
        for (var i = 0; i < arr.length; i++) {
            $('#msg_box_' + arr[i]).css('right', number);
            number = number + 270;

        }
    }

    var intervalId = window.setInterval(function () {
        getincomingCall();
    }, 10000);

    function getincomingCall() {
        incall = '';
        idsssss = '';
        $.ajax({
            type: "get",
            url: '{{url('checkincomingCall')}}',
            data: "idsssss=" + idsssss,

            success: function (msg) {
                incall = msg;

            }

        }).done(function () {
//            alert(incall);
            console.log(incall);
            if (incall != '') {
                window.open('http://52.14.96.248/Video-Call-App/reciver.html?room=' + incall, "_blank", "scrollbars=1,resizable=1,height=300,width=450");
            }

        });

    }
    function ShowLiveChatbox() {
        $('#chat_btn').addClass('hide_chatbtn');
        $('#chatbox').addClass('show_chatlist');
    }
    function Hidechatbox() {
        $('#chatbox').removeClass('show_chatlist');
        $('#chat_btn').removeClass('hide_chatbtn');
    }
</script>
<div class="chat_box" id="chatbox">
    <div class="chat_head" > Chat Box <i class="mdi mdi-minus chatlist_minusbtn" onclick="Hidechatbox()"></i></div>

    <div class="chat_body">
        <center>
            {{--<input type='text' id="srch_name" name='srch_name' onkeyup="getallusers();" placeholder='search'>--}}
        </center>
        <div id="Rtable">

        </div>
    </div>

</div>
<div class="glo_chat_btn" id="chat_btn" onclick="ShowLiveChatbox();">
    <i class="mdi mdi-wechat"></i>
</div>
<div id="boxxxx">
</div>
