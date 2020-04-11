<?php

namespace App;

use App\Http\Controllers\FilmsController;
use App\Http\Controllers\UserController;
use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class UserModel extends Model
{

    public function insertToDB($name, $email, $phone, $password, $street, $city, $postcode) {
        $emailcheck = DB::table('fss_Person')->where('personemail', $email)->pluck('personemail');
        $phonecheck = DB::table('fss_Person')->where('personphone', $phone)->pluck('personphone');
        if($emailcheck != '[]') {
            echo 'Email is already registered';
            echo $emailcheck;
        } else if ($phonecheck != '[]') {
            echo 'Phone is already registered';
        } else {
            $personid = DB::table('fss_Person')->insertGetId(
                ['personname' => $name, 'personemail' => $email, 'personphone' => $phone]
            );

            $addid = DB::table('fss_Address')->insertGetId(
                ['addstreet' => $street, 'addcity' => $city, 'addpostcode' => $postcode]
            );

            DB::insert('insert into fss_Customer(custid, custregdate, custendreg, custpassword) VALUES (?, CURDATE(), NULL, ?)',
                [$personid, $password]);

            DB::insert('insert into fss_CustomerAddress(addid, custid) VALUES (?,?)', [$addid, $personid]);

            echo 'done';
        }

            return redirect()->route('films');
    }

    public function checkDB($login, $password) { // checking login details
        $email = DB::table('fss_Person')->where('personemail', $login)->pluck('personemail');

        if ($email == null) {
            echo 'incorrect username';
        }
        else {

            $id = DB::table('fss_Person')->where('personemail', $email)->pluck('personid')[0];
            $realpass = DB::table('fss_Customer')->where('custid', $id)->pluck('custpassword')[0];

            if ($password == $realpass) {
                echo 'done';
                Session::start();
                Session::put('id', $id);
                $this->show();
            }
            else {
                echo "incorrect password";
                $isLogged = false;
            }
        }
    }

    public function show()
    {
        if (Session::exists('id')) {
            $id = Session::get('id');
            $username = DB::select('select personname from fss_Person where personid=' . $id)[0]->personname;
            Session::put('username', $username);
            Session::put('userphone', trim(DB::select('select personphone from fss_Person where personid=' . $id)[0]->personphone, '[]'));
            Session::put('useremail', trim(DB::select('select personemail from fss_Person where personid=' . $id)[0]->personemail, '[]'));
            $straddid = DB::table('fss_CustomerAddress')->where('custid', $id)->get('addid')[0]->addid;
            Session::put('addid', $straddid);
            Session::put('userstreet', DB::select('select addstreet from fss_Address where addid='.$straddid)[0]->addstreet);
            Session::put('usercity', DB::select('select addcity from fss_Address where addid='.$straddid)[0]->addcity);
            Session::put('userpostcode', DB::select('select addpostcode from fss_Address where addid='.$straddid)[0]->addpostcode);
        }
    }

    public function edituser() {
        if (Session::get('username') != Session::get('newname')) {
            DB::update('update fss_Person set personname=\''.Session::get('newname').'\' where personid='.Session::get('id'));
            Session::remove('username');
            Session::put('username', Session::get('newname'));
            Session::remove('newname');
        }
        if (Session::get('userphone') != Session::get('newphone')) {
            DB::update('update fss_Person set personphone=\''.Session::get('newphone').'\' where personid='.Session::get('id'));
            Session::remove('userphone');
            Session::put('username', Session::get('newphone'));
            Session::remove('newphone');
        }
        if (Session::get('useremail') != Session::get('newemail')) {
            DB::update('update fss_Person set personemail=\''.Session::get('newemail').'\' where personid='.Session::get('id'));
            Session::remove('useremail');
            Session::put('useremail', Session::get('newemail'));
            Session::remove('newemail');
        }
        if (Session::get('userstreet') != Session::get('newstreet')) {
            DB::update('update fss_Address set addstreet=\''.Session::get('newstreet').'\' where addid='.Session::get('addid'));
            Session::remove('userstreet');
            Session::put('userstreet', Session::get('newstreet'));
            Session::remove('newstreet');
        }
        if (Session::get('usercity') != Session::get('newcity')) {
            DB::update('update fss_Address set addcity=\''.Session::get('newcity').'\' where addid='.Session::get('addid'));
            Session::remove('usercity');
            Session::put('usercity', Session::get('newcity'));
            Session::remove('newcity');
        }
        if (Session::get('userpostcode') != Session::get('newpostcode')) {
            DB::update('update fss_Address set addpostcode=\''.Session::get('newpostcode').'\' where addid='.Session::get('addid'));
            Session::remove('userpostcode');
            Session::put('userstreet', Session::get('newpostcode'));
            Session::remove('newpostcode');
        }
    }
}
