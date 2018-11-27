<?php

$new_str = str_replace(' ', '', $firstName);

?>
<html>
<head>
    <script type="text/javascript">
        var hash = '<?php echo $hash1 ?>';
        function submitPayuForm() {
            if (hash == '') {
                return;
            }
            var payuForm = document.forms.payuForm;
            payuForm.submit();
        }
    </script>
    <script type="text/javascript">
        function check() {
            var selected_payoption = $('.payment_selected').find('.selected_option_name').val();
            if (selected_payoption == "payumoney") {
                $('#payumoney_form_btnblock1').show();
                $('#atom_form_btnblock1').hide();
            } else {
                $('#payumoney_form_btnblock1').hide();
                $('#atom_form_btnblock1').show();
            }

        }
        check();

    </script>
</head>
<body onload="submitPayuForm()">


<form method="post" name="atom" class="form-horizontal margin0" id="atom_form_btnblock1" target="_blank"
      action="{{url('AtompayCheckout/sample.php')}}">
    <div class="modal-body">
        <div class="basic_lb_row">
            <div class="col-sm-3 col-xs-12 text-right">
                <b>Amount :</b>
            </div>
            <div class="col-sm-7 col-xs-12">
                Rs. {{$amt}}
                <input type="hidden" class="form-control" name="amount" value="{{$amt}}" id="inputType" />
            </div>
        </div>
        <div class="basic_lb_row">
            <div class="col-sm-3 col-xs-12 text-right">
                <b>Name :</b>
            </div>
            <div class="col-sm-7 col-xs-12">
                <?php echo $new_str ?>
                <input type="hidden" value="<?php echo $new_str ?>"
                       name="firstname" class="form-control" id="inputType"/>
                <input type="hidden" name="page_id" id="page_id" value="{{$amt}}"/>
            </div>
        </div>
        <div class="basic_lb_row">
            <div class="col-sm-3 col-xs-12 text-right">
                <b>Email :</b>
            </div>
            <div class="col-sm-7 col-xs-12">
                {{$email}}
                <input type="hidden" name="email" value="{{$email}}" class="form-control" id="inputType"/>
            </div>
        </div>
        <div class="basic_lb_row">
            <div class="col-sm-3 col-xs-12 text-right">
                <b class="text-right">Phone :</b>
            </div>
            <div class="col-sm-7 col-xs-12">
                {{$mobile}}
                <input type="hidden" name="phone" value="{{$mobile}}" class="form-control" id="inputType"/>
            </div>
        </div>
        <div class="basic_lb_row">
            <div class="col-sm-3 col-xs-12 text-right">
                <b>Address :</b>
            </div>
            <div class="col-sm-7 col-xs-12">
                {{$addressdel1}}
                <input type="hidden" name="addressdel" class="form-control" value="{{$addressdel1}}"/>
            </div>
        </div>
        @if($shipping > 0)
            <div class="basic_lb_row">
                <div class="col-sm-3 col-xs-12 text-right">
                    <b>Shipping :</b>
                </div>
                <div class="col-sm-7 col-xs-12">
                    Rs. {{$shipping}}
                    <input type="hidden" name="shipping" class="form-control" value="{{$shipping}}"/>
                </div>
            </div>
        @endif
        <div class="col-md-12 hidden">
            <div class="form-group">
                <label for="inputType" class="col-md-2 control-label">Success URL:<span
                            class="mandatory">*</span></label>
                <div class="col-md-8">
                    <input type="text" name="surl" class="form-control"
                           value="{{url('success')}}"
                           placeholder="Enter Success URL"></div>
            </div>
        </div>
        <div class="col-md-12 hidden">
            <div class="form-group">
                <label for="inputType" class="col-md-2 control-label">Failure URL:<span
                            class="mandatory">*</span></label>
                <div class="col-md-8"><input type="text" name="furl"
                                             value="{{url('failed')}}"
                                             class="form-control" placeholder="Enter Failure URL"></div>
            </div>
        </div>
        <div class="col-md-12 hidden">
            <div class="form-group">
                <label for="inputType" class="col-md-2 control-label">Product Info<span
                            class="mandatory">*</span></label>
                <div class="col-md-10"><input name="productinfo" value="product" class="form-group" rows="5" cols="125"
                                              placeholder="Product information"></div>

                {{--------------------------------------------------optional--------------------------------------------------}}
                <input type="text" name="key" value="<?php echo $MERCHANT_KEY ?>"/>
                <input type="text" name="hash" value="<?php echo $hash1 ?>"/>
                <input type="text" name="txnid" value="<?php echo $txnid ?>"/>
                <input type="text" name="" value="<?php echo $hash_string ?>"/>
                <input type="hidden" name="lastname" id="lastname"
                       value="<?php echo (empty($posted['lastname'])) ? '' : $posted['lastname']; ?>"/>
                <input type="text" name="curl" value=""/>
                <input type="text" name="address1"
                       value="<?php echo (empty($posted['address1'])) ? '' : $posted['address1']; ?> "/>
                <input type="text" name="address2"
                       value="<?php echo (empty($posted['address2'])) ? '' : $posted['address2']; ?>"/>
                <input type="text" name="city" value="<?php echo (empty($posted['city'])) ? '' : $posted['city']; ?>"/>
                <input type="text" name="state"
                       value="<?php echo (empty($posted['state'])) ? '' : $posted['state']; ?>"/>
                <input type="text" name="country"
                       value="<?php echo (empty($posted['country'])) ? '' : $posted['country']; ?>"/>
                <input type="text" name="zipcode"
                       value="<?php echo (empty($posted['zipcode'])) ? '' : $posted['zipcode']; ?>"/>
                <input type="text" name="udf1" value="<?php echo (empty($posted['udf1'])) ? '1' : $posted['udf1']; ?>"/>
                <input type="text" name="udf2" value="<?php echo (empty($posted['udf2'])) ? '2' : $posted['udf2']; ?>"/>
                <input type="text" name="udf3" value="<?php echo (empty($posted['udf3'])) ? '3' : $posted['udf3']; ?>"/>
                <input type="text" name="udf4" value="<?php echo (empty($posted['udf4'])) ? '3' : $posted['udf4']; ?>"/>
                <input type="text" name="udf5" value="<?php echo (empty($posted['udf5'])) ? '3' : $posted['udf5']; ?>"/>
                <input type="text" name="service_provider" value="payu_paisa"/>
                {{--------------------------------------------------optional--------------------------------------------------}}
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
    </div>
</form>


<form method="post" name="payumoney" action="https://secure.payu.in/_payment" target="_blank"
      id="payumoney_form_btnblock1">
    <div class="modal-body">
        <div class="basic_lb_row">
            <div class="col-sm-3 col-xs-12 text-right">
                <b class="">Amount :</b>
                <small class="text-muted payutxt">(+3% PayUMoney)</small>
            </div>
            <div class="col-sm-7 col-xs-12">
                Rs. {{$totalCost}}&nbsp;({{$amt}} + {{$amt_pum}})
                <input type="hidden" class="form-control" name="amount" value="{{$totalCost}}" id="inputType"/>
            </div>
        </div>
        <div class="basic_lb_row">
            <div class="col-sm-3 col-xs-12 text-right">
                <b>Name :</b>
            </div>
            <div class="col-sm-7 col-xs-12">
                <?php echo $new_str ?>
                <input type="hidden" value="<?php echo $new_str ?>"
                       name="firstname" class="form-control" id="inputType"/>
                <input type="hidden" name="page_id" id="page_id" value="{{$totalCost}}"/>
            </div>
        </div>
        <div class="basic_lb_row">
            <div class="col-sm-3 col-xs-12 text-right">
                <b>Email :</b>
            </div>
            <div class="col-sm-7 col-xs-12">
                {{$email}}
                <input type="hidden" name="email" value="{{$email}}" class="form-control" id="inputType"/>
            </div>
        </div>
        <div class="basic_lb_row">
            <div class="col-sm-3 col-xs-12 text-right">
                <b>Phone :</b>
            </div>
            <div class="col-sm-7 col-xs-12">
                {{$mobile}}
                <input type="hidden" name="phone" value="{{$mobile}}" class="form-control" id="inputType"/>
            </div>
        </div>
        <div class="basic_lb_row">
            <div class="col-sm-3 col-xs-12 text-right">
                <b>Address :</b>
            </div>
            <div class="col-sm-7 col-xs-12">
                {{$addressdel1}}
                <input type="hidden" name="addressdel" class="form-control" value="{{$addressdel1}}"/>
            </div>
        </div>
        @if($shipping > 0)
            <div class="basic_lb_row">
                <div class="col-sm-3 col-xs-12 text-right">
                    <b>Shipping :</b>
                </div>
                <div class="col-sm-7 col-xs-12">
                    Rs. {{$shipping}}
                    <input type="hidden" name="shipping" class="form-control" value="{{$shipping}}"/>
                </div>
            </div>
        @endif
        <div class="col-md-12 hidden">
            <div class="form-group">
                <label for="inputType" class="col-md-2 control-label">Success URL:<span
                            class="mandatory">*</span></label>
                <div class="col-md-8">
                    <input type="text" name="surl" class="form-control"
                           value="{{url('success')}}"
                           placeholder="Enter Success URL"></div>
            </div>
        </div>
        <div class="col-md-12 hidden">
            <div class="form-group">
                <label for="inputType" class="col-md-2 control-label">Failure URL:<span
                            class="mandatory">*</span></label>
                <div class="col-md-8"><input type="text" name="furl"
                                             value="{{url('failed')}}"
                                             class="form-control" placeholder="Enter Failure URL"></div>
            </div>
        </div>
        <div class="col-md-12 hidden">
            <div class="form-group">
                <label for="inputType" class="col-md-2 control-label">Product Info<span
                            class="mandatory">*</span></label>
                <div class="col-md-10"><input name="productinfo" value="product" class="form-group" rows="5" cols="125"
                                              placeholder="Product information"></div>

                {{--------------------------------------------------optional--------------------------------------------------}}
                <input type="text" name="key" value="<?php echo $MERCHANT_KEY ?>"/>
                <input type="text" name="hash" value="<?php echo $hash1 ?>"/>
                <input type="text" name="txnid" value="<?php echo $txnid ?>"/>
                <input type="text" name="" value="<?php echo $hash_string ?>"/>
                <input type="hidden" name="lastname" id="lastname"
                       value="<?php echo (empty($posted['lastname'])) ? '' : $posted['lastname']; ?>"/>
                <input type="text" name="curl" value=""/>
                <input type="text" name="address1"
                       value="<?php echo (empty($posted['address1'])) ? '' : $posted['address1']; ?> "/>
                <input type="text" name="address2"
                       value="<?php echo (empty($posted['address2'])) ? '' : $posted['address2']; ?>"/>
                <input type="text" name="city" value="<?php echo (empty($posted['city'])) ? '' : $posted['city']; ?>"/>
                <input type="text" name="state"
                       value="<?php echo (empty($posted['state'])) ? '' : $posted['state']; ?>"/>
                <input type="text" name="country"
                       value="<?php echo (empty($posted['country'])) ? '' : $posted['country']; ?>"/>
                <input type="text" name="zipcode"
                       value="<?php echo (empty($posted['zipcode'])) ? '' : $posted['zipcode']; ?>"/>
                <input type="text" name="udf1" value="<?php echo (empty($posted['udf1'])) ? '1' : $posted['udf1']; ?>"/>
                <input type="text" name="udf2" value="<?php echo (empty($posted['udf2'])) ? '2' : $posted['udf2']; ?>"/>
                <input type="text" name="udf3" value="<?php echo (empty($posted['udf3'])) ? '3' : $posted['udf3']; ?>"/>
                <input type="text" name="udf4" value="{{$shipping}}"/>
                <input type="text" name="udf5" value="{{$address_id}}"/>
                <input type="text" name="service_provider" value="payu_paisa"/>
                {{--------------------------------------------------optional--------------------------------------------------}}
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Close</button>
    </div>
</form>
</body>
</html>
