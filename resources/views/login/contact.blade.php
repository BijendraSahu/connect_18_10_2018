<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    @include('login.plugin_header')
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"/>
    <style type="text/css">

        .links_ul li {
            background: rgba(0, 125, 195, 0.6);
        }
    </style>
</head>
<body class="bg_profile_color">
@include('login.outer_master')
<div class="privacy_images">
    <div id="particles-js" class="canvas_block"></div>
    <script src="{{ asset('js/Social_Connectivity.js') }}"></script>
    <div class="overlay_image">
    </div>
    <div class="main_heading">
        <h1>Contact Us</h1>
    </div>
</div>
<section class="map_form">
    <div class="map_box">
        <div class="mapouter">
            <div class="gmap_canvas">
                <div class="other_map" style="display: block" id="map_jabalpur">
                    <iframe width="100%" height="600" class="maps" id="gmap_canvas"
                            src="https://maps.google.com/maps?q=Techno%20Park%20Bargi%20Hills%2C%20Jabalpur%2C%20Madhya%20Pradesh&t=&z=13&ie=UTF8&iwloc=&output=embed"
                            frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                    <div class="contact_form">
                        <h2 class="text-white text-center">Get in Touch</h2>
                        <h3 class="text-white text-center">Feel free to contact us
                            <p>connectingoneenterprises@gmail.com</p>
                        </h3>
                        <form action="{{url('contact_us')}}" method="post" enctype="multipart/form-data"
                              class="form-horizontal" id="contact_us">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="mdi mdi-account mdi-16px"></i></span>
                                        <input name="name" placeholder="Name" tabindex="1" autofocus="autofocus"
                                               value=""
                                               class="form-control required textWithSpace" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="mdi mdi-email-open-outline mdi-16px"></i></span>
                                        <input name="email" placeholder="Email Id*" tabindex="2" autofocus="autofocus"
                                               value="" class="form-control required email" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="mdi mdi-phone-log mdi-16px"></i></span>
                                        <input name="contact" placeholder="Phone no." tabindex="3" maxlength="10" autofocus="autofocus"
                                               value="" class="form-control required" type="text">
                                    </div>
                                </div>
                            </div>
                            {{--<div class="col-sm-12">--}}
                            {{--<div class="form-group">--}}
                            {{--<div class="input-group">--}}
                            {{--<span class="input-group-btn">--}}
                            {{--<span class="btn btn-default btn-file">--}}
                            {{--Browse… <input type="file" id="file-input" class="contact_file">--}}
                            {{--</span>--}}
                            {{--</span>--}}
                            {{--<input type="text" id="file_document" placeholder="Upload Documents" class="form-control" readonly="" />--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            {{--</div>--}}
                            <div class="col-sm-12">
                                <div class="form-group">
                                <textarea cols="1" rows="4" name="message" class="form-control txt_resize required"
                                          placeholder="Massage" data-validate="Btn_advertise" tabindex="4"
                                          maxlength="500"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button class="contact_btn" type="submit" id="contact_submit">Submit</button>
                            </div>
                        </form>
                        <div class="col-sm-12">
                            <div class="contact_links_block">
                                <ul class="links_ul">
                                    <li><a href="{{'/'}}">Home</a></li>
                                    <li><a target="_blank" href="{{url('aboutus')}}">About</a></li>
                                    <li><a target="_blank" href="{{url('privacy')}}">Privacy</a></li>
                                    <li><a target="_blank" href="{{url('faq')}}">Faq</a></li>
                                    <li><a target="_blank" href="{{url('terms')}}">Terms & Condition</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{ url('js/login_validation.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        AOS.init({
            easing: 'ease-in-out-sine'
        });
    });
</script>
</body>
</html>