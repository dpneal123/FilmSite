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
        } else if ($phonecheck != '[]') {
            echo 'Phone is already registered';
        } else {
            $personid = DB::table('fss_Person')->insertGetId(
                ['personname' => $name, 'personemail' => $email, 'personphone' => $phone]
            );

            Session::put('id', $personid);

            $addid = DB::table('fss_Address')->insertGetId(
                ['addstreet' => $street, 'addcity' => $city, 'addpostcode' => $postcode]
            );

            DB::insert('insert into fss_Customer(custid, custregdate, custendreg, custpassword) VALUES (?, CURDATE(), NULL, ?)',
                [$personid, $password]);

            DB::insert('insert into fss_CustomerAddress(addid, custid) VALUES (?,?)', [$addid, $personid]);
        }
            return redirect()->route('account.insert');
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
            $this->carddetails();
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

    public function history() {
        $purchases = $this->getpayid();
        echo "<br><center>";
        echo "<div class='col'>";
        while ($row = mysqli_fetch_assoc($purchases)) {
            foreach ($row as $field => $value) {
                $basketcontents = DB::select('select fss_Payment.amount, fss_Payment.paydate from fss_Payment inner join fss_OnlinePayment fP on fss_Payment.payid = fP.payid where fP.payid='. $value);
                echo "<div class='row'><p>" . $basketcontents[0]->paydate . ' || <b>£' . $basketcontents[0]->amount . "</b></p></div></>";
                for ($num=0; $num<count((array)$basketcontents); $num++) {
                    echo "<div class='row'>";
                    $films = DB::select('select filmid from fss_FilmPurchase where payid=' . $value);
                    for ($y=0; $y<count((array)$films); $y++) {
                            $film = (new FilmsModel)->get($films[$y]->filmid)[0]->filmtitle;
                            echo "<div class='col'><p>" . $film . "</p></div><br>";
                    }
                    echo "</div><hr>";
                }
            }
            }
        echo "</div></center>";
    }

    public function getpayid() {
        $payid = "select payid from fss_OnlinePayment where custid=" . Session::get('id');
        $conn = mysqli_connect('127.0.0.1', 'root', 'root', 'FilmStore', '8889');
        $purchases = mysqli_query($conn, $payid);
        return $purchases;
    }

    public function carddetails() {
        Session::start();
        if (Session::exists('card')) {
            Session::forget('card');
        }

        $card = (array) DB::select('select cno, ctype, cexpr from fss_CardDetails where cardid=' . Session::get('id'));
        if (count($card) == 0) {
            return redirect('/user/register/card');
        }
        else {
            Session::put('card', $card);
        }
    }

    public function insertcard($cardno, $ctype, $expdate) {
        Session::start();
        $id = Session::get('id');
        if (Session::exists('card')) {
            $card = Session::get('card');
            DB::update('update fss_CardDetails set cno=\'' . $card[0]->cno .'\', ctype=\''. $card[0]->ctype . '\', cexpr=\''. $card[0]->cexpr . '\' where cardid='.$id);
        }
        else {
            DB::insert('insert into fss_CardDetails(cardid, cno, ctype, cexpr) values (?, ?, ?, ?)', [$id, $cardno, $ctype, $expdate]);
        }
        Session::remove('card');
        $this->carddetails();
    }
}
