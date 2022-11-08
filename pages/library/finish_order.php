<?php 
    error_reporting(0);
    session_start();

    require('../../connection/database.php');
    require('../../components/notify/notify.php');


?>

<!DOCTYPE html>
<html lang="en">
    <?php 
        require('../../components/head.php');
        require('./finish_order_style.php');

        if($_SERVER['REQUEST_MEHTOD'] == 'GET') {
            $totalPrice = $_GET['total_price'];
        }

    ?>
<body>
    
    <?php require('../../components/navbar/navbar.php'); ?>

    <section class="finishOrder d-none">
        <div class="container w-50">
            <div class="row">
                <div class="totalPrice col-md-5">
                    total payment <span class="totalMoney float-end"><?php echo $_GET['total_price']; ?>€</span>
                </div>
            </div>
            <div class="payData row justify-content-center align-items-center">
                <form class="row g-3 needs-validation" novalidate>

                    <div class="col-md-4">
                        <label for="validationCustom01" class="form-label">First name</label>
                        <input type="text" class="form-control" id="validationCustom01" value="<?php echo $_SESSION['f_name'] ?>" required>
                        <div class="valid-feedback">
                        Looks good!
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Last name</label>
                        <input type="text" class="form-control" id="validationCustom02" value="<?php echo $_SESSION['l_name'] ?>" required>
                        <div class="valid-feedback">
                        Looks good!
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="validationCustom03" class="form-label">Phone Nr.</label>
                        <input type="tel" class="form-control" id="validationCustom03" required>
                        <div class="valid-feedback">
                        Looks good!
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="validationCustomUsername" class="form-label">Email Address</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input type="email" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" value="<?php echo $_SESSION['userMail'] ?>" required>
                            <div class="invalid-feedback">
                                Please choose a email.
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="validationCustom03" class="form-label">City</label>
                        <input type="text" class="form-control" id="validationCustom03" required>
                        <div class="invalid-feedback">
                        Please provide a valid city.
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="validationCustom04" class="form-label">State</label>
                        <select class="form-select" id="validationCustom04" required>
                        <option selected disabled value="">Choose...</option>
                            <option value="Lisbon">Lisbon</option>
                            <option value="Porto">Porto</option>
                            <option value="Leiria">Leiria</option>
                            <option value="Braga">Braga</option>
                            <option value="Algarve">Algarve</option>
                        </select>
                        <div class="invalid-feedback">
                        Please select a valid state.
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="validationCustom05" class="form-label">Zip</label>
                        <input type="text" class="form-control" id="validationCustom05" required>
                        <div class="invalid-feedback">
                        Please provide a valid zip.
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="validationCustom06" class="form-label">Promo Code</label>
                        <input type="text" class="form-control" id="validationCustom06">
                    </div>

                    <div class="col-12">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" disabled>
                            <label class="form-check-label" for="inlineRadio1">Cards</label>
                        </div>
                        
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                            <label class="form-check-label" for="inlineRadio2">Payment at Delivery</label>
                        </div>
                        
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled>
                            <label class="form-check-label" for="inlineRadio3">Google Play</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                        <label class="form-check-label" for="invalidCheck">
                            Agree to terms and conditions
                        </label>
                        <div class="invalid-feedback">
                            You must agree before submitting.
                        </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary float-end" id="finishPayment" type="submit">FINISH ORDER</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <section class="orderFinished">
        <div class="container">
            <div class="row text-center justify-content-center">
                <div class="infoMsg col-md-6">
                    <span class="iconFinish"><i class="bi bi-list-check"></i></span>

                    <p>We've received your order!</p>
                    <p>Thanks for shopping with book'Shop!</p>
                    <p>Please allow up to 2 business days (excluding weeknd, holidays) to process and ship your order.</p>
                    <p>You will receive another email when your order has shipped.</p>
                </div>
            </div>
            <div class="chooseOption row text-center justify-content-center">
                <div class="col-md-4">
                    <p>Order Number: #<?php echo rand(1234, 4321); ?></p>
                    <a class="continueShopping" href="./library.php">CONTINUE SHOPPING</a>
                </div>
                <div class="col-md-4">
                    <p>
                        Order Date: 
                        <?php 
                            echo date("Y/m/d");
                        ?>
                    </p>
                    <a class="contactUs" href="../../../shop/pages/contact/contact.php">CONTACT OUR TEAM</a>
                </div>
            </div>
        </div>
    </section>

    <?php require('../../components/footer/footer.php'); ?>
    <script src="./finishOrder.js"></script>
</body>
</html>