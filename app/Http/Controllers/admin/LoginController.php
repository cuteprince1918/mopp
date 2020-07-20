<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Users;
use App\Model\company_master;
use App\Model\university_master;
use App\Model\admin_master;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Redirect;
use Auth;
use Session;
use Illuminate\Support\Facades\Hash;
use App\model\Inquiry;
use App\model\SendSMS;

class LoginController extends Controller {

    protected $redirectTo = '/';

    public function __construct() {
        
    }

    public function login(Request $request) {
        if ($request->isMethod('post')) {
            if ($request['selection'] == '1') {
                $bojUser = new admin_master();
                $bojUser = $bojUser->getUsers($request);
                if ($bojUser == FALSE) {
                    $return['status'] = 'error';
                    $return['message'] = "Invaild Id Or Password";
                } else {

                    $request->session()->put('USERTYPE', $bojUser['user_type']);
                    $request->session()->put('NAME', $bojUser['name']);
                    $request->session()->put('EMAIL', $bojUser['email']);
                    $request->session()->put('IMAGE', $bojUser['image']);
                    $request->session()->put('USERNAME', $bojUser['username']);
                    $request->session()->put('PASSWORD', $bojUser['password']);

                    $return['status'] = 'success';
                    $return['message'] = "Well Done login Successfully!";
                    $return['redirect'] = route('admin-dashboard');
                }
                return json_encode($return);
                exit();
            } elseif ($request['selection'] == '2') {
                $bojUser = new university_master();
                $bojUser = $bojUser->getUsers($request);
                if ($bojUser == FALSE) {
                    $return['status'] = 'error';
                    $return['message'] = "Invaild Id Or Password";
                } else {
                    $return['status'] = 'success';
                    $return['message'] = "Well Done login Successfully!";
                    $return['redirect'] = route('/');
                }
                return json_encode($return);
                exit();
            } elseif ($request['selection'] == '3') {
                $bojUser = new company_master();
                $bojUser = $bojUser->getUsers($request);
                if ($bojUser == FALSE) {
                    $return['status'] = 'error';
                    $return['message'] = "Invaild Id Or Password";
                } else {
                    $return['status'] = 'success';
                    $return['message'] = "Well Done login Successfully!";
                    $return['redirect'] = route('/');
                }
                return json_encode($return);
                exit();
            }

//
//                $loginData = array(
//                    'fname' => Auth::guard('admin')->user()->fname,
//                    'lname' => Auth::guard('admin')->user()->lname,
//                    'mobile' => Auth::guard('admin')->user()->mobile,
//                    'email' => Auth::guard('admin')->user()->email,
//                    'id' => Auth::guard('admin')->user()->id,
//                    'user_type' => Auth::guard('admin')->user()->user_type,
//                );
//
//                Session::push('logindata', $loginData);
//
//                $return['status'] = 'success';
//                $return['message'] = "Well Done login Successfully!";
//                $return['redirect'] = route('dashboard');
//
//
////                return redirect('dashboard');
//            } else {
//
//                $return['status'] = 'error';
//                $return['message'] = "Invaild Id Or Password";
//            }
//            return json_encode($return);
//            exit();
        }

        $data['title'] = 'Login | Admin';
        $data['css'] = array('');
        $data['js'] = array('ajaxfileupload.js', 'jquery.form.min.js', 'login.js', 'comman_function.js', 'jquery.validate.min.js');
        $data['funinit'] = array('Login.init()');
        return view('admin.pages.loginpage', $data);
    }

    public function forgotpassword(Request $request) {
        if ($request->isMethod('post')) {
            if ($request['selection'] == '2') {
                $bojUser = new university_master();
                $bojUser = $bojUser->getUsersreset($request);
                if ($bojUser == FALSE) {
                    $return['status'] = 'error';
                    $return['message'] = "Invaild Email";
                } else {
                    $key = md5($request['email'] . now());
                    $bojUser = new university_master();
                    $bojUser = $bojUser->addKey($request, $key);
                    $objSendSms = new SendSMS();
                    $sendSMS = $objSendSms->sendMailltesting($request, $key);
                    $return['status'] = 'success';
                    $return['message'] = "Please Check Your Email To Reset Your Password!";
                    $return['redirect'] = route('/');
                }
                return json_encode($return);
                exit();
            } elseif ($request['selection'] == '3') {
                $bojUser = new company_master();
                $bojUser = $bojUser->getUsersreset($request);
                if ($bojUser == FALSE) {
                    $return['status'] = 'error';
                    $return['message'] = "Invaild Id Or Password";
                } else {
                    $key = md5($request['email'] . now());
                    $bojUser = new company_master();
                    $bojUser = $bojUser->addKey($request, $key);
                    $objSendSms = new SendSMS();
                    $sendSMS = $objSendSms->sendMailltesting($request);
                    $return['status'] = 'success';
                    $return['message'] = "Please Check Your Email To Reset Your Password!";
                    $return['redirect'] = route('/');
                }
                return json_encode($return);
                exit();
            }
        }
        $data['title'] = 'forgotpassword';
        $data['css'] = array('');
        $data['js'] = array('ajaxfileupload.js', 'jquery.form.min.js', 'login.js', 'comman_function.js', 'jquery.validate.min.js');
        $data['funinit'] = array('Login.freset()');
        return view('admin.pages.forgotpassword', $data);
    }

    public function resetpassword(Request $request, $id) {

        $bojUser = new company_master();
        $bojUser = $bojUser->checkKey($id);
        $bojUser1 = new university_master();
        $bojUser1 = $bojUser1->checkKey($id);
        if ($bojUser == '' && $bojUser1 == '') {
            print_r('Key does not match in our records please try again');
            die();
        } else {
            if ($request->isMethod('post')) {

                $bojUser = new company_master();
                $bojUser = $bojUser->updatepassword($request, $id);
                $bojUser1 = new university_master();
                $bojUser1 = $bojUser1->updatepassword($request, $id);
                if ($bojUser == FALSE && $bojUser1 == FALSE) {
                    $return['status'] = 'error';
                    $return['message'] = "Something is Wrong...";
                } else {
                    $bojUser = new company_master();
                    $bojUser = $bojUser->addKey($request, $request['key']);
//                    $objSendSms = new SendSMS();
//                    $sendSMS = $objSendSms->sendMailltesting($request);
                    $return['status'] = 'success';
                    $return['message'] = "Your password is successfully Reset";
                    $return['redirect'] = route('admin-login');
                }
                return json_encode($return);
                exit();
            }
            $data['title'] = 'resetpassword';
            $data['css'] = array('');
            $data['js'] = array('ajaxfileupload.js', 'jquery.form.min.js', 'login.js', 'comman_function.js', 'jquery.validate.min.js');
            $data['funinit'] = array('Login.reset()');
            $data['key'] = $id;
            return view('admin.pages.resetpassword', $data);
        }
    }

    public function logout(Request $request) {
//        print_r($request->session()->all());die();
        $request->session()->forget('_token');
        $request->session()->flush();
        return Redirect::to('/');
    }

    //new module of admin login

    public function adminlogin(Request $request) {
        if ($request->isMethod('post')) {
            $bojUser = new admin_master();
            $bojUser = $bojUser->getUsers($request);
            if ($bojUser == FALSE) {
                $return['status'] = 'error';
                $return['message'] = "Invaild Id Or Password";
            } else {

                $request->session()->put('USERTYPE', $bojUser['user_type']);
                $request->session()->put('NAME', $bojUser['name']);
                $request->session()->put('EMAIL', $bojUser['email']);
                $request->session()->put('IMAGE', $bojUser['image']);
                $request->session()->put('USERNAME', $bojUser['username']);
                $request->session()->put('PASSWORD', $bojUser['password']);

                $return['status'] = 'success';
                $return['message'] = "Well Done login Successfully!";
                $return['redirect'] = route('admin-dashboard');
            }
            return json_encode($return);
            exit();
        }
        $data['title'] = 'Login | Admin';
        $data['css'] = array('');
        $data['js'] = array('ajaxfileupload.js', 'jquery.form.min.js', 'login.js', 'comman_function.js', 'jquery.validate.min.js');
        $data['funinit'] = array('Login.init()');
        return view('admin.pages.adminloginpage', $data);
    }

    public function adminforgotpassword(Request $request) {
        if ($request->isMethod('post')) {
            $bojUser = new admin_master();
            $bojUser = $bojUser->getUsersreset($request);
            if ($bojUser == FALSE) {
                $return['status'] = 'error';
                $return['message'] = "Invaild Email";
            } else {
                $key = md5($request['email'] . now());
                $bojUser = new admin_master();
                $bojUser = $bojUser->addKey($request, $key);
                $objSendSms = new SendSMS();
                $sendSMS = $objSendSms->sendMailltesting($request, $key);
                $return['status'] = 'success';
                $return['message'] = "Please Check Your Email To Reset Your Password!";
                $return['redirect'] = route('/');
            }
            return json_encode($return);
            exit();
        }
        $data['title'] = 'forgotpassword';
        $data['css'] = array('');
        $data['js'] = array('ajaxfileupload.js', 'jquery.form.min.js', 'login.js', 'comman_function.js', 'jquery.validate.min.js');
        $data['funinit'] = array('Login.freset()');
        return view('admin.pages.adminforgotpassword', $data);
    }

    public function adminresetpassword(Request $request, $id) {

        $bojUser = new admin_master();
        $bojUser = $bojUser->checkKey($id);
        if ($bojUser == '') {
            print_r('Key does not match in our records please try again');
            die();
        } else {
            if ($request->isMethod('post')) {

                $bojUser = new admin_master();
                $bojUser = $bojUser->updatepassword($request, $id);
                if ($bojUser == FALSE) {
                    $return['status'] = 'error';
                    $return['message'] = "Something is Wrong...";
                } else {
//                    $bojUser = new admin_master();
//                    $bojUser = $bojUser->addKey($request, $request['key']);
                    $return['status'] = 'success';
                    $return['message'] = "Your password is successfully Reset";
                    $return['redirect'] = route('admin-login');
                }
                return json_encode($return);
                exit();
            }
            $data['title'] = 'resetpassword';
            $data['css'] = array('');
            $data['js'] = array('ajaxfileupload.js', 'jquery.form.min.js', 'login.js', 'comman_function.js', 'jquery.validate.min.js');
            $data['funinit'] = array('Login.reset()');
            $data['key'] = $id;
            return view('admin.pages.adminresetpassword', $data);
        }
    }

}
