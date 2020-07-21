<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class student_master extends Model {

    protected $table = 'student_master';

    public function getstudent() {
        $result = student_master::select('name', 'id')
                ->get();
        return $result;
    }

}
