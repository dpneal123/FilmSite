<?php

namespace App\Http\Controllers;

use \Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\UserModel;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function insert(\Illuminate\Http\Request $request) {
        $name = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $password = $request->input('password');
        $street = $request->input('street');
        $city = $request->input('city');
        $postcode = $request->input('postcode');

        (new \App\UserModel)->insertToDB($name, $email, $phone, $password, $street, $city, $postcode);

    }

    public function check(\Illuminate\Http\Request $request) {

        $login = $request->input('login');
        $password = $request->input('password');

        (new UserModel)->checkDB($login, $password);
    }

}
