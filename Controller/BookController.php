<?php
require_once '../connection.php';

class BookController
{
    public static function insert(Book $obj)
    {
        $result = [];
        if (empty($obj)) {
            $result = array("errno" => 0, "errdes" => "Input empty");
            return $result;
        }
        if (!is_object($obj)) {
            $result = array("errno" => -1, "errdes" => "Input not type");
            return $result;
        }
        $conn = Connection::getConnection();
        $sql = "insert into book(bookCode, name, author, publishYear, status, categoryId) 
            values (?,?,?,?,?, ?)";
        $ps = $conn->prepare($sql);
        $ps->bind_param("sssiis", $obj->bookCode, $obj->name, $obj->author, $obj->publishYear, $obj->status, $obj->categoryId);
        if ($ps->execute()) {
            $result = array("errno" => 1, "errdes" => "Them thanh cong");
        } else {
            $result = array("errno" => 0, "errdes" => $ps->error);
        }
        Connection::closeConnection($conn);
        return $result;
    }
    static function search()
    {
        $datas = [];
        $connection = Connection::getConnection();
        $sql = "select id, bookCode, name, author, publishYear, status, categoryId from book";
        $rs = $connection->query($sql);
        if ($rs->num_rows > 0) {
            $datas = [];
            while (true) {
                $row = $rs->fetch_assoc();
                if (empty($row)) {
                    break;
                }
                $datas[] = $row;
            }
        } else {
            $datas = [];
        }
        Connection::closeConnection($connection);
        return $datas;
    }
    static function update(book $obj, $id)
    {
        $result = [];
        if (empty($id)) {
            $result = array("errno" => 0, "errdes" => "Id empty");
            return $result;
        }
        if (empty($obj)) {
            $result = array("errno" => 0, "errdes" => "Input empty");
            return $result;
        }
        if (!is_object($obj)) {
            $result = array("errno" => -1, "errdes" => "Input not type");
            return $result;
        }
        $conn = Connection::getConnection();
        $sql = "update book set bookCode=?, name=?, author=?, publishYear=?, status=?, categoryId=? where id=?";
        $ps = $conn->prepare($sql);
        $ps->bind_param("sssiisi", $obj->bookCode, $obj->name, $obj->author, $obj->publishYear, $obj->status, $obj->categoryId, $id);
        if ($ps->execute()) {
            $result = array("errno" => 1, "errdes" => "Update successful!");
        } else {
            $result = array("errno" => 0, "errdes" => $ps->error);
        }
        Connection::closeConnection($conn);
        return $result;
    }
    static function delete($id)
    {
        $result = [];
        if (empty($id)) {
            $result = array("errno" => 0, "errdes" => "Id empty");
            return $result;
        }
        $conn = Connection::getConnection();
        $sql = "delete from book where id=?";
        $ps = $conn->prepare($sql);
        $ps->bind_param("i", $id);
        if ($ps->execute()) {
            $result = array("errno" => 1, "errdes" => "Deleted!");
        } else {
            $result = array("errno" => 0, "errdes" => $ps->error);
        }
        Connection::closeConnection($conn);
        return $result;
    }
    static function getDetail($id)
    {
        $datas = [];
        if (empty($id)) {
            return $datas;
        }
        $conn = Connection::getConnection();
        $sql = "select id, bookCode, name, author, publishYear, status, categoryId from book where id=$id";
        $rs = $conn->query($sql);
        if ($rs->num_rows > 0) {
            $datas = $rs->fetch_assoc();
        } else {
            $datas = [];
        }
        Connection::closeConnection($conn);
        return $datas;
    }
}
