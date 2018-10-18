<?php $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20); ?>
@extends('layout.master.master')

@section('title', 'My Earning')

@section('head')
    <section class="notofication_containner">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12">
                    <div class="all_left_brics_container">
                    {{--<div class="left_common_block permanent_display_none">
                            <div class="basic_heading">
                                About
                            </div>
                            <div class="profile_name network_name">{{$timeline->name}}</div>
                            <div class="profile_follow"><i
                                        class="profile_icons mdi mdi-calendar"></i>{{ date_format(date_create($user->birthday), "d-M-Y")}}
                            </div>
                            <div class="profile_follow"><i class="profile_icons mdi mdi-phone"></i>{{isset($user->contact)?$user->contact:'-'}}</div>
                            <div class="profile_follow last_border_mar0"><i
                                        class="profile_icons mdi mdi-map-marker"></i>{{isset($user->address)?$user->address:'-'}}
                            </div>
                        </div>--}}
                    <div class="left_common_block">
                        <div class="icon_circle" style="background-color: #f8c301;">
                            <i class="mdi mdi-currency-inr"></i>
                        </div>
                        <div class="basic_heading">
                            My Earning
                            <div class="btn-group pull-right" href="#Modal_AccountDetails" data-toggle="modal">
                                <button type="button" class="btn btn-primary btn-sm res_btn"><span
                                            class="mdi mdi-currency-inr"></span></button>
                                <button type="button" class="btn btn-primary btn-sm res_btn">Redeem</button>
                            </div>
                        </div>
                        <div class="basic_count" style="color: #f8c301;">Rs {{$amnt}} /-</div>
                        <input type="hidden" id="my_earning_amt" value="{{$amnt}}"/>
                    </div>
                    <div class="left_common_block">
                        <div class="icon_circle" style="background-color: #ff4141;">
                            <i class="mdi mdi-currency-inr"></i>
                        </div>
                        <div class="basic_heading">
                            Advertise Earning {{--{{url('ads-earning')}}--}}
                            <a href="#" data-toggle="tooltip" data-placement="top" title="coming soon" class="btn btn-primary post_btn_photo">
                                <i class="basic_icons mdi mdi-view-module"></i>View All
                            </a>
                        </div>
                        <div class="basic_count" style="color: #f8c301;">0</div>
                    </div>
                    <div class="left_common_block">
                        <div class="icon_circle" style="background-color: #007cc2;">
                            <i class="mdi mdi-sitemap"></i>
                        </div>
                        <div class="basic_heading">
                            My Networks
                            <a href="{{url('my-network')}}" class="btn btn-primary post_btn_photo"><i
                                        class="basic_icons mdi mdi-view-module"></i>View All
                            </a>
                        </div>
                        <div class="basic_count" style="color: #007cc2;">{{$MembersCount}}</div>
                    </div>
                    <div class="left_common_block">
                        <div class="icon_circle" style="background-color: #07a20d;">
                            <i class="mdi mdi-chemical-weapon"></i>
                        </div>
                        <div class="basic_heading">
                            My Friends
                            <a href="{{url('member')}}" class="btn btn-primary post_btn_photo"><i
                                        class="basic_icons mdi mdi-view-module"></i>View All
                            </a>
                        </div>
                        <div class="basic_count" style="color: #07a20d;">{{$friend_count}}</div>
                    </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-9">
                    <div class="network_block">
                        <div class="net_imgblk">
                            <div class="net_img">
                                <img src="{{url('/'.$user->profile_pic)}}" class=""/>
                            </div>
                        </div>
                        <div class="net_arrow_blk">
                            <div class="arrow_blk">
                                <i class="mdi mdi-arrow-down-bold"></i>
                            </div>
                        </div>
                        <!-- <div class="net_long_line">
                         </div>-->
                        <div class="level_caption">Level 0</div>
                        <div class="net_internaldiv">
                            <div class="user_image_containner">

                            </div>
                            @if($user->member_type == 'free')
                                <div>
                                    <div class="no_pay_show">
                                        <div class="no_pay_txt">Please pay and earn money</div>
                                        <div class="referal_container" id="referal_box">
                                            <div class="row">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <div class="Lb-title-txt">Referral Code :</div>
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <input type="text" onkeyup="CheckReferral(this);"
                                                               id="referral_txt"
                                                               name="title" class="form-control required"
                                                               placeholder="Enter Referal Code"
                                                               data-validate="Btn_referal"
                                                               maxlength="50" autocomplete="off"/>
                                                        <span id="error_referal"
                                                              class="show_error">Invalid Referral code</span>
                                                    </div>
                                                </div>
                                                <div class="refral_profilebox">
                                                    <div class="referal_layer">
                                                        <img src="{{url('images/loading.gif')}}" id="load_img"/>
                                                    </div>
                                                    <div class="referal_imgbox">
                                                        <img src="{{url('images/Male_default.png')}}"
                                                             id="referral_img"/>
                                                    </div>
                                                    <div class="referal_details">
                                                        <table class="table table-bordered white_bgcolor">
                                                            <tbody>
                                                            <tr>
                                                                <td class="width_35 title-more">Name :</td>
                                                                <td class="width_65" id="referral_name">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="width_35 title-more">Contact No. :</td>
                                                                <td class="width_65" id="referral_contact">-</td>
                                                            </tr>
                                                            <tr>
                                                                <td class="width_35 title-more">City :</td>
                                                                <td class="width_65" id="referral_city">-</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <!-- ###################################33 -->
                                            <form class="pay_form display_none" target="_blank"
                                                  action="{{url('make-payment/2')}}"
                                                  method="post" name="payuForm">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="hidden" name="key" value="mqqqWtY9"/>
                                                <input type="hidden" name="hash" value="<?php if (!empty($hash)) {
                                                    echo $hash;
                                                }; ?>"/>

                                                <input type="hidden" name="txnid" value="<?php if (!empty($txnid)) {
                                                    echo $txnid;
                                                }; ?>"/>
                                                <table>

                                                    <tr>
                                                        <td><input type="hidden" name="amount" value="1.00"/></td>
                                                        <td>
                                                            <input type="hidden" name="firstname"
                                                                   value="<?php echo $_SESSION['user_timeline']['name'];?>">

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><input type="hidden" name="email" id="email"
                                                                   value="<?php echo $_SESSION['user_master']['email'];?>"/>
                                                        </td>
                                                        <td><input type="hidden" name="phone"
                                                                   value="<?php echo $_SESSION['user_master']['contact'];?>"/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3"><input type="hidden" name="productinfo"
                                                                               value="Registration fees"/></td>
                                                    </tr>
                                                    <tr>

                                                        <td colspan="3"><input type="hidden" name="surl"
                                                                               value="{{url('success')}}"/></td>
                                                    </tr>
                                                    <tr>

                                                        <td colspan="3"><input type="hidden" name="furl"
                                                                               value="{{url('payu-failed')}}"/></td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="3"><input type="hidden" name="service_provider"
                                                                               value="payu_paisa"/></td>
                                                    </tr>

                                                </table>

                                                <!-- ################################### -->
                                                <button type="submit" onclick="globalloadershow();"
                                                        class="more_btn btn btn-warning"><i
                                                            class="mdi mdi-currency-inr"></i>Pay without Referral
                                                </button>
                                            </form>

                                            <button type="submit" data-target="#Modal_payoptionlist" data-toggle="modal"
                                                    class="more_btn btn btn-warning"><i
                                                        class="mdi mdi-currency-inr"></i>Pay
                                                without Referral
                                            </button>
                                            <button id="refferal_blockshow" type="submit" onclick="ShowReferralBox();"
                                                    class="more_btn btn btn-warning"><i
                                                        class="mdi mdi-currency-inr"></i>Pay
                                                with Referral
                                            </button>
                                            <button type="submit" id="pay_afterreferal"
                                                    data-target="#Modal_payoptionlist"
                                                    data-toggle="modal" class="more_btn btn btn-success"
                                                    style="display: none"><i class="mdi mdi-currency-inr"></i>Pay Now
                                            </button>
                                            <form class="pay_form display_none" action>
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                                <button type="submit" id="pay_afterreferal_2"
                                                        onclick="globalloadershow();"
                                                        class="more_btn btn btn-success" style="display: none"><i
                                                            class="mdi mdi-currency-inr"></i>Pay Now
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="text-center" style="display: none;">
                            <div class="more_btn btn btn-warning btn_sm"><i
                                        class="basic_icon mdi mdi-arrow-right-bold"></i>
                                See More
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" id="hdn_id" value="0"/>
            </div>
        </div>
    </section>
    <div id="myModal_TermsAccepted" class="connect_LBbox modal fade in" role="dialog" aria-hidden="false">
        <div class="modal-dialog Payment_lb">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onclick="GloCloseModel();">x</button>
                    <h4 class="modal-title">Terms & Conditions</h4>
                </div>
                <div class="modal-body">
                    <div class="terms_modelblock">
                        <p>1. Membership to be given to the authenticated person who is having Mo No., Bank Account. Valid E-Mail Id. And PAN / Adhar card.</p>
                        <p>2. As a Member, Person have the role and responsibility to maintain the decorum of the membership, and should not violate any rules and regulation, and Privacy of the company.
                        </p>
                        <p>3. If any member found guilty of violation of policy ,their membership will be terminated without notice.</p>
                        <p>4. Member will get reward point after completing online surveys/advertisement promo scheme decided as per policy of connecting one which keep changes from time to time with notification to member.</p>
                        <p>5. Member can upload there paid advertisement at our platform and get benefited of 50% of the advertisement directly after settlement of bills.</p>
                        <p>6. Member can redeem their credit points/ Money at any moment of time( Min amount – Rs. 10/-)</p>
                        <p>7. At the time of redemption 10% of the total income will be deducted as service charges.</p>
                        <p>8. Membership fee is non refundable.</p>
                        <p>9. Max Capping of level is Level-250,</p>
                        <p>10. By visiting this Portal, you agree that the laws of the Republic of India (state of Madhya Pradesh, City Jabalpur)  without regard to its conflict of laws principles, govern this Privacy Policy and any dispute arising in respect hereof shall be subject to and governed by the dispute resolution process set out in the Terms and Conditions. You and Connecting-One.com agree to submit to the personal and exclusive jurisdiction of the court located within Jabalpur, Madhya Pradesh.</p>
                        <p>11. You are not allowed to share your account with any other individual.</p>
                        <p>12. Payment/Redemption settlement will be carried out in 7 working dates. </p>
                        <p>13. Your membership will terminate immediately in the unfortunate event of your death. Service accounts are not transferable upon death or otherwise by operation of law.</p>
                        <div class="terms_imgbox">
                            <img src="{{url('images/level.png')}}"/>
                        </div>
                        <div class="terms_checkbox">
                            <div class="checkbox glo_checkbox_mainbox" style="text-align: left;">
                                <label>
                                    <input class="glo_checkbox" id="accepted_check" type="checkbox"
                                           onchange="AcceptTerms(this);"/>
                                    <span class="cr"><i class="cr-icon mdi mdi-check"></i></span>
                                    <span class="checkbox_txt"> Accepts Terms & Conditions</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                {{-- <button type="button" class="btn btn-primary" id="terms_btn" data-dismiss="modal" disabled="disabled">Accepted</button>--}}
                <!-- ################PayuformBlock###################33 -->
                    {{--<form action="{{url('PayUkit/')}}" method="post" name="payuForm" id="payu_form_btnblock">--}}
                    <form method="post" name="atom" target="_blank" id="atom_form_btnblock"
                          action="{{url('Atompay/sample.php')}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="key" value="mqqqWtY9"/>
                        <input type="hidden" name="hash" value="<?php if (!empty($hash)) {
                            echo $hash;
                        }; ?>"/>
                        <input type="hidden" name="rfrl_box" id="rfrl_box" value="0"/>
                        <input type="hidden" name="rfrl_ptymbox" id="rfrl_ptymbox" value="0"/>
                        <input type="hidden" name="page_id" id="page_id" value="3"/>
                        <input type="hidden" name="txnid" value="<?php if (!empty($txnid)) {
                            echo $txnid;
                        }; ?>"/>
                        <table>

                            <tr>
                                <td><input type="hidden" name="amount" value="1.00"/></td>
                                <td>
                                    <input type="hidden" name="firstname"
                                           value="<?php echo $_SESSION['user_timeline']['name'];?>">

                                </td>
                            </tr>
                            <tr>
                                <td><input type="hidden" name="email" id="email"
                                           value="<?php echo $_SESSION['user_master']['email'];?>"/></td>
                                <td><input type="hidden" name="phone"
                                           value="<?php echo $_SESSION['user_master']['contact'];?>"/></td>
                            </tr>
                            <tr>
                                <td colspan="3"><input type="hidden" name="productinfo" value="Registration fees"/></td>
                            </tr>
                            <tr>

                                <td colspan="3"><input type="hidden" name="surl"
                                                       value="https://www.connecting-one.com/PayUkit/response.php"/>
                                </td>
                            </tr>
                            <tr>

                                <td colspan="3"><input type="hidden" name="furl"
                                                       value="https://www.connecting-one.com/PayUkit/response.php"/>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa"/></td>
                            </tr>

                        </table>

                        <!-- ###################################33 -->
                        {{--  <button type="submit" class="btn btn-warning" id="terms_btn">Accepted<i class="mdi mdi-arrow-right"></i></button>--}}
                        <button type="submit" class="btn btn-primary btn_terms" id="terms_btn"
                                onclick="refresh_page()"  disabled="disabled">Accepted
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="GloCloseModel();">
                            Close
                        </button>
                    </form>

                    <form method="post" name="payumoney" target="_blank" id="payu_form_btnblock"
                          action="{{url('PayUkit/index.php')}}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="key" value="mqqqWtY9"/>
                        <input type="hidden" name="hash" value="<?php if (!empty($hash)) {
                            echo $hash;
                        }; ?>"/>
                        <input type="hidden" name="rfrl_box" id="rfrl_box" value="0"/>
                        <input type="hidden" name="rfrl_ptymbox" id="rfrl_ptymbox" value="0"/>
                        <input type="hidden" name="page_id" id="page_id" value="3"/>
                        <input type="hidden" name="txnid" value="<?php if (!empty($txnid)) {
                            echo $txnid;
                        }; ?>"/>
                        <table>

                            <tr>
                                <td><input type="hidden" name="amount" value="1.00"/></td>
                                <td>
                                    <input type="hidden" name="firstname"
                                           value="<?php echo $_SESSION['user_timeline']['name'];?>">

                                </td>
                            </tr>
                            <tr>
                                <td><input type="hidden" name="email" id="email"
                                           value="<?php echo $_SESSION['user_master']['email'];?>"/></td>
                                <td><input type="hidden" name="phone"
                                           value="<?php echo $_SESSION['user_master']['contact'];?>"/></td>
                            </tr>
                            <tr>
                                <td colspan="3"><input type="hidden" name="productinfo" value="Registration fees"/></td>
                            </tr>
                            <tr>

                                <td colspan="3"><input type="hidden" name="surl"
                                                       value="https://www.connecting-one.com/PayUkit/response.php"/>
                                </td>
                            </tr>
                            <tr>

                                <td colspan="3"><input type="hidden" name="furl"
                                                       value="https://www.connecting-one.com/PayUkit/response.php"/>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa"/></td>
                            </tr>

                        </table>

                        <!-- ###################################33 -->
                        {{--  <button type="submit" class="btn btn-warning" id="terms_btn">Accepted<i class="mdi mdi-arrow-right"></i></button>--}}
                        <button type="submit" class="btn btn-primary btn_terms" id="terms_btn" onclick="refresh_page()"
                                disabled="disabled">Accepted
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="GloCloseModel();">
                            Close
                        </button>
                    </form>
                    <!-- ################PaytmFormBlock###################33 -->
                    {{--<form method="post"  name="paytm" action="{{url('PaytmKit/TxnTest.php')}}" id="paytm_form_btnblock" style="display: none;">--}}
                    <?php $paytm = \App\PaytmLink::find(1); ?>
                    <form method="get" name="paytm" target="_blank" action="{{$paytm->link}}"
                          id="paytm_form_btnblock"
                          style="display: none;">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="rfrl_ptymbox" id="rfrl_ptymbox" value="0"/>
                        <input type="hidden" name="page_id" id="page_id" value="2"/>
                        <!-- ###################################33 -->
                        {{--  <button type="submit" class="btn btn-warning" id="terms_btn">Accepted<i class="mdi mdi-arrow-right"></i></button>--}}
                        <button type="submit" class="btn btn-primary btn_terms" onclick="Payment_clickbtn();"
                                disabled="disabled">Accepted
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="GloCloseModel();">
                            Close
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade-scale" id="Modal_payoptionlist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog likelist_model" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Choose Payment Options</h4>
                </div>
                <div class="modal-body bg_profile_color">
                    <div class="option_container">
                        <div class="col-xs-4">
                            <div class="payment_optionbox" onclick="Selected_option(this);">
                                <img src="{{url('images/payu_logo.png')}}" alt="payu_logo"/>
                                <input type="hidden" value="payumoney" class="selected_option_name"/>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="payment_optionbox" onclick="Selected_option(this);">
                                <img src="{{url('images/atom_logo.png')}}" alt="payu_logo"/>
                                <input type="hidden" value="atom" class="selected_option_name"/>
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <div class="payment_optionbox" onclick="Selected_option(this);">
                                <img src="{{url('images/paytm_logo.png')}}" alt="paytm_logo"/>
                                <input type="hidden" value="paytm" class="selected_option_name"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" disabled="disabled" id="btn_payoption"
                            data-dismiss="modal" onclick="Submit_PayOption();" data-toggle="modal"
                            data-target="#myModal_TermsAccepted">Submit
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function Payment_clickbtn() {
            // globalloadershow();
            var rc = $('#referral_txt').val();
            if (rc.trim() != '') {
                $.ajax({
                    type: "GET",
                    contentType: "application/json; charset=utf-8",
                    url: "{{ url('saverc') }}",
                    data: {rc: rc},
                    success: function (d) {
                        setTimeout(function () {
                            window.location.href = "{{url('dashboard')}}";
                        }, 2000);
//                        alert('success');
                    },
                    error: function (xhr, status, error) {
//                        alert('fail');
                    }
                });
            }
        }
        
        function refresh_page() {
            setTimeout(function () {
                window.location.href = "{{url('dashboard')}}";
            }, 2000);
        }


        function CheckReferral(dis) {
            var totallength = $(dis).val().length;
            if (totallength >= 6) {
                var curr_val = $(dis).val();
                $('#load_img').show();


                ///////////////////////////////
                var a = $(dis).val();
                if (a == '') {
                    return false;
                }

                $.ajax({
                    type: "POST",
                    contentType: "application/json; charset=utf-8",
                    url: "{{ url('vRC') }}",
                    data: '{"a":"' + a + '"}',
                    success: function (d) {
                        $('.pyb').prop('disabled', true);
                        $('.pyb').attr('type', 'button');
                        $('#referral_img').attr('src', d.p);
                        $('#referral_name').text('');
                        $('#referral_contact').text('');
                        $('#referral_img').attr('src', '{{url('images/Male_default.png')}}');
                        $('#referral_city').text('');
                        $('#error_referal').text('');
                        if (d.t) {

                            $('.pyb').prop('disabled', false);
                            $('.pyb').attr('type', 'submit');
                            $('#referral_img').attr('src', d.p);
                            $('#referral_name').text(d.f + ' ' + d.l);
                            $('#referral_contact').text(d.m);
                            $('#referral_city').text(d.c);
                            $('.referal_layer').hide();
                            $('#refferal_blockshow').hide();
                            $('#pay_afterreferal').show();
                        }

                    },
                    error: function (xhr, status, error) {
                    }
                });
                ///////////////////////////////
            } else {
                $('#referral_img').attr("src", "{{url('images/Male_default.png')}}");
                //$('#referral_img').src('');
                $('#referral_name').text('-');
                $('#referral_contact').text('-');
                $('#referral_city').text('-');
                $('#load_img').hide();
                $('.referal_layer').show();
                $('#pay_afterreferal').hide();
                $('#refferal_blockshow').show();
            }
        }

        function ShowReferralBox() {
            $('#referal_box').slideToggle();
        }

        $('body').on('click', '#pay_afterreferal', function () {
            $('#rfrl_box').val($('#referral_txt').val());
            $('#rfrl_ptymbox').val($('#referral_txt').val());
        });
        $(document).ready(function () {
            //$(".emoji_div").emojioneArea();
            /* $(".comment_emoji_div").emojioneArea({
             pickerPosition: "bottom",
             tonesStyle: "radio"
             });
             $(".emoji_div").emojioneArea({
             pickerPosition: "bottom",
             tonesStyle: "radio"
             });*/
            function xn() {
                var a = $('#hdn_id').val();
                appendnorecord = '<span class="list_no_record">&lt; No Record Available &gt;</span>';
                $.ajax({
                    type: "POST",
                    contentType: "application/json; charset=utf-8",
                    url: "{{ url('ge') }}",
                    data: '{"a":"' + a + '"}',
                    success: function (data) {
                        if (data.t != '') {
                            $('.user_image_containner').append(data.t);
                            $('#hdn_id').val(data.id);
                        } else {
                            $('.user_image_containner').html(appendnorecord);
                        }
                    },
                    error: function (xhr, status, error) {
//						alert(xhr.responseText);
                        $('.user_image_containner').html(xhr.responseText);

                    }
                });
            }

            xn();
            $('body').on('click', '.btn_sm', function () {
                xn();
            });
            function Requiredtxt(me) {
                var text = $.trim($(me).val());
                if (text == '') {
                    $(me).addClass("errorClass");
                    return false;
                } else {
                    $(me).removeClass("errorClass");
                    return true;
                }
            }

//            $(function () {
//                $('form#rejfrm').submit(function () {
//                    /* var c = confirm("Are you sure to continue?");
//                     return c;*/
//                    var reason_data = $('#master_reasontxt').val();
//                    var result = true;
//                    if (!Boolean(Requiredtxt("#master_reasontxt"))) {
//                        result = false;
//                    }
//                    if (!result) {
//                        return false;
//                    }
//                });
//            });
            /////////////////
            $('body').on('click', '#Btn_AccountDetails', function () {
                var ahName = $('#acc_lbtxt_name').val();
                var ah_no = $('#acc_lbtxt_no').val();
                var ah_bnk = $('#acc_lbtxt_bank').val();
                var ah_ifs = $('#acc_lbtxt_ifs').val();
                var ah_amt = $('#acc_lbtxt_amt').val();
                var ah_adhr = $('#acc_lbtxt_adhr').val();
                var is_f = $('#Checkboxfuturesave').is(":checked");
                var f_s = 0;
                if (is_f)
                    f_s = 1;
                var result = true;
                if (!Boolean(Requiredtxt("#acc_lbtxt_name")) || !Boolean(Requiredtxt("#acc_lbtxt_no")) || !Boolean(Requiredtxt("#acc_lbtxt_bank")) || !Boolean(Requiredtxt("#acc_lbtxt_ifs")) || !Boolean(Requiredtxt("#acc_lbtxt_amt")) || !Boolean(Requiredtxt("#acc_lbtxt_adhr"))) {
                    result = false;
                }
                if (!result) {
                    return false;
                } else {
                    $.ajax({
                        type: "POST",
                        contentType: "application/json; charset=utf-8",
                        url: "{{ url('rdm') }}",
                        beforeSend: function () {
                            ShowOnpageLoopader();
                        },
                        data: '{"a":"' + ahName + '","b":"' + ah_no + '","c":"' + ah_bnk + '","d":"' + ah_ifs + '","e":"' + ah_amt + '","f":"' + ah_adhr + '","g":"' + f_s + '"}',
                        success: function (data) {
                            if (data.s == 1) {
                                //$('.err_aex').text(data.t);
                                getUA();
                                $('#Modal_AccountDetails').modal('hide');
                                HideOnpageLoopader();
                            }
                        },
                        error: function (xhr, status, error) {
//						alert(xhr.responseText);
                            HideOnpageLoopader();
                            $('.user_image_containner').html(xhr.responseText);

                        }
                    });
                }

            });
            ////////////
            function getUA() {
                ///////////
                $.ajax({
                    type: "POST",
                    contentType: "application/json; charset=utf-8",
                    url: "{{ url('guad') }}",
                    data: '{"a":"0"}',

                    success: function (data) {
                        $('#acc_lbtxt_name').val('');
                        $('#acc_lbtxt_no').val('');
                        $('#acc_lbtxt_bank').val('');
                        $('#acc_lbtxt_ifs').val('');
                        $('#acc_lbtxt_amt').val('');
                        $('#acc_lbtxt_adhr').val('');
                        $('#Checkboxfuturesave').prop("checked", false);
                        $('.acc_qa').html(data);
                    },
                    error: function (xhr, status, error) {
//						alert(xhr.responseText);
                        $('.user_image_containner').html(xhr.responseText);

                    }
                });
                ///////////
            }

            getUA();
            //////////////
            function gpys() {
                //no_pay_show
                var a = 0;
                $.ajax({
                    type: "POST",
                    contentType: "application/json; charset=utf-8",
                    url: "{{ url('gpys') }}",
                    data: '{"a":"' + a + '"}',
                    success: function (data) {
                        $('.no_pay_show').addClass('dn');
                        if (data == '0') {
                            $('.no_pay_show').addClass('db');
                            $('.no_pay_show').removeClass('dn');
                        }
                        else {
                            $('.no_pay_show').addClass('dn');
                            $('.no_pay_show').removeClass('db');
                        }
                    },
                    error: function (xhr, status, error) {
                        //alert(xhr.responseText);
//                       
                    }
                });
            }

            gpys();
            //////////////
        });
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })

    </script>
@stop