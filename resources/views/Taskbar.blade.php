<html lang="en">
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
