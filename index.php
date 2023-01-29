<?php 
    error_reporting(0);
    session_start();

    include($_SERVER['DOCUMENT_ROOT'].'/shop/connection/database.php');
    
    require($_SERVER['DOCUMENT_ROOT'].'/shop/functions/functions.php');
    require($_SERVER['DOCUMENT_ROOT'].'/shop/components/notify/notify.php');


    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(isset($_POST['send_button'])) {
            $index_mail = mysqli_real_escape_string($sql, $_POST['index_mail']);

            $checkMail = mysqli_query($sql, "SELECT email FROM `newsletter` WHERE `email` = '$index_mail'");

            if(!mysqli_num_rows($checkMail)) {
                mysqli_query($sql, "INSERT INTO `newsletter` (email) VALUES ('$index_mail')");
                displayNotify('Email '."$index_mail".' has been added to our newsletter list!');
            }
            else
                displayNotify('Email already exist on our list.');
        }
    }

?>

<!doctype html>
<html lang="en">
    <?php include($_SERVER['DOCUMENT_ROOT'].'/shop/components/head.php'); ?>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap');

        /* quotes */
        @import url('https://fonts.googleapis.com/css2?family=Pacifico&display=swap');


        html, body { 
            height: 100%;
            font-family: 'Montserrat', sans-serif;
        }

        #quotes-line {
            font-size: 3rem;
            color: black;
            font-weight: 600;
            font-family: 'Pacifico', cursive;
        }
        #q_content {
            font-size: 1.5rem;
            letter-spacing: 1.5px;
            padding: 10px;
        }
        #q_f_letter {
            font-size: 2.5rem;
            color: black;
            font-weight: bold;
            border-bottom: 1px solid black;
        }

        .toast {
            position: fixed;
            bottom: 5px;
            left: 5px;
            right: 50;
            z-index: 2025;
            font-weight: 600;
        }
    </style>

<body>
    <?php include($_SERVER['DOCUMENT_ROOT'].'/shop/components/navbar/navbar.php'); ?>

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
                    <div class="news-letter">
                        <h3>SEND ME NEWSLETTER!</h3>
                    </div>
                    <form  method="post">
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="index_mail" name="index_mail" placeholder="name@example.com">
                        </div>
                        <input type="submit" id="send_button" name="send_button" class="btn btn-outline-success disabled" value="Submit">
                    </form>
                    <hr />
                </div>
            </div>
        </div>
    </header>

    <section class="our-library mt-5">
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

    <?php include($_SERVER['DOCUMENT_ROOT'].'/shop/components/footer/footer.php'); ?>

    <script src="./script/script.js"></script>
    </body>
</html>