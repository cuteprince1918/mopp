<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Users;
use DB;
use Illuminate\Support\Facades\Hash;

class company_master extends Model {

    protected $table = 'company_master';

    public function getUsers($request) {
        $result = company_master::where('email', $request['email'])
                ->first();
        if (Hash::check($request['password'], $result['password']) && $request['email'] == $result['email']) {
            return $result;
        } else {
            return FALSE;
        }
    }

    public function getcompanyapi() {
        $result = company_master::select('*')
                ->get();
        return $result;
    }

    public function getUsersreset($request) {
        $result = company_master::select('*')
                ->where('email', $request['email'])
                ->get();
        if (!$result->isEmpty()) {
            return $result;
        } else {
            return FALSE;
        }
    }

    public function addKey($request, $key) {

        $result = company_master::select('email')
                ->where('email', $request['email'])
                ->get();
        if (!$result->isEmpty()) {
            $objkey = DB::table('company_master')
                    ->where('email', $request['email'])
                    ->update(['forgotkey' => $key]);
            return $objkey;
        } else {
            return FALSE;
        }
    }

    public function updatepassword($request, $id) {
        $result = company_master::select('*')
                ->where('forgotkey', $id)
                ->get();
        if (!$result->isEmpty()) {
            $password = Hash::make($request['password']);
            $objkey = DB::table('company_master')
                    ->where('forgotkey', $id)
                    ->update(['password' => $password, 'forgotkey' => '']);
            return $objkey;
        } else {
            return FALSE;
        }
    }

    public function checkKey($key) {

        $result = company_master::select('*')
                ->where('forgotkey', $key)
                ->get();
        if (!$result->isEmpty()) {
            return $result;
        } else {
            return FALSE;
        }
    }

    public function getCompany($request, $id) {
        $result = company_master::select('*')
                ->where('id', $id)
                ->first();
        return $result;
    }

    public function deletecompany($data) {

        $resut = DB::table('company_master')->where('id', $data['id'])->update(['is_delete' => '1']);
        if ($resut) {
            return true;
        } else {
            return false;
        }
    }

    public function addCompany($request) {
//          print_r($request->file());
//          die();
        $result = company_master::where("name", $request->input('name'))
                ->count();
        if ($result == 0) {
            $objCompany = new company_master();
            $objCompany->user_type = '3';
            $objCompany->name = $request->input('name');
            $objCompany->email = $request->input('email');
            $objCompany->username = $request->input('username');
            $objCompany->password = Hash::make($request->input('password'));
            $objCompany->status = '1';
            $objCompany->is_delete = '0';
            $objCompany->created_by = '1';
            $objCompany->created_time = date("Y-m-d h:i:s");
            $objCompany->created_ip = '1';
            $objCompany->modified_by = '1';
            $objCompany->modified_time = date("Y-m-d h:i:s");
            $objCompany->modified_ip = '1';
            $objCompany->updated_at = date("Y-m-d h:i:s");
            $objCompany->created_at = date("Y-m-d h:i:s");
            $objCompany->image = 'admin1573557559.jpg';
            if ($objCompany->save()) {
                return "add";
            } else {
                return "wrong";
            }
        } else {
            return "exits";
        }
    }

    public function editCompany($request, $id) {

        $result = company_master::where("name", $request->input('name'))
                ->where('id', '!=', $id)
                ->count();
        if ($result == 0) {
            $objCompany = company_master::find($id);
            $objCompany->user_type = '2';
            $objCompany->name = $request->input('name');
            $objCompany->email = $request->input('email');
            $objCompany->username = $request->input('username');
//            $objCompany->password = Hash::make($request->input('password'));
            $objCompany->status = '1';
            $objCompany->is_delete = '0';
            $objCompany->created_by = '1';
            $objCompany->created_time = date("Y-m-d h:i:s");
            $objCompany->created_ip = '1';
            $objCompany->modified_by = '1';
            $objCompany->modified_time = date("Y-m-d h:i:s");
            $objCompany->modified_ip = '1';
            $objCompany->updated_at = date("Y-m-d h:i:s");
            $objCompany->created_at = date("Y-m-d h:i:s");
            $objCompany->image = 'admin1573557559.jpg';
            if ($objCompany->save()) {
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

        $query = university_master::from('company_master');
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

            $imagepath = url('public/uploads/company/' . $row['image']);
            $actionhtml = '';
            $actionhtml = '<center><a href="' . route('edit-company', $row['id']) . '" class="btn btn-icon btn-outline-success" data-id="' . $row["id"] . '"><em class="fa fa-edit"></em></a>
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
