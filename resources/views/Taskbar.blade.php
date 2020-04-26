<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav mr-auto">
            <a class="nav-item nav-link" href="/">FILMS</a>
        </ul>
    </div>
    <a class="navbar-brand" href="/">Film Store</a>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <?php if (\Illuminate\Support\Facades\Session::exists('id')) { ?>
            <a class="nav-item nav-link" href="/account">Account</a>
            <a class="nav-item nav-link" href="/logout">Log Out</a>
                <a class="nav-item nav-link" href="/basket">Basket</a>
            <?php } else { ?>
            <a class="nav-item nav-link" href="/register">Register</a>
            <a class="nav-item nav-link" href="/login">Login</a>
            <?php } ?>
        </ul>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>
</body>
</html>
