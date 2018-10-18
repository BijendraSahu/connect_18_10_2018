<?php $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20); ?>
@extends('layout.master.master')

@section('title', 'My Network')

@section('head')
    <section class="member_profileblk">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="basic_thumb res_network networkfirst_top">
                        <div class="icon_circle" style="background-color: #f8c301; ">
                            <i class="mdi mdi-sitemap"></i>
                        </div>
                        <div class="basic_heading">
                            My Networks
                            <button class="btn btn-primary post_btn_photo" data-toggle="modal" data-target="#Mymodal_AddNewMamber" ><i class="basic_icons mdi mdi-plus"></i>Add New
                            </button>
                        </div>
                        <div class="basic_count" style="color: #f8c301;">{{$MembersCount}} </div>
                    </div>
                    <div class="basic_thumb res_about" style="margin-top: 0px;">
                        <div class="basic_heading">
                            About
                        </div>
                        <div class="profile_name network_name">{{$timeline->name}}</div>
                        <div class="profile_follow"><i class="profile_icons mdi mdi-calendar"></i>{{ date_format(date_create($user->birthday), "d-M-Y")}}</div>
                        <div class="profile_follow"><i class="profile_icons mdi mdi-phone"></i>{{$user->contact}}</div>
                        <div class="profile_follow" style="margin-bottom: 0px;border: none;"><i class="profile_icons mdi mdi-map-marker"></i>Gohalpur New basti No.1 Amkhera Road</div>
                    </div>
                    <div class="basic_thumb res_earning" style="">
                        <div class="icon_circle" style="background-color: #007cc2;">
                            <i class="mdi mdi-currency-inr"></i>
                        </div>
                        <div class="basic_heading">
                            My Earning
                            <a href="{{url('my-earning')}}" class="btn btn-primary post_btn_photo"><i class="basic_icons mdi mdi-view-module"></i>View All
                            </a>
                        </div>
                        <div class="basic_count" style="color: #007cc2;">Rs {{$amnt}} /-</div>
                    </div>
                    <div class="basic_thumb">
                        <div class="icon_circle" style="background-color: #07a20d;">
                            <i class="mdi mdi-chemical-weapon"></i>
                        </div>
                        <div class="basic_heading">
                            My Friends
                            <a href="{{url('member')}}" class="btn btn-primary post_btn_photo"><i class="basic_icons mdi mdi-view-module"></i>View All
                            </a>
                        </div>
                        <div class="basic_count" style="color: #07a20d;">0</div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-9">
                    <div class="network_block">
                        <div class="net_imgblk">
                            <div class="net_img">
                                <img src="{{url('/'.$user->profile_pic)}}" class="" />
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
                                <div class="no_pay_show">
                                    <div class="no_pay_txt">Please pay and earn money </div>
                                    <div class="referal_container" id="referal_box">
                                        <div class="row">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <div class="Lb-title-txt">Referral Code :</div>
                                                </div>
                                                <div class="col-sm-9">
                                                    <input type="text" onkeyup="CheckReferral(this);" id="referral_txt"  name="title" class="form-control required" placeholder="Enter Referal Code" data-validate="Btn_referal" maxlength="50" autocomplete="off" />
                                                    <span id="error_referal" class="show_error">Invalid Referral code</span>
                                                </div>
                                            </div>
                                            <div class="refral_profilebox">
                                                <div class="referal_layer">
                                                    <img src="{{url('images/loading.gif')}}" id="load_img" />
                                                </div>
                                                <div class="referal_imgbox">
                                                    <img src="{{url('images/Male_default.png')}}" id="referral_img" />
                                                </div>
                                                <div class="referal_details">
                                                    <table class="table table-bordered white_bgcolor">
                                                        <tbody><tr>
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
                                                        </tbody></table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <!-- ###################################33 -->
                                        <form class="pay_form display_none" action="{{url('make-payment/2')}}" method="post" name="payuForm">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="key" value="mqqqWtY9" />
                                            <input type="hidden" name="hash" value="<?php if(!empty($hash)){ echo $hash; }; ?>"/>

                                            <input type="hidden" name="txnid" value="<?php if(!empty($txnid)){ echo $txnid; }; ?>" />
                                            <table>

                                                <tr>
                                                    <td><input type="hidden"  name="amount" value="1.00" /></td>
                                                    <td>
                                                        <input  type="hidden" name="firstname" value="<?php echo $_SESSION['user_timeline']['name'];?>">

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><input type="hidden" name="email" id="email" value="<?php echo $_SESSION['user_master']['email'];?>" /></td>
                                                    <td><input type="hidden" name="phone" value="<?php echo $_SESSION['user_master']['contact'];?>" /></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"><input type="hidden" name="productinfo" value="Registration fees" /></td>
                                                </tr>
                                                <tr>

                                                    <td colspan="3"><input type="hidden" name="surl" value="{{url('success')}}"  /></td>
                                                </tr>
                                                <tr>

                                                    <td colspan="3"><input type="hidden" name="furl" value="{{url('payu-failed')}}"  /></td>
                                                </tr>

                                                <tr>
                                                    <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" /></td>
                                                </tr>

                                            </table>

                                            <!-- ################################### -->
                                            <button type="submit" onclick="globalloadershow();" class="more_btn btn btn-warning"><i class="mdi mdi-currency-inr"></i>Pay without Referral</button>
                                        </form>
                                        <button type="submit" data-target="#Modal_payoptionlist" data-toggle="modal" class="more_btn btn btn-warning"><i class="mdi mdi-currency-inr"></i>Pay without Referral</button>
                                        <button id="refferal_blockshow" type="submit" onclick="ShowReferralBox();" class="more_btn btn btn-warning"><i class="mdi mdi-currency-inr"></i>Pay with Referral </button>
                                        <button type="submit" id="pay_afterreferal" data-target="#Modal_payoptionlist" data-toggle="modal" class="more_btn btn btn-success" style="display: none"><i class="mdi mdi-currency-inr"></i>Pay Now</button>
                                        <form class="pay_form display_none" action>
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                           
                                            <button type="submit" id="pay_afterreferal_2" onclick="globalloadershow();" class="more_btn btn btn-success" style="display: none"><i class="mdi mdi-currency-inr"></i>Pay Now</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center" style="display: none;">
                            <div class="more_btn btn btn-warning btn_sm"><i class="basic_icon mdi mdi-arrow-right-bold"></i>
                                See More</div> </div>
                    </div>
                </div>
				<input type="hidden" id="hdn_id" value="0" />
            </div>
        </div>
    </section>
<div class="modal fade-scale" id="Mymodal_AddNewMamber" data-easein="bounceIn" class="connect_LBbox modal fade in" role="dialog"  aria-hidden="false">
        <div class="modal-dialog LBAdd_newmember" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">REQUEST NEW MEMBERS</h4>
                </div>
                <div class="modal-body">
                    <div class="col-sm-12 col-md-6 pull-right">
                        <div class="Lb_searchbox">
                            <input type="text" class="header_search" placeholder="Search" />
                            <i class="search_icon mdi mdi-magnify"></i>
                        </div>
                    </div>
                    <div class="basicLb_containner style-scroll">
                        <div class="lb_heading">Non Paid Referal</div>
                        <div class="lb_internalmemberbox">
                            <div class="col-sm-3  col-xs-6">
                                <div class="network_user_block">
                                    <div class="connected_imgbox current_hover_img"><img src="images/Frount_userpic1.jpeg"></div>
                                    <div class="connected_name">Rohit Mishra</div>
                                    <div class="Request_btn">Connect</div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <div class="network_user_block">
                                    <div class="connected_imgbox current_hover_img"><img src="images/Frount_userpic2.jpeg"></div>
                                    <div class="connected_name">Sunil Saxena</div>
                                    <div class="Request_btn">Connect</div>
                                </div>
                            </div>
                            <div class="col-sm-3  col-xs-6">
                                <div class="network_user_block">
                                    <div class="connected_imgbox current_hover_img"><img src="images/Frount_userpic3.jpeg"></div>
                                    <div class="connected_name">Amit Tiwari</div>
                                    <div class="Request_btn">Connect</div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <div class="network_user_block">
                                    <div class="connected_imgbox current_hover_img"><img src="images/Frount_userpic4.jpeg"></div>
                                    <div class="connected_name">Sunny Bhatia</div>
                                    <div class="Request_btn">Connect</div>
                                </div>
                            </div>
                        </div>
                        <div class="lb_heading">Rendom Members</div>
                        <div class="lb_internalmemberbox">
                            <div class="col-sm-3  col-xs-6">
                                <div class="network_user_block">
                                    <div class="connected_imgbox current_hover_img"><img src="images/Frount_userpic1.jpeg"></div>
                                    <div class="connected_name">Rohit Mishra</div>
                                    <div class="Request_btn">Connect</div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <div class="network_user_block">
                                    <div class="connected_imgbox current_hover_img"><img src="images/Frount_userpic2.jpeg"></div>
                                    <div class="connected_name">Sunil Saxena</div>
                                    <div class="Request_btn">Connect</div>
                                </div>
                            </div>
                            <div class="col-sm-3  col-xs-6">
                                <div class="network_user_block">
                                    <div class="connected_imgbox current_hover_img"><img src="images/Frount_userpic3.jpeg"></div>
                                    <div class="connected_name">Amit Tiwari</div>
                                    <div class="Request_btn">Connect</div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-xs-6">
                                <div class="network_user_block">
                                    <div class="connected_imgbox current_hover_img"><img src="images/Frount_userpic4.jpeg"></div>
                                    <div class="connected_name">Sunny Bhatia</div>
                                    <div class="Request_btn">Connect</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
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
                    <p>1.	Membership to be given to the authenticated person who is having Mo No., Bank Account. Valid Mail Id. And PAN / Adhar card</p>
                    <p>2.	Age bar for the  membership above 18+</p>
                    <p>3.	As a Member, Person have the role and responsibility to maintain the decorum of the membership, and should not violate any rules and regulation, and Privacy of the company.</p>
                    <p>4.	If any member if found guilty/culprit/ or done wrong, its membership will be cancelled.</p>
                    <p>5.	Member get rewards points for their review on the advertisement   (posted by the company and users ) and surveys. Rewards points will be decided by the company management time to time.</p>
                    <p>6.	Member can upload there paid advertisement at our platform and get benefited of 50% of the advertisement directly after settlement of bills.</p>
                    <p>7.	Member can redeem their credit points/ Money at any moment of time.</p>
                    <p>8.	Membership fee is non refundable.</p>
                    <p>9.	Max Capping of level is  Level-250,</p>
                    <p>10.	At the time of redemption 10% of the total income will be deducted as miscellaneous charges.</p>
                    <p>11.	By visiting this Portal, you agree that the laws of the Republic of India (state of Madhya Pradesh, City Jabalpur)  without regard to its conflict of laws principles, govern this Privacy Policy and any dispute arising in respect hereof shall be subject to and governed by the dispute resolution process set out in the Terms and Conditions. You and Connecting-One.com agree to submit to the personal and exclusive jurisdiction of the court located within Jabalpur, Madhya Pradesh</p>
                    <p>12.	You are not allowed to share your account with any other individual. Nor are you allowed to transfer accounts to someone else. </p>
                    <p>13.	Payment/Redemption settlement will be carried out in 7 working dates.</p>
                    <p>14.	Your membership will terminate immediately in the unfortunate event of your death. Service accounts are not transferable upon death or otherwise by operation of law.</p>
                    <div class="terms_imgbox">
                        <img src="{{url('images/Lavel_img.jpg')}}" />
                    </div>
                    <div class="terms_checkbox">
                        <div class="checkbox glo_checkbox_mainbox" style="text-align: left;">
                            <label>
                                <input class="glo_checkbox" id="accepted_check" type="checkbox" onchange="AcceptTerms(this);" />
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
                    <form action="{{url('PayUkit/')}}" method="post" name="payuForm" id="payu_form_btnblock">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="key" value="mqqqWtY9" />
                        <input type="hidden" name="hash" value="<?php if(!empty($hash)){ echo $hash; }; ?>"/>
						<input type="hidden" name="rfrl_box" id="rfrl_box" value="" />
                       <input type="hidden" name="page_id" id="page_id" value="3" />
                        <input type="hidden" name="txnid" value="<?php if(!empty($txnid)){ echo $txnid; }; ?>" />
                        <table>

                            <tr>
                                <td><input type="hidden"  name="amount" value="1.00" /></td>
                                <td>
                                    <input  type="hidden" name="firstname" value="<?php echo $_SESSION['user_timeline']['name'];?>">

                                </td>
                            </tr>
                            <tr>
                                <td><input type="hidden" name="email" id="email" value="<?php echo $_SESSION['user_master']['email'];?>" /></td>
                                <td><input type="hidden" name="phone" value="<?php echo $_SESSION['user_master']['contact'];?>" /></td>
                            </tr>
                            <tr>
                                <td colspan="3"><input type="hidden" name="productinfo" value="Registration fees" /></td>
                            </tr>
                            <tr>

                                <td colspan="3"><input type="hidden" name="surl" value="http://www.connecting-one.com/PayUkit/response.php"  /></td>
                            </tr>
                            <tr>

                                <td colspan="3"><input type="hidden" name="furl" value="http://www.connecting-one.com/PayUkit/response.php"  /></td>
                            </tr>

                            <tr>
                                <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" /></td>
                            </tr>

                        </table>

                        <!-- ###################################33 -->
                        {{--  <button type="submit" class="btn btn-warning" id="terms_btn">Accepted<i class="mdi mdi-arrow-right"></i></button>--}}
                        <button type="submit" class="btn btn-primary btn_terms" id="terms_btn" onclick="Payment_clickbtn();" disabled="disabled">Accepted</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="GloCloseModel();">Close</button>
                    </form>
                    <!-- ################PaytmFormBlock###################33 -->
                    <form method="post"  name="paytm" action="{{url('PaytmKit/TxnTest.php')}}" id="paytm_form_btnblock" style="display: none;">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="rfrl_ptymbox" id="rfrl_ptymbox" value="0" />
                        <input type="hidden" name="page_id" id="page_id" value="3" />
                        <!-- ###################################33 -->
                        {{--  <button type="submit" class="btn btn-warning" id="terms_btn">Accepted<i class="mdi mdi-arrow-right"></i></button>--}}
                        <button type="submit" class="btn btn-primary btn_terms" onclick="Payment_clickbtn();" disabled="disabled">Accepted</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="GloCloseModel();">Close</button>
                    </form>
                </div>
        </div>
    </div>
</div>
<div class="modal fade-scale" id="Modal_payoptionlist" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog likelist_model" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Choose Payment Options</h4>
            </div>
            <div class="modal-body bg_profile_color">
                <div class="option_container">
                    <div class="col-xs-6">
                        <div class="payment_optionbox" onclick="Selected_option(this);">
                            <img src="{{url('images/payu_logo.png')}}" alt="payu_logo"/>
                            <input type="hidden" value="payumoney" class="selected_option_name" />
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="payment_optionbox" onclick="Selected_option(this);">
                            <img src="{{url('images/paytm_logo.png')}}" alt="paytm_logo" />
                            <input type="hidden" value="paytm" class="selected_option_name" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" disabled="disabled" id="btn_payoption" data-dismiss="modal" onclick="Submit_PayOption();" data-toggle="modal"  data-target="#myModal_TermsAccepted">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    <script type="text/javascript">
        function CheckReferral(dis) {
            var totallength=$(dis).val().length;
            if(totallength>=6)
            {
                var curr_val=$(dis).val();
                $('#load_img').show();
                $('#referral_img').attr("src","http://www.connecting-one.com/images/ConnectingOneAdmin.jpg");
                $('#referral_name').text('Pinku Kesharwani');
                $('#referral_contact').text('9589883533');
                $('#referral_city').text('Jabalpur');
                $('.referal_layer').hide();
                $('#refferal_blockshow').hide();
                $('#pay_afterreferal').show();
            }else {
                $('#referral_img').attr("src","http://www.connecting-one.com/images/Male_default.png");
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
        function ShowReferralData() {
            
        }
        function ShowReferralBox() {
            $('#referal_box').slideToggle();
        }
		$('body').on('click','#pay_afterreferal',function(){
			$('#rfrl_box').val($('#referral_txt').val());
			$('#rfrl_ptymbox').val($('#referral_txt').val());
		});
        function Dynamic_AddClass(dis) {
            $(dis).find('.connected_imgbox').addClass('current_hover_img')
        }
        function MouseOut(dis) {
            $(dis).find('.connected_imgbox').removeClass('current_hover_img')
        }
		$(document).ready(function(){
		
		
		function xn(){
				var a = $('#hdn_id').val();
				$.ajax({
					type: "POST",
					 contentType: "application/json; charset=utf-8",
					url: "{{ url('loadNetwork') }}",
					data: '{"a":"' + a + '"}',
					success: function (data) {
						$('.user_image_containner').append(data.t);
						$('#hdn_id').val(data.id);
					},
					error: function (xhr, status, error) {
						alert(xhr.responseText);
//                        $('.user_image_containner').html(xhr.responseText);
					}
				});
			}
			xn();
			$('body').on('click', '#btn_Moredata', function(){
			xn();
		});
		
		function cR(){
				
			}
			$('body').on('keyup', '#referral_txt', function(){
				var a = $(this).val();
				if(a == '') {return false;}
				
				$.ajax({
					type: "POST",
					 contentType: "application/json; charset=utf-8",
					url: "{{ url('vRC') }}",
					data: '{"a":"' + a + '"}',
					success: function (d) {
						$('.pyb').prop('disabled', true);
						$('.pyb').attr('type','button');
						$('#referral_img').attr('src',d.p);
						$('#referral_name').text('');
						$('#referral_contact').text('');
						$('#referral_img').attr('src','http://www.connecting-one.com/images/Male_default.png');
						$('#referral_city').text('');
						$('#error_referal').text('');
						if(d.t){
							$('.pyb').prop('disabled', false);
							$('.pyb').attr('type','submit');
							$('#referral_img').attr('src',d.p);
							$('#referral_name').text(d.f + ' ' + d.l);
							$('#referral_contact').text(d.m);
							$('#referral_city').text(d.c);
						}
						else
							$('#error_referal').text('Invalid Referral code');
					},
					error: function (xhr, status, error) {
						console.log(xhr.responseText);
//                       
					}
				});
			});
///////////////////////////
}); // document.ready
		
    </script>
@stop