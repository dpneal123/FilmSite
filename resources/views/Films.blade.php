<html lang="en">
<head>
    <title>Films</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
@include('taskbar');
<br><br><br>
<div class="col">
    <div class="row">
        <div class="col-1"></div>
        <div class="col">
            <center>
            <h1>Film List</h1>
            </center>
            <?php
            use App\FilmsModel;use Illuminate\Support\Facades\DB;
            (new FilmsModel())->getall();
            ?>
        </div>
        <div class="col-1"></div>
    </div>
</div>

</body>
</html>
