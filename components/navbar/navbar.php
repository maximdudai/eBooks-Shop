<?php
    session_start();
    include('navbar-style.php');
    include('./logout.php');

    function displayUserAccount() {
        echo '
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle bg-warning border border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i>
            </button>
            <ul class="dropdown-menu" style="padding: 10px;">
                <li><a class="nav-link profile-item" href="#">My Cart <i class="bi bi-cart"></i></a></li>
                <li><a class="nav-link profile-item" href="#">Settings <i class="bi bi-gear"></i></a></li>
                <li><a class="nav-link profile-item" href="#">Support <i class="bi bi-info-circle"></i></a></li>

                <li>
                    <br />
                    '.(($_SESSION['isAdmin']) ? ('<a class="m-1 nav-link profile-item" id="admincp-btn" href="#">Admin CP <i class="bi bi-shield-slash-fill"></i></a>') : ('')) .'
                    <a class="nav-link profile-item justify-content-center align-items-center" id="logout-btn" href="../../../shop/components/navbar/logout.php">Log Out <i class="bi bi-box-arrow-left"></i></a>
                </li>

            </ul>
        </div>
        ';
    }
?>

<nav class="navbar navbar-expand-lg bg-light">
    <div class="container justify-content-between">
        <div class="home-page">
            <a class="navbar-brand" href="../../index.php">book'Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="../../../shop/pages/library/library.php">Library</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../../shop/pages/contact/contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../../shop/pages/about/about.php">About US</a>
                </li>
            </ul>
        </div>


        <div class="user-info">
            <?php 
                if($_SESSION["loggedIn"]) {
                    displayUserAccount();
                } else {
                    echo '<a href="../../../shop/pages/auth/auth.php" class="auth-btn">Login <i class="bi bi-box-arrow-in-right"></i></a>';
                }
            ?>
        </div>
    </div>
</nav>