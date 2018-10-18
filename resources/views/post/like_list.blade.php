<div class="news_containner like_containner style-scroll">
    @if(count($puser) > 0)
        @foreach($puser as $user)
            <div class="col-xs-6 person_block">
                <div class="image_with_name">
                    <div class="post_imgblock like_imgbox">
                        <img src="{{url('').'/'.$user->profile_pic}}">
                    </div>
                    <div class="posted_name like_name">{{$user->name}}</div>
                </div>
            </div>
        @endforeach
    @else
        <p>No one like this post yet...</p>
    @endif
</div>