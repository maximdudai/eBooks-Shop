<?php 
    error_reporting(0);
    session_start();

    require($_SERVER['DOCUMENT_ROOT'].'/shop/connection/database.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/shop/components/notify/notify.php');

    $ticket_id = mysqli_real_escape_string($sql, $_GET['ticket_id']);
    $user_id = $_SESSION['sqlID'];

    $checkTicketDetails = mysqli_query($sql, "SELECT * FROM `users_support` WHERE `user_id` = '$user_id' AND `ID` = '$ticket_id'");

    if(!mysqli_num_rows($checkTicketDetails)) {
        header("../user-settings.php");
        die();
    }
    $ticketDetails = mysqli_fetch_assoc($checkTicketDetails);


?>

<!DOCTYPE html>
<html lang="en">
    <?php 
        require($_SERVER['DOCUMENT_ROOT'].'/shop/components/head.php');
    ?>

<body>
    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/navbar/navbar.php'); ?>

    <div class="container" style="margin-top: 5%;">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">

                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="floatingInput" value="<?php echo $ticketDetails['user_mail']; ?>" disabled>
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 200px; resize: none;" disabled><?php echo $ticketDetails['user_message']; ?></textarea>
                    <label for="floatingTextarea2">Message</label>
                </div>

                <div class="form-floating mt-3">
                    <input type="text" class="form-control" id="floatingInput" value="<?php echo $ticketDetails['date']; ?>" disabled>
                    <label for="floatingInput">Date</label>
                </div>

                <div class="col-sm">
                    <div>
                        Status: 
                        <b>
                            <?php
                                $ticketStatus = rand(1, 15);

                                if($ticketStatus < 5) 
                                    $ticketMessage = '<span style="color: silver;">Under Review</span>';
                                else if ($ticketStatus < 10)
                                    $ticketMessage = '<span style="color: green;">Active</span>';
                                else
                                    $ticketMessage = '<span style="color: red;">Solved</span>';

                                echo $ticketMessage
                            ?>
                        </b>
                    </div>
                    <button class="btn btn-sm btn-outline-success mt-3"><a href="../user-settings.php" class="d-flex align-items-center"><b>BACK</b> <span class="material-symbols-outlined">undo</span></a></button>
                </div>
            </div>
        </div>
    </div>

    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/footer/footer.php'); ?>
</body>
</html>