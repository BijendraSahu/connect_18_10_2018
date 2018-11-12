@extends('layout.master.master')

@section('title', 'My Advertisement')
<link href="{{url('css/cropper.min.css')}}" type="text/css" rel="stylesheet"/>
<style type="text/css">

</style>
@section('head')
    <section class="container-fluid overall_containner notofication_containner">
        <div class="row">
            <div class="col-md-2">
                <div class="profile_basic_menu_block res_menu_hide">
                    <div class="profile_img_block">
                        <img src="{{url('').'/'.$user->profile_pic}}"/>
                    </div>
                    <div class="profile_name">{{$timeline->name}}</div>
                    {{--<div class="profile_follow"><i class="profile_icons mdi mdi-chemical-weapon"></i>100 Friends</div>--}}

                    <ul class="profile_ul">
                        <li><a href="{{url('my-earning')}}"><i class="profile_icons mdi mdi-currency-inr"></i>My Earning</a>
                        </li>
                        <li><a href="{{url('my-profile')}}"><i class="profile_icons mdi mdi-account-edit"></i>My Profile</a>
                        </li>
                        <li data-toggle="modal" data-target="#Mymodal_AddNewMamber">
                            <a><i class="profile_icons mdi mdi-account-multiple-plus"></i>Add Members</a></li>
                        <li><a href="{{url('myads')}}"><i class="profile_icons mdi mdi-chemical-weapon"></i>My Advertise</a>
                        </li>
                        <li><a href="{{url('my-network')}}"><i class="profile_icons mdi mdi-sitemap"></i>My Network</a>
                        </li>
                        <li><a href="{{url('member')}}"><i class="profile_icons mdi mdi-account-multiple"></i>All
                                Members</a></li>
                        <li style="border-bottom: none;">
                            <a href="{{url('buy')}}"><i class="profile_icons mdi mdi-cart-outline"></i>Buy & Sell</a>
                        </li>
                    </ul>
                </div>
            </div>


            <div class="col-md-10">
                <div class="dash_boxcontainner">
                    <div class="advertise_withhead margin0">
                        <div class="col-xs-12 head_caption">Our Advertise List
                            {{--  <a href="javascript:void(0);" onclick="create_add()" class="btn btn-warning btn-sm add-ouradd" id="add-Newouradd"><i class="mdi basic_icon_margin mdi-plus"></i>Create</a>--}}
                            <div class="grid_header_btnbox">
                                <div class="btn-group" onclick="create_add()" id="add-Newouradd">
                                    <button type="button" class="btn btn-primary btn-sm action-btn"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Create
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm action-btn"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span
                                                class="mdi mdi-plus"></span></button>
                                </div>
                                <div class="btn-group gridbtn-group pull-right total_record_btnbox" id="TotalRecords">
                                    <span class="grid-counter-text">Counter</span><span
                                            class="btn btn-counter btn-sm">{{count($ads)}}</span>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-condensed table-hover table-responsive grid-table">
                            <tbody>
                            <tr class="tr-header globe-header-tr">
                                <th class="width_17">Advertise Title</th>
                                <th class="width_8">Type</th>
                                <th class="width_8">Price</th>
                                <th class="width_12">City</th>
                                <th class="width_15">Contact / Email</th>
                                <th class="width_16">Date</th>
                                <th class="width_12">Status</th>
                                <th class="width_12">Action</th>
                            </tr>
                            </tbody>
                            <tbody id="ListContainerSection">
                            @if(count($ads) > 0)
                                @foreach($ads as $ad)
                                    <tr id="row_{{$ad->id}}">
                                        <td class="tab-grid width_17 col1" data-line="Advertise Title"
                                            id="admin_adverlist_title">
                                            <?php $cat_img = \App\AdsImages::where(['ad_id' => $ad->id])->first(); ?>
                                            @if(isset($cat_img->image_url))
                                                <img class="always_display_none" id="admin_adverlist_img"
                                                     src="{{url('').'/'.$cat_img->image_url}}"/>
                                            @else
                                                <img class="always_display_none" id="admin_adverlist_img"
                                                     src="{{url('images/Adver_mainimg1.jpg')}}"/>
                                            @endif
                                            <div class="always_display_none"
                                                 id="admin_adverlist_contact">{{$ad->user->contact}}</div>
                                            {{$ad->ad_title}}
                                        </td>
                                        <td class="tab-grid width_8 col2"
                                            data-line="Type"
                                            id="admin_adverlist_category">{{isset($ad->ad_category_id)?$ad->ad_cat->category:'-'}}</td>
                                        <td class="tab-grid width_8 col2 text-right"
                                            data-line="Price"
                                            id="admin_adverlist_price">1500.00
                                        </td>
                                        <td class="tab-grid width_12 col3" data-line="City"
                                            id="admin_adverlist_city">{{$ad->city}}</td>
                                        <td class="tab-grid width_15 col3" data-line="Contact / Email"
                                            id="admin_adverlist_contact">{{$ad->city}}</td>
                                        <td class="tab-grid width_16 col5"
                                            data-line="Date"
                                            id="admin_adverlist_date">{{ date_format(date_create($ad->created_time), "d-M-Y h:i A")}}</td>
                                        <td class="tab-grid width_12 col6 text_center" data-line="Status"
                                            id="admin_adverlist_status">

                                            @if($ad->status=='Approved')
                                                <div class="status excepted">{{$ad->status}}</div>
                                            @elseif($ad->status=='Pending')
                                                <div class="status pending">{{$ad->status}}</div>
                                            @else
                                                <div class="status rejected">{{$ad->status}}</div>
                                            @endif
                                        </td>
                                        <td class="tab-grid width_12 col7 btn_td" data-line="Action">
                                            <div class="btn-group grid_btn_box">
                                                <button type="button" class="btn btn-primary btn-sm action-btn"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">Options
                                                </button>
                                                <button type="button" class="btn btn-primary btn-sm action-btn"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="true"><span class="caret"></span><span
                                                            class="sr-only"></span></button>
                                                <ul class="dropdown-menu dropdown-menu-right grid-dropdown">
                                                    <li><a data-toggle="modal"
                                                           onclick="ShowAdvertiseDetails_user(row_{{$ad->id}});"
                                                           data-target="#Modal_ViewDetails_advertiselist"><i
                                                                    class="mdi mdi-more optiondrop_icon"></i>More</a>
                                                    </li>
                                                    <li>
                                                        <a onclick="ShowConformationPopupMsg('Are You Sure To close this Advertisement.');"><i
                                                                    class="mdi mdi-close optiondrop_icon"></i>Close</a>
                                                    </li>
                                                    <li>
                                                        <a id="{{$ad->id}}"
                                                           onclick="ShowConformationPopupMsg('Are You Sure To delete this record.');"
                                                           class="border_none btnDelete"><i
                                                                    class="mdi mdi-delete optiondrop_icon delete_color"></i>Delete</a>
                                                    </li>
                                                    {{--<li>--}}
                                                    {{--<a id="{{$ad->id}}"--}}
                                                    {{--onclick="ShowConformationPopupMsg('Are you sure you want to delete this ad');"--}}
                                                    {{--class="border_none btnDelete"><i--}}
                                                    {{--class="mdi mdi-delete optiondrop_icon delete_color"></i>Delete</a>--}}
                                                    {{--</li>--}}
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7">
                                        <span class="list_no_record">< No Record Available ></span>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <!-- <div class="grid_pagination">
                             <div class="drop_downpagination">
                                 <select class="form-control" data-live-search="true">
                                     <option data-tokens="10">10</option>
                                     <option data-tokens="25">25</option>
                                     <option data-tokens="50">50</option>
                                     <option data-tokens="50">100</option>
                                     <option data-tokens="50">All</option>
                                 </select>
                             </div>
                             <div class="pagination_box">
                                 <ul class="pagination pagination_ul">
                                     <li class="page-item">
                                         <a href="#" class="page-link" aria-label="Previous">
                                             <span aria-hidden="true">«</span>
                                         </a>
                                     </li>
                                     <li class="page-item"><a href="#" class="page-link">1</a></li>
                                     <li class="page-item"><a href="#" class="page-link">2</a></li>
                                     <li class="page-item active"><a href="#" class="page-link">3</a></li>
                                     <li class="page-item"><a href="#" class="page-link">4</a></li>
                                     <li class="page-item"><a href="#" class="page-link">5</a></li>
                                     <li class="page-item">
                                         <a href="#" class="page-link" aria-label="Next">
                                             <span aria-hidden="true">»</span>
                                         </a>
                                     </li>
                                 </ul>
                             </div>
                         </div>-->
                    </div>
                </div>
            </div>
        </div>
        @php
            $cities = DB::select("select * from cities where City IS NOT NULL order by City ASC");
        @endphp
        <div id="Modal_NewAdd" class="modal fade" data-easein="bounceIn" role="dialog">
            {!! Form::open(['url' => 'buys', 'class' => 'form-horizontal', 'id'=>'user_master', 'files'=>true]) !!}
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"
                                onclick="GloCloseModel();">&times;</button>
                        <h4 class="modal-title">Add New Advertisement</h4>
                    </div>
                    <div class="modal-body" id="Add_newAdvertise">
                        <div class="basic_lb_row">
                            <div class="col-sm-6">
                                <div class="inner_lbdiv">
                                    <div class="advertise_lefttxt" id="_TypeName">Advertise Title :</div>
                                    <input type="text" name="title" class="form-control required"
                                           placeholder="Enter title" data-validate="Btn_advertise" maxlength="250"
                                           autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="inner_lbdiv">
                                    <div class="advertise_lefttxt" id="_TypeName">Advertise Type :</div>
                                    <select class="form-control requiredDD" name="ddcategory">
                                        <option value="0">Select</option>
                                        @foreach($ad_category as $category)
                                            <option value="{{$category->id}}">{{$category->category}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="basic_lb_row">
                            <div class="col-sm-6">
                                <div class="inner_lbdiv">
                                    <div class="advertise_lefttxt" id="_TypeName">Email Id :</div>
                                    <input type="text" name="email" class="form-control" placeholder="Enter Email id"
                                           data-validate="Btn_advertise" maxlength="250" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="inner_lbdiv">
                                    <div class="advertise_lefttxt">Contact No. :</div>
                                    <input type="text" name="title" class="form-control required"
                                           placeholder="Enter contact no." data-validate="Btn_advertise" maxlength="250"
                                           autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="basic_lb_row">
                            <div class="col-sm-6">
                                <div class="inner_lbdiv">
                                    <div class="advertise_lefttxt" id="_TypeName">City :</div>
                                    <select class="form-control" id="a_city"
                                            name="city">
                                        {{--<option value="0"> --Please Select*--</option>--}}
                                        @foreach($cities as $city)
                                            <option value="{{$city->CID}}">{{$city->City}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="inner_lbdiv">
                                    <div class="advertise_lefttxt">Selling Price :</div>
                                    <input type="number" name="selling_cost" class="form-control amount"
                                           placeholder="Enter Selling Price" data-validate="Btn_advertise"
                                           maxlength="50" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="basic_lb_row">
                            <div class="col-sm-6">
                                <div class="inner_lbdiv">
                                    <div class="advertise_lefttxt" id="_TypeName">Advertise Details :</div>
                                    <textarea cols="1" rows="4" name="add_details"
                                              class="form-control txt_resize required" placeholder="Enter Details"
                                              data-validate="Btn_advertise" maxlength="500"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="inner_lbdiv">
                                    <div class="advertise_lefttxt">Location :</div>
                                    <textarea cols="1" rows="4" name="add_address" class="form-control txt_resize"
                                              placeholder="Enter Location" data-validate="Btn_advertise"
                                              maxlength="500"></textarea>
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
                                    <div class="advertise_lefttxt">Upload Image :</div>
                                    <div class="upload_limittxt">You can upload maximum 8 images for Advertisement.
                                    </div>
                                    {{--<div class="com-block file_upload_box">--}}
                                    {{--<input type="file" name="ad_img" accept=".png,.jpg, .jpeg, .gif"--}}
                                    {{--class="file_upload"--}}
                                    {{--id="advertise_Image"--}}
                                    {{--onchange="UploadImage(this);"/>--}}
                                    {{--</div>--}}
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
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="Submit_advertise();">Submit</button>
{{--                        {!! Form::submit('Submit', ['class' => 'btn btn-sm btn-primary']) !!}--}}
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="GloCloseModel();">
                            Close
                        </button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </section>
    <div id="modal_crop" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Crop and Download your image</h4>
                </div>
                <div class="modal-body">
                    <main class="page">
                        <div class="box" style="display:none">
                            <div class="input-group">
            <span class="input-group-btn">
                <span class="btn btn-default btn-file">
                    Browse… <input type="file" id="file-input"/>
                </span>
            </span>
                                <input type="text" id="file_text_crop" class="form-control" readonly=""/>
                            </div>
                            <p class="note_forcrop">
                                You can easily rotate, move and crop the image. double click are used to change the
                                event like move to 360 degree. ( image and crop frame )
                            </p>
                        </div>
                        <div class="box-2">
                            <div class="result">
                                <img class="cropped" id="image_frout" src="{{url('images/NoPreview_CropImg.png')}}"
                                     alt="">
                            </div>
                        </div>
                        <div class="box-2 img-result hide">
                            <img class="cropped" id="image_frout" src="" alt="">
                        </div>
                        <div class="box" id="cropbtn_setting">
                            {{--<div class="options hide">--}}
                                {{--<label> Width</label>--}}
                                {{--<input type="text" class="img-w" value="300" min="100" max="1200"/>--}}
                            {{--</div>--}}
                            <button class="btn btn-info btn-sm" disabled="disabled" id="btn_RotateLeft">
                                <i class="mdi mdi-format-rotate-90 basic_icon_margin"></i>Rotate Left
                            </button>
                            <button class="btn btn-warning btn-sm center_btnmargin" disabled="disabled"
                                    id="btn_RotateRight">
                                <i class="mdi mdi-rotate-right basic_icon_margin"></i>Rotate Right
                            </button>
                            <button class="btn btn-danger btn-sm" disabled="disabled" id="btn_RotateReset">
                                <i class="mdi mdi-rotate-3d basic_icon_margin"></i>Reset
                            </button>
                            <!-- <button class="btn btn-success" id="btn_getRounded">
                                 <i class="mdi mdi-rotate-3d basic_icon_margin"></i>Rounded</button>-->
                        </div>
                    </main>
                </div>
                <div class="modal-footer">
                    <a href="" target="_blank" class="btn btn-default download" disabled="disabled"
                       id="btncrop_download" download="imagename.png">
                        <i class="mdi mdi-folder-download basic_icon_margin"></i>Download</a>
                    <button class="btn btn-primary save" id="save" onclick="Cropped_image();" disabled="disabled"><i
                                class="mdi mdi-crop basic_icon_margin"></i>Cropped
                    </button>
                    <button class="btn btn-success upload-result" disabled="disabled" id="save_toserver" data-dismiss="modal"
                            onclick="UpdateImage();"><i class="mdi mdi-account-check basic_icon_margin"></i>
                        Save
                    </button>
                </div>
            </div>

        </div>
    </div>
    <script type="text/javascript" src="{{url('js/cropper.min.js')}}"></script>
    <script type="text/javascript">
       // window.URL = window.URL || window.webkitURL;
       function CheckFileValidation(dis) {
           var sizefile = Number(dis.files[0].size);
           if (sizefile > 1048576 * 2) {
               var finalfilesize = parseFloat(dis.files[0].size / 1048576).toFixed(2);
               ShowErrorPopupMsg('Your file size ' + finalfilesize + ' MB. File size should not exceed 2 MB');
               $(dis).val("");
               return false;
           }
           var validfile = ["png", "jpg", "jpeg"];
           var source = $(dis).val();
           var current_filename = $(dis).val().replace(/\\/g, '/').replace(/.*\//, '');
           var ext = source.substring(source.lastIndexOf(".") + 1, source.length).toLowerCase();
           for (var i = 0; i < validfile.length; i++) {
               if (validfile[i] == ext) {
                   break;
               }
           }
           if (i >= validfile.length) {
               ShowErrorPopupMsg('Only following file extension is allowed, png, jpg, jpeg ');
               $(dis).val("");
               return false;
           }
           else {
               var input = dis;
               if (input.files && input.files[0]) {
                   var reader = new FileReader();
                   reader.onload = function (e) {
                       // $(changepicid).attr('src', e.target.result);
                   };
                   reader.readAsDataURL(input.files[0]);
                   $('#file_text_crop').val(current_filename);
                   return true;
               }
           }
       }
        useBlob = false && window.URL;
       var result = $('.result'),
                img_result = $('.img-result'),
                img_w = $('.img-w'),
                img_h = $('.img-h'),
                options = $('.options'),
                save = $('.save'),
                cropped = $('.cropped'),
                dwn = $('.download'),
//                upload = $('#file-input'),
                cropper = '';
        function readImage(file) {
            var reader = new FileReader();
            var image_src = "";
            reader.addEventListener("load", function () {
                var image = new Image();
                image.addEventListener("load", function () {
//                    var imageInfo = file.name + ' ' +
//                        image.width + '×' +
//                        image.height + ' ' +
//                        file.type + ' ' +
//                        Math.round(file.size / 1024) + 'KB';
                    // elPreview.appendChild(this);
                    //elPreview.insertAdjacentHTML("beforeend", imageInfo + '<br>');
                    if (useBlob) {
                        image_src = window.URL.revokeObjectURL(image.src);
                    }
                });
                // image.src = useBlob ? window.URL.createObjectURL(file) : reader.result;
                image_src = useBlob ? window.URL.createObjectURL(file) : reader.result;
                var append_image = "<div class='upimg_box'>" +
                    "<i class='thumb_edit mdi mdi-pencil' data-toggle='modal' data-target='#modal_crop' " +
                    "onclick='EditImage(this)'></i>" +
                    "<i class='thumb_close mdi mdi-close' onclick='Remove_uploadimg_advertise(this);'></i>" +
                    "<img class='up_img' src='" + image_src + "' /></div>";//
                $('#preview').append(append_image);
            });
            getfilelength();
            reader.readAsDataURL(file);
        }
        function Remove_uploadimg_advertise(dis) {
            Remove_uploadimg(dis);
            getfilelength();
        }
        function getfilelength() {
            setTimeout(
                function () {
                   var pen_length = $('.upimg_box').length;
                        $('#file_upload_count').val(pen_length + " Files Selected");
                }, 300);
        }
        function UploadImage(dis) {
            var files = dis.files;
            var errors = "";
            if (!files) {
                errors += "File upload not supported by your browser.";
            }
            if (files && files[0]) {
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    if ((/\.(png|jpeg|jpg|gif)$/i).test(file.name)) {
                        debugger;
                        // SUCCESS! It's an image!
                        // Send our image `file` to our `readImage` function!
                        var img_length=Number($('.upimg_box').length);
                        console.log(img_length);
                        if(img_length < 8) {
                            readImage(file);
                           // getfilelength();
                        }else {
                           // getfilelength();
                            ShowErrorPopupMsg("You can upload maximum 8 images for Advertisement");
                        }
                    } else {
                        errors += file.name + " Unsupported Image extension\n";
                    }
                }
            }
            if (errors) {
                alert(errors);
            }
            $(dis).val('');
        }
        function EditImage(dis) {
            var getimag_src =$(dis).parent().find('.up_img').attr('src');
            $('.up_img').removeClass('edit_this');
            $(dis).parent().find('.up_img').addClass('edit_this');
           // $('#image_frout').attr('src', img_src);

            var img = document.createElement('img');
            img.id = 'image';
            img.src = getimag_src;
            // clean result before
            //result.innerHTML = '';
            result.children().remove();
            // append new image
            result.append(img);
            // show save btn and options
            // save.removeClass('hide');
            options.removeClass('hide');
            $('#image_frout').attr('src', '');
           // $('.cropped').attr('src', getimag_src);
            cropper = new Cropper(img);

            // cropbtn setting enabled
            $('#cropbtn_setting').find('.btn').removeAttr("disabled");
            $('#btncrop_download').attr("disabled", "true");
            $('#save_toserver').attr("disabled", "true");
            save.removeAttr("disabled");
            $('#btn_RotateLeft').click(function () {
                cropper.rotate(90);
            });
            $('#btn_RotateRight').click(function () {
                cropper.rotate(-90);
            });
            $('#btn_RotateReset').click(function () {
                cropper.reset();
            });
            $('#btn_Compresed').click(function () {
                /*     cropper.(UMD, compressed);*/
            });
        }
        function UpdateImage() {
            var update_imgsrc=$('#image_frout').attr('src');
            $('.edit_this').attr('src', update_imgsrc);
            $('.up_img').removeClass('edit_this');
        }
        function Cropped_image() {
            var imgSrc = cropper.getCroppedCanvas({
                width: img_w.value // input value
            }).toDataURL();
            // remove hide class of img
            cropped.removeClass('hide');
            img_result.removeClass('hide');
            // show image cropped
            cropped.attr('src', imgSrc);
            dwn.removeClass('hide');
            //dwn.download = 'imagename.png';
            dwn.attr('href', imgSrc);
            // download button enabled
            $('#btncrop_download').removeAttr("disabled");
            $('#save_toserver').removeAttr("disabled");
        }
        function Submit_advertise() {
           var adverimg_length = $('.upimg_box').length;
           if(adverimg_length >8) {
               ShowErrorPopupMsg("You can upload maximum 8 images for Advertisement");
           }else {
               ShowSuccessPopupMsg("Advertisement has been uploaded... Advertisement will get appear after approval.");
               $('#Modal_NewAdd').modal('hide');
           }
       }
    </script>
    <script type="text/javascript">
        $('.btnDelete').click(function () {
                    {{--$('#ConfirmBtn').html('<a class="popup_submitbtn conformation_bg conformation_btn" href="{{ url('myads') }}/' + id +--}}
                    {{--'/delete"> Yes</a>'--}}
                    {{--);--}}
            var id = $(this).attr('id');
            var append_url = '{{ url('/') }}' + "/myads/" + id + "/delete";
            $('#ConfirmBtn').attr("href", append_url);
        });


        function GridHeaderCheck(dis) {
            $('input[type="checkbox"]').prop("checked", $(dis).prop("checked"));
        }
        function ChildGridEvent() {
            $("#CheckboxgridHead").prop("checked", false);
        }
        function MoneyTransfer() {

            if (Number($('input[name="checkboxChild"]:checked').length) == 0) {
                ShowErrorPopupMsg("Please select record first")
                return false;
            }
            var CheckIds = [];
            $('input[name="checkboxChild"]:checked').each(function () {
                CheckIds.push($(this).val());
            });
            $("#Modal_AccountDetails").modal('show');
        }
        //        $(document).ready(function () {
        //            $(function () {
        //                $('[data-toggle="tooltip"]').tooltip()
        //            });
        //        });

        function ShowAdvertiseDetails_user(dis) {
            $('#adver_title').text($(dis).find('#admin_adverlist_title').text());
            $('#adver_type').text($(dis).find('#admin_adverlist_category').text());
            $('#adver_by').text($(dis).find('#admin_adverlist_by').text());
            $('#adver_city').text($(dis).find('#admin_adverlist_city').text());
            $('#adver_date').text($(dis).find('#admin_adverlist_date').text());
            $('#adver_status').text($(dis).find('#admin_adverlist_status').text());
            $('#adver_contact').text($(dis).find('#admin_adverlist_contact').text());
            $('#adver_price').text($(dis).find('#admin_adverlist_price').text());
            $('#adver_image').attr('src', $(dis).find('#admin_adverlist_img').attr('src'));
            //globalloaderhide();
        }

        function create_add() {
            globalloadershow();
            $('#Modal_NewAdd').modal('show');
            //$('.modal-title').html('Add New Advertisement');
            //$('#Add_newAdvertise').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');
            //alert(id);
            {{--$.ajax({--}}
                {{--type: "GET",--}}
                {{--contentType: "application/json; charset=utf-8",--}}
                {{--url: "{{ url('buys/create') }}",--}}
                {{--success: function (data) {--}}
                    {{--$('#Add_newAdvertise').html(data);--}}
    {{--//            $('#modelBtn').visible(disabled);--}}
                {{--},--}}
                {{--error: function (xhr, status, error) {--}}
                    {{--$('#Add_newAdvertise').html(xhr.responseText);--}}
                    {{--//$('.modal-body').html("Technical Error Occured!");--}}
                {{--}--}}
            {{--});--}}
            globalloaderhide();
        }
    </script>
@stop