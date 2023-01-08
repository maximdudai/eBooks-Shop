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


    <div class="container hereWeGo">
        <div class="row justify-content-center align-items-center ">
            
            <!-- manage categories -->
            <div class="card border-success mb-3 m-1 text-center" style="max-width: 18rem;">
                <div class="card-header bg-transparent border-success">Categories</div>
                <div class="card-body text-success">
                    <h5 class="card-title">Manage Categories</h5>
                    <p class="card-text">
                        <ul>
                            <li>Add Categories</li>
                            <li>Remove Categories</li>
                            <li>Add Sub Categories</li>
                            <li>Remove Sub Categories</li>
                        </ul>
                    </p>
                </div>
                <div class="card-footer bg-transparent border-success">
                    <a href="#" class="d-flex align-items-center justify-content-center">Manage<span class="material-symbols-outlined">settings</span></a>
                </div>
            </div>

            <!-- manage books -->
            <div class="card border-success mb-3 m-1 text-center" style="max-width: 18rem;">
                <div class="card-header bg-transparent border-success">Books</div>
                <div class="card-body text-success">
                    <h5 class="card-title">Manage Books</h5>
                    <p class="card-text">
                        <ul>
                            <li>Add Books</li>
                            <li>Remove Books</li>
                            <li>Update Books</li>
                        </ul>
                    </p>
                </div>
                <div class="card-footer bg-transparent border-success">
                    <a href="#" class="d-flex align-items-center justify-content-center">Manage<span class="material-symbols-outlined">settings</span></a>
                </div>
            </div>
            
            <!-- manage users -->
            <div class="card border-success mb-3 m-1 text-center" style="max-width: 18rem;">
                <div class="card-header bg-transparent border-success">Users</div>
                <div class="card-body text-success">
                    <h5 class="card-title">Manage Users</h5>
                    <p class="card-text">
                        <ul>
                            <li>Registered Users</li>
                            <li>Users Orders</li>
                        </ul>
                    </p>
                </div>
                <div class="card-footer bg-transparent border-success">
                    <a href="#" class="d-flex align-items-center justify-content-center">Manage<span class="material-symbols-outlined">settings</span></a>
                </div>
            </div>

        </div>
    </div>
    

    <?php require('../../components/footer/footer.php'); ?>

</body>
</html>