<?php

namespace App\Http\Controllers;

use App\FilmsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use stdClass;

class BasketController extends Controller
{
    public function add()
    {
        if (Session::exists('id')) {
            Session::start();
            $basket = new stdClass();
            $id = (int)Session::pull('filmid');

            if (Session::exists('basket')) {
                $basket = Session::get('basket');
                Session::remove('basket');
            }
            $done = false;
            $basketid = (int)1;
            while ($done == false) {
                if (property_exists($basket, (string)$basketid)) {
                    $basketid = $basketid + 1;
                } else {
                    $done = true;
                }
            }
            $basket->$basketid = (new FilmsModel)->get($id);
            Session::put('basket', $basket);
            return redirect()->route('basket');
        }
        else {
            return redirect()->route('login');
        }
    }

    public function remove($id) {

    }

    public function clear() {
        Session::start();
        Session::remove('basket');
        return redirect()->route('basket');
    }
}
