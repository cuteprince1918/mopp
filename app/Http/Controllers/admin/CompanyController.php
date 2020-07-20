<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\company_master;

class CompanyController extends Controller {

    public function company() {


        $data['title'] = 'Company | Admin';
        $data['css'] = array('');
        $data['js'] = array('ajaxfileupload.js', 'jquery.form.min.js', 'company.js', 'comman_function.js', 'jquery.validate.min.js');
        $data['funinit'] = array('Company.init()');
        return view('admin.pages.company.company', $data);
    }

    public function add(Request $request) {
        if ($request->isMethod('post')) {
//            print_r($request->input());die();
            $objCompany = new company_master();
            $res = $objCompany->addCompany($request);
            if ($res == "add") {
                $return['status'] = 'success';
                $return['message'] = 'Company added successfully.';
                $return['redirect'] = route('company');
            }

            if ($res == "exits") {
                $return['status'] = 'error';
                $return['message'] = 'Company Already Exist!';
            }
            if ($res == "wrong") {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
        $data['title'] = 'Add Company | Admin';
        $data['css'] = array();
        $data['js'] = array('ajaxfileupload.js', 'jquery.form.min.js', 'company.js', 'comman_function.js', 'jquery.validate.min.js');
        $data['funinit'] = array('Company.add()');
        return view('admin.pages.company.add', $data);
    }

    public function edit(Request $request, $id) {
        if ($request->isMethod('post')) {
            $objCompany = new company_master();
            $res = $objCompany->editCompany($request, $id);
            if ($res == "add") {
                $return['status'] = 'success';
                $return['message'] = 'Company edited successfully.';
                $return['redirect'] = route('company');
            }

            if ($res == "exits") {
                $return['status'] = 'error';
                $return['message'] = 'Company Already Exist!';
            }
            if ($res == "wrong") {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
        $objCompany = new company_master();
        $data['company'] = $objCompany->getCompany($request, $id);
        $data['title'] = 'Add Company | Admin';
        $data['css'] = array();
        $data['js'] = array('ajaxfileupload.js', 'jquery.form.min.js', 'company.js', 'comman_function.js', 'jquery.validate.min.js');
        $data['funinit'] = array('Company.edit()');
        return view('admin.pages.company.edit', $data);
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {

            case 'getdatatable':
                $objCompany = new company_master();
                $list = $objCompany->getdatatable();
                echo json_encode($list);
                break;

            case 'deletecompany':
                $objLogo = new company_master();
                $res = $objLogo->deletecompany($request->input('data'));
                if ($res) {
                    $return['status'] = 'success';
                    $return['message'] = 'Company Deleted successfully.';
                    $return['redirect'] = route('company');
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'something will be wrong.';
                }
                echo json_encode($return);
                break;
        }
    }

}
