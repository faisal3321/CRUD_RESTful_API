<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class Register extends ResourceController
{
    protected $modelName = 'App\Models\UserModel';
    protected $format = 'json';

    public function create()
    {
        $data = $this->request->getJSON(true); // works for JSON requests

        // Validation rules
        $rules = [
            'userName'     => 'required|min_length[3]|max_length[50]',
            'userEmail'    => 'required|valid_email|is_unique[users.userEmail]',
            'userPassword' => 'required|min_length[8]|max_length[25]',
        ];

        if (! $this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        // Insert user (timestamps handled automatically)
        $this->model->insert([
            'userName'     => $data['userName'],
            'userEmail'    => $data['userEmail'],
            'userPassword' => password_hash($data['userPassword'], PASSWORD_DEFAULT),
        ]);

        // Response
        return $this->respondCreated([
            'statusCode' => 201,
            'status'     => true,
            'message'    => 'Registration successful! Welcome!'
        ]);
    }
}




























// okok