<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("location:index.php");
}
include 'includes/DBOperation.php';
$d_get = $_GET['id'];
$delete = new DBOperation();
$sql = "DELETE FROM medicine WHERE pid='$d_get'";
$query = $delete->con->query($sql);
if($query=== TRUE){
    header("location:product_manage.php");
}else{
    echo '<div class="alert alert-danger" role="alert">
    Some Error Happened
 </div>';
}
?>