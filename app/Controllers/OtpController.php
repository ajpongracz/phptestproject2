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

        $model = model(OtpModel::class);

        $model->save([
            'email' => $post['email'],
            'firstname' => $post['firstname'],
            'lastname' => $post['lastname'],
            'newpassword' => $post['newpassword'],
        ]);

        return view('otp/success');
    }

    // TESTING link generation
    // =============================
    public function randomLink() {

        // random alphanumeric generated string
        helper('text');
        $data = [
            'randomString' => bin2hex(random_bytes(8))
        ];

        return view('otp/success', $data);
    }
    // =============================
}

?>