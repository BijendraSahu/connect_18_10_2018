<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Faq</title>
    @include('login.plugin_header')
</head>
<body class="bg_profile_color">
@include('login.outer_master')
<div class="privacy_images">
    <div id="particles-js" class="canvas_block"></div>
    <script src="{{ asset('js/Social_Connectivity.js') }}"></script>
<div class="overlay_image">

</div>
<div class="main_heading">
    <h1>FAQ</h1>
</div>
</div>
<div class="container">
    <div class="basic_otherformbox">
        <div class="data_heading">Frequently Asked Question</div>
        <div id="accordion" role="tablist" aria-multiselectable="true">
            <div class="faq_quesbox">
                <div class="card-header" role="tab" id="headingOne">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        How can I Post ?
                    </a>
                </div>
                <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="innershow_block">
                        There is a button “ post” from there u should post, apart from that u will post , image, vedio, text and emogies too.
                    </div>
                </div>
            </div>
            <div class="faq_quesbox">
                <div class="card-header" role="tab" id="headingTwo">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        How i pay for membership/ paid services.
                    </a>
                </div>
                <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="innershow_block">
                        You should pay through the given payment gateways only.
                    </div>
                </div>
            </div>
            <div class="faq_quesbox">
                <div class="card-header" role="tab" id="headingThree">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Where Can i view my Members Feed?
                    </a>
                </div>
                <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="innershow_block">
                        It will automatically come to your news feed/ home page.
                    </div>
                </div>
            </div>
            <div class="faq_quesbox">
                <div class="card-header" role="tab" id="headingThree">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="false" aria-controls="collapseThree">
                        How does the search Feature work?
                    </a>
                </div>
                <div id="collapsefour" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="innershow_block">
                        You type  your friends/want to be friend name in the given search option it will show.
                    </div>
                </div>
            </div>
            <div class="faq_quesbox">
                <div class="card-header" role="tab" id="headingThree">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapsefive" aria-expanded="false" aria-controls="collapseThree">
                        How can i post my advertisement?
                    </a>
                </div>
                <div id="collapsefive" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="innershow_block">
                        There is a button on the menu, from there you put your request there.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>