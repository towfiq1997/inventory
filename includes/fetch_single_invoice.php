<?php

session_start();
if (!isset($_SESSION['name'])) {
    header("location:index.php");
}
$con = mysqli_connect('localhost', 'shebabar_shebabari', 'mysql!8Dy()', 'shebabar_inv');

$request = $_REQUEST;
$col = array(
    0   =>  'id',
    1   =>  'invoice_no',
    2   =>  'product_name',
    3   =>  'price'
);  //create column like table in database

$sql = "SELECT * FROM invoice_details";
$query = mysqli_query($con, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT * FROM invoice_details WHERE 1=1";
if (!empty($request['search']['value'])) {
    $sql .= " AND (id Like '" . $request['search']['value'] . "%' ";
    $sql .= " OR invoice_no  Like '" . $request['search']['value'] . "%' ";
    $sql .= " OR product_name Like '" . $request['search']['value'] . "%' ";
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
    $subdata[] = $row['id'];
    $subdata[] = $row['invoice_no'];
    $subdata[] = $row['product_name'];
    $subdata[] = $row['price'];
    $subdata[] = $row['qty'];
    $subdata[] = '<a href="edit_medicine.php?id=' . $row["id"] . '" style="margin-right:10px !important"><i class="fas fa-edit"></i></a><a href="delete_medicine.php?id=' . $row["id"] . '"><i class="fas fa-trash-alt"></i></a>';
    $data[] = $subdata;
}

$json_data = array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);

echo json_encode($json_data);
