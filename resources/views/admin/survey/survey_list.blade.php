@extends('layout.master.admin_master')

@section('title', 'Admin Survey List')

@section('head')

@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="advertiselist_block">
                <div class="dash_boxcontainner">
                    <div class="advertise_withhead margin0">
                        <div class="col-sm-6 col-md-4 col-xs-12 head_caption">Our Survey List</div>
                        <div class="btn-group gridbtn-group pull-right" id="TotalRecords">
                            <a href="#" class="btn btn-primary create-add" onclick="create_survey()">Create Survey</a>
                            <span class="grid-counter-text">Counter</span><span
                                    class="btn btn-counter btn-sm">{{count($surveys)}}</span></div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-condensed table-hover table-responsive grid-table">
                            <tbody>
                            <tr class="tr-header globe-header-tr">
                                <th class="width_25">Survey Question</th>
                                <th class="width_12">Question Type</th>
                                <th class="width_12">Amt</th>
                                <th class="width_12">No of User</th>
                                <th class="width_12">Distributed Amt</th>
                                <th class="width_12">Option 1</th>
                                <th class="width_12">Option 2</th>
                                <th class="width_12">Option 3</th>
                                <th class="width_12">Option 4</th>
                                <th class="width_12">Statue</th>
                                <th class="width_10">Action</th>
                            </tr>
                            </tbody>
                            <tbody id="ListContainerSection">
                            @if(count($surveys)>0)
                                @foreach($surveys as $surevey)
                                    <tr>
                                        <td class="tab-grid width_25 col1" data-line="Advertise Title"
                                            title="{{$surevey->question}}" data-toggle="tooltip" data-placement="top">
                                            {{$surevey->question}}
                                        </td>
                                        <td class="tab-grid width_18 col2"
                                            data-line="Type">{{$surevey->question_type}}</td>
                                        <td class="tab-grid width_18 col2"
                                            data-line="Type">{{$surevey->survey_amount}}</td>
                                        <td class="tab-grid width_18 col2"
                                            data-line="Type">{{$surevey->no_of_user}}</td>
                                        <td class="tab-grid width_18 col2"
                                            data-line="Type">{{$surevey->total_distributed}}</td>
                                        <td class="tab-grid width_18 col2"
                                            data-line="Type">{{$surevey->option1}}</td>
                                        <td class="tab-grid width_18 col2"
                                            data-line="Type">{{$surevey->option2}}</td>
                                        <td class="tab-grid width_18 col2"
                                            data-line="Type">{{isset($surevey->option3)?$surevey->option3:'N/A'}}</td>
                                        <td class="tab-grid width_18 col2"
                                            data-line="Type">{{isset($surevey->optio4)?$surevey->option4:'N/A'}}</td> <td class="tab-grid width_18 col2"
                                            data-line="Type">@if($surevey->is_active == '0') <span for=""  class="label label-danger">Hidden</span> @else <span for="" class="label label-success">Showing</span> @endif</td>
                                        <td id="{{$surevey->id}}" class="tab-grid width_10 col7" data-line="Action">
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
                                                    {{--<li><a data-toggle="modal"--}}
                                                    {{--data-target="#Modal_ViewDetails_LatestNews"><i--}}
                                                    {{--class="mdi mdi-more optiondrop_icon"></i>More</a>--}}
                                                    {{--</li>--}}
                                                    <li><a id="{{$surevey->id}}" onclick="edit_survey(this)"
                                                           class="edit-ads"><i
                                                                    class="mdi mdi-account-edit optiondrop_icon"></i>Edit</a>
                                                    </li>
                                                    @if($surevey->is_active == '0')
                                                        <li>
                                                            <a id="{{$surevey->id}}" title="Approved"
                                                               onclick="ShowConformationPopupMsg('Are you sure you want to show this survey from website');"
                                                               class="border_none btnShow"><i
                                                                        class="mdi mdi-more optiondrop_icon"></i>Show</a>
                                                        </li>
                                                    @else
                                                        <li>
                                                            <a id="{{$surevey->id}}"
                                                               onclick="ShowConformationPopupMsg('Are you sure you want to hide this survey from website');"
                                                               class="border_none btnDelete"><i
                                                                        class="mdi mdi-delete optiondrop_icon delete_color"></i>Hide</a>
                                                        </li>
                                                    @endif
                                                </ul>
                                            </div>
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
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
        $('.btnDelete').click(function () {
            var id = $(this).attr('id');
            var append_url = '{{ url('/') }}' + "/survey/" + id + "/delete";
            $('#ConfirmBtn').attr("href", append_url);
        });
        function create_survey() {
            $('#myModal').modal('show');
            $('#modal_title').html('Add New Survey');
            $('#modal_body').html('<img height="50px" class="center-block" src="{{url('images/loading.gif')}}"/>');
            //alert(id);
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('survey/create') }}",
                success: function (data) {
                    $('#modal_body').html(data);
                },
                error: function (xhr, status, error) {
                    $('#modal_body').html(xhr.responseText);
                    //$('#modal_body').html("Technical Error Occured!");
                }
            });
        }
        function edit_survey(dis) {
            $('#myModal').modal('show');
            $('#modal_title').html('Edit Survey');
            $('#modal_body').html('<img height="50px" class="center-block" src="{{url('images/loading.gif')}}"/>');
            var id = $(dis).attr('id');
            var editurl = '{{ url('/') }}' + "/survey/" + id + "/edit";
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: editurl,
                data: '{"data":"' + id + '"}',
                success: function (data) {
                    $('#modal_body').html(data);
                },
                error: function (xhr, status, error) {
                    $('#modal_body').html(xhr.responseText);
                }
            });
        }

        $('.btnShow').click(function () {
            var id = $(this).attr('id');
            var append_url = '{{ url('/') }}' + "/survey/" + id + "/show";
            $('#ConfirmBtn').attr("href", append_url);
        });
    </script>
@stop