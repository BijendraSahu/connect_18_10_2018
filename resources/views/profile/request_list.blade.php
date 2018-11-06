<span class="mdi mdi-account-multiple-plus"></span>
@if(count($friends)>0)
    <div class="total_count">{{count($friends)}}</div>
@endif
<div class="menu_basic_popup effect scale0 fr_request_popbox">
    <div class="menu_popup_head">Friend Requests <div class="basic_popup_close" onclick="Hidepopup('hide');"><i class="mdi mdi-close"></i></div></div>

    <div id="request_list" class="menu_popup_containner  chat_scroll style-scroll">
        @if(count($friends)>0)
            @foreach($friends as $friend)
                <div class="menu_popup_row">
                    <div class="menu_popup_imgbox"><img src="{{url('').'/'.$friend->users->profile_pic}}"
                                                        class="profile_img"></div>
                    <a href="{{url('friend?search='.$friend->user_id)}}" class="menu_popup_request">
                        <p class="popup_text_name">{{$friend->users->timeline->name}}</p>
                        {{--<div class="popup_iconwithtime"><i class="mdi mdi-calendar-clock"></i> 28-Dec-2017</div>--}}
                    </a>
                    <div id="req_acc_rej_{{$friend->id}}" class="menu_popup_button">
                        <button class="btn btn-primary popup_btnrequest" onclick="acceptrequest({{$friend->id}})"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Confirm">
                            <i class="mdi mdi-check"></i></button>
                        <button class="btn btn-danger popup_btndelete" onclick="rejectrequest({{$friend->id}})"
                                data-toggle="tooltip" data-placement="top"
                                title="Delete">
                            <i class="mdi mdi-close"></i></button>
                    </div>
                </div>
            @endforeach
        @else
            <p class="alert">< No Request Pending ></p>
        @endif
    </div>

</div>
<script>
    function acceptrequest(requestid) {
        var formData = '_token=' + $('.token').val();
        $.ajax({
            type: "POST",
            contentType: "application/json; charset=utf-8",
            url: "{{ url('acceptrequest') }}",
//                data: '{"data":"' + endid + '"}',
            data: '{"formData":"' + formData + '", "requestid":"' + requestid + '"}',
            success: function (data) {
//                console.log(data);
                $("#req_acc_rej_" + requestid).html(data);
//                        console.log(data);
//                    ShowSuccessPopupMsg("Request has been cancelled");
            },
            error: function (xhr, status, error) {
                alert('xhr.responseText');
//                    $('#err').html(xhr.responseText);
            }
        });
    }

    function rejectrequest(requestid) {
        var formData = '_token=' + $('.token').val();
        $.ajax({
            type: "POST",
            contentType: "application/json; charset=utf-8",
            url: "{{ url('rejectrequest') }}",
//                data: '{"data":"' + endid + '"}',
            data: '{"formData":"' + formData + '", "requestid":"' + requestid + '"}',
            success: function (data) {
//                console.log(data);
                $("#req_acc_rej_" + requestid).html(data);
//                        console.log(data);
//                    ShowSuccessPopupMsg("Request has been cancelled");
            },
            error: function (xhr, status, error) {
//                alert('xhr.responseText');
                $('#errorall').html(xhr.responseText);
            }
        });
    }
</script>
