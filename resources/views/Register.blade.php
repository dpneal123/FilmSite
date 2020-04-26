<html lang="en">
<head>
    <title>
        Register
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
@include('taskbar');
<br><br>
<div class="row">
    <div class="col"></div>
<form method="post" action="{{route('register.insert')}}">

    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">

    <div class="col">
        <br><br>
        <h1>Register</h1>
        <div class="row">
            <label class="label col-md control-label">Name
                <input type="text" class="form-control" name="name" placeholder="Name"  pattern="[A-Za-z\s]+" required>
            </label>
        </div>

        <div class="row">
            <label class="label col-md control-label">Phone
                <input type="tel" class="form-control" name="phone" placeholder="Phone" pattern="^\s*\(?(020[7,8]{1}\)?[ ]?[1-9]{1}[0-9{2}[ ]?[0-9]{4})|(0[1-8]{1}[0-9]{3}\)?[ ]?[1-9]{1}[0-9]{2}[ ]?[0-9]{3})\s*$" required>
            </label>
        </div>

        <div class="row">
            <label class="label col-md control-label">Email
                <input type="email" class="form-control" name="email" placeholder="you@domain.com" required>
            </label>
        </div>

        <div class="row">
            <label class="label col-md control-label">Password
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </label>
        </div>

        <div class="row">
            <label class="label col-md control-label">Street
                <input type="text" class="form-control" name="street" placeholder="Street" pattern="[0-9A-Za-z\s]+" required>
            </label>
        </div>

        <div class="row">
            <label class="label col-md control-label">City
                <input type="text" class="form-control" name="city" placeholder="City" pattern="[A-Za-z\s]+" required>
            </label>
        </div>

        <div class="row">
            <label class="label col-md control-label">Postcode
                <input type="text" class="form-control" name="postcode" placeholder="Postcode" pattern="[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}" >
            </label>
        </div>

        <div class="row">
            <div class="col"></div>
            <div class="col">
                <input type="submit" value="Register">
            </div>
            <div class="col"></div>
        </div>
    </div>
</form>
<div class="col"></div>
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
