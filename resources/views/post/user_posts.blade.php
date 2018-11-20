<?php $countpostmedia = 0;?>
@foreach($posts as $post)
    <?php $post_media = \App\Post_media::where(['is_deleted' => 0])->get();  ?>
    @if(isset($post_media))
        @foreach($post_media as $media)
            @if($media->post_id==$post->id)
                <?php $countpostmedia++;?>
            @endif
        @endforeach
    @endif
    <div class="existing_post_block">
        <div class="existing_head_block">
            <div class="post_imgblock">
                <img src="{{url('').'/'.$post->profile_pic}}"/>
            </div>
            <div class="exis_name_post">
                @if($post->user_id != $user->id)
                    <a class="posted_name" href="{{url('friend?search=').$post->user_id}}">{{$post->name}}</a>
                @else
                    <a class="posted_name" href="{{url('my-profile')}}">{{$post->name}}</a>
                @endif
                <div class="posted_date"><i
                            class="basic_icons mdi mdi-calendar"></i>{{ date_format(date_create($post->created_at), "d-M-Y h:i A")}}
                </div>
            </div>
            <div class="post_delete" id="{{$post->id}}"
                 onclick="ShowConformationPopupMsg('Are You Sure To delete this post.');">
                <i class="mdi mdi-delete"></i>
            </div>
            {{--<div class="exis_setupblock">--}}
            {{--<div class="exislike"><i class="basic_icons mdi mdi-thumb-up"></i>20</div>--}}
            {{--<div class="exislike"><i class="basic_icons mdi mdi-thumb-down"></i>02</div>--}}
            {{--</div>--}}
        </div>
        <div class="exis_txtblock">
            @if(isset($post[$i]['checkin'])) <i class="basic_icons mdi mdi-map-marker">at</i>{!! $post[$i]['checkin'] !!}
            <br> @endif
            {!! \ChristofferOK\LaravelEmojiOne\LaravelEmojiOneFacade::shortnameToImage($post->description) !!}</div>

        {{--<input type="hidden" class="glo_emojishow" id="demo{{$post->id}}" value="{!! $post->description  !!}">--}}
        {{--<div class="exis_txtblock" id="container{{$post->id}}"></div>--}}
        {{--<script type="text/javascript">--}}
            {{--$(document).ready(function () {--}}
                {{--$("#demo{{$post->id}}").emojioneArea({--}}
                    {{--container: "#container{{$post->id}}",--}}
                    {{--hideSource: false,--}}
                    {{--standalone: true,--}}
                {{--});--}}
            {{--});--}}
        {{--</script>--}}
        <input type="hidden" id="emtext" value="{!! $post->description  !!}">
        @if($countpostmedia > 0)
            <?php $countmedia = 0;?>
            @foreach($post_media as $media)
                @if($media->post_id==$post->id)
                    <?php $countmedia++;?>
                @endif
            @endforeach

            <div class="exis_imgblock">
                <!--When single image post use below-->
                @if($countmedia== 1)
                    @foreach($post_media as $media)
                        @if($media->post_id==$post->id)
                            <div class="postsingle_img">
                                <?php  $extension = \Illuminate\Support\Facades\File::extension($media->media_url);
                                $valid_ext = ["png", "jpg", "jpeg", "gif"];
                                $valid_ext_v = ["mp4", "ogg", "webm", "3gp"];
                                ?>
                                @for($i=0; $i < count($valid_ext); $i++)
                                    @if($valid_ext[$i] == $extension)
                                        <img src="{{url('').'/'.$media->media_url}}"/>
                                    @elseif($valid_ext_v[$i]==$extension)
                                        <video class="slider_video">
                                            <source type='video/mp4' src="{{url('').'/'.$media->media_url}}"/>
                                        </video>
                                        <span class="slider_video_playicon" onclick="playvideo(this);">
                                    <i class="mdi mdi-play-circle-outline"></i></span>
                                    @endif
                                @endfor
                            </div>
                        @endif
                    @endforeach
                @else
                <!--When mulple image post use below-->
                    <div id="myCarousel{{$post->id}}" class="feedslider carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <?php $counter = 0; ?>
                            @foreach($post_media as $media)
                                @if($media->post_id==$post->id)
                                    @if($counter == 0)
                                        <li data-target="#myCarousel{{$post->id}}" data-slide-to="{{$counter}}"
                                            class="active"></li>
                                        <?php $counter++; ?>
                                    @else
                                        <li data-target="#myCarousel{{$post->id}}" data-slide-to="{{$counter}}"></li>
                                    @endif
                                @endif
                            @endforeach
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <?php $counterimg = 0; ?>
                            @foreach($post_media as $media)
                                @if($media->post_id==$post->id)
                                    @if($counterimg == 0)
                                        <div class="item active">
                                            @if($media->media_type == 'img')
                                                <a class="example-image-link"
                                                   href="{{url('').'/'.$media->media_url}}"
                                                   data-lightbox="feed_post{{$post->id}}">
                                                    <img class="example-image"
                                                         src="{{url('').'/'.$media->media_url}}"></a>
                                            @else
                                                <video class="slider_video">
                                                    <source type='video/mp4' src="{{url('').'/'.$media->media_url}}"/>
                                                </video>
                                                <span class="slider_video_playicon" onclick="playvideo(this);">
                                    <i class="mdi mdi-play-circle-outline"></i></span>
                                            @endif
                                        </div>
                                        <?php $counterimg++; ?>
                                    @else
                                        <div class="item">
                                            @if($media->media_type == 'img')
                                                <a class="example-image-link"
                                                   href="{{url('').'/'.$media->media_url}}"
                                                   data-lightbox="feed_post{{$post->id}}">
                                                    <img class="example-image"
                                                         src="{{url('').'/'.$media->media_url}}"></a>
                                            @else
                                                <video class="slider_video">
                                                    <source type='video/mp4'
                                                            src="{{url('').'/'.$media->media_url}}"/>
                                                </video>
                                                <span class="slider_video_playicon" onclick="playvideo(this);">
                                    <i class="mdi mdi-play-circle-outline"></i></span>
                                            @endif
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                        <!-- Left and right controls -->
                        <a class="carousel_arrow feed_left_arrow" href="#myCarousel{{$post->id}}" role="button"
                           data-slide="prev">
                            <span class="mdi mdi-chevron-left"></span>
                        </a>
                        <a class="carousel_arrow feed_right_arrow" href="#myCarousel{{$post->id}}" role="button"
                           data-slide="next">
                            <span class="mdi mdi-chevron-right" aria-hidden="true"></span>
                        </a>
                    </div>
                @endif
            </div>
        @endif

        {{--like/unlike + share on facebook--}}
        <div class="exis_operation">
            <div class="like_block">
                <?php $like = \App\Post_likes::where(['post_id' => $post->id, 'user_id' => $_SESSION['user_master']->id])->first();
                $countlike = \App\Post_likes::where(['post_id' => $post->id])->count();
                $countcomments = \App\Comments::where(['post_id' => $post->id])->count();
                ?>
                @if(isset($like) > 0)
                    <div class="heart existing_happy" id="{{$post->id}}" onclick="LikeUnlike(this);">
                        <i class="mdi mdi-heart"></i>
                    </div>
                @else
                    <div class="heart" id="{{$post->id}}" onclick="LikeUnlike(this);">
                        <i class="mdi mdi-heart"></i>
                    </div>
                @endif
                <span class="caption_count" onclick="getLikeList('{{$post->id}}');">Like</span>
                <span class="count_like" href="#Modal_ViewLikeList" data-toggle="modal"
                      onclick="getLikeList('{{$post->id}}');">{{$countlike}}</span>
            </div>
            <div class="comment_block"><i class="basic_icons mdi mdi-comment"></i>Comment
                <span class="count_like">{{$countcomments}}</span>
            </div>
            <div id="socialShare" class="btn-group share-group pull-right glo-social-share">
                <a data-toggle="dropdown" class="btn btn-info" aria-expanded="false">
                    <i class="mdi mdi-share-variant fa-inverse"></i>
                </a>
                <button href="#" data-toggle="dropdown" class="btn btn-info dropdown-toggle share"
                        aria-expanded="true">
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li>
                        <a data-original-title="Twitter" rel="tooltip" href="#" class="btn btn-twitter"
                           data-placement="left">
                            <i class="mdi mdi-twitter"></i>
                        </a>
                    </li>
                    <li>
                        <a data-original-title="Facebook" rel="tooltip" href="#" class="btn btn-facebook-share"
                           ta-placement="left">
                            <i class="mdi mdi-facebook"></i>
                        </a>
                    </li>
                    <li>
                        <a data-original-title="Google+" rel="tooltip" href="#" class="btn btn-google"
                           data-placement="left">
                            <i class="mdi mdi-google-plus"></i>
                        </a>
                    </li>
                    <li>
                        <a data-original-title="LinkedIn" rel="tooltip" href="#" class="btn btn-linkedin"
                           data-placement="left">
                            <i class="mdi mdi-linkedin"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        {{--like/unlike + share on facebook--}}

        {{--Comments--}}
        {{--<div class="exis_comments_msgbox">--}}
        {{--@foreach($post_comments as $comment)--}}
        {{--@if($comment->post_id==$post->id)--}}
        {{--<div class="existing_msg_block">--}}
        {{--<div class="post_imgblock">--}}
        {{--<img src="{{url('').'/'.$comment->user->profile_pic}}">--}}
        {{--</div>--}}
        {{--<div class="exis_msg_post">--}}
        {{--<div class="posted_name">{{$comment->user->timeline->name}}</div>--}}
        {{--<div class="exis_msg">--}}
        {{--{{$comment->description}}--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--@endif--}}
        {{--@endforeach--}}
        {{--</div>--}}

        <div class="exis_comments_msgbox chat_scroll style-scroll" data-content="{{$post->id}}"
             id="commentlist{{$post->id}}">
            {{--            @foreach($post_comments as $comment)--}}
            {{--                @if($comment->post_id==$post->id)--}}
            {{--  <div class="existing_msg_block">
                  <div class="post_imgblock">
                      <img src="{{url('').'/'.$comment->user->profile_pic}}">
                  </div>
                  <div class="exis_msg_post">
                      <div class="posted_name">{{$comment->user->timeline->name}}</div>
                      <div class="exis_msg">
                          {!! $comment->description  !!}
                      </div>
                  </div>
              </div>--}}
            {{--@endif--}}
            {{--@endforeach--}}
        </div>
        {{--Comments--}}

        {{--Write Comments--}}
        {{--<div class="exis_comments_post">--}}
        {{--<div class="post_imgblock"><img src="{{url('').'/'.$user->profile_pic}}"/></div>--}}
        {{--<div class="comment_txtboxblock">--}}
        {{--<div class="new_comment_txt comment_emoji_div" placeholder="Write a comment...">--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        <div class="exis_comments_post">
            <div class="post_imgblock"><img src="{{url('').'/'.$user->profile_pic}}"/></div>

            <div class="comment_txtboxblock">
                <textarea class="new_comment_txt comment_emoji_div" id="commentpost{{$post->id}}"
                          placeholder="Write a comment...">
                </textarea>
                <button class="btn btn-primary btn-sm comment_postbtn" disabled="disabled"
                        onclick="postcomment('{{$post->id}}')"><i class="mdi mdi-send"></i></button>
            </div>
        </div>
        {{--Write Comments--}}
    </div>

    <br>
@endforeach
<input type="hidden" id="pcount" value="{{$post_count}}"/>
<script>
    function playvideo(dis) {
        $(dis).hide();
        $(dis).parent().find('.slider_video').attr('controls', 'controls');
        $(dis).parent().find('.slider_video').get(0).play();
    }
    InitializeEmoji();
    /********Delete Post********/
    $('.post_delete').click(function () {
        var id = $(this).attr('id');
        var append_url = '{{ url('/') }}' + "/post/" + id + "/delete";
        $('#ConfirmBtn').attr("href", append_url);
    });
    /********Delete Post********/

    /*******comment append*/
    setTimeout(function () {
        $('.exis_comments_msgbox').each(function () {
            var post_id = $(this).attr('data-content');
            $.ajax({
                type: "Get",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('getcommentlist') }}",
                data: {post_id: post_id},
                success: function (data) {
                    $('#commentlist' + post_id).html(data);
                },
                error: function (xhr, status, error) {
                    $('.modal-body').html(xhr.responseText);
                }
            });
        });
    }, 2000);
    function loadcommentlist(dis) {
        var post_id = dis;
        $.ajax({
            type: "Get",
            contentType: "application/json; charset=utf-8",
            url: "{{ url('getcommentlist') }}",
            data: {post_id: post_id},
            success: function (data) {
//                console.log(data);
                $('#commentlist' + post_id).html(data);
            },
            error: function (xhr, status, error) {
//                alert(xhr.responseText);
                $('.modal-body').html(xhr.responseText);
            }
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
    function postcomment(dis) {
        var post_id = dis;
        var commenttext = $('#commentpost' + post_id).val();
        var result = true;
        if (!Boolean(Requiredtxt('#commentpost' + post_id))) {
            result = false;
        }
        if (!result) {
            return false;
        }
        $.ajax({
            type: "POST",
            contentType: "application/json; charset=utf-8",
            url: "{{ url('post_comment') }}",
//            data: {post_id: post_id, commenttext: commenttext},
            data: '{"post_id":"' + post_id + '", "commenttext":"' + commenttext + '"}',
//            beforeSend: function () {
//                $('.comment_postbtn').attr("disabled", "disabled");
//            },
            success: function (data) {
                $('.comment_postbtn').removeAttr("disabled", "disabled");
                $('#commentpost' + post_id).parent().find('.emojionearea-editor').text('');
//                console.log(data);
//                setTimeout(function () {
                loadcommentlist(post_id);
//                }, 500);
            },
            error: function (xhr, status, error) {
//                alert(xhr.responseText);
                $('.modal-body').html(xhr.responseText);
            }
        });
    }

    function getLikeList(id) {
        $.ajax({
            type: "Get",
            contentType: "application/json; charset=utf-8",
            url: "{{ url('postlikelist') }}",
//            data: '{"post_id":"' + post_id + '"}',
            data: {post_id: id},
            success: function (data) {
//                console.log(data);
                $('#mdlbody').html(data);
            },
            error: function (xhr, status, error) {
//                alert(xhr.responseText);
                $('.modal-body').html(xhr.responseText);
            }
        });
    }

</script>
