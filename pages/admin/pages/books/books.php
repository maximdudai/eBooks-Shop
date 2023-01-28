<?php 
    error_reporting(0);
    session_start();

    require($_SERVER['DOCUMENT_ROOT'].'/shop/connection/database.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        if(isset($_POST['addNewBook'])) {

            $newBookName = mysqli_real_escape_string($sql, $_POST['newBookName']);
            $bookDescription = mysqli_real_escape_string($sql, $_POST['bookDescription']);
            $newBookPrice = mysqli_real_escape_string($sql, $_POST['newBookPrice']);
            $newBookCategory = mysqli_real_escape_string($sql, $_POST['newBookCategory']);

            $image = $_FILES['image']['tmp_name'];
            $name = $_FILES['image']['name'];
            $image = base64_encode(file_get_contents(addslashes($image)));

            mysqli_query($sql, "INSERT INTO `stock` (livroName, livroPrice, livroDescription, livroCategory, img_url, img_name) VALUES ('$newBookName', '$newBookPrice', '$bookDescription', '$newBookCategory', '$image', '$name')");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <?php 
        require($_SERVER['DOCUMENT_ROOT'].'/shop/components/head.php');
    
        ?>
<body>
    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/navbar/navbar.php'); ?>

    <div class="container">
        <div class="row mt-3 justify-content-between">
            <div class="col-md-5">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">Book</th>
                            <th scope="col">Manage</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                                $getBooksInfo = "SELECT ID, livroName FROM `stock` ORDER BY `ID`";
                                $bookInfo = mysqli_query($sql, $getBooksInfo);


                                if(mysqli_num_rows($bookInfo)) {
                                    while($row = mysqli_fetch_array($bookInfo)) {

                                        echo '
                                            <tr>
                                                <th scope="row">'.$row['livroName'].'</th>
                                                <td><a href="edit_book.php?book_id='.$row['ID'].'"><span class="material-symbols-outlined">settings</span></a></td>
                                            </tr>
                                        ';
                                    }

                                }
                            ?>
                    </tbody>
                </table>
            </div>

            <div class="col-sm-5">
                <div class="row">
                <!-- enctype="multipart/form-data" -->
                    <form method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="newBookName" class="form-label">Book Name</label>
                            <input type="text" class="form-control" name="newBookName" id="newBookName" aria-describedby="bookName" required>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2Disabled" name="bookDescription" style="height: 100px; resize:none;"></textarea>
                            <label for="floatingTextarea2Disabled">Description</label>
                        </div>

                        <div class="mb-3">
                            <label for="newBookPrice" class="form-label">Price</label>
                            <input type="number" name="newBookPrice" min="1" class="form-control" id="newBookPrice" required>
                        </div>

                        <div class="mb-3">
                            <div class="category">
                                <label for="category" class="form-label">Category</label>
                                <select id="category" name="newBookCategory">
                                    <option value="None" disabled selected>Select Category..</option>
                                    <?php
                                        $bookCategories = mysqli_query($sql, "SELECT * FROM `categories` ORDER BY ID");
                                        if(mysqli_num_rows($bookCategories)) {

                                            while($row = mysqli_fetch_array($bookCategories)) {
                                                echo '
                                                    <option value="'.$row['category_name'].'">'.$row['category_name'].'</option>
                                                ';
                                            }
                                        }
                                   ?>
                                 </select>
                            </div>
                        </div>

                        <div class="book-image mt-5">
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Book Image</label>
                                <input class="form-control form-control-sm" id="formFileSm" name="image" type="file" accept="image/*">
                            </div>
                        </div>

                        <button type="submit" name="addNewBook" class="btn btn-primary mb-3">ADD BOOK</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/footer/footer.php'); ?>

    <script type="text/javascript" src="./books.js"></script>
</body>
</html>