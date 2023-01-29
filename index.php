<?php 
    error_reporting(0);
    session_start();

    include($_SERVER['DOCUMENT_ROOT'].'/shop/connection/database.php');
    require($_SERVER['DOCUMENT_ROOT'].'/shop/functions/functions.php');

?>

<!doctype html>
<html lang="en">
    <?php include('./components/head.php'); ?>

    <!-- <meta http-equiv="refresh" content="4"> -->

    <body>
    <?php include('./components/navbar/navbar.php'); ?>

    <header>
        <div class="container">
            <div class="row d-flex justify-content-center align-items-center">
                <!-- image slider -->
                <div class="col-lg-5 mt-5"> 
                    <div class="slider">
                        <div class="row w-100">
                            <div class="quotes">
                                <p style="text-align: center;">
                                <span id="quotes-line" style="float: left;" >&quot;</span>
                                    <br /><span id="q_content"><span id="q_f_letter">O</span> livro é uma extensão da memória e da imaginação</span><br/>
                                <span id="quotes-line" style="float: right;" >&quot;</span>

                                </p>
                            </div>
                            <div class="btn-group" role="group" aria-label="First group">
                                <div class="dot"></div>
                                <div class="dot"></div>
                                <div class="dot"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- send news to mail -->
                <div class="col-lg-5">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="index_mail" placeholder="name@example.com">
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Comments</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" style="resize: none;" rows="3" maxlength="256"></textarea>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                            <label class="form-check-label" for="flexSwitchCheckChecked">Newsletter</label>
                        </div>
                        <input type="button" id="send_button" class="btn btn-outline-success disabled" value="Submit">
                    </form>
                    <hr />
                </div>
            </div>
        </div>
    </header>

    <section class="our-library">
        <div class="container">
            <div class="row">
                <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php 
                            $query = "SELECT ID, img_url, livroDescription FROM `stock` ORDER BY ID";
                            $sendQuery = mysqli_query($sql, $query);
                            $rows = mysqli_num_rows($sendQuery);
                            $rnd_img = rand(1, $rows);

                            while($row = mysqli_fetch_array($sendQuery)) {

                                $getImage = displayImageFromDatabase($sql, $row['ID']);
                                $active = $row['ID'] == $rnd_img ? 'active' : '';
                                
                                $timeToChange = 4000;

                                echo '
                                    <div class="carousel-item '.$active.'" data-bs-interval="'.$timeToChange.'">
                                        <div class="row justify-content-center align-items-center">
                                            <div class="col-md-5">
                                                "'.$getImage.'"
                                            </div>
                                            <div class="col-md-5">
                                                <p>'.$row['livroDescription'].'</p>
                                                <div class="d-grid gap-2">
                                                    <a class="btn btn-danger" href="./pages/library/library.php">Check our stock</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('./components/footer/footer.php'); ?>
    <script>
        let isActive = false;
        document.getElementById("index_mail").addEventListener("input", () => {
            let hasInput = document.getElementById("index_mail").value

            if(!isActive || !hasInput.length) enableSubmit(hasInput.length ? true : false);
        });
        const enableSubmit = (toggle) => 
        {
            isActive = toggle;
            document.getElementById("send_button").classList.toggle("disabled");
        }

    </script>

    <script src="./script/script.js"></script>
    </body>
</html>