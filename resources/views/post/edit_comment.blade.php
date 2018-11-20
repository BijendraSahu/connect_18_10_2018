
<div class="modal-body">
    <div class="basic_lb_row">
        <div class="exis_comments_post" id="edit_comment_popup">
            <div class="post_imgblock"><img src="{{url('').'/'.$user->profile_pic}}"/></div>
            <div class="comment_txtboxblock">
                <textarea class="new_comment_txt comment_emoji_div edit_emoji" id="commentpost1{{$comment->post_id}}"
                          placeholder="Write a comment...">{{$comment->description}}</textarea>
                <button class="btn btn-primary btn-sm comment_postbtn"
                        onclick="editpostcomment('{{$comment->post_id}}','{{$comment->id}}')"><i class="mdi mdi-send"></i>
                </button>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        InitializeEditEmoji();
    });
    function InitializeEditEmoji() {
        $(".edit_emoji").emojioneArea({
            pickerPosition: "bottom",
            tonesStyle: "bullet",
            placeholder: "write a comments"
        });
    }
    function Requiredtxt(me) {
        var text = $.trim($(me).val());
        if (text == '') {
            $(me).parent().find('.emojionearea-editor').addClass("errorClass");
//            $(me).addClass("errorClass");
            return false;
        } else {
            $(me).parent().find('.emojionearea-editor').removeClass("errorClass");
            return true;
        }
    }
    function editpostcomment(dis, comment_id) {
        var post_id = dis;
        var commenttext = $('#commentpost1' + post_id).val();
        var result = true;
        if (!Boolean(Requiredtxt('#commentpost1' + post_id))) {
            result = false;
        }
        if (!result) {
            return false;
        }
        append_loading_img = '<div class="feed_loadimg_block" id="load_img">' +
            '<img height="50px" class="center-block" src="{{ url('images/loading.gif') }}"/></div>';
        $.ajax({
            type: "POST",
            contentType: "application/json; charset=utf-8",
            url: "{{ url('edit_post_comment') }}",
            data: '{"post_id":"' + post_id + '", "commenttext":"' + commenttext + '", "comment_id":"' + comment_id + '"}',
            beforeSend: function () {
//                $('#dashboard_post').append(append_loading_img);
            },
            success: function (data) {
                $('#myModal').modal('hide');
                $('#comment_id' + comment_id).html(data);
                success_noti("Comment has been updated");
            },
            error: function (xhr, status, error) {
                $('#myModal').html(xhr.responseText);
            }
        });
    }
</script>