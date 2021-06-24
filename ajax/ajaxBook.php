<?php
require_once '../Controller/BookController.php';
$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "";
if ($action == "delete") {
    $id = $_POST["id"];
    $res = BookController::delete($id);
    if ($res["errno"] == 1) {
        echo "success";
    } else {
        echo "Fail";
    }
} else if ($action == "getdata") {
    $datas = BookController::search();
    $i = 0;
    foreach ($datas as $row) {
        $id = $row["id"];
?>
        <tr>
            <td><?php echo ++$i; ?></td>
            <td><?php echo $row["bookCode"]; ?></td>
            <td><?php echo $row["name"]; ?></td>
            <td><?php echo $row["author"]; ?></td>
            <td><?php echo $row["publishYear"]; ?></td>
            <td><?php echo ($row["status"] == 1) ? "Available" : "Not Available"; ?></td>
            <td><?php echo $row["categoryId"]; ?></td>
            <td>
                <a href="create.php?id=<?= $id ?>">Edit</a>
                <a onclick="deleteRec(<?= $id ?>)">Delete</a>
            </td>
        </tr>
<?php
    }
}
?>