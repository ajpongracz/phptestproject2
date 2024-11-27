<?php

namespace App\Models;

use CodeIgniter\Model;

class OtpModel extends Model {

    protected $table = 'otp';
    //protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'firstname', 'lastname', 'newpassword'];

}

?>