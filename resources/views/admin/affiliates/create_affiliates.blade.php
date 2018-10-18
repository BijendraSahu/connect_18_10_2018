<script src="{{ url('js/validation.js') }}"></script>
<script src="{{ url('js/Global.js') }}"></script>
{!! Form::open(['url' => 'save_affiliates', 'class' => 'form-horizontal', 'id'=>'Unit', 'method'=>'post', 'files'=>true]) !!}
<div class="container-fluid">
    <div class="basic_lb_row">
        <div class="col-sm-2">
            <div class="Lb-title-txt" id="_TypeDesc">Affiliate Link :</div>
        </div>
        <div class="col-sm-10">
            <textarea cols="1" rows="4" name="affiliate_link" class="form-control txt_resize required"
                      placeholder="Enter Affiliate Link"
                      data-validate="Btn_advertise"></textarea>
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