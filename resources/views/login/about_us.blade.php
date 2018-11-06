<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>About Us</title>
    @include('login.plugin_header')
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet"/>
    <style type="text/css">
        .about-text p {
            margin-bottom: 10px;
        }
        body{
            font-family: poppins;
            overflow-x: hidden;
        }

        .about_us_first_p{    padding-top: 17px;}



        #team {
            background: #eee !important;
        }



        .section_1{
            padding: 60px 0;
        }

        .section_1 .section-title {
            text-align: center;
            color: #0b6b92;
            margin-bottom: 50px;
            text-transform: uppercase;
        }

        #team .card {
            border: none;
            background: #ffffff;
        }



        .frontside {
            position: relative;
            /*-webkit-transform: rotateY(0deg);*/
            /*-ms-transform: rotateY(0deg);*/
            z-index: 2;
            margin-bottom: 30px;
        }



        .frontside .card,
        .backside .card {
            min-height: 244px;
        }

        .backside .card a {
            font-size: 18px;
            color: #f8c301 !important;
        }

        .frontside .card .card-title,
        .backside .card .card-title {
            color: #5270b2 !important;
            padding:10px;
        }

        .frontside .card .card-body img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            box-shadow: 2px 2px 2px 2px #f8c30178;
        }
        .ourteam{
            padding: 19px;
        }
        .uq_tittle{
            height:2px;width:414px;background-color:#fbce01;margin-bottom:20px;
        }
        ._tittle{ height:2px;width:200px;background-color:#f8c301;}
        .core_tittle{
            height:2px;width:143px;background-color:#f8c301;
        }
    </style>
    <style>
        .box{
            /* height: 100px; */
            /* border: 1px solid #ccc; */
            margin-top: 80px;
            /* padding-left: 90; */
            padding-bottom: 6px;
            padding-top: 14px;
        }
        .box-img{
            height: 141px;
            width: 159px;
            box-shadow: 2px 2px 2px 2px #ccc;
            border-radious: 48px;
            border-radius: 12px;
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
        <h1>About Us</h1>
    </div>
</div>
<section class="about_txt" data-aos-duration="1000" data-aos="fade-up">
    <div class="container">
        <p>Connecting One is a social networking website  under the company name. Connecting One Enterprises based in the heart of the city, jabalpur, MP. which is also known as the the City of marbal, and city of sanskardhadi .</p>
    </div>
</section>
<section class="mob_pad0 bg_profile_color">
    <div class="about_picstxt container">
        <div class="col-md-6 col-sm-12" data-aos-duration="1000" data-aos="fade-right">
            <div class="about_image_box">
                <img src="images/about_image.jpg" class="img-responsive">
            </div>
        </div>

        <div class="col-md-6 col-sm-12"  data-aos-duration="1000" data-aos="fade-left">
            <div class="about-text">
                <h4>Who We are?</h4>
                <div class="_tittle"></div>
                <p class="about_us_first_p">Connecting-One.com is an INDIAN online social media and social networking service company based in
                    Jabalpur, Madhya Pradesh. Our website development started in November 5, 2017, by AjaykumarGautam,
                    along with fellow I.G.E.C Sagar students and roommates Himanshu Thakur, Swapnil Sharma, VeereshSoni,
                    Jayant Prajapati & Seema Suraiya.Anyone who claims to be at least 18 years old has been allowed to
                    become a registered user of Connecting One. </p>

                <p>After registering, users can create a customized profile indicating their name&occupation.</p>
                <p>Users can add other users as "friends", exchange messages, post status updates, share photos, videos
                    and links, receive notifications of another users' activity. </p>
                <p>Additionally, users may join common-interest user groups organized by workplace, school, hobbies or
                    other topics, and categorize their friends into lists such as "People from Work" or "Close
                    Friends". </p>
                <p>Additionally, users can report or block unpleasant people.</p>


            </div>
        </div>
    </div>
</section>

<section class="core_valuebox">
    <div class="container">

        <div class="col-sm-12 col-md-12 col-xs-12" data-aos-duration="900" data-aos="fade-up">
            <h3>Unique Features of Connecting One</h3>
            <div class="uq_tittle" ></div>
            <p class="about_us_first_p">Connecting-One.com is an INDIAN online social media and social networking service company based in
                Jabalpur, Madhya Pradesh. Our website development started in November 5, 20017, by AjaykumarGautam,
                along with fellow I.G.E.C Sagar students and roommates Himanshu Thakur, Swapnil Sharma, VeereshSoni,
                Jayant Prajapati & Seema Suraiya.Anyone who claims to be at least 18 years old has been allowed to
                become a registered user of Connecting One. </p>
            <div class="core_value_txt">
                <p data-aos-duration="1000" data-aos="fade-up"><i class="mdi mdi-checkbox-multiple-marked-outline"></i>It is a social networking site that makes it
                    easy for users to connect and sharewith your family and friends online</p>
                <p data-aos-duration="1200" data-aos="fade-up"><i class="mdi mdi-checkbox-multiple-marked-outline"></i>It is a unique Earning &Advertising platform
                    that brings together the socially conscious members & Advertisers</p>
                <p data-aos-duration="1300" data-aos="fade-up"><i class="mdi mdi-checkbox-multiple-marked-outline"></i>E-Commerce Platform where users can purchase
                    and sale of goods and/or services

                    their used Items/New Items on personal terms</p>
                <p data-aos-duration="1400" data-aos="fade-up"><i class="mdi mdi-checkbox-multiple-marked-outline"></i>Messenger application that allows the sending
                    of Text Messages and Voice calls, Video calls, Video Conferencing, Images and other Media,
                    Documents and user location</p>
                <p data-aos-duration="1500" data-aos="fade-up"><i class="mdi mdi-checkbox-multiple-marked-outline"></i>Elegant Graphics & Themes allows users to
                    make their own customized environment of working</p>
                <p data-aos-duration="1600" data-aos="fade-up"><i class="mdi mdi-checkbox-multiple-marked-outline"></i>Online Surveys which yield benefits to users&
                    give opportunity to service providers to improve based on user feedbacks</p>
            </div>
        </div>

    </div>
</section>
<!-- Team -->
<section id="team" class="pb-5 section_1">
    <div class="container">
        <h5 class="section-title h1">OUR TEAM</h5>

        <div class="row">
            <!-- Team member -->
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                    <div class="mainflip">
                        <div class="frontside" data-aos-duration="1000" data-aos="fade-right">
                            <div class="card">
                                <div class="card-body text-center ourteam">
                                    <p><img class=" img-fluid" src="https://www.connecting-one.com/profile/4oBwin_cropped-1950218407.jpg" alt="card image"></p>
                                    <h4 class="card-title">Ajay gautam</h4>
                                    {{--<p class="card-text">This is basic card with image on top, title, description and button.</p>--}}
                                    <!--<a href="#" class="btn btn-primary btn-sm"><i class="mdi mdi-plus"></i></a>-->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- ./Team member -->
            <!-- Team member -->
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                    <div class="mainflip">
                        <div class="frontside" data-aos-duration="1000" data-aos="fade-right">
                            <div class="card">
                                <div class="card-body text-center ourteam">
                                    <p><img class=" img-fluid" src="https://www.connecting-one.com/profile/o0DZvq_cropped5953343696762633887.jpg" alt="card image"></p>
                                    <h4 class="card-title">Himanshu Thakur</h4>
                                    {{--<p class="card-text">This is basic card with image on top, title, description and button.</p>--}}
                                    <!--<a href="#" class="btn btn-primary btn-sm"><i class="mdi mdi-plus"></i></a>-->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- ./Team member -->
            <!-- Team member -->
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="image-flip" ontouchstart="this.classList.toggle('hover');">
                    <div class="mainflip">
                        <div class="frontside" data-aos-duration="1000" data-aos="fade-right">
                            <div class="card">
                                <div class="card-body text-center ourteam">
                                    <p><img class=" img-fluid" src="https://www.connecting-one.com/profile/RcTzrH_cropped1738119773.jpg" alt="card image"></p>
                                    <h4 class="card-title">Veeresh Soni</h4>
                                    {{--<p class="card-text">This is basic card with image on top, title, description and button.</p>--}}
                                    <!--<a href="#" class="btn btn-primary btn-sm"><i class="mdi mdi-plus"></i></a>-->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- ./Team member -->
            <!-- Team member -->
            {{--<div class="col-xs-12 col-sm-6 col-md-4">--}}
                {{--<div class="image-flip" ontouchstart="this.classList.toggle('hover');">--}}
                    {{--<div class="mainflip">--}}
                        {{--<div class="frontside" data-aos-duration="1000" data-aos="fade-left">--}}
                            {{--<div class="card">--}}
                                {{--<div class="card-body text-center ourteam">--}}
                                    {{--<p><img class=" img-fluid" src="https://sunlimetech.com/portfolio/boot4menu/assets/imgs/team/img_04.jpg" alt="card image"></p>--}}
                                    {{--<h4 class="card-title">Sunlimetech</h4>--}}
                                    {{--<p class="card-text">This is basic card with image on top, title, description and button.</p>--}}

                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<!-- ./Team member -->--}}
            {{--<!-- Team member -->--}}
            {{--<div class="col-xs-12 col-sm-6 col-md-4">--}}
                {{--<div class="image-flip" ontouchstart="this.classList.toggle('hover');">--}}
                    {{--<div class="mainflip">--}}
                        {{--<div class="frontside" data-aos-duration="1000" data-aos="fade-left">--}}
                            {{--<div class="card">--}}
                                {{--<div class="card-body text-center ourteam">--}}
                                    {{--<p><img class=" img-fluid" src="https://sunlimetech.com/portfolio/boot4menu/assets/imgs/team/img_05.png" alt="card image"></p>--}}
                                    {{--<h4 class="card-title">Sunlimetech</h4>--}}
                                    {{--<p class="card-text">This is basic card with image on top, title, description and button.</p>--}}
                                    {{--<!--<a href="#" class="btn btn-primary btn-sm"><i class="mdi mdi-plus"></i></a>-->--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}


            {{--<!-- ./Team member -->--}}
            {{--<!-- Team member -->--}}
            {{--<div class="col-xs-12 col-sm-6 col-md-4">--}}
                {{--<div class="image-flip" ontouchstart="this.classList.toggle('hover');">--}}
                    {{--<div class="mainflip">--}}
                        {{--<div class="frontside" data-aos-duration="1000" data-aos="fade-left">--}}
                            {{--<div class="card">--}}
                                {{--<div class="card-body text-center ourteam">--}}
                                    {{--<p><img class=" img-fluid" src="https://sunlimetech.com/portfolio/boot4menu/assets/imgs/team/img_06.jpg" alt="card image"></p>--}}
                                    {{--<h4 class="card-title">Sunlimetech</h4>--}}
                                    {{--<p class="card-text">This is basic card with image on top, title, description and button.</p>--}}
                                    {{--<!--<a href="#" class="btn btn-primary btn-sm"><i class="mdi mdi-plus"></i></a>-->--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            <!-- ./Team member -->

        </div>


    </div>
</section>
<section class="vision_missonbg">
    <div class="vm_overlay">
        <div class="container mob_pad0">
            <div class="col-md-6 col-sm-6 help-pd0">
                <div class="trans_box" data-aos-duration="1000" data-aos="fade-right">
                    <h3>Our Vision</h3>
                    <p>To build strong communities & a place where people can Connect with each other, Earn while they
                        learn, develop business skills & a place where socially-conscious people can come to find a
                        better world.</p>
                    <div class="vm-box-circle"><span class="mdi mdi-eye"></span></div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 help-pd0">
                <div class="trans_box" data-aos-duration="1000" data-aos="fade-left">
                    <h3>Our Mission</h3>
                    <p>Enterprise will produce superior financial returns for its shareowners by providing high
                        value-added servicesthrough focused operating company</p>
                    <div class="vm-box-circle"><span class="mdi mdi-target"></span></div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="core_valuebox" data-aos-duration="900" data-aos="fade-up">
    <div class="container">
        <div class="col-md-6 col-sm-12 col-xs-12 pull-right">
            <div class="core_value_imgbox">

                <img src="images/core_value.png"/></div>

        </div>
        <div class="col-sm-12 col-md-6 col-xs-12">
            <h3>Core Values</h3>
            <div class="core_tittle"></div>
            <div class="core_value_txt">
                <p data-aos-duration="1000" data-aos="fade-up">
                    <i class="mdi mdi-checkbox-multiple-marked-outline"></i>Excellence with commitment
                </p>
                <p data-aos-duration="1100" data-aos="fade-up"><i class="mdi mdi-checkbox-multiple-marked-outline"></i>Serving customers with honesty</p>
                <p data-aos-duration="1200" data-aos="fade-up"><i class="mdi mdi-checkbox-multiple-marked-outline"></i>Passion to Innovation</p>
                <p data-aos-duration="1300" data-aos="fade-up"><i class="mdi mdi-checkbox-multiple-marked-outline"></i>Responsibility and sustainability</p>
                <p data-aos-duration="1400" data-aos="fade-up"><i class="mdi mdi-checkbox-multiple-marked-outline"></i>Collaborative approach</p>
                <p data-aos-duration="1500" data-aos="fade-up"><i class="mdi mdi-checkbox-multiple-marked-outline"></i>Quantitative company that uses data to make
                    decisions</p>
                <p data-aos-duration="1600" data-aos="fade-up"><i class="mdi mdi-checkbox-multiple-marked-outline"></i>Environmental sustainability</p>
                <p data-aos-duration="1700" data-aos="fade-up"><i class="mdi mdi-checkbox-multiple-marked-outline"></i>Commitment to building strong communities</p>
            </div>
        </div>

    </div>
</section>
<script type="text/javascript">
    $(document).ready(function () {
        AOS.init({
            easing: 'ease-in-out-sine'
        });
    });
</script>
</body>
</html>