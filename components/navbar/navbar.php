<?php
    error_reporting(0);
    session_start();
    include('navbar-style.php');

    require($_SERVER['DOCUMENT_ROOT'].'/shop/config/constants.php');

    function displayUserAccount() {
        echo '
        <div class="dropdown">
            <button class="btn btn-danger dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                ACCOUNT <i class="bi bi-person-circle"></i>
            </button>
            <ul class="dropdown-menu" style="padding: 10px;">
                <li><a class="nav-link profile-item" href="'.CART_PAGE.'">My Cart <i class="bi bi-cart"></i></a></li>
                <li><a class="nav-link profile-item" href="'.SETTINGS_PAGE.'">Settings <i class="bi bi-gear"></i></a></li>
                <li><a class="nav-link profile-item" href="'.CONTACT_PAGE.'">Support <i class="bi bi-info-circle"></i></a></li>

                <li>
                    <br />
                    '.(($_SESSION['isAdmin']) ? ('<a class="m-1 nav-link profile-item" id="admincp-btn" href="'.ADMIN_PAGE.'">Admin CP <i class="bi bi-shield-slash-fill"></i></a>') : ('')) .'
                    <a class="nav-link profile-item justify-content-center align-items-center" id="logout-btn" href="'.LOGOUT_PAGE.'">Log Out <i class="bi bi-box-arrow-left"></i></a>
                </li>

            </ul>
        </div>
        ';
    }
?>
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container justify-content-between">
        <div class="home-page">
            <a class="navbar-brand" href="<?php echo BASE_PATH; ?>">book'Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="<?php echo LIBRARY_PAGE; ?>">Library</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo CONTACT_PAGE; ?>">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo ABOUT_PAGE; ?>">About US</a>
                </li>
            </ul>
        </div>


        <div class="user-info">
            <?php 
                if(isset($_SESSION['loggedIn'])) {
                    displayUserAccount();
                } else {
                    echo '<a href="'.LOGIN_PAGE.'" class="auth-btn">Login <i class="bi bi-box-arrow-in-right"></i></a>';
                }
            ?>
        </div>
    </div>
</nav>