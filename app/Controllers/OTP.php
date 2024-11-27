<?php

namespace App\Controllers;

use App\Models\OTPModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class OTP extends BaseController {

    public function index() {
        


        return view('otp/index');
    }

    public function new()
    {
        helper('form');
        return view('otp/storenewpassword');
    }

    public function storenewpassword() {

        helper('form');

        $data = $this->request->getPost(['email', 'firstname', 'lastname', 'newpassword']);

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validateData($data, [
            'email' => 'required|max_length[50]|min_length[7]', // require @ symbol, length must be at least 1 letter, @ symbol, another letter, and .com (7 characters)
            'firstname' => 'required|max_length[20]',
            'lastname' => 'required|max_length[20]',
            'newpassword' => 'required|max_length[30]',
        ])) {
            // The validation fails, so returns the form.
            return $this->new();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        $model = model(OTPmodel::class);

        $model->save([
            'email' => $post['email'],
            'firstname'  => $post['firstname'],
            'lastname'  => $post['lastname'],
            'newpassword'  => $post['newpassword'],
        ]);

        return view('otp/success');
    }

    // public function getnewpassword() {

    //     return null;
    // }

}

?>