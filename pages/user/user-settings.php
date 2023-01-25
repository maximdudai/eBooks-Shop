<?php 
    error_reporting(0);
    session_start();

    require($_SERVER['DOCUMENT_ROOT'].'/shop/connection/database.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/shop/components/notify/notify.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST') 
    {

        $sql_id = $_SESSION['sqlID'];

        if(isset($_POST['changeUserPassword'])) {

            $validOldPassword = mysqli_real_escape_string($sql, $_POST['validOldPassword']);
            $validNewPassword = mysqli_real_escape_string($sql, $_POST['validNewPassword']);


            $getUserData = mysqli_query($sql, "SELECT `password` FROM `users` WHERE `ID` = '$sql_id'");
            $userData = mysqli_fetch_assoc($getUserData);

            if($userData['password'] == $validOldPassword && $validNewPassword != $validOldPassword && strlen($validNewPassword) >= 6) {
                mysqli_query($sql, "UPDATE `users` SET `password` = '$validNewPassword' WHERE `ID` = '$sql_id'");
                displayNotify('Account password has been change successfully!');
            } else {
                displayNotify('The data entered is not valid!');
            }
        }
        if(isset($_POST['changeUserEmail'])) {

            $oldUserEmail = mysqli_real_escape_string($sql, $_POST['oldUserEmail']);
            $newUserEmail = mysqli_real_escape_string($sql, $_POST['newUserEmail']);

            $getUserData = mysqli_query($sql, "SELECT `email` FROM `users` WHERE `ID` = '$sql_id'");
            $userData = mysqli_fetch_assoc($getUserData);


            if($userData['email'] == $oldUserEmail && $oldUserEmail != $newUserEmail) {
                mysqli_query($sql, "UPDATE `users` SET `email` = '$newUserEmail' WHERE `ID` = '$sql_id'");
                displayNotify('Account email address has been change successfully!');
            } else {
                displayNotify('The data entered is not valid!');
            }

        }

    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php 
        require($_SERVER['DOCUMENT_ROOT'].'/shop/components/head.php');
    ?>

<body>
    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/navbar/navbar.php'); ?>

    <div class="container mt-5 justify-content-center align-items-center">

        <div class="row justify-content-between align-items-center">

            <div class="col-md-5">
                <div class="account-security"><h3>My Account Settings</h3></div>
                <div class="row">
                    <form method="post">
                        <div class="mb-3">
                            <div class="input-group align-items-center">
                                <input type="password" class="form-control" id="oldUserPassowrd" name="validOldPassword" placeholder="Old Password.." aria-describedby="inputGroupPrepend2" required>
                                <span class="material-symbols-outlined user-select-none input-group-text" id="btnOldPassowrd" role="button">visibility</span>
                            </div>
                        </div>                        
                        <div class="mb-3">
                            <div class="input-group align-items-center">
                                <input type="password" class="form-control" id="newUserPassowrd" name="validNewPassword" placeholder="New Password.." aria-describedby="inputGroupPrepend2" required>
                                <span class="material-symbols-outlined user-select-none input-group-text" id="btnNewPassowrd" role="button">visibility</span>
                            </div>
                        </div>

                        <button type="submit" name="changeUserPassword" class="btn btn-outline-danger">Change</button>
                    </form>
                </div>
                <hr style="margin: 30px 0;" />
                <div class="row">
                    <form method="post">
                        <div class="mb-3">
                            <label for="oldUserEmail" class="form-label">Old Email Address</label>
                            <input type="email" class="form-control" name="oldUserEmail" id="oldPassowrd">
                        </div>                        
                        <div class="mb-3">
                            <label for="newUserEmail" class="form-label">New Email Address</label>
                            <input type="email" class="form-control" name="newUserEmail" id="newPassowrd">
                        </div>

                        <button type="submit" name="changeUserEmail" class="btn btn-outline-danger">Change</button>
                    </form>
                </div>
            </div>

            <div class="col-sm-3 text-center">
                <div class="account-settings"><h3>My Account History</h3></div>
                <ul class="list-group">
                    <li class="list-group-item"><button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">My Order History</button></li>
                    <li class="list-group-item"><button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">My Help Tickets</button></li>
                </ul>
            </div>

        </div>
    </div>
    <!-- User History Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ....
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>

    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/footer/footer.php'); ?>
    <script type="text/javascript" src="./user-settings.js"></script>
</body>
</html>