@extends('layout.master.admin_master')

@section('title', 'Profile Update')

@section('content')
    <script src="{{url('js/login_validation.js')}}"></script>
    <div class="container">
        <div class="content_block form-group">
            <div class="com-block block_header">
                {!! Form::open(['url' => 'admin-profile', 'class' => '','id'=>'profile', 'method'=>'post', 'files'=>true]) !!}
                <div class="com-block content-body">

                    <div class="row">
                        {{--                <form action="{{url('profile/'.str_slug($timeline->fname." ".$timeline->lname).'/'.$user->id)}}">--}}

                        <input type="hidden" name="_token" class="token" value="{{ csrf_token() }}">
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="profile_block text-center">
                                <div class="profile-picture">
                                    <img src="{{url('').'/'.$user->profile_pic}}" id="_UserProfile" alt="UserProfile">
                                </div>
                                <div class="btn btn-info btn-sm profile-upload">
                                    <span class="mdi mdi-account-edit mdi-24px"></span>
                                    <input type="file" name="profile_pic" id="avatar_id" class="profile-upload-pic"
                                           onchange="ChangeSetImage(this, _UserProfile);">
                                </div>
                                <div class="btn btn-default btn-sm profile-upload">
                                    <span class="mdi mdi-close mdi-24px"></span>
                                </div>
                                <p style="display: none;">
                                    <small class="text-muted">Accepted formats are .jpg, .gif &amp; .png. Size &lt; 1MB.
                                        Best
                                        fit 198 X 120
                                    </small>
                                </p>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-8 pull-right">
                            <div class="profile_block">
                                <div class="row">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="mdi mdi-account mdi-16px"></i></span>
                                            {{--<input name="fname" placeholder="First Name" class="form-control fname"--}}
                                            {{--value="{{$timeline->fname}}" type="text"/>--}}
                                            {!! Form::text('name', $user->name, ['class' => 'form-control required','placeholder'=>' Name']) !!}


                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="mdi mdi-account mdi-16px"></i></span>
                                            {!! Form::select('profession', ['Doctor'=>'Doctor','Engineer'=>'Engineer','Enterprener'=>'Enterprener'], $user->designation,['class' => 'form-control requiredDD']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <div class="input-group">

                                            {!! Form::submit('Submit', ['class' => 'glo_button mdi']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--</form>--}}
                {!! Form::close() !!}
                <p id="err"></p>
            </div>
        </div>
    </div>
    <div id="myModal_TermsAccepted" class="connect_LBbox modal fade in" role="dialog" aria-hidden="false"></div>
@stop