<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Users;
use DB;
use Illuminate\Support\Facades\Hash;

class admin_master extends Model {

    protected $table = 'admin_master';

    public function getUsers($request) {
        $result = admin_master::where('email', $request['email'])
                ->first();
        if ($result != '') {
            if (Hash::check($request['password'], $result['password']) && $request['email'] == $result['email']) {
                return $result;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function checkKey($key) {

        $result = admin_master::select('*')
                ->where('forgotkey', $key)
                ->get();
        if (!$result->isEmpty()) {
            return $result;
        } else {
            return FALSE;
        }
    }

    public function updatepassword($request, $id) {
        $result = admin_master::select('*')
                ->where('forgotkey', $id)
                ->get();
        if (!$result->isEmpty()) {
            $password = Hash::make($request['password']);
            $objkey = DB::table('admin_master')
                    ->where('forgotkey', $id)
                    ->update(['password' => $password, 'forgotkey' => '']);
            return $objkey;
        } else {
            return FALSE;
        }
    }

    public function getUsersreset($request) {
        $result = admin_master::select('*')
                ->where('email', $request['email'])
                ->get();
        if (!$result->isEmpty()) {
            return $result;
        } else {
            return FALSE;
        }
    }

    public function addKey($request, $key) {

        $result = admin_master::select('email')
                ->where('email', $request['email'])
                ->get();
        if (!$result->isEmpty()) {
            $objkey = DB::table('admin_master')
                    ->where('email', $request['email'])
                    ->update(['forgotkey' => $key]);
            return $objkey;
        } else {
            return FALSE;
        }
    }
    
}
