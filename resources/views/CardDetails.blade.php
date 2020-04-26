<html lang="en">
<head>
    <title>Card Details</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
@include('taskbar');
<br><br><br><br>
<form method="post" action="{{ route('card.update') }}" >
    <input type = "hidden" name = "_token" value = "<?php use Illuminate\Support\Facades\Session;echo csrf_token(); ?>">
    <?php
    \Illuminate\Support\Facades\Session::start();
    (new \App\UserModel)->carddetails();
    if (Session::exists('card')) {
        $card = (array)Session::get('card');
        $cardno = $card[0]->cno;
        $ctype = strtolower(Session::get('card')[0]->ctype);
        $ctype = ucfirst($ctype);
        $expmonth=substr(Session::get('card')[0]->cexpr, 0,2);
        $expyear = substr(Session::get('card')[0]->cexpr, -2,2);
    }
    else {
        $ctype = "";
        $ctype = "";
        $expmonth= "";
        $expyear = "";
    }
    ?>
<div class="row">
    <div class="col-2"></div>
    <div class="col">
        <h1>Card Details</h1>
        <br><br><br>
        <div class="row">
            <label class="label col-md control-label">Card No.
                <input type="number" class="form-control" name="cardno" placeholder="Card Number" value="<?php if (Session::exists('card')) { echo $cardno; } ?>"  pattern="[0-9]{10,16}" required>
            </label>
        </div>

<br><br><br>
        <div class="row">
                    <label for="ctype">Card Type</label>
                    <select class="btn" name="ctype">
                    <option value="Visa" <?php if ($ctype == "Visa") { ?> selected="selected" <?php } ?>>Visa</option>
                    <option value="Mastercard" <?php if ($ctype == "Mastercard") { ?> selected="selected" <?php } ?>>Mastercard</option>
                    <option value="Solo" <?php if ($ctype == "Solo") { ?> selected="selected" <?php } ?>>Solo</option>
                    <option value="American Express" <?php if (($ctype == "American Express")||($ctype == "Amex")) { ?> selected="selected" <?php } ?>>American Express</option>
                    <option value="Switch" <?php if ($ctype == "Switch") { ?> selected="selected" <?php } ?>>Switch</option>
                    <option value="Visa Electron" <?php if ($ctype == "Visa Electron") { ?> selected="selected" <?php } ?>>Visa Electron</option>
                </select>
        </div>

        <br><br><br><br>
        <div class="row">
        <div class="col">
            <div class="row">
                <label for="expmonth">Expiry Month</label>
            </div>
            <div class="row">
                <select class="btn" name="expmonth">
                    <option value="01" <?php if ($expmonth == "01") { ?> selected="selected" <?php } ?>>01</option>
                    <option value="02" <?php if ($expmonth == "02") { ?> selected="selected" <?php } ?>>02</option>
                    <option value="03" <?php if ($expmonth == "03") { ?> selected="selected" <?php } ?>>03</option>
                    <option value="04" <?php if ($expmonth == "04") { ?> selected="selected" <?php } ?>>04</option>
                    <option value="05" <?php if ($expmonth == "05") { ?> selected="selected" <?php } ?>>05</option>
                    <option value="06" <?php if ($expmonth == "06") { ?> selected="selected" <?php } ?>>06</option>
                    <option value="07" <?php if ($expmonth == "07") { ?> selected="selected" <?php } ?>>07</option>
                    <option value="08" <?php if ($expmonth == "08") { ?> selected="selected" <?php } ?>>08</option>
                    <option value="09" <?php if ($expmonth == "09") { ?> selected="selected" <?php } ?>>09</option>
                    <option value="10" <?php if ($expmonth == "10") { ?> selected="selected" <?php } ?>>10</option>
                    <option value="11" <?php if ($expmonth == "11") { ?> selected="selected" <?php } ?>>11</option>
                    <option value="12" <?php if ($expmonth == "12") { ?> selected="selected" <?php } ?>>12</option>
                </select>
            </div>
            </div>
        <br>
        <div class="col">
            <div class="row">
            <label for="expyear">Expiry Year</label>
            </div>
            <div class="row">
            <select class="btn" name="expyear">
                <option value="20" <?php if ($expyear == "20") { ?> selected="selected" <?php } ?>>20</option>
                <option value="21" <?php if ($expyear == "21") { ?> selected="selected" <?php } ?>>21</option>
                <option value="22" <?php if ($expyear == "22") { ?> selected="selected" <?php } ?>>22</option>
                <option value="23" <?php if ($expyear == "23") { ?> selected="selected" <?php } ?>>23</option>
                <option value="24" <?php if ($expyear == "24") { ?> selected="selected" <?php } ?>>24</option>
                <option value="25" <?php if ($expyear == "25") { ?> selected="selected" <?php } ?>>25</option>
            </select>
            </div>
        </div>
        </div>
        <input type="submit" value="Update" class="btn btn-secondary">
    </div>
    <div class="col-2"></div>
</div>
</form>

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
