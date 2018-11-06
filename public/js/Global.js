/**
 * Created by Pinku Kesharwani on 12/01/2018.
 */
var appenddiv_fixed = "<div class='topfixed_marginbox'></div>";
var append = false;
$(window).scroll(function (event) {
    var chk_scroll = $(window).scrollTop();
    if (chk_scroll > 70) {
        $('#master_header_block').addClass('top_manubar_fixed');
        if (!append) {
            $('#master_header_block').after(appenddiv_fixed);
            append = true;
        }
    } else {
    }
});

function HideOnpageLoopader() {
    $('#onpage_loader').hide();
}

function ShowOnpageLoopader() {
    $('#onpage_loader').show();
}

$(document).ready(function () {
    $('#acc_lbtxt_amt').focusout(function () {
        var marge_value = '';
        var request_redeem_amt = $(this).val();
        var actualvalue = 0;
        if (request_redeem_amt.includes('.') == true) {
            var actualvalue = request_redeem_amt.split('.');
            if (actualvalue[0] == '') {
                actualvalue[0] = 0;
            }
            if (actualvalue[1] == '') {
                actualvalue[1] = 0;
            }
            marge_value = actualvalue[0] + '.' + actualvalue[1];
        } else {
            marge_value = request_redeem_amt;
        }
        l = ($('#my_earning_amt').val());
        if (parseFloat(marge_value)>l) {
            $(this).val('');
        }
    });
    $("form").attr('autocomplete', 'off');
    $('#adver_responsive').click(function () {
        Advertise_categorylist(advertise_category_block, 'advertise_category_show');
    });

    /*--------------On page Loader ---------*/
    /*----------------------page Search auto complete-----------*/
    $('.header_search').keydown(function (e) {
        if ($(this).parent().find('.header_filter_row').length > 0) {
            var po = $(this).parent().find('#filter_friend_ul').scrollTop();
            var key = Number(e.keyCode);
            //var count = 0;
            var lenPress = Number($(this).parent().find('.P_pressed').length);
            var lenCoun = Number($(this).parent().find('.header_filter_row:visible').length);
            switch (key) {
                case 13:
                    $('.search_filter_box').addClass('scale0');
                    $('#onpage_loader').show();
                    window.location = $(this).parent().find('.P_pressed a').attr('href');
                    return false;
                    break;
                case 38:
                    if (lenPress == 0) {
                        $(this).parent().find('.header_filter_row:visible').last().attr('class', 'P_pressed');
                        $(this).parent().find('#filter_friend_ul').scrollTop($(this).parent().find('#filter_friend_ul').prop('scrollHeight'));
                    } else {
                        var PrevNum = Number($(this).parent().find('.P_pressed').prev('.header_filter_row:visible').length);
                        if (PrevNum == 0) {
                            $(this).parent().find('.header_filter_row:visible').last().attr('class', 'P_pressed');
                            $(this).parent().find('.P_pressed').first().attr('class', 'header_filter_row');
                            $(this).parent().find('#filter_friend_ul').scrollTop($(this).parent().find('#filter_friend_ul').prop('scrollHeight'));
                        } else {
                            $(this).parent().find('.P_pressed').prev().attr('class', 'P_pressed');
                            $(this).parent().find('.P_pressed').last().attr('class', 'header_filter_row');
                            $(this).parent().find('#filter_friend_ul').scrollTop(po - 40);
                        }
                    }
                    var v38 = $(this).parent().find('.P_pressed').text();
                    //$(this).val(v38);
                    break;
                case 40:
                    debugger;
                    var len40 = Number($(this).parent().find('.P_pressed').length);
                    if (len40 == 0) {
                        $(this).parent().find('.header_filter_row:visible').first().attr('class', 'P_pressed');
                    } else {
                        var inLen40 = Number($(this).parent().find('.P_pressed').first().next().length);
                        if (inLen40 == 0) {
                            var coulen40 = Number($(this).parent().find('.header_filter_row:visible').length);
                            if (coulen40 != 0) {
                                $(this).parent().find('.P_pressed').attr('class', 'header_filter_row');
                                $(this).parent().find('.header_filter_row:visible').first().attr('class', 'P_pressed');
                                $(this).parent().find('#filter_friend_ul').scrollTop(0);
                            }
                        } else {
                            var outLen40 = Number($(this).parent().find('.P_pressed').first().next('.header_filter_row:visible').length);
                            if (outLen40 == 0) {
                                $(this).parent().find('.P_pressed').attr('class', 'header_filter_row');
                                $(this).parent().find('.header_filter_row:visible').first().attr('class', 'P_pressed');
                                $(this).parent().find('#filter_friend_ul').scrollTop(0);
                            } else {
                                $(this).parent().find('.P_pressed').first().next().attr('class', 'P_pressed');
                                $(this).parent().find('.P_pressed').first().attr('class', 'header_filter_row');
                                $(this).parent().find('#filter_friend_ul').scrollTop(po + 40);
                            }
                        }
                    }
                    var v40 = $(this).parent().find('.P_pressed').text();
                    //$(this).val(v40);
                    break;
                //                    default:
                //                        var me = e.target;
                //                        $(this).next().find('.P_pressed').attr('class', 'P_row');
                //                        PopulateList(me);
                //                        e.preventDefault();
                //       break;
            }
        }
    });
    /*$('.header_search').keyup(function (e) {
     var key = Number(e.keyCode);
     if ((key >= 65 && key <= 105) || (key >= 48 && key <= 57) || key == 8 || key == 46) {
     var txt = $.trim($(this).val().toLowerCase());
     if (txt != '') {
     var me = e.target;
     $(this).next().find('.P_pressed').attr('class', 'P_row');
     // PopulateList(me);
     } else {
     var me = e.target;
     $(this).next().find('.P_pressed').attr('class', 'P_row');
     //PopulateList(this);
     }
     }
     });
     */
    /*------------Autocomplete Search-----------------*/
    /*var Recived_data=[name][0];
     for(var i=0;i<options.data.length;i++){
     Recived_data[i][0]=options.data[{name:,icon:}];
     }*/

    /*------------Autocomplete Search-----------------*/
    /*------------------Comments Js------------*/
    $(".comment_emoji_div").text('');
    $(".comment_emoji_div").emojioneArea({
        pickerPosition: "top",
        tonesStyle: "radio",
        /*autocompleteTones: false,
         textcomplete: {
         maxCount  : 20,
         placement : 'absleft'
         },
         default:
         {
         dir            : "ltr",
         spellcheck     : false,
         autocomplete   : "off",
         autocorrect    : "off",
         autocapitalize : "off",
         }*/
    });
    /*------------------Emoji-------------- */
    $(".emoji_div").emojioneArea({
        pickerPosition: "bottom",
        autocompleteTones: false,
        textcomplete: {
            maxCount: 20,
            placement: 'absleft'
        },
        default: {
            dir: "ltr",
            spellcheck: false,
            autocomplete: "off",
            autocorrect: "off",
            autocapitalize: "off",
        }
    });
    /* $(window).bind('statechange',function(){

     $(".comment_emoji_div").text('');
     (".comment_emoji_div").emojioneArea({
     pickerPosition: "bottom",
     tonesStyle: "radio",
     });
     });*/
    $('.emoji_div').text('');

    $('.glo_menuclick').click(function (e) {
        debugger;
        var chkopen = $(this).find('.menu_basic_popup').attr('class');
        $('#setting_box_slide').removeClass('show_setting');
        if (chkopen != 'menu_basic_popup effect') {
            if (chkopen != 'menu_basic_popup menu_popup_setting effect') {
                $('.menu_basic_popup').addClass('scale0');
                $(this).find('.menu_basic_popup').removeClass('scale0');
            } else {
                $('.menu_basic_popup').addClass('scale0');
            }
        } else {
            $('.menu_basic_popup').addClass('scale0');
        }
        e.stopPropagation();
    });
    $("#countdown").dsCountDown(options);

    window.onload = function () {
        // var announce_txt = "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.";
        // setTimeout(ShowAnnouncement(announce_txt), 8000);
        // setTimeout(ShowAnnouncement(announce_txt), 15000);
        setTimeout(function () {
            $('.comment_emoji_div').parent().find('.emojionearea-editor').attr('onkeyup', 'Gatcommenttxt(this);');
        }, 1000);
    }
});
$(document).click(function (e) {
    $('.menu_basic_popup').addClass('scale0');
    e.stopPropagation();
});
function Hidepopup(ins) {
    event.stopPropagation();
    switch (ins) {
        case 'hide':
            $('.menu_basic_popup').addClass('scale0');
            return false;
            break;
    }
}
//var current_event=0;
function ShowPrevAccDetails(dis) {
    $('#acc_lbtxt_amt').val($(dis).find('.hidden_acc_amount').val());
    $('#acc_lbtxt_name').val($(dis).find('.hidden_acc_name').val());
    $('#acc_lbtxt_no').val($(dis).find('.hidden_acc_no').val());
    $('#acc_lbtxt_bank').val($(dis).find('.hidden_acc_bank').val());
    $('#acc_lbtxt_ifs').val($(dis).find('.hidden_acc_ifs').val());
    $('#acc_lbtxt_adhr').val($(dis).find('.hidden_acc_adhr').val());
    $('.account_exist').removeClass('Account_selected');
    $(dis).addClass('Account_selected');
}

function HidePrevAccDetails() {
    $('#acc_lbtxt_amt').val('');
    $('#acc_lbtxt_no').val('');
    $('#acc_lbtxt_name').val('');
    $('#acc_lbtxt_bank').val('');
    $('#acc_lbtxt_ifs').val('');
    $('#acc_lbtxt_adhr').val('');
    $('.account_exist').removeClass('Account_selected');
}

/*function InitializeEmoji() {
 $(".comment_emoji_div").text('');
 //$(".comment_emoji_div").parent().find('.emojionearea').remove();
 $(".comment_emoji_div").emojioneArea({
 pickerPosition: "bottom",
 tonesStyle: "radio",
 placeholder: "write a comments"
 });
 }*/

function InitializeEmoji() {
    $('.comment_emoji_div').each(function () {
        if ($(this).parent().find('.emojionearea').length < 1) {
            $(this).text('');
            $(this).emojioneArea({
                pickerPosition: "top",
                tonesStyle: "radio",
                placeholder: "write a comments"
            });
        }
    });
}

function ShowAdvertiseDetails(dis) {
    globalloadershow();
    $('#otr_lb_details').show();
    var getimgsrc = $(dis).parent().parent().find('img').attr('src');
    var gettitle = $(dis).text().trim();
    var getdetails = $(dis).parent().find('.list_description').text().trim();
    var getlocation = $(dis).parent().find('.list_address').text().trim();
    var gettype = $(dis).parent().find('.list_adver_type').val().trim();
    var getcontact = $(dis).parent().find('.list_contact').text().trim();
    var getemail = $(dis).parent().find('.list_email').text().trim();
    var getprice = $(dis).parent().find('.list_price').text().trim();
    $('#adver_img_lb').attr('src', getimgsrc);
    $('#adver_title_lb').text(gettitle);
    $('#adver_details_lb').text(getdetails);
    $('#adver_city_lb').text(getlocation);
    $('#adver_type_lb').text(gettype);
    $('#adver_contact_lb').text(getcontact);
    $('#adver_email_lb').text(getemail);
    $('#adver_price_lb').text(getprice);
    globalloaderhide();
}

function ShowAdminAdvertiseDetails(dis) {
    ShowOnpageLoopader();
    $('#otr_lb_details').hide();
    var getimgsrc = $(dis).parent().parent().find('img').attr('src');
    var gettitle = $(dis).text().trim();
    var getdetails = $(dis).parent().find('.list_description').val().trim();
    /* var getlocation = $(dis).parent().find('.list_address').text().trim();
     var gettype = $(dis).parent().find('.list_adver_type').val().trim();*/
    $('#adver_img_lb').attr('src', getimgsrc);
    $('#adver_title_lb').text(gettitle);
    $('#adver_details_lb').text(getdetails);
    /*   $('#adver_city_lb').text(getlocation);
     $('#adver_type_lb').text(gettype);*/
    HideOnpageLoopader();
}

var append_this = "<div onclick='GloCloseModel();' class='modal-backdrop fade in'></div>";

function update_password() {
    $('#myModal_UpdatePassword').addClass('in');
    $('#myModal_UpdatePassword').show();
    $('body').append(append_this);
    $('body').addClass('modal-open');
}

function Model_NewAdd() {
    $('#Modal_NewAdd').addClass('in');
    $('#Modal_NewAdd').show();
    $('body').append(append_this);
    $('body').addClass('modal-open');
}

function GloCloseModel() {
    $('#Modal_NewAdd').hide();
    $('#myModal_UpdatePassword').hide();
    $('#Modal_NewAdd').removeClass('in');
    $('#myModal_UpdatePassword').removeClass('in');
    $('body').removeClass('modal-open');
    var thisbox = $('body').find('.modal-backdrop');
    $(thisbox).remove();
}

function LikeUnlike(dis) {
    var chk_like = $(dis).attr('class');
    // var curr_count=Number($(dis).parent().find('.count_like').text());
    if (chk_like == 'heart') {
        $(dis).addClass('happy').removeClass('broken');
        //$(dis).parent().find('.count_like').text(curr_count+1);
        LikeUpdate(dis, true);
    }
    else if (chk_like == 'heart existing_happy') {
        $(dis).removeClass('existing_happy').addClass('broken');
        //$(dis).parent().find('.count_like').text(curr_count-1);
        LikeUpdate(dis, false);
    }
    else if (chk_like == 'heart broken') {
        $(dis).addClass('happy').removeClass('broken');
        // $(dis).parent().find('.count_like').text(curr_count+1);
        LikeUpdate(dis, true);
    } else {
        $(dis).removeClass('happy').addClass('broken');
        // $(dis).parent().find('.count_like').text(curr_count-1);
        LikeUpdate(dis, false);
    }
}

/*-----------------Remove Advertise----------------*/
function ShowAdverImage(dis, changepicid, closebtn) {
    var chkreturn = ChangeSetImage(dis, changepicid);
    if (chkreturn == true) {
        $(closebtn).fadeIn();
    }
}

function ShowPassword(pass_icon, txt_id) {
    var gettype = $('#' + txt_id).attr('type');
    if (gettype == 'text') {
        $('#' + pass_icon).removeClass('mdi-eye-off');
        $('#' + txt_id).attr('type', 'password');
    } else {
        $('#' + pass_icon).addClass('mdi-eye-off');
        $('#' + txt_id).attr('type', 'text');
    }
}

function RemoveAdvertise(dis, changepicid, file_id) {
    $(dis).fadeOut();
    $(changepicid).attr('src', 'images/NoPreview_Img.png');
    $(file_id).val('');
}

function ShowSuccessPopupMsg(msg) {
    $('#sucess_popup').find('.dynamic_popuptxt').text(msg);
    $('#sucess_popup').addClass('show_popup');
}

function ShowErrorPopupMsg(msg) {
    $('#error_popup').find('.dynamic_popuptxt').text(msg);
    $('#error_popup').addClass('show_popup');
}

function ShowConformationPopupMsg(msg) {
    $('#conformation_popup').find('.dynamic_popuptxt').text(msg);
    $('#conformation_popup').addClass('show_popup');
}

function HidePopoupMsg() {
    $('.popup_bgcolor').removeClass('show_popup');
}

function RemoveSetImage(changepicimg, img_id, file_id) {
    $(img_id).attr('src', changepicimg);
    $(file_id).val('');
}

function ChangeSetImage(dis, changepicid) {
    var sizefile = Number(dis.files[0].size);
    if (sizefile > 1048576) {
        var finalfilesize = parseFloat(dis.files[0].size / 1048576).toFixed(2);
        ShowErrorPopupMsg('Your file size ' + finalfilesize + ' MB. File size should not exceed 1 MB');
        $(dis).val("");
        return false;
    }
    var validfile = ["png", "jpg", "jpeg", "gif"];
    var source = $(dis).val();
    var ext = source.substring(source.lastIndexOf(".") + 1, source.length).toLowerCase();
    for (var i = 0; i < validfile.length; i++) {
        if (validfile[i] == ext) {
            break;
        }
    }
    if (i >= validfile.length) {
        ShowErrorPopupMsg('Only following file extention is allowed, png, jpg, jpeg, gif ');
        $(dis).val("");
        return false;
    }
    else {
        var input = dis;
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(changepicid).attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0])
            return true;
        }
    }
}

var options = {
    startDate: new Date(),
    endDate: new Date("April 28, 2018 12:00:00")
};

/*------------Earning Js-----------*/
function Show_Earnering() {
    $('.res_earning').addClass('basic_thumb_show');
    $('.overlay_res').show();
    $('body').css('overflow', 'hidden');
}

function Show_Network() {
    $('.res_network').addClass('basic_thumb_show');
    $('.overlay_res').show();
    $('body').css('overflow', 'hidden');
}

function Show_About() {
    $('.res_about').addClass('basic_thumb_show');
    $('.overlay_res').show();
    $('body').css('overflow', 'hidden');
}

function GlobalHideTranparent() {
    $('.overlay_res').fadeOut();
    $('.basic_thumb').removeClass('basic_thumb_show');
    $('.profile_basic_menu_block').removeClass('profile_basic_menu_block_show');
    $('.top_earner_block').removeClass('show_fixed_rightblk');
    $('.followers_block').removeClass('show_fixed_rightblk');
    $('#advertise_category_block').removeClass('advertise_category_show');
    $('body').css('overflow', 'auto');
}

function Othershowhide(dis, action_id) {
    var checktype = $(dis).val().toLowerCase();
    if (checktype == "other") {
        $(action_id).slideDown();
    } else {
        $(action_id).slideUp();
    }
}

function Advertise_categorylist(id_show, add_class) {
    $(id_show).addClass(add_class);
    $('.overlay_res').show();
    $('body').css('overflow', 'hidden');
}

/*------------------Post js----------------------------*/
var current_uploadfile = 0;
var oversize = false;
var overfilesname = "";

function PreviewImage() {
    $('#image_preview').text('');
    total_file = 0;
    current_uploadfile = 0;
    total_file += document.getElementById("upload_file_image").files.length;
    var _file = document.getElementById("upload_file_image").files;
    var imageUrl = $(this).find('[name=upload_file_image]').val();
    var fileInput = $("input#upload_file_image[type=file]")[0],
        file = fileInput.files && fileInput.files[0];
    if (total_file < 11) {
        if (current_uploadfile < 11) {
            for (var i = 0; i < total_file; i++) {
                if (current_uploadfile < 10) {
                    //sizefile = Number(i.size);
                    var sizefile = _file.item(i).size;
                    if (sizefile > 1048576*5) {
                        oversize = true;
                        overfilesname += _file.item(i).name + ", ";
                    } else {
                        debugger;

                        var currentfile = _file[i].name;
                        var tmppath = window.URL.createObjectURL(fileInput.files[i]);

                        // var convertFunction = convertFileToDataURLviaFileReader;
                        // convertFunction(currentfile, function(base64Img) {
                        //     alert(base64Img);
                        // var src = window.URL.createObjectURL(event.target.files[i]);
                        // })

                        //var FR= new FileReader();
                       // tour_dates = new Array();

                        FR.addEventListener("load", function(e) {
                            // document.getElementById("img").src       = e.target.result;
                            //document.getElementById("b64").innerHTML = e.target.result;
                           //  alert("First Alert"+e.target.result);
                           // console.log(e.target.result);
                            //tour_dates.push(e.target.result);
                            // tmppath=e.target.result;
                        });
                       /// var tids = tour_dates;
                        //var base= FR.readAsDataURL(_file[i]);
                        // alert(" Alert"+base);
                        // var selectedFile = _file[i];
                        // selectedFile.convertToBase64(function(base64){
                        //     alert(base64);
                        // })


                        var append_image = "<div class='upimg_box'><i class='thumb_close mdi mdi-close' onclick='Remove_uploadimg(this);'></i>" +
                            "<img class='up_img' src='" + tmppath + "' />" +
                            "<input class='profile-upload-pic dynamic_fileappend' type='file' val='" + _file.item(i).name + "'  /></div>";
                        $('#image_preview').append(append_image);
                        $('#files_block').show();
                        current_uploadfile++;
                        // });
                    }
                } else {
                    ShowErrorPopupMsg("Maximum 10 images post at a time");
                    break;
                }
            }
        } else {
            ShowErrorPopupMsg("Maximum 10 images post at a time");
            return false;
        }
    } else {
        ShowErrorPopupMsg("Maximum 10 images post at a time");
        return false;
    }
    if (oversize == true) {
        ShowErrorPopupMsg(overfilesname + " File size must not exceed 5 MB");
    }
}

function PreviewVideo(dis) {
    var total_file = document.getElementById("upload_file_video").files.length;
    var _file = document.getElementById("upload_file_video").files;
    for (var i = 0; i < total_file; i++) {
        var sizefile = _file.item(i).size;
        if (sizefile > (1048576*10)) {
            overfilesname += _file.item(i).name + ", ";
            $('#upload_file_video').val('');
            ShowErrorPopupMsg(overfilesname + " File size must not exceed 10 MB");
        } else {
            var append_video = "<div class='upimg_box video_box'><i class='thumb_close mdi mdi-close' onclick='Remove_uploadvideo(this);'></i><span class='video_playicon'><i class='mdi mdi-play-circle-outline'></i></span><video autoplay='autoplay' poster='images/video_default.png' class='up_img'> <source src='" + window.URL.createObjectURL(event.target.files[i]) + "' type='video/mp4' /> </video></div>";
            $('#image_preview').find('.video_box').remove();
            $('#image_preview').append(append_video);
            $('#files_block').show();
        }
    }
}

// function playvideo(dis) {
//     $(dis).hide();
//     $(dis).parent().find('.slider_video').attr('controls', 'controls');
//     $(dis).parent().find('.slider_video').get(0).play();
// }
function checkvideo(dis) {
    var sizefile = Number(dis.files[0].size);
    if (sizefile > 5242880) {
        var finalfilesize = parseFloat(dis.files[0].size / 5242880).toFixed(2);
        ShowErrorPopupMsg('Your file size ' + finalfilesize + ' MB. File size should not exceed 5 MB');
        $(dis).val("");
        return false;
    }
    var validfile = ["mp4", "ogg", "webm", "3gp"];
    var source = $(dis).val();
    var ext = source.substring(source.lastIndexOf(".") + 1, source.length).toLowerCase();
    for (var i = 0; i < validfile.length; i++) {
        if (validfile[i] == ext) {
            break;
        }
    }
}

function CheckImage(dis) {
    var sizefile = Number(dis.files[0].size);
    if (sizefile > 3145728) {
        var finalfilesize = parseFloat(dis.files[0].size / 3145728).toFixed(2);
        ShowErrorPopupMsg('Your file size ' + finalfilesize + ' MB. File size should not exceed 3 MB');
        $(dis).val("");
        return false;
    }
    var validfile = ["png", "jpg", "jpeg", "gif"];
    var source = $(dis).val();
    var ext = source.substring(source.lastIndexOf(".") + 1, source.length).toLowerCase();
    for (var i = 0; i < validfile.length; i++) {
        if (validfile[i] == ext) {
            break;
        }
    }
}

function Remove_uploadvideo(dis) {
    $(dis).parent().remove();
    var chkcount = $('#image_preview').children().length;
    if (chkcount < 1) {
        $('#files_block').hide();
        $('#upload_file_video').val('');
    }
}

function Remove_uploadimg(dis) {
    $(dis).parent().remove();
    current_uploadfile--;
    var chkcount = $('#image_preview').children().length;
    if (chkcount < 1) {
        $('#files_block').hide();
        $('#upload_file_image').val('');
    }
}

/*----------------Update By Pinku 03_04_18----------*/
var selected_payoption = "payumoney";

function Submit_PayOption() {
    $('#accepted_check').prop('checked', false);
    $('.btn_terms').attr('disabled', 'disabled');
    if (selected_payoption == "paytm") {
        $('#payu_form_btnblock').hide();
        $('#paytm_form_btnblock').show();
        $('#atom_form_btnblock').hide();
    } else if (selected_payoption == "payumoney") {
        $('#payu_form_btnblock').show();
        $('#paytm_form_btnblock').hide();
        $('#atom_form_btnblock').hide();
    } else {
        $('#paytm_form_btnblock').hide();
        $('#payu_form_btnblock').hide();
        $('#atom_form_btnblock').show();
    }
}

function Submit_PayOptionCheckout() {
    $('#accepted_check').prop('checked', false);
    $('.btn_terms').attr('disabled', 'disabled');
    if (selected_payoption == "payumoney") {
        submitContactForm();
        // $('#payu_form_btnblock').show();
        // $('#paytm_form_btnblock').hide();
        // $('#atom_form_btnblock').hide();
    } else {
        submitContactForm();
        // $('#paytm_form_btnblock').hide();
        // $('#payu_form_btnblock').hide();
        // $('#atom_form_btnblock').show();
    }
}

function Selected_option(dis) {
    $('.payment_optionbox').removeClass('payment_selected');
    $(dis).addClass('payment_selected');
    selected_payoption = $('.payment_selected').find('.selected_option_name').val();
    $('#btn_payoption').removeAttr('disabled', 'disabled');
}

function AcceptTerms(dis) {
    if ($(dis).prop("checked")) {
        $('.btn_terms').removeAttr('disabled', 'disabled');
    } else {
        $('.btn_terms').attr('disabled', 'disabled');
    }
}

function AcceptTerms_Frount(dis) {
    if ($(dis).prop("checked")) {
        $('.disable_check').removeClass('disable_submit_btn');
    } else {
        $('.disable_check').addClass('disable_submit_btn');
    }
}

function ShowAnnouncement(ann_txt) {
    $('#annouce_txt').text(ann_txt);
    $('#announcement').addClass('animate_announcement_show');
    // setTimeout(function() {
    //     $('#announcement').removeClass('animate_announcement_show');
    // },8000);
}

// function HideAnnouncement() {
//     $('#announcement').removeClass('animate_announcement_show');
// }

/*function Gatcommenttxt(dis) {
 debugger;
 var comment_txt = $(dis).text();
 if (comment_txt.length > 0) {
 $(dis).parent().parent().find('.comment_postbtn').removeAttr('disabled', 'disabled');
 } else {
 $(dis).parent().parent().find('.comment_postbtn').attr('disabled', 'disabled');
 }
 }*/
/*-----------------End Update By Pinku 03_04_18-----------*/
(function (e) {
    e.fn.dsCountDown = function (t) {
        var n = this;
        n.data = {
            refreshed: 1e3,
            thread: null,
            running: false,
            left: 0,
            decreament: 1,
            interval: 0,
            seconds: 0,
            minutes: 0,
            hours: 0,
            days: 0,
            elemDays: null,
            elemHours: null,
            elemMinutes: null,
            elemSeconds: null
        };
        var r = {
            startDate: new Date,
            endDate: null,
            elemSelDays: "",
            elemSelHours: "",
            elemSelMinutes: "",
            elemSelSeconds: "",
            theme: "white",
            titleDays: "Days",
            titleHours: "Hours",
            titleMinutes: "Minutes",
            titleSeconds: "Seconds",
            onBevoreStart: null,
            onClocking: null,
            onFinish: null
        };
        n.options = e.extend({}, r, t);
        if (this.length > 1) {
            this.each(function () {
                e(this).dsCountDown(t)
            });
            return this
        }
        n.init = function () {
            if (!n.options.elemSelSeconds) {
                n.prepend('<div class="ds-element ds-element-seconds">							<div class="ds-element-title">' + n.options.titleSeconds + '</div>							<div class="ds-element-value ds-seconds">00</div>						</div>');
                n.data.elemSeconds = n.find(".ds-seconds")
            } else {
                n.data.elemSeconds = n.find(n.options.elemSelSeconds)
            }
            if (!n.options.elemSelMinutes) {
                n.prepend('<div class="ds-element ds-element-minutes">							<div class="ds-element-title">' + n.options.titleMinutes + '</div>							<div class="ds-element-value ds-minutes">00</div>						</div>');
                n.data.elemMinutes = n.find(".ds-minutes")
            } else {
                n.data.elemMinutes = n.find(n.options.elemSelMinutes)
            }
            if (!n.options.elemSelHours) {
                n.prepend('<div class="ds-element ds-element-hours">							<div class="ds-element-title">' + n.options.titleHours + '</div>							<div class="ds-element-value ds-hours">00</div>						</div>');
                n.data.elemHours = n.find(".ds-hours")
            } else {
                n.data.elemHours = n.find(n.options.elemSelHours)
            }
            if (!n.options.elemSelDays) {
                n.prepend('<div class="ds-element ds-element-days">							<div class="ds-element-title">' + n.options.titleDays + '</div>							<div class="ds-element-value ds-days">00</div>						</div>');
                n.data.elemDays = n.find(".ds-days")
            } else {
                n.data.elemDays = n.find(n.options.elemSelDays)
            }
            n.addClass("dsCountDown");
            n.addClass("ds-" + n.options.theme);
            if (n.options.startDate && n.options.endDate) {
                n.data.interval = n.options.endDate.getTime() - n.options.startDate.getTime();
                if (n.data.interval > 0) {
                    var e = n.data.interval / 1e3;
                    var t = e % 86400;
                    var r = t % 3600;
                    n.data.left = e;
                    n.data.days = Math.floor(e / 86400);
                    n.data.hours = Math.floor(t / 3600);
                    n.data.minutes = Math.floor(r / 60);
                    n.data.seconds = Math.floor(r % 60)
                }
            }
            n.start()
        };
        n.stop = function (e) {
            if (n.data.running) {
                clearInterval(n.data.thread);
                n.data.running = false
            }
            if (e) {
                e(n)
            }
        };
        n.start = function () {
            e("#logger").append("<br/>Start");
            if (!n.data.running) {
                e("#logger").append("<br/>Clock");
                if (n.data.left > 0) {
                    if (n.options.onBevoreStart) {
                        n.options.onBevoreStart(n)
                    }
                    n.data.thread = setInterval(function () {
                        if (n.data.left > 0) {
                            n.data.left -= n.data.decreament;
                            n.data.seconds -= n.data.decreament;
                            if (n.data.seconds <= 0 && (n.data.minutes > 0 || n.data.hours > 0 || n.data.days > 0)) {
                                n.data.minutes--;
                                n.data.seconds = 60
                            }
                            if (n.data.minutes <= 0 && (n.data.hours > 0 || n.data.days > 0)) {
                                n.data.hours--;
                                n.data.minutes = 60
                            }
                            if (n.data.hours <= 0 && n.data.days > 0) {
                                n.data.days--;
                                n.data.hours = 24
                            }
                            if (n.data.elemDays) n.data.elemDays.html(n.data.days < 10 ? "0" + n.data.days : n.data.days);
                            if (n.data.elemHours) n.data.elemHours.html(n.data.hours < 10 ? "0" + n.data.hours : n.data.hours);
                            if (n.data.elemMinutes) n.data.elemMinutes.html(n.data.minutes < 10 ? "0" + n.data.minutes : n.data.minutes);
                            if (n.data.elemSeconds) n.data.elemSeconds.html(n.data.seconds < 10 ? "0" + n.data.seconds : n.data.seconds);
                            if (n.options.onClocking) {
                                n.options.onClocking(n)
                            }
                        } else {
                            n.stop(n.options.onFinish)
                        }
                    }, n.data.refreshed);
                    n.data.running = true
                } else {
                    if (n.options.onFinish) {
                        n.options.onFinish(n)
                    }
                }
            }
        };
        n.init()
    }
})(jQuery)
// $("input").on({
//     keydown: function(e) {
//         if (e.which === 32)
//             return false;
//     },
//     change: function() {
//         this.value = this.value.replace(/\s/g, "");
//     }
// });