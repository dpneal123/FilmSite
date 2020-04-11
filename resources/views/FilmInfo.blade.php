<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="row">
    <div class="col-2"></div>
    <div class="col">
@include('taskbar');
<form method="post" action="{{ route('basket.add') }}">
    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
<?php

    use App\FilmsModel;use Illuminate\Support\Facades\Session;
    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $id = parse_url($url, PHP_URL_PATH);
    $id = ltrim($id, '/films/');
    Session::forget('filmid');
    Session::put('filmid', $id);
    $currentfilm = (new FilmsModel)->get($id)[0];
    echo "<br><br><br>";
    echo $currentfilm->filmtitle;
    echo "<br><br>";
    echo $currentfilm->filmdescription;
    echo "<br><br>";
    echo "£" . (new FilmsModel)->getprice($id);
?>
    <br><br>
    <input type="submit" class="btn btn-primary" value="Add to Basket">
</form>
    </div>
    <div class="col-2"></div>
</div>
</body>
</html>
