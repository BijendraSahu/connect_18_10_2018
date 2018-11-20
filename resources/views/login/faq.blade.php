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
                    <a data-toggle="collapse" data-parent="#accordion" href="#faq_ques1" aria-expanded="true"
                       aria-controls="collapseOne">
                        To create a Connecting-One Account
                    </a>
                </div>
                <div id="faq_ques1" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                    <div class="innershow_block">
                        <ul class="faq_ul">
                            <li>Go to https://www.connecting-one.com/</li>
                            <li>Enter your name, Email or Mobile phone number, Date of Birth (DOB), password, City and
                                Gender.
                            </li>
                            <li>Click SUBMIT.</li>
                            <li>To finish creating your account, you need to confirm your email or mobile phone
                                number.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="faq_quesbox">
                <div class="card-header" role="tab" id="headingTwo">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#faq_ques2"
                       aria-expanded="false" aria-controls="collapseTwo">
                        If you're having a problem logging in
                    </a>
                </div>
                <div id="faq_ques2" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                    <div class="innershow_block">
                        <ul class="faq_ul">
                            <li>If you're having trouble with your password, learn how to reset your password.</li>
                            <li>If you still can't log in, find out what to do next.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="faq_quesbox">
                <div class="card-header" role="tab" id="headingThree">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#faq_ques3"
                       aria-expanded="false" aria-controls="collapseThree">
                        How to use my referral code while doing registration ?
                    </a>
                </div>
                <div id="faq_ques3" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="innershow_block">
                        <ul class="faq_ul">
                            <li>If you already have referral code of your friend the you can use it while doing
                                registration
                            </li>
                            <li>Click on Referral Code Field & complete filling rest of registration form</li>
                            <li>Click Submit</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="faq_quesbox">
                <div class="card-header" role="tab" id="headingThree">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#faq_ques4"
                       aria-expanded="false" aria-controls="collapseThree">
                        How What should I do if I don't have referral code ?
                    </a>
                </div>
                <div id="faq_ques4" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="innershow_block">
                        <ul class="faq_ul">
                            <li>If you don't have referral code of your friend the you can leave the space blank &
                                complete rest of your registration form
                            </li>
                            <li>Click Submit</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="faq_quesbox">
                <div class="card-header" role="tab" id="headingThree">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#faq_ques5"
                       aria-expanded="false" aria-controls="collapseThree">
                        What are the Benefits of using Referral Code ?
                    </a>
                </div>
                <div id="faq_ques5" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="innershow_block">
                        While doing Registration if user is creating profile using Referral code of any friend then that
                        friend will become parent of user with no real benifits later. It will get registered that user
                        created profile on referral by his/her friend
                    </div>
                </div>
            </div>

            <div class="faq_quesbox">
                <div class="card-header" role="tab" id="headingThree">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#faq_ques6"
                       aria-expanded="false" aria-controls="collapseThree">
                        How can I use Referral code to earn money ?
                    </a>
                </div>
                <div id="faq_ques6" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="innershow_block">
                        <ul class="faq_ul">
                            <li><b>You may do following :</b></li>
                            <li>Go to https://www.connecting-one.com/</li>
                            <li>Login to your profile</li>
                            <li>Click on My Earning on left panel </li>
                            <li>Make 1 Rupee payment using referral code of your friend</li>
                            <li>50 Paisa will get credit to your friends account on your successful payment </li>
                      <li>After this you will get your own Referral code which your friends can use while making payment</li>
                            <li>After each successful payment of 1 Rupee using your referral code you will earn 50 Paisa</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="faq_quesbox">
                <div class="card-header" role="tab" id="headingThree">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#faq_ques7"
                       aria-expanded="false" aria-controls="collapseThree">
                        How do I finish creating my ConnectingOne account and confirm my email or mobile phone number?
                    </a>
                </div>
                <div id="faq_ques7" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="innershow_block">
                    <ul class="faq_ul">
                        <li>To finish creating an account, you need to confirm that you own the email or mobile phone number that you used to create the account:</li>
                        <li>To confirm your mobile number, enter the code you get via text message (SMS) in the Confirm box that shows up when you log in. Learn what to do if you didn't get the SMS.</li>
                        <li>To confirm your email, click or tap the link in the email you got when you created the account. Learn what to do if you can't find the email.</li>
                        <li>Confirming your email or mobile number helps us know that we're sending your account info to the right place.</li>
                        <li>Note: Please confirm your email or mobile number as soon as possible. You may not be able to use your account until you confirm your email or mobile number.</li>
                    </ul>
                    </div>
                </div>
            </div>
            <div class="faq_quesbox">
                <div class="card-header" role="tab" id="headingThree">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#faq_ques8"
                       aria-expanded="false" aria-controls="collapseThree">
                        How do I change or reset my ConnectingOne password?
                    </a>
                </div>
                <div id="faq_ques8" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="innershow_block">
                        <ul class="faq_ul">
                            <li>To change your password on ConnectingOne if you're already logged in:</li>
                            <li>Click in the top right corner of any ConnectingOne home page and select change password.</li>
                            <li>Enter your old password</li>
                            <li>Enter your new password.</li>
                            <li>Confirm your new password.</li>
                            <li>Click on Update</li>
                            <li>If you're not logged in but have forgotten your password, then click Forgot your password? and follow the steps to reset it. Keep in mind that you'll need access to the email associated with your account.</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="faq_quesbox">
                <div class="card-header" role="tab" id="headingThree">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#faq_ques9"
                       aria-expanded="false" aria-controls="collapseThree">
                        Reset Your Password
                    </a>
                </div>
                <div id="faq_ques9" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="innershow_block">
                    <ul class="faq_ul">
                        <li>To reset your password if you're not logged in to ConnectingOne :</li>
                        <li>Go to the https://www.connecting-one.com/.</li>
                        <li>Click Forgot Password</li>
                        <li>Follow the on-screen instructions.</li>
                        <li>You will receive SMS on your Mobile which is your new password</li>
                    </ul>
                    </div>
                </div>
            </div>
            <div class="faq_quesbox">
                <div class="card-header" role="tab" id="headingThree">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#faq_ques10"
                       aria-expanded="false" aria-controls="collapseThree">
                        I didn't receive the code to confirm my mobile phone number.
                    </a>
                </div>
                <div id="faq_ques10" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="innershow_block">
                    <ul class="faq_ul">
                        <li>We're sorry you're having trouble confirming your mobile number. Here are some things you can try:</li>
                       <li>If you entered the wrong number ?</li>
                       <li>Enter the correct number and click Submit.</li>
                       <li>Wait for some time there may be delay in receiving OTP due to network congestion.</li>
                       <li></li>
                    </ul>
                    </div>
                </div>
            </div>
            <div class="faq_quesbox">
                <div class="card-header" role="tab" id="headingThree">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#faq_ques11"
                       aria-expanded="false" aria-controls="collapseThree">
                        Re-send the SMS
                    </a>
                </div>
                <div id="faq_ques11" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="innershow_block">
                    <ul class="faq_ul">
                        <li>Click Send SMS Again.</li>
                        <li><b>Use an email instead</b></li>
                        <li>Check your email for OTP.</li>
                        <li>Try confirming your ConnectingOne account with your email instead of a mobile number.</li>
                    </ul>
                    </div>
                </div>
            </div>
            <div class="faq_quesbox">
                <div class="card-header" role="tab" id="headingThree">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#faq_ques12"
                       aria-expanded="false" aria-controls="collapseThree">
                        I can't find my ConnectingOne signup confirmation email
                    </a>
                </div>
                <div id="faq_ques12" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="innershow_block">
                    <ul class="faq_ul">
                        <li>If you created a ConnectingOne account with an email, we sent a confirmation link to that email. If you can't find your confirmation email</li>
                        <li>Check your junk mail folder. If you're using Gmail, check your Social emails.</li>
                        <li>Make sure that you entered the correct email. If you entered the wrong email, you can change and send the email again.</li>
                        <li>You can try creating your ConnectingOne account with a mobile phone number instead of an email.</li>
                    </ul>
                    </div>
                </div>
            </div>
            <div class="faq_quesbox">
                <div class="card-header" role="tab" id="headingThree">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#faq_ques13"
                       aria-expanded="false" aria-controls="collapseThree">
                        I used the wrong email to create my ConnectingOne account. How do I change my email?
                    </a>
                </div>
                <div id="faq_ques13" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="innershow_block">
                    <ul class="faq_ul">
                        <li>To change your email and finish creating your ConnectingOne account:</li>
                        <li>Make sure that you have a secure email that only you can access.</li>
                        <li>Go to https://www.connecting-one.com/ and click in the top right corner of any ConnectingOne home page and select Edit profile </li>
                        <li>Enter an email or mobile number you have access to and click SUBMIT.</li>
                        <li>When you confirm the new email, we'll replace the incorrect email that you created the account with.</li>
                    </ul>
                    </div>
                </div>
            </div>
            <div class="faq_quesbox">
                <div class="card-header" role="tab" id="headingThree">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#faq_ques14"
                       aria-expanded="false" aria-controls="collapseThree">
                        How do I add or change my profile picture?
                    </a>
                </div>
                <div id="faq_ques14" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="innershow_block">
                    <ul class="faq_ul">
                        <li>Click in the top right corner of any ConnectingOne home page and select Edit profile</li>
                        <li>Click on Icon below Profile Picture.</li>
                        <li>You can upload a photo from your computer.</li>
                        <li>Crop & rotate your photo and click Set profile. If you don't want to crop your photo, click Set profile.</li>
                        <li>For best quality, your profile picture should be at least 320 pixels wide and 320 pixels tall.</li>
                        <li>Note: Your current profile picture is always public.</li>
                    </ul>
                    </div>
                </div>
            </div>
            <div class="faq_quesbox">
                <div class="card-header" role="tab" id="headingThree">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#faq_ques15"
                       aria-expanded="false" aria-controls="collapseThree">
                        How do I delete a profile picture?
                    </a>
                </div>
                <div id="faq_ques15" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="innershow_block">
                    <ul class="faq_ul">
                        <li>Click in the top right corner of any ConnectingOne home page and select Edit profile</li>
                        <li>Click Cross Icon below Profile Picture.</li>
                        <li>You will get a popup message for confirmation</li>
                        <li>Click OK to delete</li>
                        <li>Click Cancel if don't wish to delete</li>
                        <li>You will get confirmation with Popup</li>
                    </ul>
                    </div>
                </div>
            </div>
            <div class="faq_quesbox">
                <div class="card-header" role="tab" id="headingThree">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#faq_ques16"
                       aria-expanded="false" aria-controls="collapseThree">
                        How do I edit basic info on my profile and choose who can see it?
                    </a>
                </div>
                <div id="faq_ques16" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="innershow_block">
                    <ul class="faq_ul">
                        <li>To edit your basic personal info (example: Name, Gender, Contact info, Profession, Address):</li>
                        <li>Click in the top right corner of any ConnectingOne home page and select Edit profile</li>
                        <li>Click your name or Surname in respective fields to edit</li>
                        <li>Click buttons below your cover photo. Click SUBMIT</li>
                    </ul>
                    </div>
                </div>
            </div>
            <div class="faq_quesbox">
                <div class="card-header" role="tab" id="headingThree">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#faq_ques17"
                       aria-expanded="false" aria-controls="collapseThree">
                        How do I choose who can see my profile details?
                    </a>
                </div>
                <div id="faq_ques17" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="innershow_block">
                    <ul class="faq_ul">
                        <li>Click in the top right corner of any ConnectingOne home page and select Privacy Settings</li>
                        <li>Choose Public, Private or Friend Click Submit</li>
                        <li>You will get confirmation</li>
                    </ul>
                    </div>
                </div>
            </div>
            <div class="faq_quesbox">
                <div class="card-header" role="tab" id="headingThree">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#faq_ques18"
                       aria-expanded="false" aria-controls="collapseThree">
                        How do I adjust my mobile push notifications from ConnectingOne?
                    </a>
                </div>
                <div id="faq_ques18" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="innershow_block">
                    <ul class="faq_ul">
                        <li><b>ios</b></li>
                        <li>Tap Notifications > Facebook.</li>
                        <li>Tap next to Allow Notifications to turn notifications from Facebook on or off.</li>
                        <li><b>Android</b></li>
                        <li>To adjust your mobile push notifications on your Android device (OS 6.0+):</li>
                        <li>Go to your device settings.</li>
                        <li>Tap Applications > Application manager > ConnectingOne > Notifications.</li>
                        <li>Turn on or off notifications from ConnectingOne.</li>
                    </ul>
                    </div>
                </div>
            </div>
            <div class="faq_quesbox">
                <div class="card-header" role="tab" id="headingThree">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#faq_ques19"
                       aria-expanded="false" aria-controls="collapseThree">
                        How do I remove or cancel a friend request I received from someone?
                    </a>
                </div>
                <div id="faq_ques19" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="innershow_block">
                    <ul class="faq_ul">
                        <li>Go to profile of your friend to whom you sent your friend request.</li>
                        <li>Select Cancel Request </li>
                    </ul>
                    </div>
                </div>
            </div>
            <div class="faq_quesbox">
                <div class="card-header" role="tab" id="headingThree">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#faq_ques20"
                       aria-expanded="false" aria-controls="collapseThree">
                        How do I delete a friend request?
                    </a>
                </div>
                <div id="faq_ques20" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                    <div class="innershow_block">
                    <ul class="faq_ul">
                        <li>When you delete a friend request, the person who sent you the request won't be notified and can't send you another request for one year. To permanently stop that person from sending you another friend request, you can block them block them.</li>
                        <li>Go to https://www.connecting-one.com</li>
                        <li>Login to your account</li>
                        <li>Click on Friends Icon on main bar</li>
                        <li>Click Delete Request.</li>
                    </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>