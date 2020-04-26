<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BasketModel extends Model
{
    public function store() {

        if ((Session::exists('total')) && (Session::exists('card'))) {
            $basket = (array) Session::get('basket');
            $total = (array) Session::get('total');
            $id = (array) Session::get('id');

            $date = date('Y-m-d');

            $payid = DB::table('fss_Payment')->insertGetId(
                ['amount' => $total[0], 'paydate' => $date, 'shopid' => 1, 'ptid' => 2]
            );
            Session::put('payid', $payid);

            DB::table('fss_OnlinePayment')->insert(
                ['payid' => $payid, 'custid' => $id[0]]
            );

            DB::table('fss_CardPayment')->insert(
                ['payid' => $payid, 'cardid' => $id[0]]
            );

            $addid = (array) Session::get('addid');
            for ($x=1; $x<count($basket)+1; $x++) {
                $fpid = DB::table('fss_FilmPurchase')->insertGetId(
                  ['price' => $basket[$x][0]->price, 'filmid' => $basket[$x][0]->filmid, 'shopid' => 1, 'payid' => $payid]
                );

                DB::table('fss_OnlinePurchase')->insert(
                 ['fpid' => $fpid, 'addid' => $addid[0]]
                );
            }
        }
        else {
            return redirect()->route('account.insert');
        }
    }
}
