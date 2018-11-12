@extends('layout.master.master')

@section('title', 'E-Commerce : Product List')
@section('head')
    <script type="text/javascript">
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
        function ShowMenuPopup(dis) {
            $('.menu_basic_popup').addClass('scale0');
            $(dis).find('.menu_basic_popup').removeClass('scale0');
        }
    </script>
    <section class="container-fluid overall_containner mob_pad0">
            <div class="col-md-2 dashboard_fixed res_menu_hide">
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
            <div class="col-md-10 col-sm-12">
                <div class="product_boxcontainner adver_mainblock">
                    <div class="advertise_withhead">
                        <div class="col-sm-6 col-md-4 col-xs-5 head_caption">Products List
                           {{-- <input class="form-control" placeholder="Search by item name" name="srch-term"
                                   id="Search" type="text" onkeyup="getBuyItem()">--}}
                        </div>
                        <div class="col-sm-6 col-md-8 col-xs-7 product_list_searchbox">
                            <div class="input-group add-on glo_searchbox">
                                <input class="form-control" placeholder="Search by item name" name="srch-term" id="Search" type="text" onkeyup="getBuyEItem()">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div>
                            <div class="baskit_containner glo_menuclick pull-right" id="cartload">
                                @php $total = 0; $itemcount = 0; $gtotal = 0; $counter = 0; @endphp
                                @foreach(\Gloudemans\Shoppingcart\Facades\Cart::content() as $row)
                                    {{--    @if($row->options->remark == 'grocery')--}}
                                    <?php $total += $row->price * $row->qty;
                                    $counter++;
                                    $itemcount++;
                                    ?>
                                    {{--@endif--}}
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
                                    <div class="menu_popup_containner style-scroll">
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
                                    @if($total > 0)
                                        <div class="cart_btn_box">
                                            <a class="btn btn-success btn-sm pull-right" href="{{url('checkout')}}">
                                                <span class="mdi mdi-cart basic_icon_margin"></span>Checkout
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="all_product_block">
                        <div class="row" id="list_container">
                            @foreach($items as $item)
                                <div class="col-sm-4 col-md-3 target">
                                    <div class="ecommerce_product_block">
                                        <div class="long_product_img">
                                            <img src="{{url('').'/'.$item->image}}" height="200px" width="230px">
                                            <div class="hover_center_block" id="{{$item->id}}"
                                                 onclick="getItemDetails(this);"
                                                 data-toggle="modal"
                                                 data-target="#Modal_ViewProductDetails">
                                            </div>
                                        </div>
                                        {{--<a class="product_name" href="{{url('dashboard')}}">{{$item->name}}</a>--}}
                                        <span class="product_name" data-toggle="modal"
                                              data-target="#Modal_ViewDetails_Ecommerce"
                                              onclick="ShowProductDetails(this);">{{$item->name}}
                                            <input type="hidden" id="Product_name" value="{{$item->name}}"/>
                                    <input type="hidden" id="Product_desc" value="{{$item->description}}"/>
                                    <input type="hidden" id="Product_price" value="{{$item->price}}"/>
                                     <img src="{{url('').'/'.$item->image}}" height="0px" width="0px"
                                          class="hidden_image"/>
                                </span>

                                        <div class="product_qty">
                                            <select class="form-control product_drop">
                                                <option value="5">{{$item->price}}</option>
                                            </select>
                                        </div>
                                        <div class="spinner_withbtn">
                                            <div class="input-group qty_box">
                                                <span class="qty_txt">Qty</span>
                                                <input type="number" class="form-control text-center qty_edittxt"
                                                       min="1" onkeypress="return false" max="10" value="1" id="qty_{{$item->id}}">
                                            </div>
                                            <button class="spinner_addcardbtn btn-primary" id="{{$item->id}}"
                                                    type="button"
                                                    data-content="{{$item->id}}" onclick="AddTOcart(this);">
                                                <i id="{{$item->id}}" onclick="AddTOcart(this);"
                                                   class="mdi mdi-basket"></i> <span
                                                        class="button-group_text">Add</span>
                                            </button>
                                        </div>

                                    </div>
                                    {{-- <div class="long_spinner_withbtn">
                                         <div class="input-group long_qty_box"><span
                                                     class="long_qty_txt">Rs. {{$item->price}}</span>
                                             <input type="number"
                                                    class="form-control text-center qty_edittxt"
                                                    min="0"
                                                    max="10"
                                                    value="0" id="qty_1">
                                         </div>
                                         <button class="spinner_addcardbtn btn-primary" id="{{$item->id}}" type="button"
                                                 data-content="{{$item->id}}" onclick="AddTOcart(this);">
                                             <i id="{{$item->id}}" onclick="AddTOcart(this);" class="mdi mdi-basket"></i> <span
                                                     class="button-group_text">Add</span>
                                         </button>
                                     </div>--}}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <div class="modal fade-scale" id="Modal_ViewDetails_Ecommerce" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel">
        <div class="modal-dialog survey_model" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">View Details</h4>
                </div>
                <div class="modal-body">
                    <div class="news_containner style-scroll">
                        <div class="advertise_details_box">
                            <div class="latest_update_title" id="product_title_lb"></div>
                            <div class="latest_updatetxt" id="product_details_lb"></div>
                            <div class="latest_otr_details">
                                <span><i class="mdi mdi-currency-inr"></i> <span id="product_price_lb"></span></span>
                            </div>
                        </div>
                        <div class="latest_updateimg">
                            <img src="{{url('images/Adver_mainimg1.jpg')}}" id="product_img_lb"/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @if(session()->has('message'))
        <script type="text/javascript">
            setTimeout(function () {
                {{--ShowSuccessPopupMsg('{{ session()->get('message') }}');--}}
                swal("Success!", "{{ session()->get('message') }}", "success");
            }, 500);
        </script>
    @endif
    <script type="text/javascript">
        var append_norecord_e = '<div class="col-sm-12 no_block" id="no_record_found_block_e"><div class="adver_list_row"><span class="list_no_record">' +
            '< No Record Available ></span></div></div>';
        function getBuyEItem() {
            var check_rowcount = $('.target').length;
            if(check_rowcount > 0) {
                var input = document.getElementById("Search");
                var filter = input.value.toLowerCase();
                var nodes = document.getElementsByClassName('target');
                for (i = 0; i < nodes.length; i++) {
                    if (nodes[i].innerText.toLowerCase().includes(filter)) {
                        nodes[i].style.display = "block";
                        $('#no_record_found_block_e').remove();
                    } else {
                        nodes[i].style.display = "none";
                    }
                }
                if($('.target:visible').length == 0)
                {
                    $('.no_block').remove();
                    $('#list_container').append(append_norecord_e);
                }else {
                    $('#list_container').find('.no_block').remove();
                }
            }
        }

        function ShowProductDetails(dis) {
            globalloadershow();
            //$('#Modal_ViewDetails_Ecommerce').show();
            var getimgsrc = $(dis).find('img').attr('src');
            var gettitle = $(dis).find('#Product_name').val().trim();
            var getdetails = $(dis).find('#Product_desc').val().trim();
            var getprice = $(dis).find('#Product_price').val().trim();
            $('#product_img_lb').attr('src', getimgsrc);
            $('#product_title_lb').text(gettitle);
            $('#product_details_lb').text(getdetails);
            $('#product_price_lb').text(getprice);
            globalloaderhide();
        }
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
    </script>
@stop