<?php error_reporting(E_ERROR | E_PARSE);

    session_start();

?>

<!DOCTYPE html>
<html lang="en">
    <?php 
        require('../../components/head.php');
        require('./contact-style.php');
    ?>
<body>
    <?php require('../../components/navbar/navbar.php'); ?>

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5" id="show-mail-img">
                <img src="https://img.icons8.com/bubbles/500/important-mail.png" id="send-image" alt="mail-img" class="img-fluid">
            </div>
            <div class="col-md-5">
                <form action="contact.php" method="post">
                    <div class="mb-3">
                        <label for="user_name" class="form-label">Your Name</label>
                        <input type="email" class="form-control" id="user_name" placeholder="Lorem Ipsum">
                    </div>
                    <?php 
                        if(!$_SESSION['loggedIn']) {
                            echo '
                            <div class="mb-3">
                                <label for="user_mail" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="user_mail" placeholder="name@example.com">
                            </div>
                            ';
                        }
                    ?>
                    <div class="mb-3">
                        <label for="user_message" class="form-label">Your Message</label>
                        <textarea class="form-control" id="user_message" rows="3" maxlength="256"></textarea>
                    </div>
                    <button type="submit" class="btn btn-outline-success">Send <i class="bi bi-forward"></i></button>
                </form>
            </div>
        </div>
    </div>

    <!-- when click 'send' -> shwoing and modal with "message has sent successfully -->

    <?php require('../../components/footer/footer.php'); ?>

</body>
</html>