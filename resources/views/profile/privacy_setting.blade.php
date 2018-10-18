{!! Form::open(['url' => 'privacy_setting', 'class' => 'form-horizontal', 'id'=>'Unit', 'method'=>'post', 'files'=>true]) !!}
<div class="container-fluid">
    <div class="basic_lb_row">
        <div class="col-sm-2">
            <div class="Lb-title-txt" id="_TypeDesc">Contact Privacy:</div>
        </div>
        <div class="col-sm-10">
            <select name="contact_privacy" class="form-control" id="">
                <option {{$user->contact_privacy == 'public'?'selected':''}} value="public">Public</option>
                <option {{$user->contact_privacy == 'private'?'selected':''}} value="private">Private</option>
                <option {{$user->contact_privacy == 'friends'?'selected':''}} value="friends">Friends</option>
            </select>
        </div>
    </div>
    <div class="basic_lb_row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-10">
            {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}