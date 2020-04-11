<?php

namespace App\Http\Controllers;

use App\FilmsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilmsController extends Controller {
    public function index() {
        (new FilmsModel)->getall();
    }
}
