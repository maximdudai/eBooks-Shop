<?php 
    error_reporting(0);
    session_start();

    require($_SERVER['DOCUMENT_ROOT'].'/shop/connection/database.php');
?>

<!DOCTYPE html>
<html lang="en">
    <?php 
        require($_SERVER['DOCUMENT_ROOT'].'/shop/components/head.php');
    ?>
<body>
    
    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/navbar/navbar.php'); ?>

    <div class="container mt-5">
        <div class="row">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Second Name</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $getUsersFromDb = "SELECT * FROM `users` ORDER BY ID";
                        $getUsers = mysqli_query($sql, $getUsersFromDb);

                        if(mysqli_num_rows($getUsers)) {

                            while($row = mysqli_fetch_array($getUsers)) {
                                echo 
                                '
                                    <tr>
                                        <th scope="row">'.$row['ID'].'</th>
                                        <td>'.$row['fName'].'</td>
                                        <td>'.$row['lName'].'</td>
                                        <td>
                                            <a href="./edit_user/edit_user.php?user='.$row['ID'].'"><span class="material-symbols-outlined" role="button">settings</span></a>
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

    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/footer/footer.php'); ?>

</body>
</html>