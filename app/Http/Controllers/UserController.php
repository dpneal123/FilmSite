<?php

namespace App\Http\Controllers;

use http\Client\Response;
use \Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\UserModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function insert(\Illuminate\Http\Request $request) {
        Session::start();
        $name = $request->input('name');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $password = $request->input('password');
        $street = $request->input('street');
        $city = $request->input('city');
        $postcode = $request->input('postcode');

        (new \App\UserModel)->insertToDB($name, $email, $phone, $password, $street, $city, $postcode);
        return \redirect()->route('account.insert');
    }

    public function check(\Illuminate\Http\Request $request) {
        $login = $request->input('login');
        $password = $request->input('password');

        Session::put('email', $login);

        (new UserModel)->checkDB($login, $password);
        return redirect()->route('films');
    }

    public function get()
    {
        (new UserModel)->show();
    }

    public function logout() {
        Session::flush();
        return redirect()->route('films');
    }

    public function edit() {
        if ((Session::get('username') != $_POST['name']) || ($_POST['name']!=null)) {
            Session::put('newname', $_POST['name']);
        }
        if ((Session::get('userphone') != $_POST['phone']) || ($_POST['phone']!=null)) {
            Session::put('newphone', $_POST['phone']);
        }
        if ((Session::get('useremail') != $_POST['email']) || ($_POST['email']!=null)) {
            Session::put('newemail', $_POST['email']);
        }
        if ((Session::get('userstreet') != $_POST['street']) || ($_POST['street']!=null)) {
            Session::put('newstreet', $_POST['street']);
        }
        if ((Session::get('usercity') != $_POST['city']) || ($_POST['city']!=null)) {
            Session::put('newcity', $_POST['city']);
        }
        if ((Session::get('userpostcode') != $_POST['postcode']) || ($_POST['postcode']!=null)) {
            Session::put('newpostcode', $_POST['postcode']);
        }
        (new UserModel)->edituser();
        return redirect()->route('account');
    }

    public function gethistory() {
        return view('AccountHistory');
    }

    public function getcard() {
        (new \App\UserModel)->carddetails();
    }

    public function insertcard() {
        $cardno = $_POST['cardno'];
        $ctype = $_POST['ctype'];
        $expmonth = $_POST['expmonth'];
        $expyear = $_POST['expyear'];
        $expdate = $expmonth . ':' . $expyear;
        (new \App\UserModel)->insertcard($cardno, $ctype, $expdate);
        return \redirect()->route('films');
    }

    public function updatecard() {
        $cardno = $_POST['cardno'];
        $ctype = $_POST['ctype'];
        $expmonth = $_POST['expmonth'];
        $expyear = $_POST['expyear'];
        $expdate = $expmonth . ':' . $expyear;
        (new \App\UserModel)->insertcard($cardno, $ctype, $expdate);
        return \redirect()->route('films');
    }
}
