@extends('layout.master.master')

@section('title', 'My Advertisement')

@section('head')
    <section class="notofication_containner">
        <div class="container">
            <div class="row">
                <div class="advertiselist_block">
                    <div class="dash_boxcontainner">
                        <div class="advertise_withhead margin0">
                            <div class="col-sm-6 col-md-4 col-xs-12 head_caption">Our Advertise List</div>
                            <div class="btn-group gridbtn-group pull-right" id="TotalRecords"><span class="grid-counter-text">Counter</span><span class="btn btn-counter btn-sm">5</span></div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-condensed table-hover table-responsive grid-table">
                                <tbody>
                                <tr class="tr-header globe-header-tr">
                                    <th class="width_25">Advertise Title</th>
                                    <th class="width_18">Type</th>
                                    <th class="width_20">City </th>
                                    <th class="width_15">Date</th>
                                    <th class="width_12">Status</th>
                                    <th class="width_10">Action</th>
                                </tr>
                                </tbody>
                                <tbody id="ListContainerSection">
                                <tr>
                                    <td class="tab-grid width_25 col1" data-line="Advertise Title">
                                        SPACIOUS 3 BED RESIDENCIES AT OUR FLAGSHIP PROJECT</td>
                                    <td class="tab-grid width_18 col2" data-line="Type">Property</td>
                                    <td class="tab-grid width_20 col3" data-line="City">Jabalpur</td>
                                    <td class="tab-grid width_15 col5" data-line="Date">12-Apr-2018</td>
                                    <td class="tab-grid width_12 col6 text_center" data-line="Status">
                                        <div class="status pending">Pending</div></td>
                                    <td class="tab-grid width_10 col7" data-line="Action">
                                        <div class="btn-group position_absolute">
                                            <button type="button" class="btn btn-primary btn-sm action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</button>
                                            <button type="button" class="btn btn-primary btn-sm action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                                            <ul class="dropdown-menu dropdown-menu-right grid-dropdown">
                                                <li><a data-toggle="modal" data-target="#Modal_ViewDetails_LatestNews"><i class="mdi mdi-more optiondrop_icon"></i>More</a></li>
                                                <li><a onclick="ShowConformationPopupMsg('Are You Sure To delete this record.');" class="border_none"><i class="mdi mdi-delete optiondrop_icon delete_color"></i>Delete</a></li></ul></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tab-grid width_25 col1" data-line="Advertise Title">
                                        SPACIOUS 3 BED RESIDENCIES AT OUR FLAGSHIP PROJECT</td>
                                    <td class="tab-grid width_18 col2" data-line="Type">Property</td>
                                    <td class="tab-grid width_20 col3" data-line="City">Jabalpur</td>
                                    <td class="tab-grid width_15 col5" data-line="Date">12-Apr-2018</td>
                                    <td class="tab-grid width_12 col6 text_center" data-line="Status" >
                                        <div class="status approved" href="#Modal_Actionreasons" data-toggle="modal">Approved</div>
                                    </td>
                                    <td class="tab-grid width_10 col7" data-line="Action">
                                        <div class="btn-group position_absolute">
                                            <button type="button" class="btn btn-primary btn-sm action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</button>
                                            <button type="button" class="btn btn-primary btn-sm action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                                            <ul class="dropdown-menu dropdown-menu-right grid-dropdown">
                                                <li><a data-toggle="modal" data-target="#Modal_ViewDetails_LatestNews" data-toggle="modal" data-target=""><i class="mdi mdi-more optiondrop_icon"></i>More</a></li>
                                                <li><a href="javascript:;" onclick="ShowConformationPopupMsg('Are You Sure To delete this record.');" class="border_none"><i class="mdi mdi-delete optiondrop_icon delete_color"></i>Delete</a></li></ul></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="tab-grid width_25 col1" data-line="Advertise Title">
                                        SPACIOUS 3 BED RESIDENCIES AT OUR FLAGSHIP PROJECT</td>
                                    <td class="tab-grid width_18 col2" data-line="Type">Property</td>
                                    <td class="tab-grid width_20 col3" data-line="City">Jabalpur</td>
                                    <td class="tab-grid width_15 col5" data-line="Date">12-Apr-2018</td>
                                    <td class="tab-grid width_12 col6 text_center" data-line="Status">
                                        <div class="status rejected">Rejected</div></td>
                                    <td class="tab-grid width_10 col7" data-line="Action">
                                        <div class="btn-group position_absolute">
                                            <button type="button" class="btn btn-primary btn-sm action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Options</button>
                                            <button type="button" class="btn btn-primary btn-sm action-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>
                                            <ul class="dropdown-menu dropdown-menu-right grid-dropdown">
                                                <li><a data-toggle="modal" data-target="#Modal_ViewDetails_LatestNews" data-toggle="modal" data-toggle="modal" data-target=""><i class="mdi mdi-more optiondrop_icon"></i>More</a></li>
                                                <li><a href="javascript:;"  onclick="ShowConformationPopupMsg('Are You Sure To delete this record.');"  class="border_none"><i class="mdi mdi-delete optiondrop_icon delete_color"></i>Delete</a></li></ul></div>


                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <!-- <div class="grid_pagination">
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
                             </div>-->
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
        $(document).ready(function () {
            $(function () {
                $('[data-toggle="tooltip"]').tooltip()
            });
        });
    </script>
@stop