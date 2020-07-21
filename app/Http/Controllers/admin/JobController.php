<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\job_master;
use App\Model\university_master;
use App\Model\student_master;

class JobController extends Controller {

    public function job() {


        $data['title'] = 'Job | Admin';
        $data['css'] = array('');
        $data['js'] = array('ajaxfileupload.js', 'jquery.form.min.js', 'job.js', 'comman_function.js', 'jquery.validate.min.js');
        $data['funinit'] = array('Job.init()');
        return view('admin.pages.job.job', $data);
    }

    public function add(Request $request) {
        
        if ($request->isMethod('post')) {
//            print_r($request->input());die();
            $objJob = new job_master();
            $res = $objJob->addJob($request);
            if ($res == "add") {
                $return['status'] = 'success';
                $return['message'] = 'Job added successfully.';
                $return['redirect'] = route('job');
            }

            if ($res == "exits") {
                $return['status'] = 'error';
                $return['message'] = 'Job Already Exist!';
            }
            if ($res == "wrong") {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
        $data['title'] = 'Add Job | Admin';
        $data['css'] = array();
        $data['js'] = array('ajaxfileupload.js', 'jquery.form.min.js', 'job.js', 'comman_function.js', 'jquery.validate.min.js');
        $data['funinit'] = array('Job.add()');
        return view('admin.pages.job.add', $data);
    }

    public function edit(Request $request, $id) {
        if ($request->isMethod('post')) {
            $objJob = new job_master();
            $res = $objJob->editJob($request, $id);
            if ($res == "add") {
                $return['status'] = 'success';
                $return['message'] = 'Job edited successfully.';
                $return['redirect'] = route('job');
            }

            if ($res == "exits") {
                $return['status'] = 'error';
                $return['message'] = 'Job Already Exist!';
            }
            if ($res == "wrong") {
                $return['status'] = 'error';
                $return['message'] = 'something will be wrong.';
            }
            echo json_encode($return);
            exit;
        }
        $objJob = new job_master();
        $data['job'] = $objJob->getJob($request, $id);
        $data['title'] = 'Add Job | Admin';
        $data['css'] = array();
        $data['js'] = array('ajaxfileupload.js', 'jquery.form.min.js', 'job.js', 'comman_function.js', 'jquery.validate.min.js');
        $data['funinit'] = array('Job.edit()');
        return view('admin.pages.job.edit', $data);
    }

    public function ajaxAction(Request $request) {
        $action = $request->input('action');
        switch ($action) {

            case 'getdatatable':
                $objJob = new job_master();
                $list = $objJob->getdatatable();
                echo json_encode($list);
                break;
            
            case 'getunivercity':
                $objUnivercity = new university_master();
                $list = $objUnivercity->getUnivercityBOX();
                echo json_encode($list);
                break;
            
            case 'getstudent':
                $objStudent = new student_master();
                $list = $objStudent->getstudent();
                echo json_encode($list);
                break;

            case 'deletejob':
                $objLogo = new job_master();
                $res = $objLogo->deletejob($request->input('data'));
                if ($res) {
                    $return['status'] = 'success';
                    $return['message'] = 'Job Deleted successfully.';
                    $return['redirect'] = route('job');
                } else {
                    $return['status'] = 'error';
                    $return['message'] = 'something will be wrong.';
                }
                echo json_encode($return);
                break;
        }
    }

}
