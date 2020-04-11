<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use MongoDB\Driver\Session;

class FilmsModel extends Model
{
    public function getall() {
        $sql = "SELECT filmtitle FROM fss_Film";
        $conn = mysqli_connect('127.0.0.1', 'root', 'root', 'FilmStore', '8889');
        $titleresult = mysqli_query($conn, $sql); // First parameter is just return of "mysqli_connect()" function
        echo "<br><center>";
        echo "<table>";
        while ($row = mysqli_fetch_assoc($titleresult)) { // Important line !!! Check summary get row on array ..
            echo "<tr>";
            foreach ($row as $field => $value) { // I you want you can right this line like this: foreach($row as $value) {
                $id= trim(DB::select('select filmid from fss_Film where filmtitle=\'' . $value . '\'')[0]->filmid, '[]');
                $price = trim(DB::select('select price from fss_FilmPurchase where shopid=1 and filmid='.$id)[0]->price, '[]');
                echo "<td><a href='/films/{$id}'>" . $id . ' || ' . $value . " || £" . $price . "</a><br><hr></td>"; // I just did not use "htmlspecialchars()" function.
            }
            echo "</tr>";
        }
        echo "</table></center>";
    }

    public function get($id) {
        return DB::select('select filmtitle, filmdescription, ratid from fss_Film where filmid=' . $id);

    }

    public function getprice($id) {
        return trim(DB::select('select price from fss_FilmPurchase where shopid=1 and filmid='.$id)[0]->price, '[]') +0;
    }
}
