<?php 
    error_reporting(0);
    session_start();

?>

<!DOCTYPE html>
<html lang="en">
    <?php 
        require($_SERVER['DOCUMENT_ROOT'].'/shop/components/head.php');
    ?>
<body>
    
    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/navbar/navbar.php'); ?>

    <div class="container mt-5">
        <div class="row d-flex flex-column justify-content-center align-items-center">
            
        <div class="col-md-7">
                <div class="title">
                    WHO WE ARE
                    <hr />
                </div>
                <div class="content">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique ipsam dolorem laboriosam, dicta nesciunt quod cum eum saepe odio suscipit accusamus iste architecto tempora non excepturi eaque. Provident laudantium voluptatibus odio rem, deserunt saepe dolore perspiciatis laboriosam nemo ipsa eaque necessitatibus itaque ea iusto quia, labore alias! Nemo, repudiandae ipsa?
                </div>
            </div>

            <div class="col-md-7 mt-5">
                <div class="title">
                    ABOUT OUR EBOOKS SHOP
                    <hr />
                </div>
                <div class="content">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Possimus doloribus iure omnis ullam necessitatibus dolorum architecto mollitia libero nesciunt iste culpa ad quibusdam suscipit fugit similique quae repellendus, eius accusantium ipsum earum voluptatum quas ipsa. Reprehenderit vel, porro voluptatum at nostrum quo nisi? Provident adipisci vel explicabo maxime quia ullam?
                </div>
            </div>

            <div class="col-md-5 mt-5 text-center">
                <a href="<?php echo LIBRARY_PAGE; ?>" class="btn btn-lg btn-outline-success">SHOP</a>
                <a href="<?php echo CONTACT_PAGE; ?>" class="btn btn-lg btn-outline-success">Contact US</a>
            </div>

        </div>
    </div>

    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/footer/footer.php'); ?>
</body>
</html>