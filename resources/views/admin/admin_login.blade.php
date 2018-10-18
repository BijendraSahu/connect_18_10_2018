<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"/>
    <link rel="shortcut icon" type="images/png" href="{{url('images/fav.png')}}"/>
    <link rel="stylesheet" href="{{url('css/bootstrap.css')}}"/>
    <link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{url('css/materialdesignicons.min.css')}}"/>
    <link rel="stylesheet" href="{{url('css/Dashboard.css')}}"/>
    <link rel="stylesheet" href="{{url('css/media.css')}}"/>
    <link rel="stylesheet" href="{{url('css/my.css')}}"/>
    <!--   <link rel="stylesheet" href="https://gurayyarar.github.io/AdminBSBMaterialDesign/plugins/node-waves/waves.css" />-->
    <script src="{{url('js/jquery-3.2.1.min.js')}}"></script>
{{--    <script src="{{url('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js')}}"></script>--}}

    <script src="{{url('js/bootstrap.min.js')}}"></script>
    <script src="{{url('js/Global.js')}}"></script>
    <style type="text/css">
        .login_bg {
            background: url('{{url('images/login-bg.jpg')}}');
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
    </style>
    <script type="text/javascript">
        $.getScript("https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js", function () {
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
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
    </script>
</head>
<body class="login_bg">
<div class="container">
    <div class="row">
        <div class="col-xs-4 col-md-offset-8 login_form">
            <div class="logo_images">
                <img src="{{url('images/logo.png')}}"/>
            </div>
            <h2 class="login-caption"><span class="first_letter">L</span>ogin</h2>

            <form action="{{url('adminlogin')}}" method="post" enctype="multipart/form-data"
                  id="frmLogin">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group" style="backface-visibility: hidden;">
                    <div class="input-group" style="backface-visibility: hidden;">
                        <input type="text" class="form-control login_txt" name="username" placeholder="Type your email"
                               style="backface-visibility: hidden;">
                        <span class="input-group-addon" style="backface-visibility: hidden;">
                                          <i class="glyphicon glyphicon-user" style="backface-visibility: hidden;"></i>
                                      </span>
                    </div>
                </div>
                <div class="form-group" style="backface-visibility: hidden;">
                    <div class="input-group" style="backface-visibility: hidden;">
                        <input type="password" class="form-control login_txt" name="password"
                               placeholder="Type your password"
                               style="backface-visibility: hidden;">
                        <span class="input-group-addon" style="backface-visibility: hidden;">
                                          <i class="glyphicon glyphicon-lock" style="backface-visibility: hidden;"></i>
                                      </span>
                    </div>
                </div>
                <input type="submit" class="submit_btn btn btn-primary" value="Log in"/>
            </form>

        </div>
    </div>
</div>
@if($errors->any())
    <script type="text/javascript">
        setTimeout(function () {
            ShowErrorPopupMsg('{{ $errors->first() }}');
        }, 500);
    </script>
@endif
<div class="modal popup_bgcolor" id="error_popup">
    <div class="popup_box">
        <div class="alert_popup error_bg">
            <div class="popup_verified"><i class="mdi mdi-close"></i></div>
            <h4 class="popup_mainhead">Error Massage!</h4>
            <p class="popup-text dynamic_popuptxt">You have entered wrong text</p>
        </div>
        <div class="popup_submit">
            <button class="popup_submitbtn error_bg error_btn" type="submit" onclick="HidePopoupMsg();">ok</button>
        </div>
    </div>
</div>

<div></div>
<div class="particules" id="particles-js"></div>
<script type="text/javascript" src="{{url('admin/js/Animate_Particules.js')}}"></script>
</body>
</html>