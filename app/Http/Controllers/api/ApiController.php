<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\university_master;
use App\Model\company_master;

class ApiController extends Controller {

    public function getunivercitydata(Request $request) {

        $bojUser = new university_master();
        $bojUser = $bojUser->getunivercityapi();
        print_r($bojUser);
        die();
    }

    public function getcompanydata(Request $request) {

        $bojUser = new company_master();
        $bojUser = $bojUser->getcompanyapi();
        print_r($bojUser);
        die();
    }

}
