{{--<script src="{{ url('js/validation.js') }}"></script>--}}
<script src="{{ url('js/Global.js') }}"></script>
{!! Form::open(['url' => 'advertisement', 'class' => 'form-horizontal', 'id'=>'Unit', 'method'=>'post', 'files'=>true]) !!}
<div class="container-fluid">
    <div class="basic_lb_row">
        <div class="col-sm-3">
            <div class="Lb-title-txt" id="_TypeName">Advertise Title :</div>
        </div>
        <div class="col-sm-9">
            <input type="text" name="title" class="form-control required" placeholder="Enter title"
                   data-validate="Btn_advertise" value=""
                   maxlength="250" autocomplete="off">
        </div>
    </div>
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
            <div class="Lb-title-txt">Upload Image :</div>
        </div>
        <div class="col-sm-9">
            <div class="com-block file_upload_box">
                <input type="file" accept=".png,.jpg, .jpeg, .gif" class="file_upload" name="add_img"
                       id="advertise_Image"
                       onchange="ShowAdverImage(this, adver_uploadimg, advertise_close);"/>
                <div class="view-uploaded-file">
                    <img src="{{url('images/NoPreview_Img.png')}}" id="adver_uploadimg">
                    <div class="upload_imgclose mdi mdi-close" id="advertise_close"
                         onclick="RemoveAdvertise(this, adver_uploadimg, advertise_Image)"></div>
                </div>
            </div>
        </div>

    </div>
    <div class="basic_lb_row">
        <div class="col-sm-3">
            <div class="Lb-title-txt" id="_TypeDesc">Image Show in :</div>
        </div>
        <div class="col-sm-9">
            {{--            {{ Form::radio('is_slider', 'Slider') }} {{ Form::radio('is_slider', 'Popup') }}--}}
            <input name="is_slider" type="radio" value="1">Slider &nbsp;&nbsp;&nbsp;
            <input name="is_slider" type="radio" value="0">Popup
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