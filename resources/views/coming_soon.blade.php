<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Connecting One</title>
    <link rel="shortcut icon" type="images/png" href="{{ asset('images/fav.png') }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/materialdesignicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('css/my.css') }}" rel="stylesheet">
    <link href="{{ asset('css/media.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Animation.css') }}" rel="stylesheet">
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/Global.js') }}"></script>
    <script type="text/javascript">

    </script>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet"/>
    <style type="text/css">
        @media screen and (max-width: 479px) and (min-width: 320px) {
            .form_maincontainner {
                padding-left: 15px;
            }
        }
        @media screen and (max-width: 1023px) and (min-width: 480px) {
            .form_maincontainner {
                padding-left: 15px;
            }
        }
    </style>


</head>
<body class="reg_body">
<div class="overlay_bg">
    <div class="container mob_pad0">
        <div class="col-sm-12 col-md-5" style="z-index: 10">
            <div class="left_maintxt">
                <img src="{{url('images/logo.png')}}" alt="logo"/>
                <h1 class="text-white">ONE CAN CHANGE YOUR LIFE !!!</h1>
                <p class="subheading_para">Connecting-One.com is a unique Earning &amp; advertising platform that brings together the socially conscious members &amp; Advertisers. Members are paid for adding new members by chain based earning &amp; are paid each time they check the advertiser's promotion and advertisers are able to send their message to the masses at a very low cost!</p>
                <div class="other_tabs">
                    <ul class="links_ul">
                        <li><a href="{{url('about')}}">About</a></li>
                        <li><a href="{{url('privacy')}}">Privacy</a></li>
                        <li><a href="{{url('faq')}}" >Faq</a></li>
                        <li><a href="{{url('terms')}}">Terms & Condition</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-7 form_maincontainner">
            <div class="Regis_Login_Form ">
                <div class="form_container">
                    <div class="coming_block">
                        <div class="Comming_soontxt"> Comming Soon.....</div>
                        <div id="countdown" class="anim-go-left"></div>
                    </div>
                </div>
            </div>
        <!-- <div class="Regis_Login_Form">
             <div class="form_container">
                 <div class="list-position">
                     <ul class="nav login_nav_tabs">
                         <li class="" id="regis_nav_tabs"><a href="#register" data-toggle="tab" aria-expanded="false">Register</a></li>
                         <li class="login-btn active" id="login_nav_tabs"><a href="#login" data-toggle="tab" aria-expanded="true">Login</a></li>
                     </ul>
                     &lt;!&ndash;Tabs End&ndash;&gt;
                 </div>
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
                                 <span class="input-group-addon"><i class="mdi mdi-email-open-outline mdi-16px"></i></span>
                                 <input name="email_id" placeholder="Email Id" class="form-control"  type="text" />
                             </div>
                         </div>
                     </div>
                     <div class="col-sm-12">
                         <div class="form-group">
                             <div class="input-group">
                                 <span class="input-group-addon"><i class="mdi mdi-lock mdi-16px"></i></span>
                                 <input name="password" placeholder="Password" class="form-control"  type="password" />
                             </div>
                         </div>
                     </div>
                     <div class="col-sm-6">
                         <div class="checkbox glo_checkbox_mainbox">
                             <label>
                                 <input class="glo_checkbox" type="checkbox" id="CheckboxRemember">
                                 <span class="cr"><i class="cr-icon mdi mdi-check"></i></span>
                                 <span class="checkbox_txt"> Remember Password ?</span>
                             </label>
                         </div>
                     </div>
                     <div class="col-sm-6 pull-right">
                         <div class="forgot_link" data-toggle="modal" data-target="#myModal_ForgotPassword"> Forgot Password ? </div>
                     </div>
                     <div class="col-sm-12">
                         <div class="btn_block" style="margin-top: 20px;">
                             <button class="glo_button login_btn" id="Login_submit"></button>
                         </div>
                     </div>
                 </div>
                 <div class="basic_outerblk regis_block scale0">
                     <div class="col-sm-12">
                         <div class="login_maintxt">Register Now !!!</div>
                         <div class="login_subtxt">Be cool and join today. Meet millions & Earn tommorrow.</div>
                     </div>
                     <div class="col-sm-12">
                         <div class="form-group">
                             <div class="input-group">
                                 <span class="input-group-addon"><i class="mdi mdi-account-switch mdi-16px"></i></span>
                                 <input placeholder="Referal code" class="form-control"  type="text" />
                             </div>
                         </div>
                     </div>
                     <div class="col-sm-6">
                         <div class="form-group">
                             <div class="input-group">
                                 <span class="input-group-addon"><i class="mdi mdi-account mdi-16px"></i></span>
                                 <input name="first_name" placeholder="First Name" class="form-control"  type="text" />
                             </div>
                         </div>
                     </div>
                     <div class="col-sm-6">
                         <div class="form-group">
                             <div class="input-group">
                                 <span class="input-group-addon"><i class="mdi mdi-account mdi-16px"></i></span>
                                 <input name="Last_name" placeholder="Last Name" class="form-control"  type="text" />
                             </div>
                         </div>
                     </div>
                     <div class="col-sm-12">
                         <div class="form-group">
                             <div class="input-group">
                                 <span class="input-group-addon"><i class="mdi mdi-email-open-outline mdi-16px"></i></span>
                                 <input name="email_id" placeholder="Email Id" class="form-control"  type="text" />
                             </div>
                         </div>
                     </div>
                     <div class="col-sm-6">
                         <div class="form-group">
                             <div class="input-group">
                                 <span class="input-group-addon"><i class="mdi mdi-phone-log mdi-16px"></i></span>
                                 <input name="Mo_number" placeholder="Number" class="form-control"  type="text" />
                             </div>
                         </div>
                     </div>
                     <div class="col-sm-6">
                         <div class="form-group">
                             <div class="input-group">
                                 <span class="input-group-addon"><i class="mdi mdi-calendar-check mdi-16px"></i></span>
                                 <input name="Date_of_birth" placeholder="Date of Birth" class="form-control vRequiredText" id="date_of_birth" type="text" />
                             </div>
                         </div>
                     </div>
                     <div class="col-sm-12">
                         <div class="form-group">
                             <div class="input-group">
                                 <span class="input-group-addon"><i class="mdi mdi-lock mdi-16px"></i></span>
                                 <input name="password" placeholder="Password" class="form-control"  type="password" />
                             </div>
                         </div>
                     </div>
                     <div class="col-sm-6">
                         <div class="form-group">
                             <div class="input-group">
                                 <span class="input-group-addon"><i class="mdi mdi-format-list-bulleted mdi-16px"></i></span>
                                 <select class="form-control selectpicker" id="country">
                                     <option value="country" disabled selected>Country</option>
                                     <option value="AFG">Afghanistan</option>
                                     <option value="ALA">�land Islands</option>
                                     <option value="ALB">Albania</option>
                                     <option value="DZA">Algeria</option>
                                     <option value="ASM">American Samoa</option>
                                     <option value="AND">Andorra</option>
                                     <option value="AGO">Angola</option>
                                     <option value="AIA">Anguilla</option>
                                     <option value="ATA">Antarctica</option>
                                     <option value="ATG">Antigua and Barbuda</option>
                                     <option value="ARG">Argentina</option>
                                     <option value="ARM">Armenia</option>
                                     <option value="ABW">Aruba</option>
                                     <option value="AUS">Australia</option>
                                     <option value="AUT">Austria</option>
                                     <option value="AZE">Azerbaijan</option>
                                     <option value="BHS">Bahamas</option>
                                     <option value="BHR">Bahrain</option>
                                     <option value="BGD">Bangladesh</option>
                                     <option value="BRB">Barbados</option>
                                     <option value="BLR">Belarus</option>
                                     <option value="BEL">Belgium</option>
                                     <option value="BLZ">Belize</option>
                                     <option value="BEN">Benin</option>
                                     <option value="BMU">Bermuda</option>
                                     <option value="BTN">Bhutan</option>
                                     <option value="BOL">Bolivia, Plurinational State of</option>
                                     <option value="BES">Bonaire, Sint Eustatius and Saba</option>
                                     <option value="BIH">Bosnia and Herzegovina</option>
                                     <option value="BWA">Botswana</option>
                                     <option value="BVT">Bouvet Island</option>
                                     <option value="BRA">Brazil</option>
                                     <option value="IOT">British Indian Ocean Territory</option>
                                     <option value="BRN">Brunei Darussalam</option>
                                     <option value="BGR">Bulgaria</option>
                                     <option value="BFA">Burkina Faso</option>
                                     <option value="BDI">Burundi</option>
                                     <option value="KHM">Cambodia</option>
                                     <option value="CMR">Cameroon</option>
                                     <option value="CAN">Canada</option>
                                     <option value="CPV">Cape Verde</option>
                                     <option value="CYM">Cayman Islands</option>
                                     <option value="CAF">Central African Republic</option>
                                     <option value="TCD">Chad</option>
                                     <option value="CHL">Chile</option>
                                     <option value="CHN">China</option>
                                     <option value="CXR">Christmas Island</option>
                                     <option value="CCK">Cocos (Keeling) Islands</option>
                                     <option value="COL">Colombia</option>
                                     <option value="COM">Comoros</option>
                                     <option value="COG">Congo</option>
                                     <option value="COD">Congo, the Democratic Republic of the</option>
                                     <option value="COK">Cook Islands</option>
                                     <option value="CRI">Costa Rica</option>
                                     <option value="CIV">C�te d'Ivoire</option>
                                     <option value="HRV">Croatia</option>
                                     <option value="CUB">Cuba</option>
                                     <option value="CUW">Cura�ao</option>
                                     <option value="CYP">Cyprus</option>
                                     <option value="CZE">Czech Republic</option>
                                     <option value="DNK">Denmark</option>
                                     <option value="DJI">Djibouti</option>
                                     <option value="DMA">Dominica</option>
                                     <option value="DOM">Dominican Republic</option>
                                     <option value="ECU">Ecuador</option>
                                     <option value="EGY">Egypt</option>
                                     <option value="SLV">El Salvador</option>
                                     <option value="GNQ">Equatorial Guinea</option>
                                     <option value="ERI">Eritrea</option>
                                     <option value="EST">Estonia</option>
                                     <option value="ETH">Ethiopia</option>
                                     <option value="FLK">Falkland Islands (Malvinas)</option>
                                     <option value="FRO">Faroe Islands</option>
                                     <option value="FJI">Fiji</option>
                                     <option value="FIN">Finland</option>
                                     <option value="FRA">France</option>
                                     <option value="GUF">French Guiana</option>
                                     <option value="PYF">French Polynesia</option>
                                     <option value="ATF">French Southern Territories</option>
                                     <option value="GAB">Gabon</option>
                                     <option value="GMB">Gambia</option>
                                     <option value="GEO">Georgia</option>
                                     <option value="DEU">Germany</option>
                                     <option value="GHA">Ghana</option>
                                     <option value="GIB">Gibraltar</option>
                                     <option value="GRC">Greece</option>
                                     <option value="GRL">Greenland</option>
                                     <option value="GRD">Grenada</option>
                                     <option value="GLP">Guadeloupe</option>
                                     <option value="GUM">Guam</option>
                                     <option value="GTM">Guatemala</option>
                                     <option value="GGY">Guernsey</option>
                                     <option value="GIN">Guinea</option>
                                     <option value="GNB">Guinea-Bissau</option>
                                     <option value="GUY">Guyana</option>
                                     <option value="HTI">Haiti</option>
                                     <option value="HMD">Heard Island and McDonald Islands</option>
                                     <option value="VAT">Holy See (Vatican City State)</option>
                                     <option value="HND">Honduras</option>
                                     <option value="HKG">Hong Kong</option>
                                     <option value="HUN">Hungary</option>
                                     <option value="ISL">Iceland</option>
                                     <option value="IND">India</option>
                                     <option value="IDN">Indonesia</option>
                                     <option value="IRN">Iran, Islamic Republic of</option>
                                     <option value="IRQ">Iraq</option>
                                     <option value="IRL">Ireland</option>
                                     <option value="IMN">Isle of Man</option>
                                     <option value="ISR">Israel</option>
                                     <option value="ITA">Italy</option>
                                     <option value="JAM">Jamaica</option>
                                     <option value="JPN">Japan</option>
                                     <option value="JEY">Jersey</option>
                                     <option value="JOR">Jordan</option>
                                     <option value="KAZ">Kazakhstan</option>
                                     <option value="KEN">Kenya</option>
                                     <option value="KIR">Kiribati</option>
                                     <option value="PRK">Korea, Democratic People's Republic of</option>
                                     <option value="KOR">Korea, Republic of</option>
                                     <option value="KWT">Kuwait</option>
                                     <option value="KGZ">Kyrgyzstan</option>
                                     <option value="LAO">Lao People's Democratic Republic</option>
                                     <option value="LVA">Latvia</option>
                                     <option value="LBN">Lebanon</option>
                                     <option value="LSO">Lesotho</option>
                                     <option value="LBR">Liberia</option>
                                     <option value="LBY">Libya</option>
                                     <option value="LIE">Liechtenstein</option>
                                     <option value="LTU">Lithuania</option>
                                     <option value="LUX">Luxembourg</option>
                                     <option value="MAC">Macao</option>
                                     <option value="MKD">Macedonia, the former Yugoslav Republic of</option>
                                     <option value="MDG">Madagascar</option>
                                     <option value="MWI">Malawi</option>
                                     <option value="MYS">Malaysia</option>
                                     <option value="MDV">Maldives</option>
                                     <option value="MLI">Mali</option>
                                     <option value="MLT">Malta</option>
                                     <option value="MHL">Marshall Islands</option>
                                     <option value="MTQ">Martinique</option>
                                     <option value="MRT">Mauritania</option>
                                     <option value="MUS">Mauritius</option>
                                     <option value="MYT">Mayotte</option>
                                     <option value="MEX">Mexico</option>
                                     <option value="FSM">Micronesia, Federated States of</option>
                                     <option value="MDA">Moldova, Republic of</option>
                                     <option value="MCO">Monaco</option>
                                     <option value="MNG">Mongolia</option>
                                     <option value="MNE">Montenegro</option>
                                     <option value="MSR">Montserrat</option>
                                     <option value="MAR">Morocco</option>
                                     <option value="MOZ">Mozambique</option>
                                     <option value="MMR">Myanmar</option>
                                     <option value="NAM">Namibia</option>
                                     <option value="NRU">Nauru</option>
                                     <option value="NPL">Nepal</option>
                                     <option value="NLD">Netherlands</option>
                                     <option value="NCL">New Caledonia</option>
                                     <option value="NZL">New Zealand</option>
                                     <option value="NIC">Nicaragua</option>
                                     <option value="NER">Niger</option>
                                     <option value="NGA">Nigeria</option>
                                     <option value="NIU">Niue</option>
                                     <option value="NFK">Norfolk Island</option>
                                     <option value="MNP">Northern Mariana Islands</option>
                                     <option value="NOR">Norway</option>
                                     <option value="OMN">Oman</option>
                                     <option value="PAK">Pakistan</option>
                                     <option value="PLW">Palau</option>
                                     <option value="PSE">Palestinian Territory, Occupied</option>
                                     <option value="PAN">Panama</option>
                                     <option value="PNG">Papua New Guinea</option>
                                     <option value="PRY">Paraguay</option>
                                     <option value="PER">Peru</option>
                                     <option value="PHL">Philippines</option>
                                     <option value="PCN">Pitcairn</option>
                                     <option value="POL">Poland</option>
                                     <option value="PRT">Portugal</option>
                                     <option value="PRI">Puerto Rico</option>
                                     <option value="QAT">Qatar</option>
                                     <option value="REU">R�union</option>
                                     <option value="ROU">Romania</option>
                                     <option value="RUS">Russian Federation</option>
                                     <option value="RWA">Rwanda</option>
                                     <option value="BLM">Saint Barth�lemy</option>
                                     <option value="SHN">Saint Helena, Ascension and Tristan da Cunha
                                     </option>
                                     <option value="KNA">Saint Kitts and Nevis</option>
                                     <option value="LCA">Saint Lucia</option>
                                     <option value="MAF">Saint Martin (French part)</option>
                                     <option value="SPM">Saint Pierre and Miquelon</option>
                                     <option value="VCT">Saint Vincent and the Grenadines</option>
                                     <option value="WSM">Samoa</option>
                                     <option value="SMR">San Marino</option>
                                     <option value="STP">Sao Tome and Principe</option>
                                     <option value="SAU">Saudi Arabia</option>
                                     <option value="SEN">Senegal</option>
                                     <option value="SRB">Serbia</option>
                                     <option value="SYC">Seychelles</option>
                                     <option value="SLE">Sierra Leone</option>
                                     <option value="SGP">Singapore</option>
                                     <option value="SXM">Sint Maarten (Dutch part)</option>
                                     <option value="SVK">Slovakia</option>
                                     <option value="SVN">Slovenia</option>
                                     <option value="SLB">Solomon Islands</option>
                                     <option value="SOM">Somalia</option>
                                     <option value="ZAF">South Africa</option>
                                     <option value="SGS">South Georgia and the South Sandwich Islands
                                     </option>
                                     <option value="SSD">South Sudan</option>
                                     <option value="ESP">Spain</option>
                                     <option value="LKA">Sri Lanka</option>
                                     <option value="SDN">Sudan</option>
                                     <option value="SUR">Suriname</option>
                                     <option value="SJM">Svalbard and Jan Mayen</option>
                                     <option value="SWZ">Swaziland</option>
                                     <option value="SWE">Sweden</option>
                                     <option value="CHE">Switzerland</option>
                                     <option value="SYR">Syrian Arab Republic</option>
                                     <option value="TWN">Taiwan, Province of China</option>
                                     <option value="TJK">Tajikistan</option>
                                     <option value="TZA">Tanzania, United Republic of</option>
                                     <option value="THA">Thailand</option>
                                     <option value="TLS">Timor-Leste</option>
                                     <option value="TGO">Togo</option>
                                     <option value="TKL">Tokelau</option>
                                     <option value="TON">Tonga</option>
                                     <option value="TTO">Trinidad and Tobago</option>
                                     <option value="TUN">Tunisia</option>
                                     <option value="TUR">Turkey</option>
                                     <option value="TKM">Turkmenistan</option>
                                     <option value="TCA">Turks and Caicos Islands</option>
                                     <option value="TUV">Tuvalu</option>
                                     <option value="UGA">Uganda</option>
                                     <option value="UKR">Ukraine</option>
                                     <option value="ARE">United Arab Emirates</option>
                                     <option value="GBR">United Kingdom</option>
                                     <option value="USA">United States</option>
                                     <option value="UMI">United States Minor Outlying Islands</option>
                                     <option value="URY">Uruguay</option>
                                     <option value="UZB">Uzbekistan</option>
                                     <option value="VUT">Vanuatu</option>
                                     <option value="VEN">Venezuela, Bolivarian Republic of</option>
                                     <option value="VNM">Viet Nam</option>
                                     <option value="VGB">Virgin Islands, British</option>
                                     <option value="VIR">Virgin Islands, U.S.</option>
                                     <option value="WLF">Wallis and Futuna</option>
                                     <option value="ESH">Western Sahara</option>
                                     <option value="YEM">Yemen</option>
                                     <option value="ZMB">Zambia</option>
                                     <option value="ZWE">Zimbabwe</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                     <div class="col-sm-6">
                         <div class="form-group">
                             <div class="input-group">
                                 <span class="input-group-addon"><i class="mdi mdi-format-list-checks mdi-16px"></i></span>
                                 <input name="city" placeholder="City" class="form-control" type="text" />
                             </div>
                         </div>
                     </div>
                     <div class="col-sm-12">
                         <div class="radio">
                             <input id="radio-1" name="radio" type="radio" checked>
                             <label for="radio-1" class="radio-label">Male</label>
                         </div>

                         <div class="radio">
                             <input id="radio-2" name="radio" type="radio">
                             <label  for="radio-2" class="radio-label">Female</label>
                         </div>



                         <div class="form-group">
                             <div class="input-group">
                                 &lt;!&ndash;  <span class="input-group-addon"><i class="mdi mdi-calendar-check"></i></span>
                                   <input name="city" placeholder="City" class="form-control" type="text" />&ndash;&gt;
                                 &lt;!&ndash; <input type="radio" id="featured-1" name="featured" class="glo_radio" checked>
                                  <label for="featured-1">Mail</label>
                                  <input type="radio" id="featured-2" name="featured" class="glo_radio">
                                  <label for="featured-2">Femail</label>&ndash;&gt;

                             </div>
                         </div>
                     </div>
                     <div class="col-sm-12">
                         <div class="btn_block">
                             <button class="glo_button mdi" id="Registration_submit"></button>
                         </div>
                     </div>
                 </div>
             </div>
             &lt;!&ndash;  <button class="forgot_password" data-toggle="modal" data-target="#myModal_ForgotPassword" value="forgot"></button>
               <button class="otp_form" data-toggle="modal" data-target="#myModal_varify_otp_email" value="Oto Click"></button>
          &ndash;&gt; </div>-->
    </div>
</div>
<div id="particles-js" class="canvas_block"></div>
<script src="{{ url('js/Social_Connectivity.js') }}"></script>
</body>
</html>