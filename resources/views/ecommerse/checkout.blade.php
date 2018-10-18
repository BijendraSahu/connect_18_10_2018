@extends('layout.master.master')
@section('title', 'E-Commerce : Checkout')
@section('head')
    <style>
        /*.long_qty_box {*/
        /*background-color: #e8e8e8;*/
        /*display: inline-block;*/
        /*width: 100%;*/
        /*border: solid thin #ccc;*/
        /*position: relative;*/
        /*padding-left: 105px;*/
        /*max-width: 150px;*/
        /*font-size: 12px;*/
        /*}*/
        /*.long_qty_txt {*/
        /*width: 105px;*/
        /*display: inline-block;*/
        /*color: #000;*/
        /*position: absolute;*/
        /*left: 5px;*/
        /*border-right: solid thin #ccc;*/
        /*height: 100%;*/
        /*text-align: left;*/
        /*line-height: 25px;*/
        /*background: #e8e8e8;*/
        /*}*/
        /* .spinner_addcardbtn {
             position: absolute;
             right: 0px;
             top: 0px;
             border: none;
             height: 28px;
             padding-left: 20px;
             margin-top: 25px;
         }

         .long_spinner_withbtn {
             position: relative;
             display: inline-block;
             width: 100%;
             padding-right: 80px;
             margin-bottom: 5px;
             text-align: left;
         }

         .menu_popup_containner1 {
             padding-top: 15px;
             max-height: 210px !important;
             overflow: auto !important;
         }

         .menu_basic_popup {
             width: 320px;
             height: auto;
             background: #fff;
             box-shadow: 0 2px 10px rgba(0, 0, 0, .4);
             position: absolute;
             color: #333;
             z-index: 100;
             right: 0;
             padding: 15px;
             top: 60px;
             transition: all 150ms linear;
         }

         .baskit_containner i {
             font-size: 30px;
         }

         .scale0 {
             max-width: 540px;
             opacity: 0;
             top: 100px !important;
             visibility: hidden;
         }

         .baskit_counter {
             position: absolute;
             width: 20px;
             height: 20px;
             background: #dd0000;
             color: #ffffff;
             text-align: center;
             border-radius: 50%;
             right: -8px;
             top: -2px;
             z-index: 10;
             line-height: 20px;
         }

         .product_block {
             width: 23%;
             float: left;
             overflow: hidden;
             margin-right: 2%;
             padding: 10px;
             background-color: #fff;
             box-shadow: rgba(0, 0, 0, 0.08) 5px 8px 20px, rgba(72, 67, 67, 0.23) 0px 2px 5px;
             margin-bottom: 20px;
             height: 320px;
         }

         .header_popup {
             color: #fff;
             display: flex;
             width: 100%;
             padding: 5px 10px 5px 10px;
             background: #5cb85c;
         }

         .table_addcard {
             border: solid thin #e1e1e1;
             font-size: 14px;
             margin: 0px;
         }

         .menu_basic_popup:before {
             width: 0;
             height: 0;
             border-style: solid;
             border-width: 0 8px 10px 8px;
             border-color: transparent transparent #fff transparent;
             position: absolute;
             top: -10px;
             right: 20px;
             z-index: 5;
             content: "";
         }

         .hide {
             display: none;
         }

         .show {
             display: block;
         }

         .details_radio {
             max-width: 300px;
             padding: 10px;
             border: solid thin #813e3e;
             background-color: #fda1a1;
             display: none;
             color: #000;
             width: 100%;
             margin-bottom: 5px;
         }

         .radiopanelbox {
             margin-bottom: 0px;
         }

         .radiobox {
             display: inline-block;
             width: 100%;
             max-width: 400px;
         }*/
    </style>
    <style type="text/css">

    </style>
    <script type="text/javascript">
        $(window).scroll(function (event) {
            var chk_scroll = $(window).scrollTop();
            if (chk_scroll > 70) {
                $('.top_manubar').addClass('top_manubar_fixed');
//                    $('.overall_containner').addClass('overall_margin');
                $('.profile_basic_menu_block').addClass('left_menu_fixed');
                $('.all_right_block').addClass('right_menu_fixed');
            }
            if ($(window).scrollTop() + $(window).height() == $(document).height()) {
                if (parseFloat($('#see_id').val()) <= parseFloat($('#pcount').val())) {
                    getmorepost();
                }
            }
        });
        $(document).ready(function () {
            //$('[data-toggle="tooltip"]').tooltip();
            $(document).click(function (e) {
                $('.menu_basic_popup').addClass('scale0');
                e.stopPropagation();
            });
            $('.glo_menuclick').click(function (e) {
                $('.menu_basic_popup').addClass('scale0');
                $(this).find('.menu_basic_popup').removeClass('scale0');
                e.stopPropagation();
            });
        });
        function AddressOption(txt) {
            if (txt == "existing") {
                $('#existing_dropbox').fadeIn();
            } else {
                $('#existing_dropbox').fadeOut();
            }
        }
        function ShowMenuPopup(dis) {
            $('.menu_basic_popup').addClass('scale0');
            $(dis).find('.menu_basic_popup').removeClass('scale0');
        }

        $(document).ready(function () {
            // $("#address1").show();
            $('input:radio[name=shapeList]').change(function () {
                if (this.value == '1') {
                    $('#second_details').hide();
                    $('#first_details').show();
                }
                else if (this.value == '0') {
                    $('#first_details').hide();
                    $('#second_details').show();
                }
            });
        });

        function show1() {
            $("#address1").show();
            $("#address2").hide();
        }

        function show2() {
            $("#address2").show();
            $("#address1").hide();
        }
    </script>
    <section class="container-fluid ecommerce_containner">
        <div class="row">
            <div class="col-md-2">
                <div class="profile_basic_menu_block">
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
                        <li>
                            <a href="{{url('buy')}}"><i class="profile_icons mdi mdi-cart-outline"></i>Buy & Sell</a>
                        </li>
                        <li style="border-bottom: none;">
                            <a href="{{url('item_list')}}"><i class="profile_icons mdi mdi-wallet-giftcard"></i>E-Commerce</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10">
                <div class="advertise_withhead">
                    <div class="col-sm-6 col-md-4 col-xs-12 head_caption">Products List</div>
                    <div class="col-sm-6 col-md-8 col-xs-12 head_caption" style="display: none;">
                        <div class="baskit_containner glo_menuclick pull-right" id="cartload">
                            @php $total = 0; $itemcount = 0; $gtotal = 0; $counter = 0; @endphp
                            @foreach(\Gloudemans\Shoppingcart\Facades\Cart::content() as $row)
                                @if($row->options->remark == 'grocery')
                                    <?php $total += $row->price * $row->qty;
                                    $counter++;
                                    $itemcount++;
                                    ?>
                                @endif
                            @endforeach

                            <span class="baskit_counter" id="baskit_counter">{{$counter}}</span>
                            <i class="mdi mdi-basket" id="baskit_block"></i>
                            <div class="menu_basic_popup cart_popbox scale0">
                                <div class="header_popup">
                                    <div class="total_item_count">
                                        <span class="basic_icon mdi mdi-basket-fill"></span>
                                        {{$itemcount}} Item
                                    </div>
                                    <div class="total_item_amt pull-right">
                                        <span class="basic_icon mdi mdi-currency-inr"></span>
                                        {{$total}}
                                    </div>
                                </div>
                                <div class="menu_popup_containner1 style-scroll">
                                    <table class="table table-striped table_addcard">
                                        <tbody>
                                        @php $total = 0; $gst = 0; $gtotal = 0; $sp = 0; @endphp
                                        @if(count(\Gloudemans\Shoppingcart\Facades\Cart::content())>0)
                                            @foreach(\Gloudemans\Shoppingcart\Facades\Cart::content() as $row)
                                                <tr>
                                                    <td class="text-left"><a class="cart_product_name"
                                                                             title="{{$row->name}}"
                                                                             href="#">{{ str_limit($row->name, 12) }}</a>
                                                    </td>
                                                    <td class="text-center"> x{{$row->qty}}</td>
                                                    <td class="text-center"><span
                                                                class="mdi mdi-currency-inr"></span>{{$row->price}}
                                                    </td>
                                                    <td class="text-right">
                                                        <a href="{{url('cart_delete').'/'.$row->rowId}}"
                                                           class="mdi mdi-close cart-delete"
                                                           data-toggle="tooltip"
                                                           title="Remove"></a>
                                                    </td>
                                                </tr>
                                                @php $total += $row->price * $row->qty; @endphp
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div class="cart_btn_box">
                                    <a class="btn btn-success btn-sm pull-right" href="{{url('checkout')}}">
                                        <span class="mdi mdi-cart basic_icon_margin"></span>Checkout
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    {{--<form action="{{url('res_cod_checkout')}}" id="confirmorder" method="post"--}}
                    {{--enctype="multipart/form-data">--}}
                    <input type="hidden" name="_token" value="{{ csrf_token()}}"/>
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><i class="fa fa-book"></i> Your Address</h4>
                            </div>

                            <div class="order_list_container">
                                <div class="deli_row">
                                    <div class="col-sm-6">
                                        <div class="radio_address_box">
                                            <div class="radio">
                                                <input id="add_1" value="male" class="gender" name="address_radio"
                                                       type="radio" checked="" onchange="AddressOption('new');">
                                                <label for="add_1" class="radio-label">New</label>
                                            </div>
                                            <div class="radio">
                                                <input id="add_2" onchange="AddressOption('existing');" value="female"
                                                       class="gender" name="address_radio" type="radio">
                                                <label for="add_2" class="radio-label">Existing</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6" id="existing_dropbox" style="display:none">
                                        <select class="form-control" id="existaddess"
                                                name="address_id">
                                            <option value="0"> --- Please Select ---</option>
                                            @foreach($address as $addres)
                                                <option value="{{$addres->id}}">{{$addres->name}}
                                                    , {{$addres->contact}}, {{$addres->address}}
                                                    , {{$addres->zip}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="deli_row">
                                    <div class="col-sm-4">
                                        <input type="text" placeholder="Name*" id="a_name"  onpaste="return false;" maxlength="25" class="form-control textWithSpace">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" placeholder="Contact*" onpaste="return false;"  id="a_contact" class="form-control numberOnly contact" maxlength="10" >
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" placeholder="Pincode*" onpaste="return false;"  id="a_pin" class="form-control numberOnly" maxlength="6" >
                                    </div>
                                </div>
                                <div class="deli_row">
                                    <div class="col-sm-6">
                                        <input type="email" placeholder="Email Id*" maxlength="30" onpaste="return false;" id="a_email" class="form-control email">
                                    </div>
                                    <div class="col-sm-6">
                                        {{--<input type="text" placeholder="City" id="a_city" class="form-control">--}}
                                        <select class="form-control" id="a_city"
                                                name="a_city">
                                            <option value="0"> --Please Select*--</option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->CID}}">{{$city->City}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="deli_row">
                                    <div class="col-sm-12">
                                        <textarea class="form-control glo_txtarea" maxlength="250" id="a_address"
                                                  placeholder="Delivery Address*"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div style="display: none;">
                                <div class="col-sm-12">
                                    <input type="radio" name="tab" value="1" checked="checked" class="r1" id="1"
                                           onclick="show1();"/>
                                    I want to use an existing address
                                </div>
                                <br>
                                <div class="panel-body row" style='display:none' id="address1">

                                    <div class="col-sm-2">
                                        <div class="form-group required">
                                            <label for="input-payment-country" class="control-label">Existing
                                                Address</label>

                                        </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="existaddess"
                                                name="address_id">
                                            <option value="0"> --- Please Select ---</option>
                                            @foreach($address as $addres)
                                                <option value="{{$addres->id}}">{{$addres->name}}
                                                    , {{$addres->contact}}, {{$addres->address}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                                <div class="col-sm-12">
                                    <b style="margin-left: 10%">Or</b>
                                </div>
                                <br>
                                <div class="col-md-12">
                                    <input type="radio" name="tab" value="2" class="r2" id="2"
                                           onclick="show2();"/>
                                    I want to use a new address
                                </div>
                                <hr>
                                <div class="panel-body row" style='display:none' id="address2">
                                    <div class="col-sm-12">
                                        <h3 class="text-center bg-info">Delivery Address</h3>
                                        <fieldset id="address" class="required">
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label"
                                                       for="input-name">Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="uname" value=""
                                                           placeholder="Name"  onpaste="return false;"
                                                           id="uname" class="form-control">
                                                </div>
                                            </div>
                                            <p class="clearfix"></p>
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label"
                                                       for="input-name">Contact</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="ucontact" value=""
                                                           placeholder="Contact"  onpaste="return false;"
                                                           id="ucontact" class="form-control">
                                                </div>
                                            </div>
                                            <p class="clearfix"></p>
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label"
                                                       for="input-name">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="uemail" value=""
                                                           placeholder="Email" onpaste="return false;" maxlength="30"
                                                           id="uemail" class="form-control">
                                                </div>
                                            </div>
                                            <p class="clearfix"></p>
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label" for="input-address-1">Address
                                                    Line 1</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="address" value=""
                                                           placeholder="Address Line 1" maxlength="250"
                                                           id="add1" class="form-control">
                                                </div>
                                            </div>
                                            <p class="clearfix"></p>
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label" for="input-address-2">Address
                                                    Line 2</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="address2" value=""
                                                           placeholder="Address Line 2"
                                                           id="add2" class="form-control">
                                                </div>
                                            </div>
                                            <p class="clearfix"></p>
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label"
                                                       for="input-postcode">PinCode</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="postcode" value=""
                                                           placeholder="PinCode" id="pin"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <p class="clearfix"></p>
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label"
                                                       for="input-state">State</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" id="state"
                                                            name="state_id">
                                                        <option value="0"> --Please Select--</option>
                                                        {{--<option value="282">Madhya Pradesh</option>--}}
                                                        @foreach($states as $state)
                                                            <option value="{{$state->CID}}">{{$state->State}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <p class="clearfix"></p>
                                            <div class="form-group required">
                                                <label class="col-sm-2 control-label"
                                                       for="input-state">City</label>
                                                <div class="col-sm-10">
                                                    <select class="form-control" id="city"
                                                            name="city_id">
                                                        <option value="0"> --Please Select--</option>
                                                        @foreach($cities as $city)
                                                            <option value="{{$city->CID}}">{{$city->City}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><i class="fa fa-shopping-cart"></i> Shopping cart
                                </h4>
                            </div>
                            <div class="panel-body">
                                <table class="table table-bordered table-condensed table-hover table-responsive grid-table">
                                    <thead>
                                    <tr class="tr-header globe-header-tr">
                                        {{--<td class="text-center">Category</td>--}}
                                        <th class="width_40">Product Name</th>
                                        {{--<td class="text-left">Model</td>--}}
                                        <th class="width_20">Quantity</th>
                                        <th class="width_20">Unit Price</th>
                                        <th class="width_20">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(Session::has('paid-msg'))
                                        <p class="alert alert-success">{{ Session::get('paid-msg') }}</p>
                                    @endif
                                    @if(Session::has('success-msg'))
                                        <p class="alert alert-info">{{ Session::get('success-msg') }}</p>
                                    @endif
                                    <?php $total = 0; $gst = 0; $gtotal = 0; $sp = 0;$shipping = 0; ?>
                                    @foreach($cart as $row)
                                        <tr>
                                            <td class="tab-grid width_40 col1" data-line="Product Name">
                                                {{$row->name}}
                                            </td>
                                            <form action="{{url('cart_update').'/'}}{{$row->rowId}}"
                                                  method="post">
                                                <td class="tab-grid width_20 col2" data-line="Quantity">
                                                    <div class="input-group quantity">
                                                        <input type="number" class="form-control cart_quantity_input"
                                                               onkeypress="return false" max="10"  min="1" placeholder="Quantity" name="qty"
                                                               value="{{$row->qty}}" autocomplete="off" size="3"/>
                                                        <input type="hidden" name="_token"
                                                               value="{{csrf_token()}}">
                                                        <span class="input-group-addon card_updatebtn">
                                                                              <button type="submit"
                                                                                      class="btn btn-primary">
                                                                            <i class="mdi mdi-refresh"></i></button>
                                                                        </span>

                                                    </div>
                                                    {{-- <div class="input-group btn-block quantity">
                                                         <input style="width:90px;"
                                                                class="cart_quantity_input form-control"
                                                                type="number"
                                                                name="qty" maxlength="3"
                                                                value="{{$row->qty}}"
                                                                autocomplete="off" size="3">
                                                         <input type="hidden" name="_token"
                                                                value="{{csrf_token()}}">
                                                         <button type="submit" data-toggle="tooltip"
                                                         title="Update"
                                                         class="btn btn-primary"><i
                                                         class="mdi mdi-refresh"></i>
                                                         </button>
                                                     </div>--}}
                                                </td>
                                            </form>
                                            <td class="tab-grid width_20 col3 text_right" data-line="Unit Price">
                                                <p><span class="mdi mdi-currency-inr"></span>{{$row->price}}</p>
                                            </td>
                                            <td class="tab-grid width_20 col4 text_right" data-line="Total">
                                                <p class="cart_total_price"><span
                                                            class="mdi mdi-currency-inr"></span>{{$row->price*$row->qty}}
                                                </p>
                                            </td>
                                        </tr>
                                        <?php $total += $row->price * $row->qty;

                                        ?>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col-sm-6 col-sm-offset-6">
                                        <table class="table table-bordered">
                                            <tbody>
                                            <tr>
                                                <td class="text-right">
                                                    <strong>Sub-Total:</strong>
                                                </td>
                                                <td class="text-right"><span
                                                            class="mdi mdi-currency-inr"></span> {{$total}}
                                                </td>
                                            </tr>
                                            <tr id="shipping_amt" class="hidden">
                                                <td class="text-right">
                                                    <strong>Shipping Charge:</strong>
                                                </td>
                                                <td class="text-right"><span
                                                            class="mdi mdi-currency-inr"></span>@if($total >0)
                                                        <span id="shipping">{{$shipping}}</span>
                                                    @else {{0}}
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-right">
                                                    <strong>Total:</strong>
                                                </td>
                                                {{--<td class="text-right"><i class="fa fa-inr"></i>@if($total >0){{$total+$sp}}@else {{0}} @endif--}}
                                                <td class="text-right"><span
                                                            class="mdi mdi-currency-inr"></span>@if($total >0)<span
                                                            id="gamt">{{$total+$shipping}}</span>@endif
                                                </td>
                                                <input type="hidden" id="gtotal" name="amount"
                                                       value="{{$total+$shipping}}">
                                                <input type="hidden" id="actutalgtotal" name="amount"
                                                       value="{{$total+$shipping}}">
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="pull-left"><a class="btn btn-default buttonGray"
                                                          onclick="history.go(-1);return false;"
                                                          href="#">Back</a>
                                </div>
                                <div class="buttons">
                                    <div class="pull-right">
                                        <input type="button" class="paynow btn btn-primary"
                                               data-target="#Modal_payoptionlist" data-toggle="modal"
                                               id="button_confirm_pay" {{--onclick="submitContactForm()"--}}
                                               value="Pay Now">

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    {{--</form>--}}

                </div>
            </div>
        </div>

    </section>
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
                        <div class="col-xs-6">
                            <div class="payment_optionbox" onclick="Selected_option(this);">
                                <img src="{{url('images/payu_logo.png')}}" alt="payu_logo"/>
                                <input type="hidden" value="payumoney" class="selected_option_name"/>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="payment_optionbox" onclick="Selected_option(this);">
                                <img src="{{url('images/atom_logo.png')}}" alt="payu_logo"/>
                                <input type="hidden" value="atom" class="selected_option_name"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" disabled="disabled" id="btn_payoption"
                            data-dismiss="modal" onclick="submitContactForm();" data-toggle="modal"
                            data-target="#myModal_TermsAccepted">Submit
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{--@if(session()->has('message'))--}}
    {{--<script type="text/javascript">--}}
    {{--setTimeout(function () {--}}
    {{--ShowSuccessPopupMsg('{{ session()->get('message') }}');--}}
    {{--}, 500);--}}
    {{--</script>--}}
    {{--@endif--}}
    <script type="text/javascript">
        function AddTOcart(dis) {
            var itemid = $(dis).attr('id');
            var qty = $('#qty_' + itemid).val();
            var carturl = "{{url('addtocart')}}";
            $.ajax({
                type: "get",
                contentType: "application/json; charset=utf-8",
                url: carturl,
                data: {itemid: itemid, quantity: qty},
                success: function (data) {
                    swal("Success!", "Item has been added to cart...", "success");
                    $("#cartload").html(data);
                },
                error: function (xhr, status, error) {
                    $("#cartload").html(xhr.responseText);
                }
            });
        }

        function submitContactForm() {
            var existaddress = $('#existaddess').val();
            var name = $('#a_name').val();
            var contact = $('#a_contact').val();
            var a_pin = $('#a_pin').val();
            var email = $('#a_email').val();
            var address = $('#a_address').val();
//            var city = $('#a_city').val();
//            var pin = $('#pin').val();
            var city = $('#a_city :selected').val();
//            var state = $('#state :selected').val();
            if (existaddress.trim() == '0') {
//                alert('Please enter address details.');
                if (name.trim() == '') {
                    swal("Fields Required", "Please enter name", "error");
                    $('#a_name').focus();
                    return false;
                } else if (contact.trim() == '') {
                    swal("Fields Required", "Please enter contact", "error");
                    $('#a_contact').focus();
                    return false;
                }  else if (a_pin.trim() == '') {
                    swal("Fields Required", "Please enter pincode", "error");
                    $('#a_pin').focus();
                    return false;
                } else if (email.trim() == '') {
                    swal("Fields Required", "Please enter email", "error");
                    $('#a_email').focus();
                    return false;
                } else if (address.trim() == '') {
                    swal("Fields Required", "Please enter address line", "error");
                    $('#a_address').focus();
                    return false;
                } else if (city.trim() == '0') {
                    swal("Fields Required", "Please enter city", "error");
                    $('#a_city').focus();
                    return false;
                } else {
                    submitContact();
                }
//                $('#existaddess').focus();
                return false;
            }
            else {
                submitExistAddress();
            }
        }

        function submitContact() {
            $('#myModal').modal('show');
            $('#modal_title').html('Checkout Payment');
            $('#modal_body').html('<img height="50px" class="center-block" src="{{url('images/loading.gif')}}"/>');
            var amt = $('#gtotal').val();
            var name = $('#a_name').val();
            var contact = $('#a_contact').val();
            var pincode = $('#a_pin').val();
            var email = $('#a_email').val();
            var address = $('#a_address').val();
            var city = $('#a_city :selected').val();
            var editurl = '{{ url('/') }}' + "/payment/";
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: editurl,
                data: {
                    name: name,
                    contact: contact,
                    pincode: pincode,
                    email: email,
                    add1: address,
                    city: city,
                    amt: amt,
                },
                success: function (data) {
                    $('#modal_body').html(data);
                },
                error: function (xhr, status, error) {
                    $('#modal_body').html(xhr.responseText);
                }
            });
        }

        function submitExistAddress() {
            $('#myModal').modal('show');
            var is_cod = $('#payment').val();
            var is_express = $('#express').val();
            var shipping = $('#shipping').text();
            $('#modal_title').html('Checkout Payment');
            $('#modal_body').html('<img height="50px" class="center-block" src="{{url('images/loading.gif')}}"/>');
            var id = 1;
            var amt = $('#gtotal').val();
            var existadd = $('#existaddess').val();
            var editurl = '{{ url('/') }}' + "/payment";
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: editurl,
                data: {existadd: existadd, cod: is_cod, amt: amt, is_express: is_express, shipping: shipping},
                success: function (data) {
                    $('#modal_body').html(data);
                },
                error: function (xhr, status, error) {
                    $('#modal_body').html(xhr.responseText);
                }
            });
        }

        $('#a_email').focusout(function () {
            var domains = ["gmail.com", "hotmail.com", "msn.com", "yahoo.com", "yahoo.in", "yahoo.com", "aol.com", "hotmail.co.uk", "yahoo.co.in", "live.com", "rediffmail.com", "outlook.com", "hotmail.it", "googlemail.com", "mail.com"]; //update ur domains here
            var idx1 = this.value.indexOf("@");
            if (idx1 > -1) {
                var splitStr = this.value.split("@");
                var sub = splitStr[1].split(".");
                if ($.inArray(splitStr[1], domains) == -1) {
                    swal("Oops....", "Email must have correct domain name Eg: @gmail.com", "info");
                    this.value = "";
                }
            }
        });
    </script>
@stop