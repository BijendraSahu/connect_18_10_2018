@extends('layout.master.admin_master')

@section('title', 'Affiliates List')

@section('head')

@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="advertiselist_block">
                <div class="dash_boxcontainner">
                    <div class="advertise_withhead margin0">
                        <div class="col-sm-6 col-md-4 col-xs-12 head_caption">Affiliates List</div>
                        <div class="btn-group gridbtn-group pull-right" id="TotalRecords">
                            <a href="#" class="btn btn-primary create-aff">Create Affiliate</a>
                            <span
                                    class="grid-counter-text">Counter</span><span
                                    class="btn btn-counter btn-sm">{{count($affiliates)}}</span></div>
                    </div>
                    <div class="panel-body">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                            <tr class="tr-header globe-header-tr">
                                <th class="">S.No</th>
                                <th class="">Affiliate Links</th>
                                <th class="">Option</th>
                            </tr>
                            </thead>
                            <tbody id="ListContainerSection">
                            @php $counter=1; @endphp
                            @if(count($affiliates)>0)
                                @foreach($affiliates as $affiliate)
                                    <tr>

                                        <td class="tab-grid width_25 col1" data-line="Advertise Title">
                                            {{$counter++}}
                                        </td>
                                        <td class="tab-grid width_25 col1" data-line="Advertise Title">
                                            {{$affiliate->affiliate_link}}
                                        </td>
                                        <td class="tab-grid width_25 col1" data-line="Title">
                                            <a id="{{$affiliate->id}}" onclick="ShowConformationPopupMsg('Are you sure you want to delete this link');"
                                               class="border_none btnDelete"><i
                                                        class="mdi mdi-delete optiondrop_icon delete_color"></i>Delete</a>
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
    <script>
        $(".create-aff").click(function () {
            $('#myModal').modal('show');
            $('#modal_title').html('Create New Affiliate');
            $('#modal_body').html('<img height="50px" class="center-block" src="{{url('images/loading.gif')}}"/>');
            //alert(id);
            $.ajax({
                type: "GET",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('create_affiliates') }}",
                success: function (data) {
                    $('#modal_body').html(data);
//            $('#modelBtn').visible(disabled);
                },
                error: function (xhr, status, error) {
                    $('#modal_body').html(xhr.responseText);
                    //$('.modal-body').html("Technical Error Occured!");
                }
            });

        });

        $('.btnDelete').click(function () {
            var id = $(this).attr('id');
            var append_url = '{{ url('/') }}' + "/deleteAffiliate/" + id;
            $('#ConfirmBtn').attr("href", append_url);
        });

    </script>
@stop