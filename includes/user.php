<?php
session_start();
class Admin
{
    public $conn;
    function __construct()
    {
        include_once("db.php");
        $db = new Database();
        $this->conn = $db->connect();
    }
    function adminlogin($email, $password)
    {   $sql = "SELECT id,name,password,last_login FROM admin WHERE email = '$email' && password = '$password'";
        $result = $this->conn->query($sql);
        if ($result->num_rows < 1) {
            return "Password Does not Match";
        } else {

            $row = $result->fetch_assoc();
            $_SESSION["id"] = $row["id"];
            $_SESSION["name"] = $row["name"];
            $_SESSION["last_login"] = $row["last_login"];
            $last_login = date("Y-m-d h:m:s");
           $sql = "UPDATE admin SET last_login ='$last_login' WHERE email='$email'";
            return 1;
        }
    }
}
