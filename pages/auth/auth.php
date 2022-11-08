<?php 
    error_reporting(0); 
    session_start();

    include('./auth.style.php');

    include('../../connection/database.php');

    $userName = mysqli_real_escape_string($sql, $_POST["firstName"]);
    $userLastName = mysqli_real_escape_string($sql, $_POST["secondName"]);
    $userMail = $_POST["userMail"];
    $userPassword = mysqli_real_escape_string($sql, $_POST["userPassword"]);
    
    $loggedIn = false;

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(!empty($userName) && !empty($userLastName)) {

            insertUser($sql, $userName, $userLastName, $userMail, $userPassword);

            header('location: ../../index.php');
            die();
        }
        else {
            checkLogin($sql, $userMail, $userPassword);
        }
    }

    function insertUser($con, $user_fName, $user_lName, $userMail, $userPass) {
        $ins = mysqli_query($con, "INSERT INTO `users` (fName, lName, password, email) VALUES ('$user_fName', '$user_lName', '$userPass', '$userMail')");
        

        updateVars(mysqli_insert_id($con), $user_fName, $user_lName, $userMail, $userPass, 0, true);
    }

    function checkLogin($con, $mail, $pass) {
        $query = mysqli_query($con, "SELECT * FROM `users` WHERE `email` = '$mail' AND `password` = '$pass'");
        $rows = mysqli_num_rows($query);

        if($rows) {
            
            while($row = mysqli_fetch_array($query)) {
                updateVars($row['ID'], $row['fName'], $row['lName'], $row['email'], $row['password'], $row['admin'], true);

                header('location: ../../index.php');
                die();
            }
        } else {
            echo '<script>alert("Invalid email or password, please try again!");</script>';
        }
    }

    function updateVars($sqlid, $name, $lname, $mail, $pass, $isAdmin, $loggedIn) {
        $_SESSION['sqlID'] = $sqlid;
        $_SESSION['loggedIn'] = $loggedIn;
        $_SESSION['f_name'] = $name;
        $_SESSION['l_name'] = $lname;
        $_SESSION['userMail'] = $mail;
        $_SESSION['userPass'] = $pass;
        $_SESSION['isAdmin'] = $isAdmin;
    }

    // function user_logIn($)

    function displayErrorMessage() {
        echo '

        ';
    }

?>

<!DOCTYPE html>
<html lang="en">

    <?php include('../../components/head.php'); ?>
<body>
    <?php include('../../components/navbar/navbar.php'); ?>

    <div class="container d-flex justify-content-center align-items-center" style="margin-top: 20vh;">
        <form action="auth.php" method="post">
            <div class="mb-3 reg-element hidden">
                <label for="first-name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first-name" name="firstName" aria-describedby="userFirstName">
            </div>
            <div class="mb-3 reg-element hidden">
                <label for="last-name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last-name" name="secondName" aria-describedby="userLastName">
            </div>

            <div class="mb-3">
                <label for="user-email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="user-email" name="userMail" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="user-password" class="form-label">Password</label>
                <input type="password" class="form-control" name="userPassword" id="user-password">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <div class="buttons d-flex justify-content-between align-items-center">
                <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                <a href="#" id="reg-btn" style="float: right !important; font-size: 14px;">Create an Account</a>
            </div>
        </form>
    </div>

    <?php include('../../components/footer/footer.php'); ?>

    <script>

        let regBtn = document.getElementById("reg-btn");
        let regElements = document.querySelectorAll(".reg-element");

        let visibleReg = false;
        regBtn.addEventListener('click', (e) => {
            regElements.forEach((e) => {
                e.classList.toggle("hidden");
            });

            visibleReg = !visibleReg;
            regBtn.textContent = visibleReg ? "I already have an account" : "Create an Account";
        });

    </script>

</body>
</html>