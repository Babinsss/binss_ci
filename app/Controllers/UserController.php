<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\GenderModel;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function addUser()
    {
        $data = array();
        helper('form');

        if ($this->request->getMethod() == 'post') {
            $post = $this->request->getPost(['first_name', 'middle_name', 'last_name', 'age', 'gender_id', 'email', 'password', 'confirm_password']);

            $rules = [
                'first_name' => 'required',
                'last_name' => 'required',
                'age' => 'required|numeric',
                'gender_id' => 'required',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[8]',
                'confirm_password' => 'required|matches[password]'
            ];

            $messages = [
                'confirm_password' => [
                    'matches' => 'The Confirm Password field must match the Password field.'
                ]
            ];

            if (!$this->validate($rules, $messages)) {
                $data['validation'] = $this->validator;
            } else {
                // Form is valid, save the user...
                $userModel = new UserModel();

                $userData = [
                    'first_name' => $post['first_name'],
                    'middle_name' => $post['middle_name'],
                    'last_name' => $post['last_name'],
                    'age' => $post['age'],
                    'gender_id' => $post['gender_id'],
                    'email' => $post['email'],
                    'password' => password_hash($post['password'], PASSWORD_DEFAULT) // Encrypt password
                ];

                $userModel->insert($userData);

                // Optionally, you can redirect the user to a success page or display a success message here.
            }
        }

        //Fetch all Values
        $genderModel = new GenderModel();
        $genders = $genderModel->fetchAll();

        return view('user/add', $data);
    }
}
