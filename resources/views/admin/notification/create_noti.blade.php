{{--<script src="{{ url('js/validation.js') }}"></script>--}}
<script src="{{ url('js/Global.js') }}"></script>
{!! Form::open(['url' => 'notification', 'class' => 'form-horizontal', 'id'=>'Unit', 'method'=>'post', 'files'=>true]) !!}
<div class="container-fluid">
    <div class="basic_lb_row">
        <div class="col-sm-3">
            <div class="Lb-title-txt" id="_TypeDesc">Advertise Details :</div>
        </div>
        <div class="col-sm-9">
            <textarea cols="1" rows="4" name="add_details" class="form-control txt_resize required"
                      placeholder="Enter Details"
                      data-validate="Btn_advertise" maxlength="500"></textarea>
        </div>
    </div>
    <div class="basic_lb_row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-9">
            {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}