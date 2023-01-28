<?php 
    error_reporting(0);
    session_start();

    require($_SERVER['DOCUMENT_ROOT'].'/shop/connection/database.php');
    require($_SERVER['DOCUMENT_ROOT'].'/shop/functions/functions.php');
    require_once($_SERVER['DOCUMENT_ROOT'].'/shop/components/notify/notify.php');

    $book_id = mysqli_real_escape_string($sql, $_GET['book_id']);

    $bookQuery = mysqli_query($sql, "SELECT * FROM `stock` WHERE `ID` = '$book_id'");
    if(!mysqli_num_rows($bookQuery)) {
        header("Location: ../books.php");
        die();
    }
    $bookInfo = mysqli_fetch_assoc($bookQuery);


    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $newBookName = mysqli_real_escape_string($sql, $_POST['newBookName']);
        $newBookPrice = mysqli_real_escape_string($sql, $_POST['newBookPrice']);
        
        $bookDescription = mysqli_real_escape_string($sql, $_POST['bookDescription']);
        $bookDescriptionTrim = trim($bookDescription);

        $newBookCategory = mysqli_real_escape_string($sql, $_POST['newBookCategory']);
        $newBookSubCategory = mysqli_real_escape_string($sql, $_POST['newBookSubCategory']);

        $availableImage = "";

        if($_FILES['image']['size']) {
            $image = $_FILES['image']['tmp_name'];
            $name = $_FILES['image']['name'];
            $image = base64_encode(file_get_contents(addslashes($image)));

            $availableImage = ", `img_url` = '$image', `img_name` = '$name'";
        }

        mysqli_query($sql, "UPDATE `stock` SET `livroName` = '$newBookName', `livroPrice` = '$newBookPrice', `livroDescription` = '$bookDescriptionTrim', `livroCategory` = '$newBookCategory', `livroSubCategory` = '$newBookSubCategory' $availableImage WHERE `ID` = '$book_id'");

        header("Location: ../books.php");
        die();
    }

?>

<!DOCTYPE html>
<html lang="en">
    <?php 
        require($_SERVER['DOCUMENT_ROOT'].'/shop/components/head.php');
    
        ?>
<body>
    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/navbar/navbar.php'); ?>

    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">

            <div class="col-md-5 d-flex justify-content-center">
                <div class="book-image">
                    <?php echo displayImageFromDatabase($sql, $book_id); ?>
                </div>
            </div>

            <div class="col-md-5">
                <form method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="newBookName" class="form-label">Book Name</label>
                        <input type="text" class="form-control" name="newBookName" id="newBookName" aria-describedby="bookName" value="<?php echo $bookInfo['livroName']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="newBookName" class="form-label">Book Name</label>

                        <textarea class="form-control" placeholder="Leave a comment here" id="newBookName" name="bookDescription" style="height: 200px;">
                            <?php echo trim($bookInfo['livroDescription']); ?>
                        </textarea>
                    </div>

                    <div class="mb-3">
                        <label for="newBookPrice" class="form-label">Price</label>
                        <input type="number" name="newBookPrice" min="1" class="form-control" id="newBookPrice" value="<?php echo $bookInfo['livroPrice'] ?>">
                    </div>

                    <div class="mb-3">
                        <div class="category d-flex flex-column">
                            <div class="selectCategory">
                                <label for="category" class="form-label">Category</label>
                                <select id="category" name="newBookCategory">
                                    <option value="None" disabled selected>Select Category..</option>
                                    <?php
                                        $bookCategories = mysqli_query($sql, "SELECT * FROM `categories`");
                                        if(mysqli_num_rows($bookCategories)) {

                                            while($row = mysqli_fetch_array($bookCategories)) {
                                                $selected = ($row['ID'] == $bookInfo['livroCategory']) ? 'selected="selected"' : '';

                                                echo '<option value="'.$row['ID'].'"'.$selected.'>'.$row['category_name'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="selectSubCategory mt-2">
                                <label for="subCategory" class="form-label">Sub Category</label>
                                <select id="subCategory" name="newBookSubCategory">
                                    <option value="None" disabled selected>Select Sub Category..</option>
                                    <?php
                                        $bookCategories = mysqli_query($sql, "SELECT * FROM `sub_categories` ORDER BY ID");
                                        if(mysqli_num_rows($bookCategories)) {

                                            while($row = mysqli_fetch_array($bookCategories)) {
                                                
                                                $selected = ($row['ID'] == $bookInfo['livroCategory']) ? 'selected="selected"' : '';

                                                echo  '<option value="'.$row['ID'].'"'.$selected.'>'.$row['sub_category_name'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="book-image mt-5">
                        <div class="mb-3">
                            <label for="formFileSm" class="form-label">Book Image</label>
                            <input class="form-control form-control-sm" id="formFileSm" name="image" type="file" accept="image/*">
                        </div>
                    </div>

                    <button type="submit" name="addNewBook" class="btn btn-primary mb-3">EDIT BOOK</button>
                </form>
            </div>
        </div>
    </div>

    <?php require($_SERVER['DOCUMENT_ROOT'].'/shop/components/footer/footer.php'); ?>

</body>
</html>