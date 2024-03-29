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

    <div class="container hereWeGo" style="margin-top: 10%;">
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
                    <a href="./pages/categories/category.php" class="d-flex align-items-center justify-content-center">Manage<span class="material-symbols-outlined">settings</span></a>
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
                    <a href="./pages/books/books.php" class="d-flex align-items-center justify-content-center">Manage<span class="material-symbols-outlined">settings</span></a>
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
                    <a href="./pages/users/users.php" class="d-flex align-items-center justify-content-center">Manage<span class="material-symbols-outlined">settings</span></a>
                </div>
            </div>

        </div>
    </div>

    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/footer/footer.php'); ?>
</body>
</html>