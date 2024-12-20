<?php

namespace App\Controllers;

use App\Models\OtpModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Database\Exceptions\DatabaseException;

class OtpController extends BaseController {

    public function index() {

        return view('otp/index');
    }

    // Entry point for storing
    public function newPw() {

        helper('form');
        return view('otp/store/storenewpassword');
    }

    // Store new pw in db and generate dynamic sub URL to retrieve it
    public function storePw() {

        helper('form');

        // Get user input
        $data = $this->request->getPost(['email', 'firstname', 'lastname', 'newpassword']);

        // Validate data
        if (! $this->validateData($data, [
            'email' => 'required|max_length[30]|min_length[7]',
            'firstname'  => 'required|max_length[20]',
            'lastname'  => 'required|max_length[20]',
            'newpassword'  => 'required|min_length[5]'
        ])) {
            // If validation fails, return the form
            return $this->newPw();
        }

        // Get the validated data
        $post = $this->validator->getValidated();

        // Create random alphanumeric string
        helper('text');
        $dataRandomString = [
            'randomString' => bin2hex(random_bytes(8))
        ];

        $model = model(OtpModel::class);

        // Handle DatabaseException if email already exists in database (email is unique)
        try {

             // Save user input & random string into model
            $model->save([
                'email' => $post['email'],
                'firstname' => $post['firstname'],
                'lastname' => $post['lastname'],
                'newpassword' => $post['newpassword'],
                'suburl' => $dataRandomString['randomString'],
            ]);       

        } catch (DataBaseException $e) {

            // If the email already exists, return the form
            echo "Email already exists in the database.";
            echo "<p>";
            return $this->newPw();
        }

        

        // Pass random string to view for URL link
        return view('otp/store/success', $dataRandomString);
    }

    // =======================================================================================

    // Entry point for retrieving
    public function getPw($dynamicSegment) {

        // Add dynamic URI string to array
        session()->set('suburl', $dynamicSegment);

        helper('form');
        return view ('otp/retrieve/getnewpassword');
    }

    // Retrieve new password using link generated from storePw() and by validating user data
    public function showPw() {

        $dbData['suburl'] = session()->get('suburl');
        $model = model(OtpModel::class);
    
        // Check the database for the dynamic URI segment and get the record
        $subUrlMatch = $model->where('suburl', $dbData)->first();
        
        // If missing, throw 404
        if (!$subUrlMatch) {
            throw new PageNotFoundException('Oops...no stored passwords found.');
        }

        // Provide page to enter validation data
        helper('form');
        $input = $this->request->getPost(['email', 'firstname', 'lastname']);

        // Validate data
        if (
            $input['email'] == $subUrlMatch['email'] && 
            $input['firstname'] == $subUrlMatch['firstname'] && 
            $input['lastname'] == $subUrlMatch['lastname']
        ) {

            // Delete the database entry
            $model->delete($subUrlMatch['id']);

            // All data validated - return the password
            $dbData['newpassword'] = $subUrlMatch['newpassword'];

            return view('otp/retrieve/displaypassword', $dbData);
        }

        // If validation fails, return the form
        echo "Identity was not validated! Please make sure you're entering your information correctly.";
        echo "<p>";
        return $this->getPw($dbData['suburl']);
        
    }

    public function expiredLink() {
        return view('otp/expired');
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