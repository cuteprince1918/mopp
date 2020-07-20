<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Users;
use DB;
use Illuminate\Support\Facades\Hash;

class Users extends Model {
    
    protected $table = 'user_type_master';

}
