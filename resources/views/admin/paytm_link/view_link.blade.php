@extends('layout.master.admin_master')

@section('title', 'Paytm Link')

@section('head')

@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="advertiselist_block">
                <div class="dash_boxcontainner">
                    <div class="advertise_withhead margin0">
                        <div class="col-sm-6 col-md-4 col-xs-12 head_caption">Paytm Link</div>
                        <div class="btn-group gridbtn-group pull-right" id="TotalRecords">
                            {{--<a href="#" class="btn btn-primary create-add">Create Ad</a>--}}
                            </div>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered table-condensed table-hover table-responsive grid-table">
                            <tbody>
                            <tr class="tr-header globe-header-tr">
                                <th class="width_25">Link</th>
                                <th class="width_10">Action</th>
                            </tr>
                            </tbody>
                            <tbody id="ListContainerSection">
                            <tr>
                                <td class="tab-grid width_25 col1" data-line="Advertise Title">
                                    {{$paytm->link == null ? "-" : $paytm->link}}
                                </td>
                                <td id="{{$paytm->id}}" class="tab-grid width_10 col7" data-line="Action">
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
                                            <li><a id="{{$paytm->id}}" class="edit-link"><i
                                                            class="mdi mdi-account-edit optiondrop_icon"></i>Edit</a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(".edit-link").click(function () {
            $('#myModal').modal('show');
            $('.modal-title').html('Edit Link');
            $('.modal-body').html('<img height="50px" class="center-block" src="{{url('assets/img/loading.gif')}}"/>');
            var id = $(this).attr('id');
            var editurl = '{{ url('/') }}' + "/paytmlink/" + id + "/edit";
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: editurl,
                data: '{"data":"' + id + '"}',
                success: function (data) {
                    $('.modal-body').html(data);
                },
                error: function (xhr, status, error) {
                    $('.modal-body').html(xhr.responseText);
                    //$('.modal-body').html("Technical Error Occured!");
                }
            });
        });
    </script>
@stop