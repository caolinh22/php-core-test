<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Php cơ bản</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>
    <div class="container">
        <h1>Create Book</h1>
        <?php
        // de dung code tu 1 file php khac: include, include_once, require, require_once;
        require_once '../Controller/BookController.php';
        require_once '../Model/Book.php';
        if (isset($_REQUEST["submit"])) {
            $bookCode = htmlspecialchars(trim($_REQUEST["bookCode"]));
            $name = htmlspecialchars(trim($_REQUEST["name"]));
            $author = $_REQUEST["author"];
            $publishYear = $_REQUEST["publishYear"];
            $categoryId = $_REQUEST["categoryId"];
            $status = (isset($_REQUEST["status"]) ? $_REQUEST["status"] : 0);
            $book = new Book($bookCode, $name, $author, $publishYear, $status, $categoryId);
            $book->toString();
            $idmh = $_POST["idbook"];
            if ($idmh > 0) {
                // update
                $kq = BookController::update($book, $idmh);
            } else {
                $kq = BookController::insert($book);
            }

            if ($kq["errno"] == 1) {
                if ($idmh > 0) {
                    header("location: index.php?message=update");
                } else {
                    header("location: index.php?message=insert");
                }
            } else {
                // echo "<h1>" . $kq["errdes"] . "</br></h1>";
                echo "111";
            }
        }
        if (!empty($idmh) || !empty($_GET["id"])) {
            $id = (!empty($idmh)) ? $idmh : $_GET["id"];
            echo "$id";
            $book = BookController::getDetail($id);
        }
        ?>
        <form action="" method="post">
            <input type="hidden" name="idbook" value="<?php echo empty($book) ? "0" : $book["id"]; ?>" />
            <div class="form-group">
                <label>Code(*):</label>
                <input type="text" name="bookCode" class="form-control" value="<?php echo empty($book) ? "" : $book["bookCode"]; ?>" required />
            </div>
            <div class="form-group">
                Name: <input type="text" name="name" class="form-control" value="<?php echo empty($book) ? "" : $book["name"]; ?>" required />
            </div>
            <div class="form-group">
                Author: <input type="text" name="author" class="form-control" value="<?php echo empty($book) ? "" : $book["author"]; ?>" />
            </div>
            <div class="form-group">
                Publish Year: <input type="text" name="publishYear" class="form-control" value="<?php echo empty($book) ? "" : $book["publishYear"]; ?>" />
            </div>
            <div class="form-group">
                Category: <select name="categoryId" class="form-control" required>
                    <option value="cntt" <?php echo empty($book) ? "" : ($book["categoryId"] == "cntt" ? " selected" : ""); ?>>Công nghệ thông tin</option>
                    <option value="mmt" <?php echo empty($book) ? "" : ($book["categoryId"] == "mmt" ? " selected" : ""); ?>>Mạng máy tính</option>
                    <option value="khmt" <?php echo empty($book) ? "" : ($book["categoryId"] == "khmt" ? " selected" : ""); ?>>Khoa học máy tính</option>
                </select>
            </div>
            <div class="form-check">
                <label>Status </label>
                <input type="radio" name="status" value="1" class="form-check-control" <?php echo empty($book) ? "" : ($book["status"] == "1" ? " checked" : ""); ?> /> Availabel
                <input type="radio" name="status" value="0" class="form-check-control" <?php echo empty($book) ? "" : ($book["status"] == "0" ? " checked" : ""); ?> /> Not Availabel
            </div>
            <input type="submit" name="submit" value="<?php echo empty($book) ? "Create" : "Update"; ?>" class="btn btn-danger" />
            <a class="btn btn-primary" href="./BookList.php">Back</a>
        </form>
    </div>
</body>

</html>