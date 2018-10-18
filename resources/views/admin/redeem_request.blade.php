@extends('layout.master.admin_master')

@section('title', 'Redeem Requests List')

@section('head')

@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="advertiselist_block">
                <div class="dash_boxcontainner">

                    <div class="advertise_withhead margin0">
                        <div class="col-sm-6 col-md-4 col-xs-12 head_caption">Redeem Requests List</div>
                        <div class="btn-group gridbtn-group pull-right" id="TotalRecords"><span
                                    class="grid-counter-text">Counter</span><span
                                    class="btn btn-counter btn-sm">{{count($redeems)}}</span></div>
                    </div>
                    <div class="panel-body">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                            <tr class="tr-header globe-header-tr">
                                <th class="width_20">Account No.</th>
                                <th class="width_18">Name</th>
                                <th class="width_20">Bank</th>
                                <th class="width_20">IFSC</th>
                                <th class="width_10">Amount</th>
                                <th class="width_15">Aadhar/PAN</th>
                                <th class="width_12">Date</th>
                                <th class="width_10">Status</th>
                                <th class="width_10">Details</th>
                            </tr>
                            </thead>
                            <tbody id="ListContainerSection">
                            @if(count($redeems) > 0)
                                @foreach($redeems as $redeem)
                                    <tr id="row_{{$redeem->id}}">
                                        <td class="tab-grid width_20 col1" id="ac_no"
                                            data-line="Account No.">{{$redeem->ac_number}}
                                        </td>
                                        <td class="tab-grid width_18 col2" id="ac_hold"
                                            data-line="Name">{{$redeem->account_holder}}</td>
                                        <td class="tab-grid width_20 col3" id="bank"
                                            data-line="Bank">{{$redeem->bank}}</td>
                                        <td class="tab-grid width_20 col3" id="ifsc"
                                            data-line="ifsc">{{$redeem->ifsc_code}}</td>
                                        <td class="tab-grid width_10 col4 text_right" id="amount"
                                            data-line="Amount">{{$redeem->amount}}</td>
                                        <td class="tab-grid width_13 col4 text_right" id="aadhar"
                                            data-line="Amount">{{$redeem->aadhar_pan}}</td>
                                        <td class="tab-grid width_12 col5" id="created_time"
                                            data-line="Date">{{ date_format(date_create($redeem->created_time), "d-M-Y h:i A")}}</td>
                                        <td class="tab-grid width_10 col6 text_center" data-line="Status">
                                            <input type="hidden" id="pstatus" value="{{$redeem->status}}"/>
                                            @if($redeem->status == 'Pending')
                                                <div class="status pending">Pending</div>
                                            @elseif($redeem->status == 'Approved')
                                                <div class="status excepted">Approved</div>
                                            @else
                                                <div class="status rejected">Rejected</div>
                                            @endif

                                        </td>
                                        <td class="tab-grid width_10 col7" data-line="Details">
                                            <div class="btn-group position_absolute">
                                                <button type="button" class="btn btn-primary btn-sm action-btn"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">Options
                                                </button>
                                                <button type="button" class="btn btn-primary btn-sm action-btn"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="true"><span class="caret"></span><span
                                                            class="sr-only">Toggle Dropdown</span></button>
                                                <ul class="dropdown-menu dropdown-menu-right grid-dropdown">
                                                    <li><a
                                                           href="#Modal_redeemMoreDetails" data-toggle="modal"
                                                           onclick="ShowRedeemDetails_admin(row_{{$redeem->id}});">
                                                            <i class="mdi mdi-more optiondrop_icon"></i>More
                                                        </a>
                                                    </li>
                                                    @if($redeem->status=='Pending')
                                                        <li>
                                                            <a id="{{$redeem->id}}"
                                                               onclick="ShowConformationPopupMsg('Are you sure you want to Approve this redeem request');"
                                                               class="btnApprove">
                                                                <i class="mdi mdi-format-list-checks optiondrop_icon approve_color"></i>Approve</a>
                                                        </li>
                                                        <li>
                                                            <a onclick="GetRowidforrejection({{$redeem->id}});"
                                                               class="btnReject border_none"
                                                               href="#Modal_Actionreasons" data-toggle="modal">
                                                                <i class="mdi mdi-comment-remove-outline optiondrop_icon reject_color"></i>Reject</a>
                                                        </li>
                                                    @endif
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
                                    <td colspan="9">
                                        <span class="list_no_record">< No Record Available ></span>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="Modal_redeemMoreDetails" class="modal fade" data-easein="bounceIn" role="dialog">
        <div class="modal-dialog survey_model">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onclick="GloCloseModel();">&times;</button>
                    <h4 class="modal-title">Account Details</h4>
                </div>
                <div class="modal-body light_bgcolor">
                    <table class="table table-bordered white_bgcolor">
                        <tbody>
                        <tr>
                            <td class="width_35 title-more">Account Holder :</td>
                            <td class="width_65" id="acc_holdername"> Pinku Kesharwani</td>
                        </tr>
                        <tr>
                            <td class="width_35 title-more">Account No. :</td>
                            <td class="width_65" id="acc_no">Allbd1245021259</td>
                        </tr>
                        <tr>
                            <td class="width_35 title-more">Bank :</td>
                            <td class="width_65" id="acc_bank">Allahabad Bank</td>
                        </tr>
                        <tr>
                            <td class="width_35 title-more">IFSC Code :</td>
                            <td class="width_65" id="acc_ifsccode">TIN-2341-09</td>
                        </tr>

                        <tr>
                            <td class="width_35 title-more">Amount :</td>
                            <td class="width_65" id="acc_redeemamount">100.00</td>
                        </tr>
                        <tr>
                            <td class="width_35 title-more">Date :</td>
                            <td class="width_65" id="redeem_date">12-Apr-2018</td>
                        </tr>
                        <tr>
                            <td class="width_35 title-more">Status :</td>
                            <td class="width_65">
                                <div class="status" id="redeem_status">Excepted</div>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="GloCloseModel();">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade-scale" id="Modal_Actionreasons1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog reason_model" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Reason For Rejection</h4>
                </div>

                {!! Form::open(['url' => 'redeem_reject', 'class' => '', 'id'=>'rejfrm']) !!}
                <div class="modal-body">
                    <input type="hidden" id="redreject" name="redid"/>
                    <textarea cols="1" rows="4" name="reject_reason" id="master_reasontxt"
                              class="form-control txt_resize"
                              placeholder="Enter Reason" data-validate="btn_lbreason" maxlength="700"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="btn_lbreason">
                        Submit
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
    <script>
        $('.btnApprove').click(function () {
            var id = $(this).attr('id');
            var append_url = '{{ url('/') }}' + "/redeem/" + id + "/approve";
            $('#ConfirmBtn').attr("href", append_url);
        });
        function GetRowidforrejection(row_id) {
            $('#redreject').val(row_id);
        }
        {{--$('.btnReject').click(function () {--}}
            {{--var id = $(this).attr('id');--}}
            {{--var append_url = '{{ url('/') }}' + "/ads/" + id + "/approve";--}}
            {{--$('#ConfirmBtn').attr("href", append_url);--}}
        {{--});--}}

        $(".btnReject").click(function () {
            $('#Modal_Actionreasons1').modal('show');
            var id = $(this).attr('id');
            var editurl = '{{ url('/') }}' + "/redeem_reject/" + id + "/reason";
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
        $(function () {
            $('form#rejfrm').submit(function () {
                /* var c = confirm("Are you sure to continue?");
                 return c;*/
                var reason_data = $('#master_reasontxt').val();
                var result = true;
                if (!Boolean(Requiredtxt("#master_reasontxt"))) {
                    result = false;
                }
                if (!result) {
                    return false;
                }
            });
        });
        function ShowRedeemDetails_admin(dis) {
            $('#acc_no').text($(dis).find('#ac_no').text());
            $('#acc_holdername').text($(dis).find('#ac_hold').text());
            $('#acc_bank').text($(dis).find('#bank').text());
            $('#acc_ifsccode').text($(dis).find('#ifsc').text());
            $('#acc_redeemamount').text($(dis).find('#amount').text());
            $('#redeem_date').text($(dis).find('#created_time').text());
            $('#redeem_status').text($(dis).find('#pstatus').val());
            if ($(dis).find('#pstatus').val() == 'Pending') {
                $('#redeem_status').addClass('pending');
            } else if ($(dis).find('#pstatus').val() == 'Approved') {
                $('#redeem_status').addClass('excepted');
            } else {
                $('#redeem_status').addClass('rejected');
            }
        }

    </script>

@stop