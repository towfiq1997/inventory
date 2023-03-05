<?php
class Admin
{
    public $conn;
    function __construct()
    {
        include_once("db.php");
        $db = new Database();
        $this->conn = $db->connect();
    }
     public function login($sql)
    {
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['id_m'] = $row['id'];
            $_SESSION['init_m'] = $row['username'];
            $_SESSION['name_m'] = $row['name'];
            $_SESSION['manager'] = $row['username'];
            $id = $row['id'];
            $init = $row['username'];
            header('location:testorder.php?id=' . $id . '&init=' . $init . '');
        } else {
            $msg = "<p>Password Or Email Doesn't Match Try Again!</p>";
            return $msg;
        }
    }
     public function loginnnnn($u,$p)
    {       $sql = "SELECT id,username,name FROM manager WHERE username=? AND password=?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s,s",$u,$p);
            $stmt->execute();
            $result = $stmt->store_result();
            $stmt->bind_result($id,username,name);
            $stmt->fetch();
            $_SESSION['id_m'] = $id;
            $_SESSION['init_m'] = $username;
            $_SESSION['name_m'] = $name;
            $_SESSION['manager'] = $username;
            $id = $id;
            $init = $username;
            header('location:testorder.php');
            
        }
}
