<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function addUser()
    {
        return view('user/add');
    }
}
