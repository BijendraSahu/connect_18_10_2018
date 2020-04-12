<?php

namespace App\Http\Controllers;

use App\Cities;
use App\ContactUs;
use App\Country;
use App\FirebaseModel;
use App\LoginDetail;
use App\PHPMailer;
use App\Timeline;
use App\UserModel;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

session_start();

class LoginController extends Controller
{
    public function getlogin()
    {
        $country = Country::getCountry();
        return view('login.login')->with(['country' => $country]);
    }

    public function contact_us()
    {
        $contact = new ContactUs();
        $contact->name = request('name');
        $contact->email = request('email');
        $contact->contact = request('contact');
        $contact->message = request('message');
        $contact->save();
        return redirect('/')->with('message', 'Thanks for contacting us we will get back to you soon...');
//        $country = Country::getCountry();
//        return view('login.login')->with(['country' => $country]);
    }

    public function login(Request $request)
    {
        $username = request('email_id');
        $password = request('password');
        $user = UserModel::where(['email' => $username, 'password' => md5($password)])->first();
        if ($user != null) {
//            if ($user->active == 1) {
            if ($user->verified == 1) {
                $_SESSION['user_master'] = $user;
                $user->active = 1;
                $user->save();
                $timeline = Timeline::find($user->timeline_id);
                $user1 = new UserModel();
                $_SESSION["UID"] = $user1::select('id')->where('email', $username)->get()->first()->id;
                // This Session is used in making Payment
                $_SESSION['user_timeline'] = $timeline;

                /***********chat*************/
                $_SESSION['user_id'] = $user->id;
                $_SESSION['username'] = $user->username;
                $loginDetails = new LoginDetail();
                $loginDetails->user_id = $user->id;
                $loginDetails->save();
                $_SESSION['login_details_id'] = $loginDetails->login_details_id;
                /***********chat*************/

                return redirect('dashboard');
//            return redirect('profile/' . str_slug($timeline->fname . " " . $timeline->lname));
            } else {
                $otp = rand(100000, 999999);
                $user_master = UserModel::find($user->id);
                $user_master->otp = $otp;
                $user_master->save();
//                    file_get_contents("http://63.142.255.148/api/sendmessage.php?usr=connectingone&apikey=A0F25813739CF5A748C8&sndr=CONONE&ph=$user->contact&message=Dear%20user,%20verification%20code%20to%20login%20into%20connectingone%20is%20$otp");
                file_get_contents("http://api.msg91.com/api/sendhttp.php?sender=CONONE&route=4&mobiles=$user_master->contact&authkey=213418AONRGdnQ5ae96f62&country=91&message=Dear%20user,%20verification%20code%20to%20login%20into%20connectingone%20is%20$otp");
                return Redirect::back()->with('message', 'Verification code has send to your registered mobile number...');
            }
//            } else
//                return Redirect::back()->withInput()->withErrors(array('message' => 'Your account has been deactivated by Administrator'));

        } else
            return Redirect::back()->withInput()->withErrors(array('message' => 'Email or password Invalid'));
    }

    public function register()
    {
        return view('login.login'); // login + Registration
    }

    public function coming_soon()
    {
        return view('coming_soon'); // login + Registration
    }

    public function postregister()
    {
        $checkuser = UserModel::where(['email' => request('email')])->first();
        $checkcontact = UserModel::where(['contact' => request('contact')])->first();
        if (isset($checkuser)) {
            echo "Email already";
        } elseif (isset($checkcontact)) {
            echo "Contact already";
        } else {
            $timeline = new Timeline();
            $timeline->name = request('fname') . " " . request('lname');
            $timeline->fname = request('fname');
            $timeline->lname = request('lname');
            $timeline->save();
            $contact = request('contact');
            $otp = rand(100000, 999999);
            $rc = rand(10000000, 99999999);

            $user = new UserModel();
            $user->timeline_id = $timeline->id;
            $user->email = request('email');
//        $user->rc = request('rc');
            $user->contact = $contact;
            $user->birthday = Carbon::parse(request('dob'))->format('Y-m-d');
            $user->password = md5(request('password'));
            $user->city = request('city');
            $user->state = request('state');
            $user->country_id = request('country');
            $user->gender = request('gender');
            $user->otp = $otp;
            $user->rc = "rc" . $rc;
            $user->save();
// Session to store userid only for transactions
            $user_ = new UserModel();
            $_SESSION["UID"] = $user_::select('id')->where('email', request('email'))->get()->first()->id;
            /////////////////////////////
            $timeline = Timeline::find($user->timeline_id);
            $_SESSION['user_timeline'] = $timeline;
            $_SESSION['user_master'] = $user;
//            file_get_contents("http://63.142.255.148/api/sendmessage.php?usr=connectingone&apikey=A0F25813739CF5A748C8&sndr=CONONE&ph=$contact&message=Dear%20user,%20OTP%20to%20login%20into%20connectingone%20is%20$otp");
            file_get_contents("http://api.msg91.com/api/sendhttp.php?sender=CONONE&route=4&mobiles=$contact&authkey=213418AONRGdnQ5ae96f62&country=91&message=Dear%20user,%20OTP%20to%20login%20into%20connectingone%20is%20$otp");


            /*-------------MLM  Started---------------*/
            $this->CreateRelation(request('rc'));
            /*-------------MLM  Ends---------------*/


            /***********Mail************/
            $allmails = [request('email')];

            foreach ($allmails as $mail) {
                $email[] = $mail;
            }
            if (count($email) > 0) {
                $mail = new \App\Mail();
                $mail->to = implode(",", $email);
                $mail->subject = 'Connecting-one';
                $siteurl = 'https://www.connecting-one.com/';
                $username = request('fname') . " " . request('lname');
                $salutation = request('gender') == 'male' ? "Mr." : "Ms.";

                $message = '<table width="650" cellpadding="0" cellspacing="0" align="center" style="background-color:#ececec;padding:40px;font-family:sans-serif;overflow:scroll"><tbody><tr><td><table cellpadding="0" cellspacing="0" align="center" width="100%"><tbody><tr><td><div style="line-height:50px;text-align:center;background-color:#fff;border-radius:5px;padding:20px"><a href="' . $siteurl . '" target="_blank" ><img style="width: 50%;" src="' . $siteurl . 'images/logo.png"></a></div></td></tr><tr><td><div><img src="' . $siteurl . 'images/acknowledgement.jpg" style="height:auto;width:100%;" tabindex="0"><div dir="ltr" style="opacity: 0.01; left: 775px; top: 343px;"><div><div class="aSK J-J5-Ji aYr"></div></div></div></div></td></tr><tr><td style="background-color:#fff;padding:20px;border-radius:0px 0px 5px 5px;font-size:14px"><div style="width:100%"><h1 style="color:#007cc2;text-align:center">Thank you ' . $salutation . ' ' . $username . '</h1><p style="font-size:14px;text-align:center;color:#333;padding:10px 20px 10px 20px">Thank you for your registration in www.connecting-one.com is a unique Earning & advertising platform that brings together the socially conscious members & Advertisers.<br   /> Your otp is ' . $otp . '</p></div></td></tr></tbody></table></td></tr><tr><td style="padding:20px;font-size:12px;color:#797979;text-align:center;line-height:20px;border-radius:5px 5px 0px 0px">DISCLAIMER - The information contained in this electronic message (including any accompanying documents) is solely intended for the information of the addressee(s) not be reproduced or redistributed or passed on directly or indirectly in any form to any other person.</td></tr></tbody></table>';

                $mail->body = $message;
                if ($mail->send_mail()) {
                    //return redirect('mail')->withErrors('Email sent...');
                } else {
                    //return redirect('mail')->withInput()->withErrors('Something went wrong. Please contact admin');
                }
//            echo $message;
            }
        }
        /***********Mail************/
    }


    public
    function CreateRelation($rfrcd)
    {
        $user = new UserModel();
        if (empty($rfrcd))
            $rfrcd = 0;
        // Get ID from registered Email ID
        $regID = $user::select('id')->where('email', request('email'))->get()->first();
        $user_Reg_ID = $regID->id;
        // parent_id is referal_id here, Usinf Id as referal_id
        $rel = \App\relation::where(['parent_id' => $rfrcd, 'child_id' => $user_Reg_ID])->first();
        if (!isset($rel)) {
            $add_rltns = array('parent_id' => $rfrcd, 'child_id' => $user_Reg_ID);
            DB::table('relations')->insert($add_rltns);
        }
    }

    public
    function resend_otp()
    {
        $otp = rand(100000, 999999);
        $contact = request('contact');
        $user = UserModel::where(['contact' => $contact])->first();
        if (isset($user)) {
            $user_master = UserModel::find($user->id);
            $user_master->otp = $otp;
            $user_master->save();
//            file_get_contents("http://63.142.255.148/api/sendmessage.php?usr=connectingone&apikey=A0F25813739CF5A748C8&sndr=CONONE&ph=$user->contact&message=Dear%20user,%20OTP%20to%20login%20into%20connectingone%20is%20$otp");
            file_get_contents("http://api.msg91.com/api/sendhttp.php?sender=CONONE&route=4&mobiles=$user_master->contact&authkey=213418AONRGdnQ5ae96f62&country=91&message=Dear%20user,%20OTP%20to%20login%20into%20connectingone%20is%20$otp");
            $_SESSION['user_master'] = $user;
            echo 'ok';
        } else {
            echo 'Incorrect';
        }
    }

    public
    function forgot_password()
    {
        $otp = rand(100000, 999999);
        $contact = request('contact');
        $user = UserModel::where(['contact' => $contact])->first();
        if (isset($user)) {
            $user_master = UserModel::find($user->id);
            $user_master->password = md5($otp);
            $user_master->save();
//            file_get_contents("http://63.142.255.148/api/sendmessage.php?usr=connectingone&apikey=A0F25813739CF5A748C8&sndr=CONONE&ph=$user->contact&message=Dear%20user,%20Password%20to%20login%20into%20connectingone%20is%20$otp");
            file_get_contents("http://api.msg91.com/api/sendhttp.php?sender=CONONE&route=4&mobiles=$user_master->contact&authkey=213418AONRGdnQ5ae96f62&country=91&message=Dear%20user,%20Password%20to%20login%20into%20connectingone%20is%20$otp");

            $_SESSION['user_master'] = $user_master;
            echo 'ok';
        } else {
            echo 'Incorrect';
        }
    }

    public
    function verify_otp()
    {
        $otp = request('txtotp');
        $user = UserModel::where(['otp' => $otp])->first();
        if (isset($user)) {
            $user_master = UserModel::find($user->id);
            $user_master->verified = 1;
            $user_master->save();
            $_SESSION['user_master'] = $user_master;
            echo 'ok';
        } else {
            echo 'Incorrect';
        }
    }

    public
    function checkrc()
    {
        $rc = request('rc');
        $user_master = new UserModel();
        if (!$user_master->checkrc($rc)) {
            echo 'already';
        } else {
            echo 'ok';
        }
    }

    public
    function checkno()
    {
        $contact = request('contact');
        $user_master = new UserModel();
        if (!$user_master->checkcontact($contact)) {
            echo 'already';
        } else {
            echo 'ok';
        }
    }

    public
    function checkemail()
    {
        $email = request('email');
        $user_master = new UserModel();
        if (!$user_master->checkemail($email)) {
            echo 'already';
        } else {
            echo 'ok';
        }
    }

    public
    function checkcontact()
    {
        $contact = request('contact');
        $user_master = new UserModel();
        if (!$user_master->checkcontact($contact)) {
            echo 'already';
        } else {
            echo 'ok';
        }
    }

    public
    function logout()
    {
        Auth::logout();
        return redirect(' / ')->back();
    }

    /**
     *
     */
    public
    function change_password()
    {
//        echo request('newpassword');
//        echo request('confirmpassword');
        $status = '';
        // Output status
        $curr_pass = $_SESSION['user_master']->password;
        if (md5(request('oldpassword')) == $curr_pass) {
//            if (request('newpassword') == request('confirmpassword')) {
            $user = UserModel::find($_SESSION['user_master']->id);
            $user->password = md5(request('newpassword'));
            $user->save();
            $_SESSION['user_master'] = $user;
            echo 'ok';
//                return redirect('change_password')->withErrors(array('message' => 'Password changed successfully . '));
//            } else
//                return redirect('change_password')->withInput()->withErrors(array('message' => 'Passwords mismatch'));
        } else
//            return redirect('change_password')->withInput()->withErrors(array('message' => 'Incorrect current password'));
            echo 'Incorrect';
    }

    public function getStateCity()
    {
        $state = request('state');
        $cities = DB::select("select * from cities where State = '$state' and City IS NOT NULL order by City ASC");
        return view('city_list')->with(['cities' => $cities]);
    }

    public function selectedgetStateCity()
    {
        $state = request('state');
        $cities = DB::select("select * from cities where State = '$state' and City IS NOT NULL order by City ASC");
        $scity = request('city');
        return view('city_list')->with(['cities' => $cities, 'scity' => $scity]);
    }
}
