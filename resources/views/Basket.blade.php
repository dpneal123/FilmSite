<html lang="en">
<head>
<title>Basket</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
@include('taskbar');
<br>
<br><br>
<div class="row">
    <div class="col-3"></div>
    <div class="col">
        <form>
            <input type = "hidden" name = "_token" value = "<?php use Illuminate\Support\Facades\Session;echo csrf_token(); ?>">
            <center>
                <h1>Basket</h1>
                <br>
            <?php
            Session::start();
            if (Session::exists('total')) {
                Session::forget('total');
            }
            $basket = (array) Session::get('basket');
            for ($x=1; $x<count($basket)+1; $x++) {
                echo "<hr>";
                echo $x . "   ||   " . $basket[$x][0]->filmtitle . "   ||   " . $basket[$x][0]->price;
                echo "<br>";
                }
            echo "<hr>";
            $total = 0;
            for ($i=1; $i<count($basket)+1; $i++) {
                $total = $total + $basket[$i][0]->price;
            }
            echo "<br><br><b>Total:</b> <u>£" . $total . "</u><br>";
            if ($total > 0) {
                Session::put('total', $total);
            }
            ?>
                <br><br>
                <a href="/basket/clear" role="button" class="btn btn-secondary">Clear Basket</a>
                <a href="/basket/purchase" role="button" class="btn btn-primary">Purchase</a>
            </center>
        </form>

    </div>
    <div class="col-3"></div>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>
