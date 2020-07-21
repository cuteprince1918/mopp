<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Users;
use Illuminate\Support\Facades\Config;
use DB;
use Illuminate\Support\Facades\Hash;

class university_master extends Model {

    protected $table = 'university_master';

    public function getUsers($request) {
        $result = university_master::where('email', $request['email'])
                ->first();
        if (Hash::check($request['password'], $result['password']) && $request['email'] == $result['email']) {
            return $result;
        } else {
            return FALSE;
        }
    }

    public function getunivercityBOX() {
        $result = university_master::select('name','id')
                ->get();
        return $result;
    }

    public function getUsersreset($request) {
        $result = university_master::select('*')
                ->where('email', $request['email'])
                ->get();
        if (!$result->isEmpty()) {
            return $result;
        } else {
            return FALSE;
        }
    }

    public function addKey($request, $key) {

        $result = university_master::select('email')
                ->where('email', $request['email'])
                ->get();
        if (!$result->isEmpty()) {
            $objkey = DB::table('university_master')
                    ->where('email', $request['email'])
                    ->update(['forgotkey' => $key]);
            return $objkey;
        } else {
            return FALSE;
        }
    }

    public function getUnivercity($request, $id) {
        $result = university_master::select('*')
                ->where('id', $id)
                ->first();
        return $result;
    }

    public function updatepassword($request, $id) {
        $result = university_master::select('*')
                ->where('forgotkey', $id)
                ->get();
        if (!$result->isEmpty()) {
            $password = Hash::make($request['password']);
            $objkey = DB::table('university_master')
                    ->where('forgotkey', $id)
                    ->update(['password' => $password, 'forgotkey' => '']);
            return $objkey;
        } else {
            return FALSE;
        }
    }

    public function checkKey($key) {

        $result = university_master::select('*')
                ->where('forgotkey', $key)
                ->get();
        if (!$result->isEmpty()) {
            return $result;
        } else {
            return FALSE;
        }
    }

    public function deleteunivercity($data) {

        $resut =  DB::table('university_master')->where('id', $data['id'])->update(['is_delete' => '1']);
        if ($resut) {
            return true;
        } else {
            return false;
        }
    }

    public function addUnivercity($request) {
//          print_r($request->file());
//          die();
        $result = university_master::where("name", $request->input('name'))
                ->count();
        if ($result == 0) {
            $objUnivercity = new university_master();
            $objUnivercity->user_type = '2';
            $objUnivercity->name = $request->input('name');
            $objUnivercity->email = $request->input('email');
            $objUnivercity->username = $request->input('username');
            $objUnivercity->password = Hash::make($request->input('password'));
            $objUnivercity->postfix = '';
            $objUnivercity->status = '1';
            $objUnivercity->is_delete = '0';
            $objUnivercity->created_by = '1';
            $objUnivercity->created_time = date("Y-m-d h:i:s");
            $objUnivercity->created_ip = '1';
            $objUnivercity->modified_by = '1';
            $objUnivercity->modified_time = date("Y-m-d h:i:s");
            $objUnivercity->modified_ip = '1';
            $objUnivercity->updated_at = date("Y-m-d h:i:s");
            $objUnivercity->created_at = date("Y-m-d h:i:s");
            $objUnivercity->image = 'admin1573557559.jpg';
            if ($objUnivercity->save()) {
                return "add";
            } else {
                return "wrong";
            }
        } else {
            return "exits";
        }
    }

    public function editUnivercity($request, $id) {
        
        $result = university_master::where("name", $request->input('name'))
                ->where('id', '!=',$id)
                ->count();
        if ($result == 0) {
            $objUnivercity = university_master::find($id);
            $objUnivercity->user_type = '2';
            $objUnivercity->name = $request->input('name');
            $objUnivercity->email = $request->input('email');
            $objUnivercity->username = $request->input('username');
//            $objUnivercity->password = Hash::make($request->input('password'));
            $objUnivercity->postfix = '';
            $objUnivercity->status = '1';
            $objUnivercity->is_delete = '0';
            $objUnivercity->created_by = '1';
            $objUnivercity->created_time = date("Y-m-d h:i:s");
            $objUnivercity->created_ip = '1';
            $objUnivercity->modified_by = '1';
            $objUnivercity->modified_time = date("Y-m-d h:i:s");
            $objUnivercity->modified_ip = '1';
            $objUnivercity->updated_at = date("Y-m-d h:i:s");
            $objUnivercity->created_at = date("Y-m-d h:i:s");
            $objUnivercity->image = 'admin1573557559.jpg';
            if ($objUnivercity->save()) {
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
            0 => 'id',
            1 => 'image',
            2 => 'name',
            3 => 'email',
            4 => 'username',
        );

        $query = university_master::from('university_master');
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
                ->select('id', 'name', 'email', 'username', 'image')
                ->where('is_delete', '0')
                ->get();
        $data = array();
        $i = 0;
        foreach ($resultArr as $row) {

            $imagepath = url('public/uploads/univercity/' . $row['image']);
            $actionhtml = '';
            $actionhtml = '<center><a href="' . route('edit-univercity', $row['id']) . '" class="btn btn-icon btn-outline-success" data-id="' . $row["id"] . '"><em class="fa fa-edit"></em></a>
                        <a href="" data-toggle="modal" data-target="#deletemodel" class="btn btn-icon btn-outline-danger deletelogo" data-id="' . $row["id"] . '" ><em class="fa fa-trash"></em></a></center>';
            $i++;
            $nestedData = array();
            $nestedData[] = '<center>' . $i . '</center>';
            $nestedData[] = '<center><img src="' . $imagepath . '" alt="contact-img" title="contact-img" class="rounded mr-3" height="48"></center>';
            $nestedData[] = '<center>' . $row['name'] . '</center>';
            $nestedData[] = '<center>' . $row['email'] . '</center>';
            $nestedData[] = '<center>' . $row['username'] . '</center>';
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
