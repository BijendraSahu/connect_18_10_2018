<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('login.login');
//});
Route::GET('logout', function () {
    session_start();
    $_SESSION['user_master'] = null;
    return redirect('/');
});

Route::GET('lgt', function () {
    session_start();
    $_SESSION['admin_master'] = null;
    return redirect('/access');
});

Route::GET('/', function () {
    $country = \App\Country::getCountry();
    return view('login.login')->with(['country' => $country]);
});

Route::GET('test', function () {
    return view('test');
});

Route::post('change_password', 'LoginController@change_password');
Route::POST('change_theme', 'ProfileController@change_theme');
Route::POST('checkrc', 'LoginController@checkrc');
Route::POST('checkno', 'LoginController@checkno');
Route::POST('checkemail', 'LoginController@checkemail');
Route::POST('checkcontact', 'LoginController@checkcontact');


//Route::get('/', 'LoginController@getlogin');
Route::post('login', 'LoginController@login');
Route::post('register', 'LoginController@register');
Route::post('postreg', 'LoginController@postregister');
Route::post('verify_otp', 'LoginController@verify_otp');
Route::post('resendotp', 'LoginController@resend_otp');
Route::post('forgot_password', 'LoginController@forgot_password');

Route::get('coming_soon', 'LoginController@coming_soon');
Route::get('profiles', 'TimelineController@profile');
//Route::get('profile/{slug}/{id}', 'TimelineController@profileupdate');
Route::post('profileupdate', 'TimelineController@profileupdate');
Route::get('dashboard', 'TimelineController@dashboard');


Route::post('postfollow/{id}', 'PostController@post_follow');

Route::resource('my-profile', 'ProfileController');
Route::resource('my-earning', 'EarningController');
Route::resource('my-network', 'NetworkController');
Route::resource('member', 'MemberController');
Route::resource('buys', 'BuySellController');


Route::get('ads-earning', 'EarningController@adsearning');
Route::get('myprofile', 'ProfileController@edit');
Route::post('myprofile', 'ProfileController@updateprofile');


/*********Buy and sell**********/
Route::get('bsc/{slug}', 'BuySellController@buysellbycategory');
/*********Buy and sell**********/


/*********Redeem*******/
Route::get('redeem-history', 'RedeemController@redeemhisty');
/********Redeem********/

/*********Member Find************/
Route::get('member-profession/{slug}', 'MemberController@member_profession');
Route::get('friendmember/{id}', 'MemberController@friendmember');
/*********Member Find************/

/***********Report***********/
Route::get('report_post', 'AdminController@report_post');
Route::get('view_report_post', 'AdminController@view_report_post');
/***********Report***********/


/*******Ads***********/
Route::get('buy', 'BuySellController@buy');
Route::get('myads', 'BuySellController@myads');
Route::get('myads/{id}/delete', 'BuySellController@delete');
/*******Ads***********/

/**************Admin*************/
Route::get('saverc', 'AdminController@saverc');
//Route::resource('admin', 'AdminController');
Route::get('ads/{id}/approve', 'AdminController@approve');
Route::get('markaspaid/{id}', 'AdminController@markaspaid');
Route::get('markasunpaid/{id}', 'AdminController@markasunpaid');

Route::get('markasinactive/{id}', 'AdminController@markasinactive');
Route::get('markasactive/{id}', 'AdminController@markasactive');

Route::get('redeem/{id}/approve', 'AdminController@redeem_approve');
Route::post('redeem_reject', 'AdminController@redeem_reject');

Route::get('ads', 'AdminController@getAllAds');

//Route::get('adreject/{id}/reason', 'AdminController@rejectreason');
Route::get('adreject', 'AdminController@rejectreason');
Route::post('adreject', 'AdminController@rejectsubmit');
Route::get('regs', 'AdminController@registrationlist');
Route::get('view_user/{id}', 'AdminController@view_user');
Route::get('freeregs', 'AdminController@freeregistrationlist');
Route::get('paidregs', 'AdminController@paidregistrationlist');
Route::get('clsads', 'AdminController@clickadslist');
Route::get('admin_cp', 'AdminController@change_password');
Route::get('redeems', 'AdminController@redeems');


Route::get('admin-profile', 'AdminController@admin_profile');
Route::post('admin-profile', 'AdminController@admin_profile_edit');


Route::resource('notificn', 'NotificationController');
Route::get('notification/{id}/delete', 'NotificationController@destroy');
Route::get('notification/{id}/active', 'NotificationController@active');
//Route::get('/admin', function () {
//    return view('admin.admin_login');
//});
Route::get('access', 'AdminController@getlogin');
Route::post('adminlogin', 'AdminController@login');
Route::get('home', 'AdminController@index');

Route::resource('advertisement', 'AdminAdsController');
Route::get('advertisement/{id}/delete', 'AdminAdsController@destroy');

/**************Ads Clicks*************/
Route::POST('postadsclick', 'AdminAdsController@postadsclick');
Route::get('notification_click', 'AdminAdsController@notification_click');
/**************Ads Clicks*************/

Route::get('getpaytmlist', 'AdminController@getpaytm');
Route::get('paytmlink/{id}/edit', 'AdminController@editpaytm');
Route::post('paytm/{id}', 'AdminController@savepaytm');
Route::get('paytm_redirect', 'AdminController@paytm_redirect');

Route::get('orders', 'AdminController@orders');
Route::post('order_update/{id}', 'AdminController@order_update');
Route::get('view_orders/{id}', 'AdminController@view_orders');


/**************Admin*************/


/*******Friend Search***********/
Route::get('getfriend/{id}', 'ProfileController@getAllUser');
Route::get('friend', 'ProfileController@search_friend');
/*******Friend Search***********/

/*******Request*******/
Route::post('sendrequest', 'ProfileController@sendrequest');
Route::post('cancelrequest', 'ProfileController@cancelrequest');
Route::post('requestlist', 'ProfileController@requestlist');
Route::get('notificationlist', 'ProfileController@notificationlist');
Route::get('messagelist', 'ProfileController@messagelist');
Route::post('acceptrequest', 'ProfileController@acceptrequest');
Route::post('acceptfrequest', 'ProfileController@acceptfrequest');
Route::post('rejectrequest', 'ProfileController@rejectrequest');

Route::get('wunfriend', 'ProfileController@unfriend');
/*******Request*******/


/*******Post Load*******/
Route::POST('userpost', 'PostController@post_store');

//Route::post('postload', 'PostController@postload');
Route::post('postload', 'PostController@getPost');
Route::post('morepostload', 'PostController@getPost');

Route::post('friendpostload', 'PostController@getFriendPost');
Route::post('friendmorepostload', 'PostController@getFriendPost');

Route::post('dashboard_post', 'PostController@getDashboardPost');
Route::post('latest_dashboard_post', 'PostController@latest_dashboard_post');

Route::POST('likepost', 'PostController@post_likes');
Route::POST('unlikepost', 'PostController@post_unlikes');
Route::get('spampost', 'PostController@post_spam');
Route::get('post_unlikes', 'PostController@post_unlikes');
Route::get('postlikelist', 'PostController@postlikelist');


Route::get('getcommentlist', 'PostController@getcommentlist');
Route::post('post_comment', 'PostController@post_comment');


Route::get('post/{id}/delete', 'PostController@post_delete');
Route::get('show_notification_post', 'PostController@show_notification_post');


Route::get('getsfriend', 'ProfileController@getsfriend');

/*******Post Load*******/


/*******Login Button*******/
Route::get('aboutus', function () {
    return view('login.about_us');
});
Route::get('faq', function () {
    return view('login.faq');
});
Route::get('privacy', function () {
    return view('login.privacy');
});
Route::get('terms', function () {
    return view('login.terms_condition');
});
Route::get('contact', function () {
    return view('login.contact');
});
/*******Login Button*******/


/*******Vasu*******/
//vRC -> verify referral code
Route::post('vRC', 'NetworkController@verifyReferralCode');
/*******Vasu*******/

/******** Payment Gateway */
Route::post('make-payment/{id}', 'PaymentController@makePayment');
Route::get('payu-transaction-completed', 'PaymentController@onPaymentSuccess');
Route::post('payu-failed', 'PaymentController@payuFailed');
Route::get('paytm-transaction-details', 'PaymentController@paytmTransactionDetails');
/*Route::get('success', function () {
    return view('payment.pymnt_done');
});*/
Route::post('adr', 'PaymentController@adr');
//redeem earnings
Route::post('rdm', 'EarningController@addBankDetailsToRedeem');
Route::post('guad', 'EarningController@getUserAccountDetails');
Route::get('gmbrs', 'NetworkController@getMembersToCreateNetwork');
Route::post('gpys', 'NetworkController@getPaymentStatus');


Route::post('ge', 'EarningController@getEarnings');


Route::post('loadNetwork', 'NetworkController@loadchilds');

Route::get('subchild/{id}', 'NetworkController@subchild');
Route::post('loadSubNetwork', 'NetworkController@loadsubchilds');
Route::post('image-crop', 'TimelineController@profileImage');

Route::get('create_affiliates', 'AdminController@createAffiliates');
Route::post('save_affiliates', 'AdminController@save_affiliates');
Route::get('affiliateslist', 'AdminController@affiliateslist');
Route::get('deleteAffiliate/{id}', 'AdminController@deleteAffiliate');


Route::get('privacy_setting', 'ProfileController@getprivacy_setting');
Route::post('privacy_setting', 'ProfileController@saveprivacy_setting');

////////////*Ecommerse
Route::get('item_list', 'CartController@item_list');
Route::get('cart_load', 'CartController@cartload');
Route::post('cart_update/{id}', 'CartController@cart_update');
Route::get('addtocart', 'CartController@addtocart');
Route::get('cart_delete/{id}', 'CartController@delete');
Route::get('checkout', 'CartController@checkout');
Route::get('payment', 'CartController@payment');
Route::post('success', 'CartController@payment_success');
Route::post('e_atom_payment', 'CartController@e_atom_payment');
Route::post('failed', 'CartController@payment_failed');

////////////*Ecommerse



//API
Route::get('user_login', 'APIController@login');
Route::get('resend_otp', 'APIController@resend_otp');
Route::get('verifyotp', 'APIController@verifyotp');
Route::get('user_registration', 'APIController@user_registration');
Route::get('user_ads', 'APIController@user_ads');
Route::get('all_ads', 'APIController@all_ads');
Route::get('get_category', 'APIController@get_category');
Route::get('friendlist', 'APIController@checkfriend');
Route::get('getPost', 'APIController@getPost'); //post
Route::get('getPost_new', 'APIController@getPost_new'); //post
Route::get('getPostbyid', 'APIController@getPostbyid'); //post
Route::get('getDashboardPost', 'APIController@getDashboardPost'); //post
Route::get('getDashboardPost_new', 'APIController@getDashboardPost_new'); //post
Route::get('getFriendPost', 'APIController@getFriendPost'); //post
Route::POST('addpost', 'APIController@addpost'); //post
Route::POST('addpost2', 'APIController@addpost2'); //post
Route::POST('post_video', 'APIController@post_video'); //post
Route::get('postshare', 'APIController@postshare'); //post
Route::get('sr', 'APIController@sendrequest'); //send_request
Route::get('ar', 'APIController@acceptrequest'); //acceptrequest
Route::get('cancel_r', 'APIController@cancelrequest'); //cancelrequest
Route::get('r_list', 'APIController@requestlist'); //acceptrequest
//Route::get('cr', 'APIController@checkrequest'); //checkrequest
Route::get('cp', 'APIController@change_password'); //changepass
Route::get('u_search', 'APIController@searchuser'); //usersearch
Route::get('cr', 'APIController@checkrequest'); //checkrequest
Route::get('unfriend', 'APIController@unfriend'); //unfrind
Route::get('adsbycategory', 'APIController@adsbycategory'); //adsbycat
Route::get('clist', 'APIController@commentlist'); //comment_list
Route::get('pllist', 'APIController@postlikelist'); //Like_list
Route::POST('addads', 'APIController@addads'); //user ad_list
Route::get('uadsdelete', 'APIController@myadsdelete'); //user ad_list
Route::get('pdelete', 'APIController@post_delete'); //user ad_list
Route::get('notice', 'APIController@notice'); //show notification
Route::get('panic', 'APIController@addpanic'); //add panic
Route::get('editpanic', 'APIController@editpanic'); //edit panic
Route::get('showpanic', 'APIController@showpanic'); //show panic
Route::get('sendpanic', 'APIController@sendpanic'); //show panic
Route::POST('testupload', 'APIController@testupload'); //test
Route::POST('profileupload', 'APIController@profileupload'); //Profile
Route::get('removeProfile', 'APIController@removeProfile'); //Profile
Route::get('redeem_hstr', 'APIController@redeem_hstr'); //Redeems show
Route::post('addredeem', 'APIController@addBankDetailsToRedeem'); //Redeems Add
Route::get('about', 'APIController@about'); //About
Route::get('forgetp', 'APIController@forgetp'); //pass
Route::get('success_payment', 'APIController@success_payment'); //About

Route::get('user_list', 'APIController@user_list'); //About
Route::get('save_rc', 'APIController@saverc');

Route::get('getmember', 'APIController@getmember'); //Abo
Route::get('change_privacy', 'APIController@change_privacy'); //Abo

////////////*Ecommerse
Route::post('confirm_checkout','APIController@confirm_checkout');
Route::get('getOrders','APIController@getOrders');
Route::get('getItem','APIController@get_items');

Route::get('insert_address', 'APIController@insert_user_address');
Route::get('update_address', 'APIController@update_user_address');
Route::get('get_address', 'APIController@get_address_by_uid');
Route::get('getState', 'APIController@getState');
Route::get('getCity', 'APIController@getCity');


Route::get('like_post', 'APIController@like_post');
Route::get('unlike_post', 'APIController@unlike_post');
Route::get('spam_post', 'APIController@spam_post');
Route::get('savecomment', 'APIController@savecomment');
Route::get('post_text', 'APIController@post_text');

Route::get('products', 'ProductController@show');
Route::post('create_product', 'ProductController@store');
Route::get('create_product', 'ProductController@create');
Route::get('edit_product/{id}', 'ProductController@edit');
Route::put('update_product/{id}', 'ProductController@update');
Route::get('delete_product/{id}', 'ProductController@delete');



////////////*Ecommerse

Route::GET('getpaytm', function () {
    $paytm = \App\PaytmLink::find(1);
    $ret['response'] = $paytm->link;
    echo json_encode($ret);
});
//unfriend

//Chat
Route::get('checkincomingCall', 'APIController@checkincomingCall'); //About
Route::get('updatecall', 'APIController@updatecall'); //About
Route::get('checkdata', 'APIController@checkdata'); //About
Route::get('getallusers', 'APIController@getallusers'); //About
Route::get('getrc', 'APIController@getrcdetails'); //getrc
Route::get('getuserearning', 'APIController@getuserearning'); //getrc
Route::get('make_as_read_noti', 'APIController@make_as_read_noti'); //getrc
Route::get('remove_noti', 'APIController@remove_noti'); //getrc


Route::get('getusernotification', 'APIController@getusernotification'); //getrc


Route::post('atom_payment', 'PaymentController@atom_payment');
Route::get('send', 'MailController@send');
Route::get('test', 'MailController@test');


Route::GET('test', function () {
    return view('test');
});


Route::get('test2', function () {
    event(new App\Events\StatusLiked(4));
    return "Event has been sent!";
    //\App\AdminModel::getWebNotification();
});


