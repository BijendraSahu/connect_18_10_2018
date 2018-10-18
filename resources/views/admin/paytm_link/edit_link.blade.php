<script src="{{ url('js/Global.js') }}"></script>
{!! Form::open(['url' => 'paytm/'.$paytm->id, 'class' => 'form-horizontal', 'id'=>'Unit', 'method'=>'post', 'files'=>true]) !!}
<div class="container-fluid">

    <div class="basic_lb_row">
        <div class="col-sm-2">
            <div class="Lb-title-txt" id="_TypeDesc">Link Details:</div>
        </div>
        <div class="col-sm-10">
            <input name="link" class="form-control txt_resize required" id="link" value="{{$paytm->link}}" />
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
