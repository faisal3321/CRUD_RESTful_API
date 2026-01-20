<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;

class Login extends ResourceController
{
    protected $modelName =  'App\Models\UserModel';
    protected $format = 'json';

    public function index() 
    {
        $data = $this->request->getJSON(true); // for all types of method

        $user = $this->model->where('userEmail', $data['userEmail'])->first();

        if (!$data || !isset($data['userEmail'], $data['userPassword'])) {
            return $this->fail('Email and password are required', 400);
        }


        // check if the user has already registered or not
        if (!$user || !password_verify($data['userPassword'], $user['userPassword'])) {
            return $this->fail('Please enter valid email or password, If you don’t have an account please register first', 401);
        }

            

        return $this->respond([
            'statusCode'        => 200,
            'status'            => true,
            'message'           => 'You have logged IN successfully !',
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

        // DB serch
        if (!$this->model->find($id)) {
            return $this->failNotFound('User not found');
        }

        $this->model->update($id, [
            'userName'  => $data['userName'] ?? null,
            'userEmail' => $data['userEmail'] ?? null,
        ]);

        return $this->respond([
            'status'  => true,
            'message' => 'User updated successfully'
        ]);
    }


    // Delete user
    public function delete($id = null)
    {
        // DB search
        if (!$this->model->find($id)) {
            return $this->failNotFound('User not found');
        }

        $this->model->delete($id);

        return $this->respondDeleted([
            'status'  => true,
            'message' => 'User deleted successfully'
        ]);
    }

}