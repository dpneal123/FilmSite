<html lang="en">
<head>
    <title>Order Confirmation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<?php
    use Illuminate\Support\Facades\Session;
    $basket = (array) Session::pull('basket');
    $total = (array) Session::pull('total');
    $id = (array) Session::get('id');
    $payid = (array) Session::pull('payid');
?>
@include('taskbar');
<br>
<br><br>
<div class="row">
    <div class="col-3"></div>
    <div class="col">
        <h1>Order Number: {{ $payid[0] }}</h1>
        <br><br>
        <?php
        for ($x=1; $x<count($basket)+1; $x++) {
            echo "<hr>";
            echo $x . "   ||   " . $basket[$x][0]->filmtitle . "   ||   " . $basket[$x][0]->price;
            echo "<br>";
        }
        echo '<br><hr>';
        echo '£' . $total[0];
        ?>
    </div>
    <div class="col-3"></div>
</div>
</body>
</html>
