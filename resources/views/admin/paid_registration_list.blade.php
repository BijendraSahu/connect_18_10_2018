@extends('layout.master.admin_master')

@section('title', 'Registration List')

@section('head')

@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="advertiselist_block">
                <div class="dash_boxcontainner">

                    <div class="advertise_withhead margin0">
                        <div class="col-sm-6 col-md-4 col-xs-12 head_caption">Registration List</div>
                        <div class="btn-group gridbtn-group pull-right" id="TotalRecords"><span
                                    class="grid-counter-text">Counter</span><span
                                    class="btn btn-counter btn-sm">{{count($regs)}}</span></div>
                    </div>
                    <div class="panel-body">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                            <tr class="tr-header globe-header-tr">
                                <th class="width_10">Profile</th>
                                <th class="width_10">Ref.Code</th>
                                <th class="width_15">Name</th>
                                <th class="width_10">Gender</th>
                                <th class="width_12">Contact</th>
                                <th class="width_18">Email</th>
                                <th class="width_10">City</th>
                                <th class="width_10">Profession</th>
                                <th class="width_10">Total Earning</th>
                            </tr>
                            </thead>
                            <tbody id="ListContainerSection">
                            @if(count($regs)>0)
                                @foreach($regs as $ad)
                                    <tr>
                                        <td class="tab-grid width_25 col1" data-line="Advertise Title">
                                            {{--                                            <img src="{{url('').'/'.$ad->profile_pic}}" alt="profile">--}}
                                            <div class="post_imgblock_admin"><img
                                                        src="{{url('').'/'.$ad->profile_pic}}"/></div>
                                        </td>
                                        <td class="tab-grid width_25 col1" data-line="Advertise Title">
                                            {{$ad->rc}}
                                        </td>
                                        <td class="tab-grid width_25 col1" data-line="Advertise Title">
                                            {{$ad->timeline->name}}
                                        </td>
                                        <td class="tab-grid width_18 col2"
                                            data-line="Type">{{$ad->gender}}</td>
                                        <td class="tab-grid width_20 col3" data-line="City">{{$ad->contact}}</td>
                                        <td class="tab-grid width_20 col3" data-line="City">{{$ad->email}}</td>
                                        <td class="tab-grid width_20 col3" data-line="City">{{$ad->city}}</td>
                                        <td class="tab-grid width_20 col3" data-line="City">{{$ad->profession}}</td>
                                        <td class="tab-grid width_20 col3" data-line="City">
                                            <?php
                                            $com = new \App\com();
                                            $getTotalEarningsByPID = $com::select('Com')->where('ParentID', $ad->id)->get();
                                            // Sum up all earnings
                                            $total = 0;
                                            foreach ($getTotalEarningsByPID as $Ttl) {
                                                $total = $total + $Ttl->Com;
                                            }
                                            ?>
                                            {{$total}}
                                        </td>

                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8">
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
        $('.btnApprove').click(function () {
            var id = $(this).attr('id');
            $('#ConfirmBtn').html('<a class="popup_submitbtn conformation_bg a-design conformation_btn" href="{{ url('ads') }}/' + id +
                '/approve"> Yes</a>'
            );
        });
    </script>
@stop