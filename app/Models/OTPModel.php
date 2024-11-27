<?php

namespace App\Models;

use CodeIgniter\Model;

class OTPModel extends Model {

    protected $table = 'otp';
    protected $allowedFields = ['email', 'firstname', 'lastname', 'newpassword'];

    public function getPassword($email = false) {

        // If email isn't valid, nothing should be returned
        // - point to static page?
        // - reload current page?
        if ($email === false) {
            return null;
        }

        // return first record matching email (email should be unique in table)
        return $this->where(['email' => $email])->first();

    }
}

?>