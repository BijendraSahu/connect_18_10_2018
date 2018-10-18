<div class="post_imgblock">
    <img src="{{url('').'/'.$comment->user->profile_pic}}">
</div>
<div class="exis_msg_post">
    <div class="posted_name">{{$comment->user->timeline->name}}</div>
    {{--<div class="exis_msg" id="container1{{$comment->id}}">--}}
    {{--{!! $comment->description  !!}--}}
    {{--</div>--}}
    <div class="exis_txtblock">{!! \ChristofferOK\LaravelEmojiOne\LaravelEmojiOneFacade::shortnameToImage($comment->description) !!}</div>

    {{--<input type="hidden" class="glo_emojishow" id="demo_{{$comment->id}}"--}}
           {{--value="{{$comment->description}}">--}}
    {{--<div class="exis_txtblock exis_msg" id="container1{{$comment->id}}"></div>--}}
    {{--<script type="text/javascript">--}}
        {{--$(document).ready(function () {--}}
            {{--$("#demo_{{$comment->id}}").emojioneArea({--}}
                {{--container: "#container1{{$comment->id}}",--}}
                {{--hideSource: false,--}}
                {{--standalone: true--}}
            {{--});--}}
            {{--InitializeEmoji();--}}
        {{--});--}}
    {{--</script>--}}
</div>
