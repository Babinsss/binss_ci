<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primarykey = 'user_id';
    protected $allowedFields = [
        'first_name',
        'middle_name',
        'last_name',
        'age',
        'gender_id',
        'email',
        'password'

    ];
    protected $returnType = 'object';
}
