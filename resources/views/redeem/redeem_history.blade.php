@extends('layout.master.master')

@section('title', 'Redeem History')

@section('head')
    <section class="notofication_containner">
        <div class="container">
            <div class="row">
                <div class="advertiselist_block">
                    <div class="dash_boxcontainner">
                        <div class="advertise_withhead margin0">
                            <div class="col-sm-6 col-md-4 col-xs-7 head_caption">Redeem History</div>
                            <div class="btn-group gridbtn-group pull-right" id="TotalRecords"><span
                                        class="grid-counter-text">Counter</span><span
                                        class="btn btn-counter btn-sm">{{count($redeems)}}</span></div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-condensed table-hover table-responsive grid-table">
                                <tbody>
                                <tr class="tr-header globe-header-tr">
                                    <th class="width_15">Account No.</th>
                                    <th class="width_15">Name</th>
                                    <th class="width_15">Bank</th>
                                    <th class="width_10">IFSC</th>
                                    <th class="width_8">Amount</th>
                                    <th class="width_13">Aadhar/PAN</th>
                                    <th class="width_12">Date</th>
                                    <th class="width_12">Status</th>
                                    <th class="width_10">Details</th>
                                </tr>
                                </tbody>
                                <tbody id="ListContainerSection">
                                @if(count($redeems) > 0)
                                    @foreach($redeems as $redeem)
                                        <tr id="row_{{$redeem->id}}">
                                            <td class="tab-grid width_15 col1" id="ac_no"
                                                data-line="Account No.">{{isset($redeem->ac_number)?$redeem->ac_number:'-'}}
                                            </td>
                                            <td class="tab-grid width_15 col2" id="ac_hold"
                                                data-line="Name">{{isset($redeem->account_holder)?$redeem->account_holder:'-'}}</td>
                                            <td class="tab-grid width_15 col3" id="bank"
                                                data-line="Bank">{{isset($redeem->bank)?$redeem->bank:'-'}}</td>
                                            <td class="tab-grid width_10 col3" id="ifsc"
                                                data-line="IFSC">{{isset($redeem->ifsc_code)?$redeem->ifsc_code:'-'}}</td>
                                            <td class="tab-grid width_8 col4 text_right" id="amount"
                                                data-line="Amount">{{isset($redeem->amount)?$redeem->amount:'-'}}</td>
                                            <td class="tab-grid width_13 col4 text_right" id="aadhar"
                                                data-line="Aadhar/PAN">
                                                {{isset($redeem->aadhar_pan)?$redeem->aadhar_pan:'-'}}</td>
                                            <td class="tab-grid width_12 col5" id="created_time"
                                                data-line="Date">{{ date_format(date_create($redeem->created_time), "d-M-Y h:i A")}}</td>
                                            <td class="tab-grid width_12 col6 text_center" data-line="Status">
                                                <input type="hidden" id="pstatus" value="{{$redeem->status}}"/>
                                                @if($redeem->status == 'Pending')
                                                    <div class="status pending">Pending</div>
                                                @elseif($redeem->status == 'Approved')
                                                    <div class="status excepted">Approved</div>
                                                @else
                                                    <div class="status rejected">Rejected</div>
                                                @endif

                                            </td>
                                            <td class="tab-grid width_10 text_center col7" data-line="Details">
                                                <a type="button" class="btn btn-primary btn-sm action-btn"
                                                   href="#Modal_redeemMoreDetails" data-toggle="modal"
                                                   onclick="ShowRedeemDetails_user(row_{{$redeem->id}});">
                                                    <i class="btn_icon mdi mdi-more i-tag"></i>More
                                                </a>
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
    </section>
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
    <script>
        function ShowRedeemDetails_user(dis) {
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