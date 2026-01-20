<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['userName', 'userEmail', 'userPassword'];
    
    protected $useTimestamps = true;
    protected $createdField  = 'userCreatedAt';
    protected $updatedField  = 'userUpdatedAt';

}
