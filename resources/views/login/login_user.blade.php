<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login / Registration Form</title>
    <!--Favicon-->
    <link rel="shortcut icon" type="images/png" href="{{ asset('images/fav.png') }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/materialdesignicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/my.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Animation.css') }}" rel="stylesheet">
    <link href="{{ asset('css/media.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/Datepicker.js') }}"></script>
    <script src="{{ asset('js/login_validation.js') }}"></script>
    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet"/>
    <style type="text/css">
        .errorClass {
            border: 1px solid red !important;
        }
    </style>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
    </script>
</head>
<body class="reg_body">
<div class="overlay_bg">
    <div class="container mob_pad0">

        <div class="col-sm-12 col-md-5" style="z-index: 10">
            <p id="err"></p>
            <div class="left_maintxt">
                <img src="{{ asset('images/logo.png') }}" alt="logo"/>
                <h1 class="text-white">ONE CAN CHANGE YOUR LIFE !!!</h1>
                <p class="subheading_para">Connecting-One.com is a unique Earning &amp; advertising platform that brings
                    together the socially conscious members &amp; Advertisers. Members are paid for adding new members
                    by chain based earning &amp; are paid each time they check the advertiser's promotion and
                    advertisers are able to send their message to the masses at a very low cost!</p>
                <div class="other_tabs">
                    <ul class="links_ul">
                        <li><a href="{{url('about')}}">About</a></li>
                        <li><a href="{{url('privacy')}}">Privacy</a></li>
                        <li><a href="{{url('faq')}}">Faq</a></li>
                        <li><a href="{{url('terms')}}">Terms & Condition</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-7 form_maincontainner">
            <div class="Regis_Login_Form">
                <div class="form_container">
                    <div class="list-position">
                        <ul class="nav login_nav_tabs">
                            <li class="" id="regis_nav_tabs"><a href="#register" data-toggle="tab"
                                                                aria-expanded="false">Register</a></li>
                            <li class="login-btn active" id="login_nav_tabs"><a href="#login" data-toggle="tab"
                                                                                aria-expanded="true">Login</a></li>
                        </ul>
                        <!--Tabs End-->
                    </div>
                    {{--                                        {!! Form::open(['url' => 'login', 'class' => 'form-horizontal', 'id'=>'frmLogin']) !!}--}}
                    <form action="{{url('login')}}" method="post" enctype="multipart/form-data"
                          class="form-horizontal" id="frmLogin">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="basic_outerblk login_block">
                            <div class="col-sm-12">
                                <div class="login_maintxt text-center">Login to your account</div>
                            </div>
                            <div class="row_block">
                                <div class="col-sm-6">
                                    <a class="btn btn-block btn-social btn-facebook">
                                        <i class="mdi mdi-facebook"></i> Sign in with Facebook
                                    </a>
                                </div>
                                <div class="col-sm-6">
                                    <a class="btn btn-block btn-social btn-google-plus">
                                        <i class="mdi mdi-google-plus"></i> Sign in with Google
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="mdi mdi-email-open-outline mdi-16px"></i></span>
                                        <input name="email_id" placeholder="Email Id"
                                               class="form-control required email" type="text"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="mdi mdi-lock mdi-16px"></i></span>
                                        <input name="password" placeholder="Password" class="form-control required"
                                               type="password"/>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="col-sm-6">--}}
                            {{--<div class="checkbox glo_checkbox_mainbox">--}}
                            {{--<label>--}}
                            {{--<input class="glo_checkbox" ty
                            pe="checkbox" id="CheckboxRemember">--}}
                            {{--<span class="cr"><i class="cr-icon mdi mdi-check"></i></span>--}}
                            {{--<span class="checkbox_txt"> Remember Password ?</span>--}}
                            {{--</label>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <div class="col-sm-6 pull-right">
                                <div class="forgot_link" data-toggle="modal" data-target="#myModal_ForgotPassword">
                                    Forgot
                                    Password ?
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="btn_block" style="margin-top: 20px;">
                                    {{--<button class="glo_button login_btn" type="submit" id="Login_submit"></button>--}}
                                    {!! Form::submit('Submit', ['class' => 'glo_button login_btn']) !!}

                                </div>
                            </div>
                        </div>
                        {{--                        {!! Form::close() !!}--}}
                    </form>
                    @if($errors->any())
                        <div role="alert" id="alert" class="alert alert-danger">{{$errors->first()}}</div>
                    @endif
                    {!! Form::open(['url' => 'register', 'id'=>'frmReg']) !!}
                    {{--                    <form id="frmReg" action="{{url('register')}}">--}}
                    <div class="basic_outerblk regis_block main_scale0">
                        <div class="col-sm-12">
                            <div class="login_maintxt">Register Now !!!</div>
                            <div class="login_subtxt">Be cool and join today. Meet millions & Earn tommorrow.</div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <p id="rcerr"></p>
                                <div class="input-group">
                                    <span class="input-group-addon"><i
                                                class="mdi mdi-account-switch mdi-16px"></i></span>
                                    <input placeholder="Referral Code" id="rcode" name="rc" class="form-control rcode"
                                           type="text"/>
                                    {{--                                    {!! Form::text('rc', null, ['class' => 'form-control input-sm required', 'placeholder'=>'Referal code']) !!}--}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="mdi mdi-account mdi-16px"></i></span>
                                    <input name="first_name" placeholder="First Name"
                                           class="form-control fname required"
                                           type="text"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="mdi mdi-account mdi-16px"></i></span>
                                    <input name="Last_name" placeholder="Last Name" class="form-control lname required"
                                           type="text"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="mdi mdi-email-open-outline mdi-16px"></i></span>
                                    <input name="email_id" placeholder="Email Id" class="form-control email_id required"
                                           type="text"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="mdi mdi-phone-log mdi-16px"></i></span>
                                    <input name="Mo_number" placeholder="Number" class="form-control contact required"
                                           type="text"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i
                                                class="mdi mdi-calendar-check mdi-16px"></i></span>
                                    <input name="Date_of_birth" placeholder="Date of Birth"
                                           class="form-control dtp date required vRequiredText"
                                           id="date_of_birth required"
                                           type="text"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="mdi mdi-lock mdi-16px"></i></span>
                                    <input name="password" placeholder="Password"
                                           class="form-control password1 required"
                                           type="password"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i
                                                class="mdi mdi-format-list-bulleted mdi-16px"></i></span>
                                    {!! Form::select('country', $country, null,['class' => 'form-control country requiredDD']) !!}
                                    {{--<select class="form-control selectpicker" id="country">--}}
                                    {{--<option value="country" disabled selected>Country</option>--}}
                                    {{--<option value="AFG">Afghanistan</option>--}}
                                    {{--<option value="ALA">�land Islands</option>--}}
                                    {{--<option value="ALB">Albania</option>--}}
                                    {{--<option value="DZA">Algeria</option>--}}
                                    {{--<option value="ASM">American Samoa</option>--}}
                                    {{--<option value="AND">Andorra</option>--}}
                                    {{--<option value="AGO">Angola</option>--}}
                                    {{--<option value="AIA">Anguilla</option>--}}
                                    {{--<option value="ATA">Antarctica</option>--}}
                                    {{--<option value="ATG">Antigua and Barbuda</option>--}}
                                    {{--<option value="ARG">Argentina</option>--}}
                                    {{--<option value="ARM">Armenia</option>--}}
                                    {{--<option value="ABW">Aruba</option>--}}
                                    {{--<option value="AUS">Australia</option>--}}
                                    {{--<option value="AUT">Austria</option>--}}
                                    {{--<option value="AZE">Azerbaijan</option>--}}
                                    {{--<option value="BHS">Bahamas</option>--}}
                                    {{--<option value="BHR">Bahrain</option>--}}
                                    {{--<option value="BGD">Bangladesh</option>--}}
                                    {{--<option value="BRB">Barbados</option>--}}
                                    {{--<option value="BLR">Belarus</option>--}}
                                    {{--<option value="BEL">Belgium</option>--}}
                                    {{--<option value="BLZ">Belize</option>--}}
                                    {{--<option value="BEN">Benin</option>--}}
                                    {{--<option value="BMU">Bermuda</option>--}}
                                    {{--<option value="BTN">Bhutan</option>--}}
                                    {{--<option value="BOL">Bolivia, Plurinational State of</option>--}}
                                    {{--<option value="BES">Bonaire, Sint Eustatius and Saba</option>--}}
                                    {{--<option value="BIH">Bosnia and Herzegovina</option>--}}
                                    {{--<option value="BWA">Botswana</option>--}}
                                    {{--<option value="BVT">Bouvet Island</option>--}}
                                    {{--<option value="BRA">Brazil</option>--}}
                                    {{--<option value="IOT">British Indian Ocean Territory</option>--}}
                                    {{--<option value="BRN">Brunei Darussalam</option>--}}
                                    {{--<option value="BGR">Bulgaria</option>--}}
                                    {{--<option value="BFA">Burkina Faso</option>--}}
                                    {{--<option value="BDI">Burundi</option>--}}
                                    {{--<option value="KHM">Cambodia</option>--}}
                                    {{--<option value="CMR">Cameroon</option>--}}
                                    {{--<option value="CAN">Canada</option>--}}
                                    {{--<option value="CPV">Cape Verde</option>--}}
                                    {{--<option value="CYM">Cayman Islands</option>--}}
                                    {{--<option value="CAF">Central African Republic</option>--}}
                                    {{--<option value="TCD">Chad</option>--}}
                                    {{--<option value="CHL">Chile</option>--}}
                                    {{--<option value="CHN">China</option>--}}
                                    {{--<option value="CXR">Christmas Island</option>--}}
                                    {{--<option value="CCK">Cocos (Keeling) Islands</option>--}}
                                    {{--<option value="COL">Colombia</option>--}}
                                    {{--<option value="COM">Comoros</option>--}}
                                    {{--<option value="COG">Congo</option>--}}
                                    {{--<option value="COD">Congo, the Democratic Republic of the</option>--}}
                                    {{--<option value="COK">Cook Islands</option>--}}
                                    {{--<option value="CRI">Costa Rica</option>--}}
                                    {{--<option value="CIV">C�te d'Ivoire</option>--}}
                                    {{--<option value="HRV">Croatia</option>--}}
                                    {{--<option value="CUB">Cuba</option>--}}
                                    {{--<option value="CUW">Cura�ao</option>--}}
                                    {{--<option value="CYP">Cyprus</option>--}}
                                    {{--<option value="CZE">Czech Republic</option>--}}
                                    {{--<option value="DNK">Denmark</option>--}}
                                    {{--<option value="DJI">Djibouti</option>--}}
                                    {{--<option value="DMA">Dominica</option>--}}
                                    {{--<option value="DOM">Dominican Republic</option>--}}
                                    {{--<option value="ECU">Ecuador</option>--}}
                                    {{--<option value="EGY">Egypt</option>--}}
                                    {{--<option value="SLV">El Salvador</option>--}}
                                    {{--<option value="GNQ">Equatorial Guinea</option>--}}
                                    {{--<option value="ERI">Eritrea</option>--}}
                                    {{--<option value="EST">Estonia</option>--}}
                                    {{--<option value="ETH">Ethiopia</option>--}}
                                    {{--<option value="FLK">Falkland Islands (Malvinas)</option>--}}
                                    {{--<option value="FRO">Faroe Islands</option>--}}
                                    {{--<option value="FJI">Fiji</option>--}}
                                    {{--<option value="FIN">Finland</option>--}}
                                    {{--<option value="FRA">France</option>--}}
                                    {{--<option value="GUF">French Guiana</option>--}}
                                    {{--<option value="PYF">French Polynesia</option>--}}
                                    {{--<option value="ATF">French Southern Territories</option>--}}
                                    {{--<option value="GAB">Gabon</option>--}}
                                    {{--<option value="GMB">Gambia</option>--}}
                                    {{--<option value="GEO">Georgia</option>--}}
                                    {{--<option value="DEU">Germany</option>--}}
                                    {{--<option value="GHA">Ghana</option>--}}
                                    {{--<option value="GIB">Gibraltar</option>--}}
                                    {{--<option value="GRC">Greece</option>--}}
                                    {{--<option value="GRL">Greenland</option>--}}
                                    {{--<option value="GRD">Grenada</option>--}}
                                    {{--<option value="GLP">Guadeloupe</option>--}}
                                    {{--<option value="GUM">Guam</option>--}}
                                    {{--<option value="GTM">Guatemala</option>--}}
                                    {{--<option value="GGY">Guernsey</option>--}}
                                    {{--<option value="GIN">Guinea</option>--}}
                                    {{--<option value="GNB">Guinea-Bissau</option>--}}
                                    {{--<option value="GUY">Guyana</option>--}}
                                    {{--<option value="HTI">Haiti</option>--}}
                                    {{--<option value="HMD">Heard Island and McDonald Islands</option>--}}
                                    {{--<option value="VAT">Holy See (Vatican City State)</option>--}}
                                    {{--<option value="HND">Honduras</option>--}}
                                    {{--<option value="HKG">Hong Kong</option>--}}
                                    {{--<option value="HUN">Hungary</option>--}}
                                    {{--<option value="ISL">Iceland</option>--}}
                                    {{--<option value="IND">India</option>--}}
                                    {{--<option value="IDN">Indonesia</option>--}}
                                    {{--<option value="IRN">Iran, Islamic Republic of</option>--}}
                                    {{--<option value="IRQ">Iraq</option>--}}
                                    {{--<option value="IRL">Ireland</option>--}}
                                    {{--<option value="IMN">Isle of Man</option>--}}
                                    {{--<option value="ISR">Israel</option>--}}
                                    {{--<option value="ITA">Italy</option>--}}
                                    {{--<option value="JAM">Jamaica</option>--}}
                                    {{--<option value="JPN">Japan</option>--}}
                                    {{--<option value="JEY">Jersey</option>--}}
                                    {{--<option value="JOR">Jordan</option>--}}
                                    {{--<option value="KAZ">Kazakhstan</option>--}}
                                    {{--<option value="KEN">Kenya</option>--}}
                                    {{--<option value="KIR">Kiribati</option>--}}
                                    {{--<option value="PRK">Korea, Democratic People's Republic of</option>--}}
                                    {{--<option value="KOR">Korea, Republic of</option>--}}
                                    {{--<option value="KWT">Kuwait</option>--}}
                                    {{--<option value="KGZ">Kyrgyzstan</option>--}}
                                    {{--<option value="LAO">Lao People's Democratic Republic</option>--}}
                                    {{--<option value="LVA">Latvia</option>--}}
                                    {{--<option value="LBN">Lebanon</option>--}}
                                    {{--<option value="LSO">Lesotho</option>--}}
                                    {{--<option value="LBR">Liberia</option>--}}
                                    {{--<option value="LBY">Libya</option>--}}
                                    {{--<option value="LIE">Liechtenstein</option>--}}
                                    {{--<option value="LTU">Lithuania</option>--}}
                                    {{--<option value="LUX">Luxembourg</option>--}}
                                    {{--<option value="MAC">Macao</option>--}}
                                    {{--<option value="MKD">Macedonia, the former Yugoslav Republic of</option>--}}
                                    {{--<option value="MDG">Madagascar</option>--}}
                                    {{--<option value="MWI">Malawi</option>--}}
                                    {{--<option value="MYS">Malaysia</option>--}}
                                    {{--<option value="MDV">Maldives</option>--}}
                                    {{--<option value="MLI">Mali</option>--}}
                                    {{--<option value="MLT">Malta</option>--}}
                                    {{--<option value="MHL">Marshall Islands</option>--}}
                                    {{--<option value="MTQ">Martinique</option>--}}
                                    {{--<option value="MRT">Mauritania</option>--}}
                                    {{--<option value="MUS">Mauritius</option>--}}
                                    {{--<option value="MYT">Mayotte</option>--}}
                                    {{--<option value="MEX">Mexico</option>--}}
                                    {{--<option value="FSM">Micronesia, Federated States of</option>--}}
                                    {{--<option value="MDA">Moldova, Republic of</option>--}}
                                    {{--<option value="MCO">Monaco</option>--}}
                                    {{--<option value="MNG">Mongolia</option>--}}
                                    {{--<option value="MNE">Montenegro</option>--}}
                                    {{--<option value="MSR">Montserrat</option>--}}
                                    {{--<option value="MAR">Morocco</option>--}}
                                    {{--<option value="MOZ">Mozambique</option>--}}
                                    {{--<option value="MMR">Myanmar</option>--}}
                                    {{--<option value="NAM">Namibia</option>--}}
                                    {{--<option value="NRU">Nauru</option>--}}
                                    {{--<option value="NPL">Nepal</option>--}}
                                    {{--<option value="NLD">Netherlands</option>--}}
                                    {{--<option value="NCL">New Caledonia</option>--}}
                                    {{--<option value="NZL">New Zealand</option>--}}
                                    {{--<option value="NIC">Nicaragua</option>--}}
                                    {{--<option value="NER">Niger</option>--}}
                                    {{--<option value="NGA">Nigeria</option>--}}
                                    {{--<option value="NIU">Niue</option>--}}
                                    {{--<option value="NFK">Norfolk Island</option>--}}
                                    {{--<option value="MNP">Northern Mariana Islands</option>--}}
                                    {{--<option value="NOR">Norway</option>--}}
                                    {{--<option value="OMN">Oman</option>--}}
                                    {{--<option value="PAK">Pakistan</option>--}}
                                    {{--<option value="PLW">Palau</option>--}}
                                    {{--<option value="PSE">Palestinian Territory, Occupied</option>--}}
                                    {{--<option value="PAN">Panama</option>--}}
                                    {{--<option value="PNG">Papua New Guinea</option>--}}
                                    {{--<option value="PRY">Paraguay</option>--}}
                                    {{--<option value="PER">Peru</option>--}}
                                    {{--<option value="PHL">Philippines</option>--}}
                                    {{--<option value="PCN">Pitcairn</option>--}}
                                    {{--<option value="POL">Poland</option>--}}
                                    {{--<option value="PRT">Portugal</option>--}}
                                    {{--<option value="PRI">Puerto Rico</option>--}}
                                    {{--<option value="QAT">Qatar</option>--}}
                                    {{--<option value="REU">R�union</option>--}}
                                    {{--<option value="ROU">Romania</option>--}}
                                    {{--<option value="RUS">Russian Federation</option>--}}
                                    {{--<option value="RWA">Rwanda</option>--}}
                                    {{--<option value="BLM">Saint Barth�lemy</option>--}}
                                    {{--<option value="SHN">Saint Helena, Ascension and Tristan da Cunha--}}
                                    {{--</option>--}}
                                    {{--<option value="KNA">Saint Kitts and Nevis</option>--}}
                                    {{--<option value="LCA">Saint Lucia</option>--}}
                                    {{--<option value="MAF">Saint Martin (French part)</option>--}}
                                    {{--<option value="SPM">Saint Pierre and Miquelon</option>--}}
                                    {{--<option value="VCT">Saint Vincent and the Grenadines</option>--}}
                                    {{--<option value="WSM">Samoa</option>--}}
                                    {{--<option value="SMR">San Marino</option>--}}
                                    {{--<option value="STP">Sao Tome and Principe</option>--}}
                                    {{--<option value="SAU">Saudi Arabia</option>--}}
                                    {{--<option value="SEN">Senegal</option>--}}
                                    {{--<option value="SRB">Serbia</option>--}}
                                    {{--<option value="SYC">Seychelles</option>--}}
                                    {{--<option value="SLE">Sierra Leone</option>--}}
                                    {{--<option value="SGP">Singapore</option>--}}
                                    {{--<option value="SXM">Sint Maarten (Dutch part)</option>--}}
                                    {{--<option value="SVK">Slovakia</option>--}}
                                    {{--<option value="SVN">Slovenia</option>--}}
                                    {{--<option value="SLB">Solomon Islands</option>--}}
                                    {{--<option value="SOM">Somalia</option>--}}
                                    {{--<option value="ZAF">South Africa</option>--}}
                                    {{--<option value="SGS">South Georgia and the South Sandwich Islands--}}
                                    {{--</option>--}}
                                    {{--<option value="SSD">South Sudan</option>--}}
                                    {{--<option value="ESP">Spain</option>--}}
                                    {{--<option value="LKA">Sri Lanka</option>--}}
                                    {{--<option value="SDN">Sudan</option>--}}
                                    {{--<option value="SUR">Suriname</option>--}}
                                    {{--<option value="SJM">Svalbard and Jan Mayen</option>--}}
                                    {{--<option value="SWZ">Swaziland</option>--}}
                                    {{--<option value="SWE">Sweden</option>--}}
                                    {{--<option value="CHE">Switzerland</option>--}}
                                    {{--<option value="SYR">Syrian Arab Republic</option>--}}
                                    {{--<option value="TWN">Taiwan, Province of China</option>--}}
                                    {{--<option value="TJK">Tajikistan</option>--}}
                                    {{--<option value="TZA">Tanzania, United Republic of</option>--}}
                                    {{--<option value="THA">Thailand</option>--}}
                                    {{--<option value="TLS">Timor-Leste</option>--}}
                                    {{--<option value="TGO">Togo</option>--}}
                                    {{--<option value="TKL">Tokelau</option>--}}
                                    {{--<option value="TON">Tonga</option>--}}
                                    {{--<option value="TTO">Trinidad and Tobago</option>--}}
                                    {{--<option value="TUN">Tunisia</option>--}}
                                    {{--<option value="TUR">Turkey</option>--}}
                                    {{--<option value="TKM">Turkmenistan</option>--}}
                                    {{--<option value="TCA">Turks and Caicos Islands</option>--}}
                                    {{--<option value="TUV">Tuvalu</option>--}}
                                    {{--<option value="UGA">Uganda</option>--}}
                                    {{--<option value="UKR">Ukraine</option>--}}
                                    {{--<option value="ARE">United Arab Emirates</option>--}}
                                    {{--<option value="GBR">United Kingdom</option>--}}
                                    {{--<option value="USA">United States</option>--}}
                                    {{--<option value="UMI">United States Minor Outlying Islands</option>--}}
                                    {{--<option value="URY">Uruguay</option>--}}
                                    {{--<option value="UZB">Uzbekistan</option>--}}
                                    {{--<option value="VUT">Vanuatu</option>--}}
                                    {{--<option value="VEN">Venezuela, Bolivarian Republic of</option>--}}
                                    {{--<option value="VNM">Viet Nam</option>--}}
                                    {{--<option value="VGB">Virgin Islands, British</option>--}}
                                    {{--<option value="VIR">Virgin Islands, U.S.</option>--}}
                                    {{--<option value="WLF">Wallis and Futuna</option>--}}
                                    {{--<option value="ESH">Western Sahara</option>--}}
                                    {{--<option value="YEM">Yemen</option>--}}
                                    {{--<option value="ZMB">Zambia</option>--}}
                                    {{--<option value="ZWE">Zimbabwe</option>--}}
                                    {{--</select>--}}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="mdi mdi-format-list-checks mdi-16px"></i></span>
                                    <input name="city" placeholder="City" class="form-control city required"
                                           type="text"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="radio">
                                <input id="radio-1" value="male" class="gender" name="gender_radio" type="radio"
                                       checked>
                                <label for="radio-1" class="radio-label">Male</label>
                                {{--                                {{ Form::radio('gender', 'Male', true, ['class' => 'radio-label gender']) }}Male--}}
                            </div>

                            <div class="radio">
                                <input id="radio-2" value="female" class="gender" name="gender_radio" type="radio">
                                <label for="radio-2" class="radio-label">Female</label>
                                {{--                                {{ Form::radio('gender', 'Female', ['class' => 'radio-label gender']) }}Female--}}
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <!--  <span class="input-group-addon"><i class="mdi mdi-calendar-check"></i></span>
                                      <input name="city" placeholder="City" class="form-control" type="text" />-->
                                    <!-- <input type="radio" id="featured-1" name="featured" class="glo_radio" checked>
                                     <label for="featured-1">Mail</label>
                                     <input type="radio" id="featured-2" name="featured" class="glo_radio">
                                     <label for="featured-2">Femail</label>-->

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="btn_block">
                                <button class="glo_button mdi" onclick="submitForm()"
                                        id="Registration_submit"></button>
                            </div>
                        </div>
                    </div>
                    {{--</form>--}}
                    {!! Form::close() !!}
                </div>
                <!--  <button class="forgot_password" data-toggle="modal" data-target="#myModal_ForgotPassword" value="forgot"></button>
                  <button class="otp_form" data-toggle="modal" data-target="#myModal_varify_otp_email" value="Oto Click"></button>
             -->
            </div>
        </div>
    </div>
</div>

<div id="particles-js" class="canvas_block"></div>
</body>
<script src="{{ asset('js/Social_Connectivity.js') }}"></script>
<!-- Modal Forgot Password-->
<div id="myModal_ForgotPassword" class="connect_LBbox modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog forgotpass_lb">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="closeForgotLbox();">×</button>
                <h4 class="modal-title">FORGOT PASSWORD ?</h4>
            </div>
            <div class="modal-body">
                <div class="logindiv" style="border: none">
                    <input type="text" class="form-control forgot_txt" placeholder="Please give us your email id"
                           id="txtFemailid" autocomplete="off" data-validate="TT_btnforgotpass">
                    <div class="glo_validateemail">
                        Enter valid emailid
                    </div>
                    <!-- <div class="validatelightboxfinal">
                         * Required
                     </div>-->
                    <div class="forgot_icon mdi mdi-email-open-outline"></div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" class="btn btn-primary" id="TT_btnforgotpass">Send</button>
            </div>
        </div>

    </div>
</div>
<div id="myModal_varify_otp_email" class=" connect_LBbox modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog forgotpass_lb">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" onclick="closeForgotLbox();">×</button>
                <h4 class="modal-title">OTP VERIFICATION</h4>
            </div>
            <div class="modal-body">
                <div class="logindiv" style="border: none">
                    <input type="text" class="form-control forgot_txt" placeholder="Please enter otp" id="txtotp"
                           autocomplete="off" data-validate="TT_btnforgotpass">
                    <div class="forgot_icon mdi mdi-account-check"></div>
                </div>
                <!--  <div class="logindiv" style="border: none">
                      <input type="text" class="form-control forgot_txt" placeholder="Please enter email id"  id="txtvarify_email" autocomplete="off" data-validate="TT_btnforgotpass">
                      <div class="forgot_icon mdi mdi-email-open-outline"></div>
                  </div>-->
                <p class="statusMsg"></p>
            </div>
            <div class="modal-footer text-center">
                <a href="#">
                    <button type="button" class="btn btn-primary" onclick="submitotpForm()" id="varify_otp_email">
                        Validate OTP
                    </button>
                </a>
                <button type="button" class="btn btn-default" id="resend_otp">Resend OTP</button>
            </div>
        </div>

    </div>
</div>
<div class="Globalloading" id="main_pageloader">
    <div class="Globalloading-center">
        <div class="Glo-center-absolute">
            <div class="object loadblk_one">
            </div>
            <div class="object loadblk_two">
            </div>
            <div class="object loadblk_three">
            </div>
            <div class="object loadblk_four">
            </div>
        </div>
    </div>
</div>
<script src="{{ url('/js/bootstrap-datepicker.js') }}"></script>
<script type="text/javascript">
    function checkrefcode() {
        var x = document.getElementById("fname");
        x.value = x.value.toUpperCase();
    }

    function closeForgotLbox() {
        $('#txtFemailid').val('');
        $("#txtFemailid").css("border", "solid 1px #ccc");
    }

    function submitotpForm() {
        var txtotp = $('#txtotp').val();
        var formData = '_token=' + $('.token').val();
//        alert(gender);
        if (txtotp.trim() == '') {
            alert('Please enter otp');
            $('#txtotp').focus();
            return false;
        } else {
            $.ajax({
                type: "POST",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('verify_otp') }}",
//                data: '{"data":"' + endid + '"}',
                data: '{"formData":"' + formData + '", "txtotp":"' + txtotp + '"}',
                success: function (data) {
                    if (data == 'ok') {
                        console.log(data);
                        $('#txtotp').val('');
                        $('.statusMsg').html('<span style="color:green;">You have verified successfully...you will be redirected in 3 seconds</p>');
                        setTimeout(function () {
                            window.location.href = "{{url('profiles')}}"
                            {{--                                window.location.href = "{{url('coming_soon')}}"--}}
                        }, 3000);
                    } else if (data == 'Incorrect') {
                        $('#txtotp').val('');
                        $('.statusMsg').html('<span style="color:red;">Incorrect otp...Please enter correct otp</span>');
                    }
                },
                error: function (xhr, status, error) {
//                    alert('xhr.responseText');
                    $('#err').html(xhr.responseText);
                }
            });
        }
    }

    function submitForm() {
        var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        var rc = $('.rcode').val();
        var fname = $('.fname').val();
        var lname = $('.lname').val();
        var email = $('.email_id').val();
        var contact = $('.contact').val();
        var dob = $('.dtp').val();
        var password = $('.password1').val();
        var country = $('.country').val();
        var city = $('.city').val();
        var gender = $('input[name=gender_radio]:checked').val();
        var formData = '_token=' + $('.token').val();
//        alert(gender);
        if (email.trim() == '') {
            return false;
        } else if (email.trim() != '' && !reg.test(email)) {
//            alert('Please enter valid email.');
//            $('#inputEmail').focus();
            return false;
        } else if (fname.trim() == '') {
//            alert('Please enter your fname.');
//            $('#inputMessage').focus();
            return false;
        } else if (lname.trim() == '') {
//            alert('Please enter your last name.');
//            $('#inputMessage').focus();
            return false;
        }
        else if (contact.trim() == '') {
//            alert('Please enter your contact.');
//            $('#inputMessage').focus();
            return false;
        } else if (dob.trim() == '') {
//            alert('Please enter your dob.');
//            $('#inputMessage').focus();
            return false;
        } else if (password.trim() == '') {
//            alert('Please enter your pass.');
//            $('#inputMessage').focus();
            return false;
        } else if (country.trim() == '') {
//            alert('Please enter your country.');
//            $('#inputMessage').focus();
            return false;
        } else if (city.trim() == '') {
//            alert('Please enter your city.');
//            $('#inputMessage').focus();
            return false;
        }
        else {
            $.ajax({
                type: "POST",
                contentType: "application/json; charset=utf-8",
                url: "{{ url('postreg') }}",
//                data: '{"data":"' + endid + '"}',
                data: '{"formData":"' + formData + '", "rc":"' + rc + '", "fname":"' + fname + '", "lname":"' + lname + '", "email":"' + email + '", "contact":"' + contact + '", "dob":"' + dob + '", "password":"' + password + '", "country":"' + country + '", "city":"' + city + '", "gender":"' + gender + '"}',
                success: function (data) {
                    $('#err').html(data);
                },
                error: function (xhr, status, error) {
//                    alert('xhr.responseText');
                    $('#err').html(xhr.responseText);
                }
            });
        }
    }

    /********Check Refferal Code Invalid***********/
    $(document).ready(function () {
        $('#rcode').focusout(function () {
            var txt_val = $(this).val();
            var formData = '_token=' + $('.token').val();
            if (txt_val.trim() == '') {
                $('#rcerr').html('');
                $(".glo_button").removeAttr("disabled");
            } else {
                $.ajax({
                    type: "POST",
                    contentType: "application/json; charset=utf-8",
                    url: "{{ url('checkrc') }}",
//                data: '{"data":"' + endid + '"}',
                    data: '{"formData":"' + formData + '", "rc":"' + txt_val + '"}',
                    success: function (data) {
                        if (data == 'ok') {
//                            $('#rcerr').html('<span style="color:green;">Password changed successfully</p>');
                            $('#rcerr').html('<span style="color:red;">You have entered invalid Referral code</span>');
                            $('.glo_button').attr("disabled", "disabled");
                        } else if (data == 'already') {
                            $('#rcerr').html('');
                            $(".glo_button").removeAttr("disabled");
                        }
                    },
                    error: function (xhr, status, error) {
//                    alert('xhr.responseText');
                        $('#rcerr').html(xhr.responseText);
                    }
                });
            }
        });
        /********Check Refferal Code Invalid***********/

        /*date Picker*/
        $('#date_of_birth').datepicker({
            format: 'dd-M-yyyy', autoclose: true
        }).on('changeDate', function (event) {
            if ($('#date_of_birth').val() != "") {
                $("#date_of_birth").removeClass('vErrorRed');
            }
        });
        /* $("form").submit(function (event) {

         var $btn = $(document.activeElement);
         if ($btn.attr('formnovalidate') != 'formnovalidate')
         var checkval=validate(this);
         if(checkval) {
         btnChange();
         $('#main_pageloader').show();
         }
         });*/
        /* Button Click*/
        $(function () {
            /*$("#Registration_submit2").click(function () {

             $("#Registration_submit").addClass("onclic", 250, validate);

             /!* var $btn = $(document.activeElement);
             if ($btn.attr('formnovalidate') != 'formnovalidate')
             return validate(this);*!/
             // validate(frmReg);
             var $btn = $(document.activeElement);
             if ($btn.attr('formnovalidate') != 'formnovalidate')
             return validate(this);
             btnChange();
             $('#main_pageloader').show();
             });*/

            /* function btnChange() {
             setTimeout(function () {
             $("#Registration_submit").removeClass("onclic");
             $("#Registration_submit").addClass("mdi-check", 450, callback);
             $('#main_pageloader').hide();
             $('#myModal_varify_otp_email').show();
             }, 2250);
             }

             function callback() {
             setTimeout(function () {
             $("#Registration_submit").removeClass("mdi-check");

             }, 1250);
             }*/
        });
        /*Navigation Page Block*/
        $('#regis_nav_tabs').click(function () {
            $('.login_block').addClass('main_scale0');
            $('.regis_block').removeClass('main_scale0');
        });
        $('#login_nav_tabs').click(function () {
            $('.login_block').removeClass('main_scale0');
            $('.regis_block').addClass('main_scale0');
        });
    });
    $(function () {
        $('.dtp').datepicker({
            format: "dd-MM-yyyy",
            maxViewMode: 2,
            todayBtn: "linked",
            daysOfWeekHighlighted: "0",
            autoclose: true,
            todayHighlight: true
        });
    });
</script>
<script>
    $(document).ready(function () {
        window.setTimeout(function () {
            $(".alert").fadeTo(500, 0).slideUp(500, function () {
                $(this).remove();
            });
        }, 3000);
    });
</script>
</html>