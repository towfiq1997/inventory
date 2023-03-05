<?php

session_start();
if (!isset($_SESSION['name_m'])) {
    header("location:index.php");
}
$con = mysqli_connect('localhost', 'shebabar_shebabari', 'mysql!8Dy()', 'shebabar_inv');

$request = $_REQUEST;
$col = array(
    0   =>  'pid',
    1   =>  'product_name',
    2   =>  'cost',
    3   =>  'price'
);  //create column like table in database

$sql = "SELECT * FROM medicine";
$query = mysqli_query($con, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT * FROM medicine WHERE alert_qty > stock";
if (!empty($request['search']['value'])) {
    $sql .= " AND (pid Like '" . $request['search']['value'] . "%' ";
    $sql .= " OR product_name Like '" . $request['search']['value'] . "%' ";
    $sql .= " OR cost Like '" . $request['search']['value'] . "%' ";
    $sql .= " OR price Like '" . $request['search']['value'] . "%' )";
}
$query = mysqli_query($con, $sql);
$totalData = mysqli_num_rows($query);

//Order
$sql .= " ORDER BY " . $col[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'] . "  LIMIT " .
    $request['start'] . "  ," . $request['length'] . "  ";

$query = mysqli_query($con, $sql);

$data = array();

while ($row = mysqli_fetch_assoc($query)) {
    $subdata = array();
    $subdata[] = $row['product_name'];
    $subdata[] = $row['cost'];
    $subdata[] = $row['price'];
    $subdata[] = $row['stock'];
    $subdata[] = $row['added_date'];
    $subdata[] = $row['expiry_date'];
    $subdata[] = $row['status'];
    $subdata[] = $row['block'];
    $subdata[] = $row['alert_qty'];
    $subdata[] = '<a href="edit_medicine.php?id=' . $row["pid"] . '" style="margin-right:10px !important"><i class="fas fa-edit"></i></a><a href="delete_medicine.php?id=' . $row["pid"] . '"><i class="fas fa-trash-alt"></i></a>';
    $data[] = $subdata;
}

$json_data = array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);

echo json_encode($json_data);
