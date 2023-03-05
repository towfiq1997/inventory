<?php
class helper
{
    public $con;

    function __construct()
    {
        include_once("db.php");
        $db = new Database();
        $this->con = $db->connect();
    }
    public function getstockCount()
    {
        $sql = "SELECT * FROM medicine WHERE alert_qty > stock";
        if ($result = $this->con->query($sql)) {
            $rowcount = $result->num_rows;
        }
        return $rowcount;
    }
    public function getexpkCount()
    {
        $sql = "SELECT * FROM medicine WHERE expiry_date<NOW()";
        if ($result = $this->con->query($sql)) {
            $rowcount = $result->num_rows;
        }
        return $rowcount;
    }
    public function getReports($column,$cur_date)
    {
        $sql = "SELECT SUM($column) AS getr FROM invoice WHERE order_date = '$cur_date'";
        if ($result = $this->con->query($sql)) {
            $row = $result->fetch_assoc();
            return $row['getr'];
        }
    }
}
