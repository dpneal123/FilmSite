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
        $titleresult = mysqli_query($conn, $sql);
        echo "<br><center>";
        echo "<table>";
        while ($row = mysqli_fetch_assoc($titleresult)) {
            echo "<tr>";
            foreach ($row as $field => $value) {
                $id= trim(DB::select('select filmid from fss_Film where filmtitle=\'' . $value . '\'')[0]->filmid, '[]');
                $price = trim(DB::select('select price from fss_FilmPurchase where shopid=1 and filmid='.$id)[0]->price, '[]');
                echo "<td><a href='/films/{$id}'>" . $id . ' || ' . $value . " || £" . $price . "</a><br><hr></td>";
            }
            echo "</tr>";
        }
        echo "</table></center>";
    }

    public function get($id) {
        return DB::select('select fss_Film.filmid, filmtitle, filmdescription, ratid, fFP.price from fss_Film inner join fss_FilmPurchase fFP on fss_Film.filmid = fFP.filmid where fFp.shopid=1 and fss_Film.filmid=' . $id . ' limit 1;');

    }

    public function getprice($id) {
        return trim(DB::select('select price from fss_FilmPurchase where shopid=1 and filmid='.$id)[0]->price, '[]') +0;
    }
}
