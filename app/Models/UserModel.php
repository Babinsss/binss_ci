<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users'; // Specify the table name

    protected $primaryKey = 'id'; // Specify the primary key

    protected $allowedFields = ['first_name', 'middle_name', 'last_name', 'age', 'gender_id', 'email', 'password']; // Fields that are allowed to be mass-assigned

    protected $useAutoIncrement = true; // Enable auto-increment for the primary key

    protected $returnType = 'array'; // Specify the return type of the results

    // Validation rules for user registration
    protected $validationRules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'age' => 'required|numeric',
        'gender_id' => 'required',
        'email' => 'required|valid_email|is_unique[users.email]',
        'password' => 'required|min_length[8]'
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'The email address has already been taken.'
        ]
    ];

    // Callbacks
    protected $beforeInsert = ['hashPassword'];

    // Callback function to hash the password before inserting into the database
    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    // Custom method to verify user credentials (example)
    public function verifyCredentials($email, $password)
    {
        $user = $this->where('email', $email)->first();
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return null;
    }
}
