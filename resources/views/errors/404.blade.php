<!DOCTYPE html>
<html>
<head>
    <title>Erroe Page</title>

    @include('login.plugin_header')
    <style type="text/css">
        .particules {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-position: 50% 50%;
            position: fixed;
            top: 0px;
            z-index: 10;
        }
        .error_page_bg
        {
            width: 100%;
            height: 100%;
            background: url('{{url('images/page_notfound_bg.jpg')}}');
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
            -moz-background-size: cover;
            -webkit-background-size: cover;
            position: fixed;
            top: 0;
            bottom: 0;
            right: 0;
            left: 0;
        }
        .error_pagetxt_box {
            width: 500px;
            background: rgba(255,255,255,0.7);
            position: absolute;
            left: 50%;
            text-align: center;
            margin-left: -250px;
            top: 50%;
            margin-top: -170px;
            border-radius: 5px;
            z-index: 15;
            padding: 10px 10px 30px 10px;
        }
        .erroe_center_txt
        {
            font-size: 9em;
            color: black;
            line-height: 1.3;
        }
        .erroe_center_txt img {
            margin: 0px 25px;
        }
        .errorbtn_icon {
            margin-right: 5px;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
    <script type="text/javascript">
        $.getScript("https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js", function(){
            particlesJS('particles-js',
                {
                    "particles": {
                        "number": {
                            "value": 80,
                            "density": {
                                "enable": true,
                                "value_area": 800
                            }
                        },
                        "color": {
                            "value": "#ffffff"
                        },
                        "shape": {
                            "type": "circle",
                            "stroke": {
                                "width": 0,
                                "color": "#000000"
                            },
                            "polygon": {
                                "nb_sides": 5
                            },
                            "image": {
                                "width": 100,
                                "height": 100
                            }
                        },
                        "opacity": {
                            "value": 0.5,
                            "random": false,
                            "anim": {
                                "enable": false,
                                "speed": 1,
                                "opacity_min": 0.1,
                                "sync": false
                            }
                        },
                        "size": {
                            "value": 5,
                            "random": true,
                            "anim": {
                                "enable": false,
                                "speed": 40,
                                "size_min": 0.1,
                                "sync": false
                            }
                        },
                        "line_linked": {
                            "enable": true,
                            "distance": 150,
                            "color": "#ffffff",
                            "opacity": 0.4,
                            "width": 1
                        },
                        "move": {
                            "enable": true,
                            "speed": 6,
                            "direction": "none",
                            "random": false,
                            "straight": false,
                            "out_mode": "out",
                            "attract": {
                                "enable": false,
                                "rotateX": 600,
                                "rotateY": 1200
                            }
                        }
                    },
                    "interactivity": {
                        "detect_on": "canvas",
                        "events": {
                            "onhover": {
                                "enable": true,
                                "mode": "repulse"
                            },
                            "onclick": {
                                "enable": true,
                                "mode": "push"
                            },
                            "resize": true
                        },
                        "modes": {
                            "grab": {
                                "distance": 400,
                                "line_linked": {
                                    "opacity": 1
                                }
                            },
                            "bubble": {
                                "distance": 400,
                                "size": 40,
                                "duration": 2,
                                "opacity": 8,
                                "speed": 3
                            },
                            "repulse": {
                                "distance": 200
                            },
                            "push": {
                                "particles_nb": 4
                            },
                            "remove": {
                                "particles_nb": 2
                            }
                        }
                    },
                    "retina_detect": true,
                    "config_demo": {
                        "hide_card": false,
                        "background_color": "#b61924",
                        "background_image": "",
                        "background_position": "50% 50%",
                        "background_repeat": "no-repeat",
                        "background_size": "cover"
                    }
                }
            );

        });
    </script>
</head>
<body class="error_page_bg">
<div class="container">
    <div class="error_pagetxt_box">
        <h2>Oooops.... Could not find it</h2>
        <div class="erroe_txt">For Some Reason The Page You Requested Could Not Be Found On Our Server.</div>
        <div class="erroe_center_txt">
            4<img src="{{url('images/confused.gif')}}" alt="image">4
        </div>
        {{--<a href="#" class="btn btn-warning"><i class="mdi mdi-arrow-left errorbtn_icon"></i>Go Back</a>--}}
    </div>
</div>
<div class="particules" id="particles-js"></div>
<script type="text/javascript" src="{{url('admin/js/Animate_Particules.js')}}"></script>

{{--<div class="container">
    <div class="content">
        <div class="title">Sorry, the page you are looking for could not be found.</div>
    </div>
</div>--}}
</body>
</html>
