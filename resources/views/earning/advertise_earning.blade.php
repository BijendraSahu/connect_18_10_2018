@extends('layout.master.master')

@section('title', 'Advertisement Earning')

@section('head')
    <section class="notofication_containner">
        <div class="container">
            <div class="row">
                <div class="advertiselist_block">
                    <div class="dash_boxcontainner">
                        <div class="advertise_withhead margin0">
                            <div class="col-sm-6 col-md-4 col-xs-12 head_caption">Advertise Earning List</div>
                            <div class="btn-group gridbtn-group pull-right" id="TotalRecords"><span class="grid-counter-text">Counter</span><span class="btn btn-counter btn-sm">5</span></div>
                        </div>
                        <div class="panel-body">
                            <div class="com-block grid-option">
                                <div class="row">
                                    <div class="col-md-6 col-xs-5 grid_btnbox">
                                        <div class="btn-group" data-toggle="modal"  onclick="MoneyTransfer();">
                                            <button type="button" class="btn btn-primary btn-sm res_btn"><span class="mdi mdi-currency-inr"></span></button>
                                            <button type="button" class="btn btn-primary btn-sm res_btn">Redeem</button>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-7 pull-right grid_search_box">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search" id="txtsearch">
                                            <span class="btn btn-sm input-group-addon" onclick="ListingRefreshMe();" id="refresh"><i class="mdi mdi-refresh refresh_icon"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-bordered table-condensed table-hover table-responsive grid-table">
                                <tbody>
                                <tr class="tr-header globe-header-tr">
                                    <th class="width_5">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" onchange="GridHeaderCheck(this);" id="CheckboxgridHead"><span class="cr"><i class="cr-icon mdi mdi-check"></i></span></label>
                                        </div>
                                    </th>
                                    <th class="width_25 grid_title">Advertise Title</th>
                                    <th class="width_15 grid_title">Type</th>
                                    <th class="width_25">Details</th>
                                    <th class="width_12">Click Counts</th>
                                    <th class="width_18">Earn Amount</th>
                                </tr>
                                </tbody>
                                <tbody id="ListContainerSection">
                                <tr>
                                    <td class="width_5 tab-grid tab-select col_select" data-line="Select"><div class="checkbox"><label><input type="checkbox" name="checkboxChild" onchange="ChildGridEvent();" value="8"><span class="cr"><i class="cr-icon mdi mdi-check"></i></span></label></div></td>
                                    <td class="tab-grid width_25 col1 hyperlink"  href="#Modal_ViewDetails_LatestNews" data-toggle="modal" data-line="Advertise Title">SPACIOUS 3 BED RESIDENCIES AT OUR FLAGSHIP PROJECT</td>
                                    <td class="tab-grid width_15 col2" data-line="Type">Property</td>
                                    <td class="tab-grid width_25 col3" data-line="Details">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                                    <td class="tab-grid width_12 col4 text_center" data-line="Counts">30</td>
                                    <td class="tab-grid width_18 text_right col5" data-line="Amount">1,000.00</td>
                                </tr>
                                <tr>
                                    <td class="width_5 tab-grid tab-select col_select" data-line="Select"><div class="checkbox"><label><input type="checkbox" name="checkboxChild" onchange="ChildGridEvent();" value="8"><span class="cr"><i class="cr-icon mdi mdi-check"></i></span></label></div></td>
                                    <td class="tab-grid width_25 col1 hyperlink"  href="#Modal_ViewDetails_LatestNews" data-toggle="modal" data-line="Advertise Title">SPACIOUS 3 BED RESIDENCIES AT OUR FLAGSHIP PROJECT</td>
                                    <td class="tab-grid width_15 col2" data-line="Type">Property</td>
                                    <td class="tab-grid width_25 col3" data-line="Details">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                                    <td class="tab-grid width_12 col4 text_center" data-line="Counts">30</td>
                                    <td class="tab-grid width_18 text_right col5" data-line="Amount">1,000.00</td>
                                </tr>
                                <tr>
                                    <td class="width_5 tab-grid tab-select col_select" data-line="Select"><div class="checkbox"><label><input type="checkbox" name="checkboxChild" onchange="ChildGridEvent();" value="8"><span class="cr"><i class="cr-icon mdi mdi-check"></i></span></label></div></td>
                                    <td class="tab-grid width_25 col1 hyperlink"  href="#Modal_ViewDetails_LatestNews" data-toggle="modal" data-line="Advertise Title">SPACIOUS 3 BED RESIDENCIES AT OUR FLAGSHIP PROJECT</td>
                                    <td class="tab-grid width_15 col2" data-line="Type">Property</td>
                                    <td class="tab-grid width_25 col3" data-line="Details">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</td>
                                    <td class="tab-grid width_12 col4 text_center" data-line="Counts">30</td>
                                    <td class="tab-grid width_18 text_right col5" data-line="Amount">1,000.00</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="grid_pagination">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
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

    </script>
@stop