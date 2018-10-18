@extends('layout.master.admin_master')

@section('title', 'Admin Home')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="home_brics_row">
                <div class="col-sm-3">
                    <div class="brics brics_clr1">
                        <div class="icons_blk"><i class=" mdi mdi-account-multiple-outline"></i></div>
                        <div class="admin_brics_txt">Total Users</div>
                        <div class="brics_count">{{$reg_count}}</div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="brics brics_clr2">
                        <div class="icons_blk"><i class=" mdi mdi-account-multiple"></i></div>
                        <div class="admin_brics_txt">FREE Users

                        </div>
                        <div class="brics_count">{{$free_reg_count}}</div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="brics brics_clr3">
                        <div class="icons_blk"><i class=" mdi mdi-account-star"></i></div>
                        <div class="admin_brics_txt">Paid Users</div>
                        <div class="brics_count">{{$paid_reg_count}}</div>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="brics brics_clr4">
                        <div class="icons_blk"><i class=" mdi mdi-currency-inr"></i></div>
                        <div class="admin_brics_txt">Total Earning</div>
                        <div class="brics_count">{{$totalearning}}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xs-12">
                <div class="dash_boxcontainner">
                    <div class="basic_heading"><span class="dash_head_txt">Advertise Approval Request
                    </span>
                        <a href="{{url('ads')}}" class="btn btn-primary btn-xs pull-right">Show All</a>
                    </div>
                    <div class="panel-body dash_table_containner">
                        {{--<div class="no_record_found">--}}
                            {{--< No Record Found >--}}
                        {{--</div>--}}
                        <table class="table table-bordered table-condensed table-hover table-responsive grid-table">
                            <tbody>
                            <tr class="tr-header globe-header-tr">
                                <th class="width_25">Advertise Title</th>
                                <th class="width_12">Type</th>
                                <th class="width_12">Status</th>
                            </tr>
                            </tbody>
                            <tbody id="ListContainerSection">
                            @if(count($pending_ads)>0)
                                @foreach($pending_ads as $ad)
                                    <tr id="row_{{$ad->id}}">

                                        <td class="tab-grid width_25 col1" data-line="Advertise Title"
                                            id="admin_adverlist_title">
                                            {{$ad->ad_title}}
                                        </td>
                                        <td class="tab-grid width_12 col2"
                                            data-line="Type"
                                            id="admin_adverlist_category">{{isset($ad->ad_cat->category)?$ad->ad_cat->category:'-'}}</td>
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
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="3">
                                        <span class="list_no_record">< No Record Available ></span>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-xs-12">
                <div class="dash_boxcontainner">
                    <div class="basic_heading"><span class="dash_head_txt">Redeem Request List</span>
                        <a href="{{url('redeems')}}" class="btn btn-primary btn-xs pull-right">Show All</a>
                    </div>
                    <div class="panel-body dash_table_containner">
                        <table class="table table-bordered table-condensed table-hover table-responsive grid-table">
                            <tbody>

                            <tr class="tr-header globe-header-tr">
                                <th class="width_40 grid_title">Name</th>
                                <th class="width_20 grid_title">Amount</th>
                                <th class="width_20 grid_title">Date</th>
                                <th class="width_20">Status</th>
                            </tr>
                            </tbody>
                            <tbody id="ListContainerSection">
                            @if(count($redeems) > 0)
                                @foreach($redeems as $redeem)
                                    <tr>
                                        <td class="tab-grid width_60 col1"
                                            data-line="Name">{{$redeem->account_holder}}</td>
                                        <td class="tab-grid width_20 col2 text-right"
                                            data-line="Amount">{{$redeem->amount}}</td>
                                        <td class="tab-grid width_20 col3"
                                            data-line="Date">{{ date_format(date_create($redeem->created_time), "d-M-Y h:i A")}}</td>
                                        <td class="tab-grid width_20 col4" data-line="Status">
                                            @if($redeem->status == 'Pending')
                                                <div class="status pending">Pending</div>
                                            @elseif($redeem->status == 'Approved')
                                                <div class="status excepted">Approved</div>
                                            @else
                                                <div class="status rejected">Rejected</div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4">
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
    <div class="overlay_res" onclick="HideTranparent();"></div>
@stop