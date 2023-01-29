<?php 
    error_reporting(0);
    session_start();

    require($_SERVER['DOCUMENT_ROOT'].'/shop/connection/database.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/shop/components/notify/notify.php');


    $user_id = mysqli_real_escape_string($sql, $_GET['user']);

    if($_SERVER['REQUEST_METHOD'] == 'POST') 
    {

        if(isset($_POST['changeUserDetails'])) 
        {
            $userFirstName = mysqli_real_escape_string($sql, $_POST['userFirstName']);
            $userLastName = mysqli_real_escape_string($sql, $_POST['userLastName']);
            $validUserEmail = mysqli_real_escape_string($sql, $_POST['validUserEmail']);
            $validUserPassowrd = mysqli_real_escape_string($sql, $_POST['validUserPassowrd']);

            mysqli_query($sql, "UPDATE `users` SET `fName` = '$userFirstName', `lName` = '$userLastName', `password` = '$validUserPassowrd', `email` = '$validUserEmail' WHERE `ID` = '$user_id'");

            displayNotify("User (#".$user_id.") details has been changed!");
        } 

        if(isset($_POST['addToAdmin'])) {
            
            mysqli_query($sql, "UPDATE `users` SET `admin` = '1' WHERE `ID` = '$user_id'");
            displayNotify("User (#".$user_id.") has been added to administrator.");

        } else if (isset($_POST['removeFromAdmin'])) {
            mysqli_query($sql, "UPDATE `users` SET `admin` = '0' WHERE `ID` = '$user_id'");
            displayNotify("User (#".$user_id.") has been removed from administrator.");
            
        }

    }

    $formatUserData = mysqli_query($sql, "SELECT * FROM `users` WHERE `ID` = '$user_id'");
    if(!mysqli_num_rows($formatUserData)) {
        header("Location: ../users.php");
        die();
    }

    $userData = mysqli_fetch_assoc($formatUserData);
?>

<!DOCTYPE html>
<html lang="en">
    <?php 
        require($_SERVER['DOCUMENT_ROOT'].'/shop/components/head.php');
    ?>
<body>
    
    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/navbar/navbar.php'); ?>

    <div class="container" style="margin-top: 5%;">
        <div class="row align-items-center justify-content-between">
            <div class="col">
                <form class="row g-3" method="post">
                    <!-- First Name -->
                    <div class="col-md-7">
                        <label for="userFirstName" class="form-label">First name</label>
                        <input type="text" class="form-control" name="userFirstName" id="userFirstName" value="<?php echo $userData['fName'] ?>" required>
                    </div>

                    <!-- Last Name -->
                    <div class="col-md-7">
                        <label for="userLastName" class="form-label">Last name</label>
                        <input type="text" class="form-control" name="userLastName" id="userLastName" value="<?php echo $userData['lName'] ?>" required>
                    </div>

                    <!-- Email Address -->
                    <div class="col-md-7">
                        <label for="validUserMail" class="form-label">Email Address</label>
                        <div class="input-group">
                            <input type="email" class="form-control" name="validUserEmail" id="validUserMail"  aria-describedby="userEmail" value="<?php echo $userData['email'] ?>" required>
                            <span class="input-group-text" id="userEmail"><b>@</b></span>
                        </div>
                    </div>

                    <!-- User Password -->
                    <div class="col-md-7">
                        <label for="validUserPassowrd" class="form-label">Password</label>
                        <div class="input-group align-items-center">
                            <input type="password" class="form-control" name="validUserPassowrd" id="validUserPassowrd"  aria-describedby="inputGroupPrepend2" value="<?php echo $userData['password'] ?>" required>
                            <span class="material-symbols-outlined user-select-none input-group-text" id="changePasswordVisibility" role="button">visibility</span>
                        </div>
                    </div>

                    <!-- Checkbox -->
                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" name="userNotify" type="checkbox" value="" id="invalidCheck2">
                            <label class="form-check-label" for="invalidCheck2">
                                Notify the user for the changes made
                            </label>
                        </div>
                        <?php
                            $checkIfUserAdmin = mysqli_query($sql, "SELECT `admin`, `ID` FROM `users` WHERE `ID` = '$user_id'");
                            $isUserAdmin = mysqli_fetch_assoc($checkIfUserAdmin);

                            if($isUserAdmin['ID'] != $_SESSION['sqlID']) {
                                $manageAdmin = !$isUserAdmin['admin'] ? "ADD TO" : "REMOVE FROM";
                                $buttonName = !$isUserAdmin['admin'] ? "addToAdmin" : "removeFromAdmin";

                                echo '
                                    <div class="manageUserAdministrator mt-1">
                                        <button type="submit" name="'.$buttonName.'" class="btn btn-primary btn-sm">'.$manageAdmin.' ADMIN</button>
                                    </div>
                                ';
                            }
                        ?>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary" name="changeUserDetails" type="submit">Submit Changes</button>
                    </div>
                </form>
            </div>
            
            <div class="col-md">
                <div class="col mt-1">
                    <div class="row text-center">
                        <div class="title mb-3" style="font-size: 1.5rem; border-bottom: 1px solid silver;">User Orders</div>
                    </div>

                    <div class="row">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Book</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php
                                        $getUserOders = "SELECT * FROM `user_orders` WHERE `userID` = '$user_id'";
                                        $userOrders = mysqli_query($sql, $getUserOders);

                                        if(mysqli_num_rows($userOrders)) {

                                            while($row = mysqli_fetch_array($userOrders)) {
                                                echo '
                                                    <tr>
                                                        <th scope="row">'.$row['ID'].'</th>
                                                        <td>'.$row['bookName'].'</td>
                                                        <td>'.$row['amount'].'</td>
                                                        <td>'.$row['orderDate'].'</td>
                                                    </tr>
                                                ';
                                            }

                                        }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col mt-3">
                    <div class="row text-center">
                        <div class="title mb-3" style="font-size: 1.5rem; border-bottom: 1px solid silver;">User Help Tickets</div>
                    </div>

                    <div class="row">
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php
                                        $getUserOders = "SELECT * FROM `users_support` WHERE `user_id` = '$user_id'";
                                        $userOrders = mysqli_query($sql, $getUserOders);

                                        if(mysqli_num_rows($userOrders)) {

                                            while($row = mysqli_fetch_array($userOrders)) {
                                                echo '
                                                    <tr>
                                                        <th scope="row">'.$row['ID'].'</th>
                                                        <td>'.$row['date'].'</td>
                                                        <td>
                                                            <a href="'.TICKETS_PAGE.'?ticket_id='.$row['ID'].'&from_admin=1"><span class="material-symbols-outlined">info</span></a>
                                                        </td>
                                                    </tr>
                                                ';
                                            }

                                        }
                                    ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/footer/footer.php'); ?>

    <script type="text/javascript" src="./edit_user.js"></script>
</body>
</html>