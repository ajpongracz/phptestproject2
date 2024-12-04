<?php

namespace App\Controllers;

use App\Models\OtpModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class OtpController extends BaseController {

    public function index() {

        return view('otp/index');
    }

    public function new() {

        helper('form');
        return view('otp/storenewpassword');
    }

    // Store new pw in db and generate dynamic sub URL to retrieve it
    public function storePw() {

        helper('form');

        $data = $this->request->getPost(['email', 'firstname', 'lastname', 'newpassword']);

        // Validate data
        if (! $this->validateData($data, [
            'email' => 'required|max_length[30]|min_length[7]',
            'firstname'  => 'required|max_length[20]',
            'lastname'  => 'required|max_length[20]',
            'newpassword'  => 'required|min_length[5]'
        ])) {
            // If validation fails, return the form
            return $this->new();
        }

        // Get the validated data
        $post = $this->validator->getValidated();

        // Create random alphanumeric string
        helper('text');
        $dataRandomString = [
            'randomString' => bin2hex(random_bytes(8))
        ];

        $model = model(OtpModel::class);

        // Save user input & random string into model
        $model->save([
            'email' => $post['email'],
            'firstname' => $post['firstname'],
            'lastname' => $post['lastname'],
            'newpassword' => $post['newpassword'],
            'suburl' => $dataRandomString['randomString'],
        ]);

        // Pass random string to view for URL link
        return view('otp/success', $dataRandomString);
    }

    // Retrieve new password using link generated from storePw() and by using validating user data
    public function showPw($dynamicSegment) {

        $data = [
            'suburl' => $dynamicSegment
        ];

        return view('otp/testing', $data);
    }

    // TESTING
    // ==========================================================
    public function randomLink() {

        // random alphanumeric generated string
        helper('text');
        $data = [
            'randomString' => bin2hex(random_bytes(8))
        ];

        return view('otp/success', $data);
    }

    public function testRoute($var1, $var2, $var3) {

        //dd($var1);

        $data = [
            'variable1' => $var1, 
            'variable2' => $var2, 
            'variable3' => $var3
        ];

        return view('otp/routetest', $data);
    }
    // ==========================================================
}

?>