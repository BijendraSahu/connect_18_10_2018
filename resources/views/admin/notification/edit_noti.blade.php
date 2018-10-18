<script src="{{ url('js/validation.js') }}"></script>
<script src="{{ url('js/Global.js') }}"></script>
{!! Form::open(['url' => 'notificn/'.$notification->id, 'class' => 'form-horizontal', 'id'=>'Unit', 'method'=>'put', 'files'=>true]) !!}
<div class="container-fluid">

    <div class="basic_lb_row">
        <div class="col-sm-2">
            <div class="Lb-title-txt" id="_TypeDesc">Notification Details:</div>
        </div>
        <div class="col-sm-10">
            <textarea cols="1" rows="4" name="notification" class="form-control txt_resize required"
                      placeholder="Enter Notification"
                      data-validate="Btn_advertise" maxlength="500">{{$notification->notification}}</textarea>
        </div>
    </div>
    <div class="basic_lb_row">
        <div class="col-sm-2">
            <div class="Lb-title-txt">Upload Image :</div>
        </div>
        <div class="col-sm-9">
            <div class="com-block file_upload_box">
                <input type="file" accept=".png,.jpg, .jpeg, .gif" class="file_upload" name="image"
                       id="advertise_Image"
                       onchange="ShowAdverImage(this, adver_uploadimg, advertise_close);"/>
                <div class="view-uploaded-file">
                    @if(isset($notification->image))
                        <img src="{{url('').'/'.$notification->image}}" id="adver_uploadimg">
                    @else
                        <img src="{{url('images/NoPreview_Img.png')}}" id="adver_uploadimg">
                    @endif
                    <div class="upload_imgclose mdi mdi-close" id="advertise_close"
                         onclick="RemoveAdvertise(this, adver_uploadimg, advertise_Image)"></div>
                </div>
            </div>
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