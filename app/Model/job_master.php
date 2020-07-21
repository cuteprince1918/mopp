<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Users;
use DB;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Model\job_child;
use App\Model\job_confirmation;

class job_master extends Model {

    protected $table = 'job_master';

    public function getJob($request, $id) {
        $result = job_master::select('*')
                ->where('id', $id)
                ->first();
        return $result;
    }

    public function deletejob($data) {

        $resut = DB::table('job_master')->where('id', $data['id'])->update(['is_delete' => '1']);
        if ($resut) {
            return true;
        } else {
            return false;
        }
    }

    public function addJob($request) {

        $value = $request->session()->get('USERTYPE');
        $random_code = str_random(6);
        $objJob = new job_master();
        $objJob->urertype = $value;
        $objJob->userid = $value;
        $objJob->jobcode = $random_code;
        $objJob->isactive = '1';
        $objJob->createdby = $value;
        $objJob->save();

        $last_id = job_master::select('id')
                ->where('jobcode', $random_code)
                ->first();

        $objjob_child = new job_child();
        $objjob_child->jobid = $last_id->id;
        $objjob_child->jobtitle = $request->input('title');
        $objjob_child->jobdesc = $request->input('desc');
        $objjob_child->jobenddate = $request->input('date');
        $objjob_child->jobcontact = $request->input('contact');
        $objjob_child->jobimage = 'static image';
        $objjob_child->lat = '21.3840164';
        $objjob_child->long = '71.0529075';
        if ($request->input('radio') == 'univercity') {
            $objjob_child->univercity = '1';
        } else {
            $objjob_child->student = '1';
        }
        $objjob_child->save();

        $i = 0;
        if ($request->input('radio') == 'univercity') {

            for ($i = 0; $i < count($request->input('selectbox')); $i++) {
                $objjob_confirmation = new job_confirmation();
                $objjob_confirmation->jobid = $last_id->id;
                $objjob_confirmation->unvercityid = $request->input('selectbox')[$i];
                $objjob_confirmation->studentid = '';
                $objjob_confirmation->acceptbycomapny = '0';
                $objjob_confirmation->acceptbystudent = '0';
                $objjob_confirmation->accceptbyuni = '1';
                $objjob_confirmation->isseen = '0';
                $objjob_confirmation->save();
            }
        } else {
            for ($i = 0; $i < count($request->input('selectbox')); $i++) {
                $objjob_confirmation = new job_confirmation();
                $objjob_confirmation->jobid = $last_id->id;
                $objjob_confirmation->unvercityid = '';
                $objjob_confirmation->studentid = $request->input('selectbox')[$i];
                $objjob_confirmation->acceptbycomapny = '0';
                $objjob_confirmation->acceptbystudent = '0';
                $objjob_confirmation->accceptbyuni = '1';
                $objjob_confirmation->isseen = '0';
                $objjob_confirmation->save();
            }
        }

        if ($objJob->save() && $objjob_confirmation->save() && $objjob_child->save()) {
            return "add";
        } else {
            return "wrong";
        }
    }

    public function editJob($request, $id) {

        $result = job_master::where("name", $request->input('name'))
                ->where('id', '!=', $id)
                ->count();
        if ($result == 0) {
            $objJob = job_master::find($id);
            $objJob->user_type = '2';
            $objJob->name = $request->input('name');
            $objJob->email = $request->input('email');
            $objJob->username = $request->input('username');
//            $objJob->password = Hash::make($request->input('password'));
            $objJob->status = '1';
            $objJob->is_delete = '0';
            $objJob->created_by = '1';
            $objJob->created_time = date("Y-m-d h:i:s");
            $objJob->created_ip = '1';
            $objJob->modified_by = '1';
            $objJob->modified_time = date("Y-m-d h:i:s");
            $objJob->modified_ip = '1';
            $objJob->updated_at = date("Y-m-d h:i:s");
            $objJob->created_at = date("Y-m-d h:i:s");
            $objJob->image = 'admin1573557559.jpg';
            if ($objJob->save()) {
                return "add";
            } else {
                return "wrong";
            }
        } else {
            return "exits";
        }
    }

    public function getdatatable() {

        $requestData = $_REQUEST;
        $columns = array(
            // datatable column index  => database column name
            0 => 'jobimage',
            1 => 'jobdesc',
            2 => 'jobtitle',
            3 => 'jobenddate',
            4 => 'jobcontact',
        );

        $query = university_master::from('job_child');
        if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $searchVal = $requestData['search']['value'];
            $query->where(function($query) use ($columns, $searchVal, $requestData) {
                $flag = 0;
                foreach ($columns as $key => $value) {
                    $searchVal = $requestData['search']['value'];
                    if ($requestData['columns'][$key]['searchable'] == 'true') {
                        if ($flag == 0) {
                            $query->where($value, 'like', '%' . $searchVal . '%');
                            $flag = $flag + 1;
                        } else {
                            $query->orWhere($value, 'like', '%' . $searchVal . '%');
                        }
                    }
                }
            });
        }

        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);

        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());

        $resultArr = $query->skip($requestData['start'])
                ->take($requestData['length'])
                ->select('id', 'jobtitle', 'jobdesc', 'jobimage', 'jobenddate', 'jobcontact')
                ->get();
        $data = array();
        $i = 0;
        foreach ($resultArr as $row) {

            $imagepath = url('public/uploads/job/' . $row['image']);
            $actionhtml = '';
            $actionhtml = '<center><a href="' . route('edit-job', $row['id']) . '" class="btn btn-icon btn-outline-success" data-id="' . $row["id"] . '"><em class="fa fa-edit"></em></a>
                        <a href="" data-toggle="modal" data-target="#deletemodel" class="btn btn-icon btn-outline-danger deletelogo" data-id="' . $row["id"] . '" ><em class="fa fa-trash"></em></a></center>';
            $i++;
            $nestedData = array();
            $nestedData[] = '<center>' . $i . '</center>';
            $nestedData[] = '<center><img src="' . $imagepath . '" alt="contact-img" title="contact-img" class="rounded mr-3" height="48"></center>';
            $nestedData[] = '<center>' . $row['jobtitle'] . '</center>';
            $nestedData[] = '<center>' . $row['jobdesc'] . '</center>';
            $nestedData[] = '<center>' . $row['jobenddate'] . '</center>';
            $nestedData[] = '<center>' . $row['jobcontact'] . '</center>';
            $nestedData[] = $actionhtml;
            $data[] = $nestedData;
        }
        $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
        );
        return $json_data;
    }

}
