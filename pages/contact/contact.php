<?php 
    error_reporting(0);
    session_start();

    require($_SERVER['DOCUMENT_ROOT'].'/shop/connection/database.php');
    require($_SERVER['DOCUMENT_ROOT'].'/shop/components/notify/notify.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sendUserTicket'])) {

        $userMessage = mysqli_real_escape_string($sql, $_POST['userMessage']);
        $userEmail = mysqli_real_escape_string($sql, $_POST['userEmail']);
        $user_id = $_SESSION['sqlID'] ?? 0;

        mysqli_query($sql, "INSERT INTO users_support (user_id, user_mail, user_message) VALUES ('$user_id', '$userEmail', '$userMessage')");
        displayNotify('Thank you for submitting your support ticket. Our team is currently reviewing your issue and will respond as soon as possible');
    }

?>

<!DOCTYPE html>
<html lang="en">
    <?php 
        require($_SERVER['DOCUMENT_ROOT'].'/shop/components/head.php');
        require('./contact-style.php');
    ?>
<body>
    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/navbar/navbar.php'); ?>

    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-5" id="show-mail-img">
                <img src="https://img.icons8.com/bubbles/500/important-mail.png" id="send-image" alt="mail-img" class="img-fluid">
            </div>
            <div class="col-md-5">
                <form action="contact.php" method="post">
                    <?php 
                        $idd = $_SESSION['sqlID'];
                        $getUserEmail = mysqli_query($sql, "SELECT email FROM `users` WHERE `ID` = '$idd'");
                        $userInfo = mysqli_fetch_assoc($getUserEmail);
                    ?>

                    <div class="mb-3">
                        <label for="user_mail" class="form-label">Email address</label>
                        <input type="email" name="userEmail" class="form-control" id="user_mail" placeholder="name@example.com" value="<?php echo $userInfo['email']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="user_message" class="form-label">Your Message</label>
                        <textarea class="form-control" id="user_message" name="userMessage" rows="3" maxlength="256"></textarea>
                    </div>
                    <button type="submit" name="sendUserTicket" class="btn btn-outline-success">Send <i class="bi bi-forward"></i></button>
                </form>
            </div>
        </div>
    </div>

    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/footer/footer.php'); ?>
</body>
</html>