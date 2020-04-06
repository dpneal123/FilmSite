<?php

namespace App;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

class UserModel extends Model
{

    public function insertToDB($name, $email, $phone, $password, $street, $city, $postcode) {
        $emailcheck = DB::table('fss_Person')->where('personemail', $email)->pluck('personemail');
        if($emailcheck != '[]') {
            echo 'Email is already registered';
            echo $emailcheck;
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

            return view('register');
    }

    public function checkDB($login, $password) { // checking login details
        // $email = DB::select('select personemail from fss_Person WHERE LOCATE(\''. $login .'\', personemail)=1 LIMIT 1');
        $email = DB::table('fss_Person')->where('personemail', $login)->pluck('personemail');

        if ($email == null) {
            echo 'incorrect username';
        }
        else {

            $id = DB::table('fss_Person')->where('personemail', $email)->pluck('personid');
            $realpass = DB::table('fss_Customer')->where('custid', $id)->pluck('custpassword');

            if ($password == $realpass[0]) {
                echo 'nice';
            }
            else {
                echo "incorrect password";
            }
        }
    }
}
