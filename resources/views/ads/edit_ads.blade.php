<script src="{{ url('js/validation.js') }}"></script>
<script src="{{ url('js/Global.js') }}"></script>
@php
    $cities = DB::select("select * from cities where City IS NOT NULL order by City ASC");
@endphp
{!! Form::open(['url' => 'buys/'.$ad->id, 'class' => 'form-horizontal', 'id'=>'my_ads_edit', 'method'=>'put', 'files'=>true]) !!}

<div class="basic_lb_row">
    <div class="col-sm-6">
        <div class="inner_lbdiv">
            <div class="advertise_lefttxt" id="_TypeName">Advertise Title* :</div>
            <input type="text" name="title" id="ed_ad_title" value="{{$ad->ad_title}}" class="form-control required"
                   placeholder="Enter title" data-validate="Btn_advertise" maxlength="250"
                   autocomplete="off">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="inner_lbdiv">
            <div class="advertise_lefttxt" id="_TypeName">Advertise Type* :</div>
            <select class="form-control requiredDD" id="edit_ddcategory" name="ddcategory">
                <option value="0">Select</option>
                @foreach($ad_category as $category)
                    <option value="{{$category->id}}" {{$ad->ad_category_id == $category->id?'selected':''}}>{{$category->category}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="basic_lb_row">
    <div class="col-sm-6">
        <div class="inner_lbdiv">
            <div class="advertise_lefttxt" id="_TypeName">Email Id :</div>
            <input type="text" name="email" class="form-control" value="{{$ad->email}}"
                   placeholder="Enter Email id"
                   data-validate="Btn_advertise" maxlength="250" autocomplete="off">
        </div>
    </div>
    <div class="col-sm-6">
        <div class="inner_lbdiv">
            <div class="advertise_lefttxt">Contact No. :</div>
            <input type="text" name="contact" class="form-control required" value="{{$ad->contact}}"
                   placeholder="Enter contact no." data-validate="Btn_advertise" maxlength="10"
                   autocomplete="off">
        </div>
    </div>
</div>
<div class="basic_lb_row">
    <div class="col-sm-6">
        <div class="inner_lbdiv">
            <div class="advertise_lefttxt" id="_TypeName">City :</div>
            <select class="form-control" id="ed_a_city"
                    name="city">
                <option value="0"> --Please Select*--</option>
                @foreach($cities as $city)
                    <option value="{{$city->City}}" {{$ad->city == $city->City?'selected':''}}>{{$city->City}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="inner_lbdiv">
            <div class="advertise_lefttxt">Selling Price* :</div>
            <input type="number" name="selling_cost" class="form-control amount"
                   placeholder="Enter Selling Price" id="ed_selling_cost" data-validate="Btn_advertise"
                   maxlength="8" autocomplete="off" value="{{$ad->selling_cost}}">
        </div>
    </div>
</div>
<div class="basic_lb_row">
    <div class="col-sm-6">
        <div class="inner_lbdiv">
            <div class="advertise_lefttxt" id="_TypeName">Advertise Details :</div>
            <textarea cols="1" rows="4" name="add_details"
                      class="form-control txt_resize required" id="ed_ads_de" placeholder="Enter Details"
                      data-validate="Btn_advertise" maxlength="500">{{$ad->ad_description}}</textarea>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="inner_lbdiv">
            <div class="advertise_lefttxt">Location :</div>
            <textarea cols="1" rows="4" name="add_address" class="form-control txt_resize"
                      placeholder="Enter Location" data-validate="Btn_advertise"
                      maxlength="500">{{$ad->location}}</textarea>
        </div>
    </div>
</div>
<div class="basic_lb_row other_hide" id="adver_otherbox">
    <div class="inner_lbdiv">
        <div class="advertise_lefttxt" id="_TypeName">Other Category :</div>
        <input type="text" name="other" class="form-control" placeholder="Enter Category"
               data-validate="Btn_advertise" maxlength="250" autocomplete="off">
    </div>
</div>
<div class="basic_lb_row">
    <div class="col-sm-6">
        {{--<input id="browse" type="file" onchange="UploadImage(this);" multiple/>--}}
        <div class="inner_lbdiv">
            <div class="advertise_lefttxt">Upload New Image :</div>
            <div class="upload_limittxt">You can upload maximum 8 images for Advertisement.
            </div>
            {{--<div class="com-block file_upload_box">--}}
            {{--<input type="file" name="ad_img" accept=".png,.jpg, .jpeg, .gif"--}}
            {{--class="file_upload"--}}
            {{--id="advertise_Image"--}}
            {{--onchange="UploadImage(this);"/>--}}
            {{--</div>--}}
            <input type="hidden" name="img_src" id="img_src">
            <div class="upload_file_box">
                <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">Browse…
                    <input type="file" name="ad_img" accept=".png,.jpg, .jpeg, .gif"
                           class="file_upload contact_file" maxlength="8" id="advertise_Image"
                           onchange="UploadImage(this);" multiple/>
                </span>
            </span>
                    <input type="text" id="file_upload_count"
                           placeholder="Upload Advertise Images"
                           class="form-control" readonly="">
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div id="preview" class="upload_result_img"></div>
    </div>

</div>

{{--<div class="basic_lb_row row">--}}
{{--<div class="col-sm-6">--}}
{{--<div class="col-sm-12">--}}
{{--<div class="advertise_lefttxt">Upload Image :</div>--}}
{{--</div>--}}
{{--<div class="col-sm-12">--}}
{{--<div class="com-block file_upload_box">--}}
{{--<input type="file" name="ad_img" accept=".png,.jpg, .jpeg, .gif"--}}
{{--class="file_upload"--}}
{{--id="advertise_Image"--}}
{{--onchange="ShowAdverImage(this, adver_uploadimg, advertise_close);"/>--}}
{{--<div class="view-uploaded-file">--}}
{{--<img src="{{url('images/NoPreview_Img.png')}}" id="adver_uploadimg">--}}
{{--<div class="upload_imgclose mdi mdi-close" id="advertise_close"--}}
{{--onclick="RemoveAdvertise(this, adver_uploadimg, advertise_Image)"></div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--<div class="col-sm-6">--}}
{{--</div>--}}
{{--</div>--}}
{!! Form::close() !!}
<script>
    function edit_advertise() {
        var adverimg_length = $('.upimg_box').length;
        if (adverimg_length > 8) {
            warning_noti("You can upload maximum 8 images for Advertisement");
        } else {
            img_ids = new Array();
            $('.up_img').each(function () {
                var getimg_id = $(this).attr('src');
                img_ids.push(getimg_id);
            });

            var tids = img_ids;
            if ($('#ed_ad_title').val() == '') {
                warning_noti("Please enter advertisement title");
                $('#ed_ad_title').focus();
            } else if ($('#edit_ddcategory').val() == '0') {
                warning_noti("Please select any category");
                $('#edit_ddcategory').focus();
            } else if ($('#ed_a_city').val() == '0') {
                warning_noti("Please select any city");
                $('#ed_a_city').focus();
            } else if ($('#ed_selling_cost').val() == '') {
                warning_noti("Please enter selling cost");
                $('#ed_selling_cost').focus();
            } else if ($('#ed_ads_de').val() == '') {
                warning_noti("Please enter advertisement details");
                $('#ed_ads_de').focus();
            } else {
                $('#img_src').val(tids);
                $('#Modal_NewAdd').modal('hide');
                $('#my_ads_edit').submit();
//                    ShowSuccessPopupMsg("Advertisement has been uploaded... Advertisement will get appear after approval.");
            }

        }
    }
</script>