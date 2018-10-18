@for($i=0; $i<count($post);$i++)
    <div class="existing_post_block">
        <div class="existing_head_block">
            <div class="post_imgblock">
                <img src="{{url('').'/'.$post[$i]['profile_pic']}}"/>
            </div>
            <div class="exis_name_post">
                @if($post[$i]['user_id'] != $user->id)
                    <a class="posted_name"
                       href="{{url('friend?search=').$post[$i]['user_id']}}">{{$post[$i]['name']}}</a>
                @else
                    <a class="posted_name" href="{{url('my-profile')}}">{{$post[$i]['name']}}</a>
                @endif
                <div class="posted_date"><i
                            class="basic_icons mdi mdi-calendar"></i>{{ date_format(date_create($post[$i]['created_at']), "d-M-Y h:i A")}}
                </div>
            </div>
            <div class="post_delete" id="{{$post[$i]['id']}}"
                 onclick="ShowConformationPopupMsg('Are You Sure To delete this post.');">
                <i class="mdi mdi-delete"></i>
            </div>
            {{--<div class="exis_setupblock">--}}
            {{--<div class="exislike"><i class="basic_icons mdi mdi-thumb-up"></i>20</div>--}}
            {{--<div class="exislike"><i class="basic_icons mdi mdi-thumb-down"></i>02</div>--}}
            {{--</div>--}}
        </div>
        <div class="exis_txtblock">{!! \ChristofferOK\LaravelEmojiOne\LaravelEmojiOneFacade::shortnameToImage($post[$i]['description']) !!}</div>
        {{--<input type="hidden" class="glo_emojishow" id="demo{{$post[$i]['id']}}"--}}
        {{--value="{!! $post[$i]['description'] !!}">--}}
        {{--<div class="exis_txtblock" id="container{{$post[$i]['id']}}"></div>--}}
        {{--<script type="text/javascript">--}}
        {{--$(document).ready(function () {--}}
        {{--$("#demo{{$post[$i]['id']}}").emojioneArea({--}}
        {{--container: "#container{{$post[$i]['id']}}",--}}
        {{--hideSource: false,--}}
        {{--standalone: true--}}
        {{--});--}}
        {{--//                InitializeEmoji();--}}
        {{--});--}}
        {{--</script>--}}
        <input type="hidden" id="emtext" value="{!! $post[$i]['description']  !!}">
        @if(count($post[$i]['media']) > 0)
            <?php $countmedia = 0;
            $post_media = \App\Post_media::where(['is_deleted' => 0, 'post_id' => $post[$i]['id']])->get();
            ?>
            @foreach($post_media as $media)
                <?php $countmedia++;?>
            @endforeach

            <div class="exis_imgblock">
                <!--When single image post use below-->
                @if(count($post[$i]['media']) == 1)
                    @foreach($post[$i]['media'] as $media)
                        <div class="postsingle_img">
                            @if($media->media_type == 'img')
                                <img src="{{url('').'/'.$media->media_url}}"/>
                            @else
                                <video class="slider_video">
                                    <source type='video/mp4' src="{{url('').'/'.$media->media_url}}"/>
                                </video>
                                <span class="slider_video_playicon" onclick="playvideo(this);">
                                    <i class="mdi mdi-play-circle-outline"></i></span>
                            @endif
                        </div>
                    @endforeach
                @else
                <!--When mulple image post use below-->
                    <div id="myCarousel{{$post[$i]['id']}}" class="feedslider carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <?php $counter = 0; ?>
                            @foreach($post[$i]['media'] as $media)
                                @if($counter == 0)
                                    <li data-target="#myCarousel{{$post[$i]['id']}}" data-slide-to="{{$counter}}"
                                        class="active"></li>
                                    <?php $counter++; ?>
                                @else
                                    <li data-target="#myCarousel{{$post[$i]['id']}}" data-slide-to="{{$counter}}"></li>
                                @endif
                            @endforeach
                        </ol>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <?php $counterimg = 0; ?>
                            @foreach($post[$i]['media'] as $media)
                                @if($counterimg == 0)
                                    <div class="item active">
                                        @if($media->media_type == 'img')
                                            <a class="example-image-link"
                                               href="{{url('').'/'.$media->media_url}}"
                                               data-lightbox="feed_post{{$post[$i]['id']}}">
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
                                    <?php $counterimg++; ?>
                                @else
                                    <div class="item">
                                        @if($media->media_type == 'img')
                                            <a class="example-image-link"
                                               href="{{url('').'/'.$media->media_url}}"
                                               data-lightbox="feed_post{{$post[$i]['id']}}">
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
                            @endforeach
                        </div>
                        <!-- Left and right controls -->
                        <a class="carousel_arrow feed_left_arrow" href="#myCarousel{{$post[$i]['id']}}" role="button"
                           data-slide="prev">
                            <span class="mdi mdi-chevron-left"></span>
                        </a>
                        <a class="carousel_arrow feed_right_arrow" href="#myCarousel{{$post[$i]['id']}}" role="button"
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
                <?php $liked = \App\Post_likes::where(['post_id' => $post[$i]['id'], 'user_id' => $_SESSION['user_master']->id])->first();
                $span = \App\Post_spam::where(['post_id' => $post[$i]['id'], 'user_id' => $_SESSION['user_master']->id])->first();
                $dislike = \App\Post_unlikes::where(['post_id' => $post[$i]['id'], 'user_id' => $_SESSION['user_master']->id])->first();
                ?>
                @if(isset($liked))
                    {{-- <div class="heart existing_happy" id="{{$post[$i]['id']}}" onclick="LikeUnlike(this);">❤</div>--}}
                    <div class="heart existing_happy" id="{{$post[$i]['id']}}" onclick="LikeUnlike(this);">
                        <i class="mdi mdi-heart"></i>
                    </div>
                @else
                    {{--  <div class="heart" id="{{$post[$i]['id']}}" onclick="LikeUnlike(this);">❤</div>--}}
                    <div class="heart" id="{{$post[$i]['id']}}" onclick="LikeUnlike(this);">
                        <i class="mdi mdi-heart"></i>
                    </div>
                @endif
                <span class="caption_count" href="#Modal_ViewLikeList" data-toggle="modal"
                      onclick="getLikeList('{{$post[$i]['id']}}');">Like</span>
                <span class="count_like" href="#Modal_ViewLikeList" id="{{$post[$i]['id']}}"
                      onclick="getLikeList('{{$post[$i]['id']}}');"
                      data-toggle="modal">{{count($post[$i]['like'])}}</span>
            </div>
            @if(isset($dislike))
                <div class="dislike_block you_dislike" id="{{$post[$i]['id']}}" onclick="DislikePost(this);"><i class="dislike_icon mdi mdi-thumb-down"></i>Dislike
                    <span class="count_dislike">{{$post[$i]['dislike']}}</span>
                </div>
            @else
                <div class="dislike_block" id="{{$post[$i]['id']}}" onclick="DislikePost(this);"><i class="dislike_icon mdi mdi-thumb-down"></i>Dislike
                    <span class="count_dislike">{{$post[$i]['dislike']}}</span>
                </div>
            @endif
            <div class="comment_block">
                <span class="spam_icon {{isset($span)?'spam_already':''}} mdi mdi-emoticon-devil"
                      id="{{$post[$i]['id']}}"
                      onclick="mark_as_spam(this);"></span>
                <span class="spam_txt"> Spam </span>
                <span class="count_spam">{{" ".$post[$i]['spam']}}</span>
            </div>

            <div class="comment_block">
                <i class="comment_icon_box {{count($post[$i]['comment'])>0?'comment_morethan':''}} mdi mdi-comment"></i>Comment
                <span class="count_comment"
                      id="count_comment{{$post[$i]['id']}}">{{count($post[$i]['comment'])}}</span>{{--commentcount--}}
            </div>
            {{--<div id="socialShare" class="btn-group share-group pull-right glo-social-share">--}}
            {{--<a data-toggle="dropdown" class="btn btn-info" aria-expanded="false">--}}
            {{--<i class="mdi mdi-share-variant fa-inverse"></i>--}}
            {{--</a>--}}
            {{--<button href="#" data-toggle="dropdown" class="btn btn-info dropdown-toggle share"--}}
            {{--aria-expanded="true">--}}
            {{--<span class="caret"></span>--}}
            {{--</button>--}}
            {{--<ul class="dropdown-menu">--}}
            {{--<li>--}}
            {{--<a data-original-title="Twitter" rel="tooltip" href="#" class="btn btn-twitter"--}}
            {{--data-placement="left">--}}
            {{--<i class="mdi mdi-twitter"></i>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a data-original-title="Facebook" rel="tooltip" href="#" class="btn btn-facebook-share"--}}
            {{--ta-placement="left">--}}
            {{--<i class="mdi mdi-facebook"></i>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a data-original-title="Google+" rel="tooltip" href="#" class="btn btn-google"--}}
            {{--data-placement="left">--}}
            {{--<i class="mdi mdi-google-plus"></i>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--<li>--}}
            {{--<a data-original-title="LinkedIn" rel="tooltip" href="#" class="btn btn-linkedin"--}}
            {{--data-placement="left">--}}
            {{--<i class="mdi mdi-linkedin"></i>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</div>--}}
        </div>
        {{--like/unlike + share on facebook--}}

        {{--Comments--}}
        <div class="exis_comments_msgbox chat_scroll style-scroll" data-content="{{$post[$i]['id']}}"
             id="commentlist{{$post[$i]['id']}}">
            @if(count($post[$i]['comment']) >0 )
                <div class="existing_msg_block" id="commentbox">
                    @foreach($post[$i]['comment'] as $comment)
                        <div class="post_imgblock">
                            <img src="{{url('').'/'.$comment->profile_pic}}">
                        </div>
                        <div class="exis_msg_post">
                            <div class="posted_name">{{$comment->name}}</div>
                            {{--<div class="exis_msg" id="container1{{$comment->id}}">--}}
                            {{--{!! $comment->description  !!}--}}
                            {{--</div>--}}
                            <div class="exis_txtblock">{!! \ChristofferOK\LaravelEmojiOne\LaravelEmojiOneFacade::shortnameToImage($comment->description) !!}</div>

                            {{--<input type="hidden" class="glo_emojishow" id="demo_{{$comment->id}}"--}}
                            {{--value="{!! $comment->description  !!}">--}}
                            {{--<div class="exis_txtblock exis_msg" id="container1{{$comment->id}}"></div>--}}
                            {{--<script type="text/javascript">--}}
                            {{--$(document).ready(function () {--}}
                            {{--$("#demo_{{$comment->id}}").emojioneArea({--}}
                            {{--container: "#container1{{$comment->id}}",--}}
                            {{--hideSource: false,--}}
                            {{--standalone: true--}}
                            {{--});--}}
                            {{--//                                    InitializeEmoji();--}}
                            {{--});--}}
                            {{--</script>--}}
                        </div>
                    @endforeach
                </div>
            @else
                <div class="existing_msg_block" id="commentbox{{$post[$i]['id']}}">

                </div>
            @endif
        </div>
        {{--Comments--}}

        {{--Write Comments--}}
        <div class="exis_comments_post">
            <div class="post_imgblock"><img src="{{url('').'/'.$user->profile_pic}}"/></div>

            <div class="comment_txtboxblock">
                <textarea class="new_comment_txt comment_emoji_div" id="commentpost{{$post[$i]['id']}}"
                          placeholder="Write a comment...">
                </textarea>
                <button class="btn btn-primary btn-sm comment_postbtn"
                        onclick="postcomment('{{$post[$i]['id']}}')"><i class="mdi mdi-send"></i></button>
            </div>
        </div>
        {{--Write Comments--}}
    </div>
@endfor

<input type="hidden" id="pcount" value="{{$count_post}}"/>
{{--<input type="hidden" id="p_count" value="{{$p_count}}"/>--}}
<script type="text/javascript">
    function playvideo(dis) {
        $(dis).hide();
        $(dis).parent().find('.slider_video').attr('controls', 'controls');
        $(dis).parent().find('.slider_video').get(0).play();
    }

    $('.post_delete').click(function () {
        var id = $(this).attr('id');
        var append_url = '{{ url('/') }}' + "/post/" + id + "/delete";
        $('#ConfirmBtn').attr("href", append_url);
    });
    $(document).ready(function () {
        InitializeEmoji();
    });

    /*******comment append*/
    {{--$('.exis_comments_msgbox').each(function () {--}}
        {{--var post_id = $(this).attr('data-content');--}}
        {{--$.ajax({--}}
            {{--type: "Get",--}}
            {{--contentType: "application/json; charset=utf-8",--}}
            {{--url: "{{ url('getcommentlist') }}",--}}
            {{--data: {post_id: post_id},--}}
            {{--success: function (data) {--}}
{{--//                console.log(data);--}}
                {{--$('#commentlist' + post_id).html(data);--}}
{{--//                dashboardpostload();--}}
            {{--},--}}
            {{--error: function (xhr, status, error) {--}}
{{--//                alert(xhr.responseText);--}}
                {{--$('.modal-body').html(xhr.responseText);--}}
            {{--}--}}
        {{--});--}}
{{--//        alert(post_id);--}}
{{--//        postcomment(post_id)--}}
    {{--});--}}


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

    function postcomment(dis) {
        var post_id = dis;
        var commenttext = $('#commentpost' + post_id).val();
        $.ajax({
            type: "POST",
            contentType: "application/json; charset=utf-8",
            url: "{{ url('post_comment') }}",
//            data: {post_id: post_id, commenttext: commenttext},
            data: '{"post_id":"' + post_id + '", "commenttext":"' + commenttext + '"}',
            beforeSend: function () {
                //$('.comment_postbtn').attr("disabled", "disabled");
            },
            success: function (data) {
                var curr_count = Number($('#count_comment' + post_id).text());
                $('#count_comment' + post_id).text(curr_count + 1);
                $('#commentpost' + post_id).parent().find('.emojionearea-editor').text('');
                $('#commentbox'+ post_id).append(data);
//                loadcommentlist(post_id);
            },
            error: function (xhr, status, error) {
                $('#commentlist' + post_id).html(xhr.responseText);
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

    /********Delete Post********/

</script>
