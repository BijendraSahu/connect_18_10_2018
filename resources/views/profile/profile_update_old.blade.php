<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile Upload</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="images/png" href="{{ asset('images/fav.png') }}"/>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/materialdesignicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/my.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Animation.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/Datepicker.js') }}"></script>
    <script src="{{ asset('js/login_validation.js') }}"></script>

    <!--Google Font-->
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet"/>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
    </script>
</head>
<body class="bg_profile_color">
<div class="container">
    <div class="content_block form-group">
        <div class="com-block block_header">
            <div class="row">
                <div class="col-sm-4">
                    <h2 class="h2_header">Profile Details</h2>
                </div>
                <div class="col-sm-8">
                </div>
            </div>
        </div>
        <div class="com-block content-body">
            <div class="row">
                {{--                <form action="{{url('profile/'.str_slug($timeline->fname." ".$timeline->lname).'/'.$user->id)}}">--}}
                {!! Form::open(['url' => 'profile/', 'class' => '', 'id'=>'frmupdate']) !!}
                <input type="hidden" name="_token" class="token" value="{{ csrf_token() }}">
                <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="profile_block text-center">
                        <div class="profile-picture">
                            <img src="{{url('images/Male_default.png')}}" id="_UserProfile" alt="UserProfile">
                        </div>
                        <div class="btn btn-info btn-sm profile-upload">
                            <span class="mdi mdi-account-edit mdi-24px"></span>
                            <input type="file" name="profile_pic" class="profile-upload-pic">
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="mdi mdi-account mdi-16px"></i></span>
                                        <input name="fname" placeholder="First Name" class="form-control required fname"
                                               value="{{$timeline->fname}}" type="text"/>
                                        <input name="timeline_id" placeholder="First Name"
                                               class="form-control timeline_id"
                                               value="{{$timeline->id}}" type="hidden"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="mdi mdi-account mdi-16px"></i></span>
                                        <input name="lname" placeholder="Last Name" class="form-control required lname"
                                               value="{{$timeline->lname}}" type="text"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="mdi mdi-calendar-check mdi-16px"></i></span>
                                        <input name="dob" placeholder="Date of Birth"
                                               value="{{date_format(date_create($user->birthday), "d-M-Y")}}"
                                               class="form-control required vRequiredText dob" id="date_of_birth"
                                               type="text"/>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="col-sm-6">--}}
                            {{--<div class="form-group">--}}
                            {{--<div class="input-group">--}}
                            {{--<span class="input-group-addon"><i class="mdi mdi-clipboard-account mdi-16px"></i></span>--}}
                            {{--<input name="password" placeholder="Age" class="form-control"  type="text" />--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="mdi mdi-format-list-bulleted mdi-16px"></i></span>
                                        {!! Form::select('country', $country, $user->country_id,['class' => 'form-control country requiredDD']) !!}
                                        {{--<select class="form-control selectpicker" id="country">--}}
                                        {{--<option value="country" disabled selected>Country</option>--}}
                                        {{--<option value="AFG">Afghanistan</option>--}}
                                        {{--<option value="ALA">land Islands</option>--}}
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
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                            <span class="input-group-addon"><i
                                                        class="mdi mdi-email-open-outline mdi-16px"></i></span>
                                        <input onkeypress="return false" tabindex="-1" onkeydown="return false"
                                               name="lname" placeholder="Last Name"
                                               class="form-control"
                                               value="{{$user->email}}" type="text"/>
                                        <input name="user_id" placeholder="user_id" class="form-control user_id"
                                               value="{{$user->id}}" type="hidden"/>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="col-sm-6">--}}
                            {{--<div class="form-group">--}}
                            {{--<div class="input-group">--}}
                            {{--<span class="input-group-addon"><i class="mdi mdi-clipboard-account mdi-16px"></i></span>--}}
                            {{--<input name="password" placeholder="Age" class="form-control"  type="text" />--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="mdi mdi-phone mdi-16px"></i></span>
                                        <input onkeypress="return false" onkeydown="return false" name="lname"
                                               placeholder="Last Name"
                                               class="form-control" tabindex="-1"
                                               value="{{$user->contact}}" type="text"/>
                                        {{--                                        <label>{{$user->contact}}</label>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i
                                            class="mdi mdi-format-list-checks mdi-16px"></i></span>
                                <input name="city" placeholder="City" value="{{$user->city}}" class="form-control city"
                                       type="text"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                    <span class="input-group-addon"><i
                                                class="mdi mdi-account-settings mdi-16px"></i></span>
                                <select class="form-control selectpicker requiredDD" id="profession">
                                    <option value="0" selected>Profession</option>
                                    <option value="Doctor">Doctor</option>
                                    <option value="Engineer">Engineer</option>
                                    <option value="Enterprener">Enterprener</option>
                                    <option value="otr">Other</option>
                                </select>
                                {{--                                {!! Form::select('country', $country, $user->country_id,['class' => 'form-control country requiredDD']) !!}--}}
                            </div>
                        </div>
                        <div class="form-group glo_otherbox" id="other_block">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="mdi mdi-account-settings mdi-16px"></i></span>
                                <input name="other" placeholder="Other" id="otherpro" class="form-control otherpro"
                                       type="text"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="btn_block">
                        <button class="glo_button mdi" {{--onclick="submitForm()"--}} id="profile_submit"></button>
                    </div>
                </div>
                {{--</form>--}}
                {!! Form::close() !!}
                <p id="err"></p>
            </div>
        </div>
    </div>
</div>
<!-- Modal Payment & Free User-->
<div id="myModal_PaymentUser" class="connect_LBbox modal fade in" role="dialog" aria-hidden="false">
    <div class="modal-dialog Payment_lb">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal" onclick="closeForgotLbox();">×</button>-->
                <h4 class="modal-title">Choose your plan</h4>
            </div>
            <div class="modal-body">
                <div class="logindiv" style="border: none">
                    <div class="col-sm-6">
                        <div class="payment_option_holder">
                            <div class="pay_head">Free</div>
                            <div class="pay_innerblk">
                                <div class="pay_money"><i class="mdi mdi-currency-inr"></i>0</div>
                                <ul class="payment_ul">
                                    <li><i class="mdi mdi-check"></i> Feature 1</li>
                                    <li><i class="mdi mdi-check"></i> Feature 2</li>
                                    <li><i class="mdi mdi-check"></i> Feature 3</li>
                                    <li><i class="mdi mdi-check"></i> Feature 4</li>
                                    <li><i class="mdi mdi-check"></i> Feature 5</li>
                                    <li><i class="mdi mdi-check"></i> Feature 6</li>
                                </ul>
                            </div>
                            <div class="pay_btnbox">
                                {{--                                <a href="{{url('dashboard/'. str_slug($timeline->fname . " " . $timeline->lname))}}">--}}
                                <a href="{{url('dashboard')}}">
                                    <button class="btn btn-warning" value="Continue">Continue <i
                                                class="mdi mdi-arrow-right"></i></button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="payment_option_holder">
                            <div class="pay_head">Membership</div>
                            <div class="pay_innerblk">
                                <div class="pay_money"><i class="mdi mdi-currency-inr"></i>1</div>
                                <ul class="payment_ul">
                                    <li><i class="mdi mdi-check"></i> Feature 1</li>
                                    <li><i class="mdi mdi-check"></i> Feature 2</li>
                                    <li><i class="mdi mdi-check"></i> Feature 3</li>
                                    <li><i class="mdi mdi-check"></i> Feature 4</li>
                                    <li><i class="mdi mdi-check"></i> Feature 5</li>
                                    <li><i class="mdi mdi-check"></i> Feature 6</li>
                                </ul>
                            </div>
                            <div class="pay_btnbox">
                                <button class="btn btn-warning">Pay Now <i class="mdi mdi-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
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
<script type="text/javascript">

    function submitForm() {
       /* $("#profile_submit").addClass("onclic", 250, validate);
        $('#main_pageloader').show();
        validate();*/
        var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        var rc = $('.rcode').val();
        var fname = $('.fname').val();
        var lname = $('.lname').val();
        var email = $('.email_id').val();
        var contact = $('.contact').val();
        var dob = $('.dob').val();
        var password = $('.password1').val();
        var country = $('.country').val();
        var city = $('.city').val();
        var timeline_id = $('.timeline_id').val();
        var user_id = $('.user_id').val();
        var profession = $('#profession').val();
        var otherpro = $('.otherpro').val();
//        var gender = $('.gender').val();
        var formData = '_token=' + $('.token').val();
        if (fname.trim() == '') {
//            alert('Please enter your fname.');
//            $('#inputMessage').focus();
            return false;
        } else if (lname.trim() == '') {
//            alert('Please enter your last name.');
//            $('#inputMessage').focus();
            return false;
        } else if (dob.trim() == '') {
//            alert('Please enter your dob.');
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
                url: "{{ url('profileupdate') }}",
//                data: '{"data":"' + endid + '"}',
                data: '{"formData":"' + formData + '", "fname":"' + fname + '", "lname":"' + lname + '", "dob":"' + dob + '", "country":"' + country + '", "city":"' + city + '", "timeline_id":"' + timeline_id + '", "user_id":"' + user_id + '", "profession":"' + profession + '", "otherpro":"' + otherpro + '"}',
                success: function (data) {
//                    console.log(data);
//                    $('#err').html(data);
                },
                error: function (xhr, status, error) {
//                    alert('xhr.responseText');
                    $('#err').html(xhr.responseText);
                }
            });
        }
    }
   /* function validate() {
        setTimeout(function () {
            $("#profile_submit").removeClass("onclic");
            $("#profile_submit").addClass("mdi-check", 450, callback);
            $('#main_pageloader').hide();
            $('#myModal_PaymentUser').show();
        }, 2250);
    }

    function callback() {
        setTimeout(function () {
            $("#profile_submit").removeClass("mdi-check");
        }, 1250);
    }*/
    $(document).ready(function () {
        /*date Picker*/
        $('#date_of_birth').datepicker({
            format: 'dd-M-yyyy', autoclose: true
        }).on('changeDate', function (event) {
            if ($('#date_of_birth').val() != "") {
                $("#date_of_birth").removeClass('vErrorRed');
            }
        });
        /* Button Click*/
        $(function () {
//            $("#profile_submit").click(function () {
//                $("#profile_submit").addClass("onclic", 250, validate);
//                $('#main_pageloader').show();
//                validate();
//            });


        });
        $("#profession").change(function () {
            var curr_val = this.value;
            var firstDropVal = $('#profession').val();
            if (curr_val != 'otr') {
                $('#other_block').slideUp();
            } else {
                $('#other_block').slideDown();
            }
        });
    });
</script>
</body>
</html>