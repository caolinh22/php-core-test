<?php
class Connection{
    private const SERVERNAME= "localhost:8088";
    private const USERNAME = "root";
    private const PASSWORD = "";
    private const DATABASE = "php-core";
    
    static function getConnection(){
        $con = mysqli_connect(self::SERVERNAME, self::USERNAME, Connection::PASSWORD, self::DATABASE);
        if ($con->error){
            return null;
        } else return $con;
    }
    static function closeConnection($connection){
        if (!empty($connection)){
            mysqli_close($connection);
        }
    }
}
?>