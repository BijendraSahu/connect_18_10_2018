<script src="{{ url('js/validation.js') }}"></script>
<script src="{{ url('js/Global.js') }}"></script>
{!! Form::open(['url' => 'survey/'.$survey->id, 'class' => 'form-horizontal', 'id'=>'Unit', 'method'=>'put', 'files'=>true]) !!}
<div class="container-fluid">
    <div class="basic_lb_row">
        <div class="col-sm-3">
            <div class="Lb-title-txt" id="_TypeName">Survey Question :</div>
        </div>
        <div class="col-sm-9">
            <input type="text" name="question" class="form-control required" placeholder="Enter Question"
                   data-validate="Btn_advertise" value="{{$survey->question}}"
                   maxlength="250" autocomplete="off">
        </div>
    </div>
    <div class="basic_lb_row">
        <div class="col-sm-3">
            <div class="Lb-title-txt" id="_TypeName">Survey Amount :</div>
        </div>
        <div class="col-sm-9">
            <input type="text" name="survey_amount" class="form-control amount required" placeholder="Enter Survey Amount" data-validate="Btn_advertise" value="{{$survey->survey_amount}}" maxlength="7" autocomplete="off">
        </div>
    </div>
    <div class="basic_lb_row">
        <div class="col-sm-3">
            <div class="Lb-title-txt" id="_TypeName">Survey Total Users :</div>
        </div>
        <div class="col-sm-9">
            <input type="text" name="no_of_user" class="form-control numberOnly required" placeholder="Enter No of user for this survey" data-validate="Btn_advertise" value="{{$survey->no_of_user}}" maxlength="4" autocomplete="off">
        </div>
    </div>
    <div class="basic_lb_row">
        <div class="col-sm-3">
            <div class="Lb-title-txt" id="_TypeName">Question Type:</div>
        </div>
        <div class="col-sm-9">
            <select name="question_type" id="question_type" onchange="getOptions(this);"
                    class="form-control requiredDD">
                <option {{$survey->question_type == 2?'selected':''}} value="2">2 Options(Yes/No or A/B)</option>
                <option {{$survey->question_type == 3?'selected':''}} value="3">3 Options(A/B/C)</option>
                <option {{$survey->question_type == 4?'selected':''}} value="4">4 Options(A/B/C/D)</option>
            </select>
        </div>
    </div>
    <div class="basic_lb_row">
        <div class="col-sm-3">
            <div class="Lb-title-txt" id="_TypeDesc">Option 1:</div>
        </div>
        <div class="col-sm-9">
            <input type="text" name="option1" class="form-control required" placeholder="Enter Option 1"
                   data-validate="Btn_advertise" value="{{$survey->option1}}"
                   maxlength="25" autocomplete="off">
        </div>
    </div>
    <div class="basic_lb_row">
        <div class="col-sm-3">
            <div class="Lb-title-txt" id="_TypeDesc">Option 2:</div>
        </div>
        <div class="col-sm-9">
            <input type="text" name="option2" class="form-control required" placeholder="Enter Option 2"
                   data-validate="Btn_advertise" value="{{$survey->option2}}"
                   maxlength="25" autocomplete="off">
        </div>
    </div>
    <div class="basic_lb_row hidden" id="option3">
        <div class="col-sm-3">
            <div class="Lb-title-txt" id="_TypeDesc">Option 3:</div>
        </div>
        <div class="col-sm-9">
            <input type="text" name="option3" class="form-control" placeholder="Enter Option 3"
                   data-validate="Btn_advertise" value="{{$survey->option3}}" id="txtoption3"
                   maxlength="25" autocomplete="off">
        </div>
    </div>
    <div class="basic_lb_row hidden" id="option4">
        <div class="col-sm-3">
            <div class="Lb-title-txt" id="_TypeDesc">Option 4:</div>
        </div>
        <div class="col-sm-9">
            <input type="text" name="option4" class="form-control" id="txtoption4" placeholder="Enter Option 4"
                   data-validate="Btn_advertise" value="{{$survey->optio4}}"
                   maxlength="25" autocomplete="off">
        </div>
    </div>
    {{--<div class="basic_lb_row">--}}
    {{--<div class="col-sm-3">--}}
    {{--<div class="Lb-title-txt" id="_TypeDesc">Image Show in :</div>--}}
    {{--</div>--}}
    {{--<div class="col-sm-9">--}}
    {{--            {{ Form::radio('is_slider', 'Slider') }} {{ Form::radio('is_slider', 'Popup') }}--}}
    {{--<input name="is_slider" type="radio" value="1">Slider &nbsp;&nbsp;&nbsp;--}}
    {{--<input name="is_slider" type="radio" value="0">Popup--}}
    {{--</div>--}}
    {{--</div>--}}
    <div class="basic_lb_row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-9">
            {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}

<script>
    function getOptions(dis) {
        var option_val = $(dis).val();
        if (option_val == '3') {
            $('#option3').removeClass('hidden');
            $('#txtoption3').addClass('required');
            $('#option4').addClass('hidden');
            $('#txtoption4').removeClass('required');
            $('#txtoption4').val('');
        } else if (option_val == '4') {
            $('#option3').removeClass('hidden');
            $('#option4').removeClass('hidden');
            $('#txtoption3').addClass('required');
            $('#txtoption4').addClass('required');
        } else {
            $('#option3').addClass('hidden');
            $('#option4').addClass('hidden');
            $('#txtoption3').removeClass('required');
            $('#txtoption4').removeClass('required');
            $('#txtoption3').val('');
            $('#txtoption4').val('');
        }
    }
    $(document).ready(function () {
        getselectedOptions('{{$survey->question_type}}');
    });
    function getselectedOptions(type) {
        var option_val = type;
        if (option_val == '3') {
            $('#option3').removeClass('hidden');
            $('#txtoption3').addClass('required');
            $('#option4').addClass('hidden');
            $('#txtoption4').removeClass('required');
        } else if (option_val == '4') {
            $('#option3').removeClass('hidden');
            $('#option4').removeClass('hidden');
            $('#txtoption3').addClass('required');
            $('#txtoption4').addClass('required');
        } else {
            $('#option3').addClass('hidden');
            $('#option4').addClass('hidden');
            $('#txtoption3').removeClass('required');
            $('#txtoption4').removeClass('required');
        }
    }
</script>