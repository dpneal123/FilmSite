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
<form method="post" action="{{ route('card.insert') }}" >
    <input type = "hidden" name = "_token" value = "<?php use Illuminate\Support\Facades\Session;echo csrf_token(); ?>">
    <?php
    \Illuminate\Support\Facades\Session::start();
    ?>
    <div class="row">
        <div class="col-2"></div>
        <div class="col">
            <h1>Card Details</h1>
            <br><br><br>
            <div class="row">
                <label class="label col-md control-label">Card No.
                    <input type="number" class="form-control" name="cardno" placeholder="Card Number"  pattern="[0-9]{10,16}" required>
                </label>
            </div>
            <br><br><br>
            <div class="row">
                <label for="ctype">Card Type</label>
                <select class="btn" name="ctype" required>
                    <option value="Visa">Visa</option>
                    <option value="Mastercard">Mastercard</option>
                    <option value="Solo">Solo</option>
                    <option value="American Express">American Express</option>
                    <option value="Switch">Switch</option>
                    <option value="Visa Electron">Visa Electron</option>
                </select>
            </div>
            <br><br><br><br>
            <div class="row">
                <div class="col">
                    <div class="row">
                        <label for="expmonth">Expiry Month</label>
                    </div>
                    <div class="row">
                        <select class="btn" name="expmonth" required>
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="col">
                    <div class="row">
                        <label for="expyear">Expiry Year</label>
                    </div>
                    <div class="row">
                        <select class="btn" name="expyear" required>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                        </select>
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Update Card">
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
