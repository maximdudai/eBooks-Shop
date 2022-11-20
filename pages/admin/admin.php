<?php error_reporting(E_ERROR | E_PARSE);
    session_start();

    require('../../connection/database.php');
    require_once('../../components/notify/notify.php');
?>

<!DOCTYPE html>
<html lang="en">
    <?php 
        require('../../components/head.php');
        require('./admin.style.php');
    ?>
<body>
    
    <?php require('../../components/navbar/navbar.php'); ?>

    <section class="nav-options">
        <div class="container">
            <div class="row">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Books Records</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Categories</a>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <section class="content">

        <div class="container">

            <div class="users active">
                <div class="row justify-content-center align-items-center">

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">NewsLetter</th>
                            <th scope="col">Register</th>
                            <th scope="col">Manage</th>
                        </tr>
                    </thead>
                        <tbody>
                                <?php
                                    $con = mysqli_query($sql, "SELECT * FROM `users`");
                                    $res = mysqli_num_rows($con);

                                    if($res) {
                                        while($row = mysqli_fetch_array($con)) {

                                            $activeNewsLetter = $row['newsletter'] ? ('Active') : ('Inactive');

                                            $membersList = '
                                                <tr>
                                                    <th scope="row">'.$row['ID'].'</th>
                                                    <td>'.$row['fName'].'</td>
                                                    <td>'.$row['lName'].'</td>
                                                    <td>'.$row['email'].'</td>
                                                    <td>'.$activeNewsLetter.'</td>
                                                    <td>'.$row['reg_time'].'</td>
                                                    <td><a href="./manage/change_user.php?manage_user='.$row['ID'].'"><i class="bi bi-sliders"></i></a></td>
                                                </tr>
                                            ';
                                            echo $membersList;
                                        }
                                    }
                                ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="books">
                <div class="row">

                </div>
            </div>

            <div class="categories">
                <div class="row">

                </div>
            </div>

        </div>

    </section>

    <?php require('../../components/footer/footer.php'); ?>

</body>
</html>