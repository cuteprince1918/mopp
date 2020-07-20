<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\university_master;

class AdmindashboardController extends Controller {

    public function dashboard() {
        $data['title'] = 'Dashboard | Admin';
        $data['css'] = array('');
        $data['js'] = array('ajaxfileupload.js', 'jquery.form.min.js', 'dashboard.js', 'comman_function.js', 'jquery.validate.min.js');
        $data['funinit'] = array('Dashboard.init()');
        return view('admin.pages.dashboard.dashboard', $data);
    }

    public function univercity() {


        $data['title'] = 'Univercity | Admin';
        $data['css'] = array('');
        $data['js'] = array('ajaxfileupload.js', 'jquery.form.min.js', 'dashboard.js', 'comman_function.js', 'jquery.validate.min.js');
        $data['funinit'] = array('Dashboard.init()');
        return view('admin.pages.univercity.univercity', $data);
    }

    public function add(Request $request) {
        if ($request->isMethod('post')) {
//            print_r($request->input());die();
            $objUnivercity = new university_master();
            $res = $objUnivercity->addUnivercity($request);
            if ($res == "add") {
                $return['status'] = 'success';
                $return['message'] = 'Univercity added successfully.';
                $return['redirect'] = route('univercity');
            }

            if ($res == "exits") {
                $return['status'] = 'error';
                $return['message'] = 'Univercity Already Exist!';
            }
            if ($res == "wrong") {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
        $data['title'] = 'Add Univercity | Admin';
        $data['css'] = array();
        $data['js'] = array('ajaxfileupload.js', 'jquery.form.min.js', 'univercity.js', 'comman_function.js', 'jquery.validate.min.js');
        $data['funinit'] = array('Univercity.add()');
        return view('admin.pages.univercity.add', $data);
    }
    
    public function edit(Request $request, $id) {
        if ($request->isMethod('post')) {
            $objUnivercity = new university_master();
            $res = $objUnivercity->editUnivercity($request, $id);
            if ($res == "add") {
                $return['status'] = 'success';
                $return['message'] = 'Univercity edited successfully.';
                $return['redirect'] = route('univercity');
            }

            if ($res == "exits") {
                $return['status'] = 'error';
                $return['message'] = 'Univercity Already Exist!';
            }
            if ($res == "wrong") {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
        $objUnivercity = new university_master();
        $data['univercity'] = $objUnivercity->getUnivercity($request, $id);
        $data['title'] = 'Add Univercity | Admin';
        $data['css'] = array();
        $data['js'] = array('ajaxfileupload.js', 'jquery.form.min.js', 'univercity.js', 'comman_function.js', 'jquery.validate.min.js');
        $data['funinit'] = array('Univercity.edit()');
        return view('admin.pages.univercity.edit', $data);
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {

            case 'getdatatable':
                $objUnivercity = new university_master();
                $list = $objUnivercity->getdatatable();
                echo json_encode($list);
                break;

            case 'deleteunivercity':
                $objLogo = new university_master();
                $res = $objLogo->deleteunivercity($request->input('data'));
                if ($res) {
                    $return['status'] = 'success';
                    $return['message'] = 'Univercity Deleted successfully.';
                    $return['redirect'] = route('univercity');
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'something will be wrong.';
                }
                echo json_encode($return);
                break;
        }
    }

}
