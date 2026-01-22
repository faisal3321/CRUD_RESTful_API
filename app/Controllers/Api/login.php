<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;


use Firebase\JWT\JWT;  // check again if anything goes wrong
use Firebase\JWT\Key;
use Config\JWT as JWTConfig;

class Login extends ResourceController
{
    protected $modelName =  'App\Models\UserModel';
    protected $format = 'json';

    public function index() 
    {
        $data = $this->request->getJSON(true); // for all types of method

        // to check no field should be empty
        if (!$data || !isset($data['userEmail'], $data['userPassword'])) {
            return $this->fail('Email and password are required', 400);
        }

        $user = $this->model->where('userEmail', $data['userEmail'])->first();

        // check if the user has already registered or not
        if (!$user || !password_verify($data['userPassword'], $user['userPassword'])) {
            return $this->fail('Please enter valid email or password, If you don’t have an account please register first', 401);
        }

        // JWT placed here so whenever we login we will get jwt token so that user can authenticate us.
        // creating a JWTConfig object 
        $jwtConfig = new JWTConfig;

        // PAYLOAD
        $payload = [
            'iat' => time(),
            'exp' => time() + $jwtConfig->expire,
            'uid' => $user['id'],
            'email' => $user['userEmail']
        ];

        $token = JWT::encode($payload, $jwtConfig->key, $jwtConfig->algo);

        // response when user successfully login
        return $this->respond([
            'statusCode'        => 200,
            'status'            => true,
            'message'           => 'You have logged IN successfully !',
            'token'             => $token,
            'User'              => [
                'id'        => $user['id'],
                'userName'  => $user['userName'],
                'userEmail' => $user['userEmail']
            ]
        ]);
    }


    // Update user
    public function update($id = null)
    {
        $data = $this->request->getJSON(true);

        // check request body;
        if(!$data) {
            return $this->fail("Please provide data", 400);
        }

        // check if user exist in DB
        if (!$this->model->find($id)) {
            return $this->failNotFound('User not found');
        }

        // update data
        $updateData = [];

        if(isset($data['userName'])) {
            $updateData['userName'] = $data['userName'];
        }

        if(isset($data['userEmail'])) {
            $updateData['userEmail'] = $data['userEmail'];
        }

        if(empty($updateData)) {
            return $this->fail('Nothing to update', 400);
        }

        $this->model->update($id, $updateData);

        return $this->respond([
            'statusCode' => 200,
            'status'  => true,
            'message' => 'User updated successfully'
        ]);
    }


    // Delete user
    public function deleteUser($id = null)
    {
        // DB search
        if (!$this->model->find($id)) {
            return $this->failNotFound('User not found');
        }

        $this->model->delete($id);

        return $this->respond([
            'statusCode' => 200,
            'status'  => true,
            'message' => 'User deleted successfully'
        ]);
    }

}