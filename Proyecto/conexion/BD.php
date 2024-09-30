<?php
class DB {
    const SERVER = "localhost";
    const USER = "root";
    const PASSWORD = "";
    const BD = "test";

    public static function getConnection() {
        $connection = mysqli_connect(self::SERVER, self::USER, self::PASSWORD, self::BD);

        if (!$connection) {
            die("No se logro conextar: " . mysqli_connect_error());
        }
        return $connection;
    }
}
?>