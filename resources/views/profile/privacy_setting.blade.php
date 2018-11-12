{!! Form::open(['url' => 'privacy_setting', 'class' => 'form-horizontal margin0', 'id'=>'Unit', 'method'=>'post', 'files'=>true]) !!}
<div class="modal-body">
<div class="basic_lb_row">
    <div class="col-sm-3 col-xs-12">
        <div class="Lb-title-txt" id="_TypeDesc">Contact Privacy :</div>
    </div>
    <div class="col-sm-7 col-xs-12">
        <select name="contact_privacy" class="form-control" id="">
            <option {{$user->contact_privacy == 'public'?'selected':''}} value="public">Public</option>
            <option {{$user->contact_privacy == 'private'?'selected':''}} value="private">Private</option>
            <option {{$user->contact_privacy == 'friends'?'selected':''}} value="friends">Friends</option>
        </select>
    </div>
</div>
</div>
<div class="modal-footer">
    {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
    <div id="modalBtn" class="pull-right">&nbsp;</div>
</div>
{!! Form::close() !!}