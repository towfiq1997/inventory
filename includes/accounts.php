<?php
class Accounts
{
    public $con;
    function __construct()
    {
        include_once("db.php");
        $db = new Database();
        $this->con = $db->connect();
    }
    public function revenue()
    {
        $cost = 0;
        $price = 0;
        $revenue = 0;
        $sql = "SELECT product_name,qty FROM invoice_details";
        if ($result = $this->con->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $pr_name = $row['product_name'];
                $sql2 = "SELECT cost FROM medicine WHERE product_name='$pr_name'";
                $q2 = $this->con->query($sql2);
                $row2 = $q2->fetch_assoc();
                $cost += $row2['cost'] * $row['qty'];
            }
        }
        $sql3 = "SELECT net_total FROM invoice";
        if ($result4 = $this->con->query($sql3)) {
            while ($row4 = $result4->fetch_assoc()) {
                $price += $row4['net_total'];
            }
        }
        $revenue = $price - $cost;
        return $revenue;
    }
    public function getno($table, $target)
    {
        $sql = "SELECT $target FROM $table";
        if ($query = $this->con->query($sql)) {
            $get_count = $query->num_rows;
        }

        return $get_count;
    }
}
