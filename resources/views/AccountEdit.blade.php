<html lang="en">
<head>
    <title>Edit</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

@include('taskbar');
<form method="post" action="{{ route('account.edit') }}">
    <?php use Illuminate\Support\Facades\DB;use Illuminate\Support\Facades\Session;?>
    <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
    <div class="row">
        <div class="col"></div>
        <div class="col">
            <br>
            <center><h1>Edit Account</h1></center>
            <br>
            <?php
            (new \App\UserModel)->show();
            ?>
            <br>
            <div class="row">
                <label class="label col-md control-label">Name
                    <input type="text" class="form-control" name="name" placeholder="Name" pattern="[A-Za-z\s]+" value="<?php echo htmlentities(Session::get('username')); ?>" required>
                </label>
            </div>

            <div class="row">
                <label class="label col-md control-label">Phone
                    <input type="tel" class="form-control" name="phone" placeholder="Phone" value="<?php echo htmlentities(Session::get('userphone')); ?>" required>
                </label>
            </div>

            <div class="row">
                <label class="label col-md control-label">Email
                    <input type="email" class="form-control" name="email" placeholder="you@domain.com" value="<?php echo htmlentities(Session::get('useremail')); ?>" required>
                </label>
            </div>

            <div class="row">
                <label class="label col-md control-label">Street
                    <input type="text" class="form-control" name="street" placeholder="Street" pattern="[0-9A-Za-z\s]+" value="<?php echo htmlentities(Session::get('userstreet')); ?>" required>
                </label>
            </div>

            <div class="row">
                <label class="label col-md control-label">City
                    <input type="text" class="form-control" name="city" placeholder="City" pattern="[A-Za-z\s]+" value="<?php echo htmlentities(Session::get('usercity')); ?>" required>
                </label>
            </div>

            <div class="row">
                <label class="label col-md control-label">Postcode
                    <input type="text" class="form-control" name="postcode" placeholder="Postcode" pattern="[A-Za-z0-9\s]+{8}" value="<?php echo htmlentities(Session::get('userpostcode')); ?>" required>
                </label>
            </div>
            <div class="row">
                <a class="btn btn-secondary"  href="{{ URL::route('account') }}">Back</a>
                <input type="submit" class="btn btn-primary" value="Submit Changes">
            </div>
        </div>
        <div class="col"></div>
    </div>
</form>
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
