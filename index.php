<!-- 
    - add an administrator {
        an search input with name and down show result with button 
        !admin ? add : remove
    }
 -->

<?php error_reporting(E_ERROR | E_PARSE);
    session_start();

    include('./connection/database.php');

?>

<!doctype html>
<html lang="en">
    <?php include('./components/head.php'); ?>

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
                <?php require('./components/slider/carousel.php'); ?>
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