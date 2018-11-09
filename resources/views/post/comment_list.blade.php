@php
    $uni_id = rand(100000, 999999);
@endphp
<div class="existing_msg_block" id="comment_row_id_{{$uni_id}}">
    <div class="post_imgblock">
        <img src="{{url('').'/'.$comment->user->profile_pic}}">
    </div>
    <div class="exis_msg_post">
        <div class="posted_name">
            @if($comment->user_id != $_SESSION['user_master']->id)
                <a class="posted_name"
                   href="{{url('friend?search=').$comment->user_id}}">{{$comment->name}}</a>
            @else
                <a class="posted_name" href="{{url('my-profile')}}">{{$comment->name}}</a>
            @endif
        </div>
        {{--<div class="exis_msg" id="container1{{$comment->id}}">--}}
        {{--{!! $comment->description  !!}--}}
        {{--</div>--}}
        <div class="exis_txtblock">{!! \ChristofferOK\LaravelEmojiOne\LaravelEmojiOneFacade::shortnameToImage($comment->description) !!}</div>
        <div class="noti_optionsbox">
            <div class="btn-group dropleft">
                <button type="button" class="btn noti_option_icon btn-secondary dropdown-toggle"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        onclick="showhide_notioption(this);">
                    <i class="mdi mdi-dots-horizontal"></i>
                </button>
                <div class="dropdown-menu show notifi_options scalenoti">
                    <div class="noti_opti_row"
                         onclick="EditPostComment(comment_row_id_{{$uni_id}}, count_comment{{$comment->post_id}}, '{{$comment->id}}');">
                        <i
                                class="mdi mdi-pencil basic_icon_margin"
                                style="color: #07d;"></i>Edit
                    </div>
                    <div class="noti_opti_row"
                         onclick="DeletePostComment(comment_row_id_{{$uni_id}}, count_comment{{$comment->post_id}}, '{{$comment->id}}');">
                        <i class="mdi mdi-delete color_red basic_icon_margin"
                           style="color: #ff0000;"></i>Delete
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
