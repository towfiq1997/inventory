<?php

session_start();
if (!isset($_SESSION['name_m'])) {
    header("location:index.php");
}
$con = mysqli_connect('localhost', 'shebabar_shebabari', 'mysql!8Dy()', 'shebabar_inv');

$request = $_REQUEST;
$col = array(
    0   =>  'invoice_no',
    1   =>  'customer_name',
    2   =>  'order_date',
    3   =>  'due'
);  //create column like table in database

$sql = "SELECT * FROM invoice";
$query = mysqli_query($con, $sql);

$totalData = mysqli_num_rows($query);

$totalFilter = $totalData;

//Search
$sql = "SELECT * FROM  invoice WHERE 1=1";
if (!empty($request['search']['value'])) {
    $sql .= " AND (invoice_no Like '" . $request['search']['value'] . "%' ";
    $sql .= " OR customer_name Like '" . $request['search']['value'] . "%' ";
    $sql .= " OR order_date Like '" . $request['search']['value'] . "%' ";
    $sql .= " OR due Like '" . $request['search']['value'] . "%' )";
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
    $subdata[] = $row['invoice_no'];
    $subdata[] = $row['customer_name'];
    $subdata[] = $row['order_date'];
    $subdata[] = $row['sub_total'];
    $subdata[] = $row['discount'];
    $subdata[] = $row['net_total'];
    $subdata[] = $row['paid'];
    $subdata[] = $row['due'];
    $subdata[] = '<a href="edit_medicine.php?id=' . $row["invoice_no"] . '" style="margin-right:10px !important"><i class="fas fa-edit"></i></a><a href="delete_medicine.php?id=' . $row["invoice_no"] . '"><i class="fas fa-trash-alt"></i></a>';
    $data[] = $subdata;
}

$json_data = array(
    "draw"              =>  intval($request['draw']),
    "recordsTotal"      =>  intval($totalData),
    "recordsFiltered"   =>  intval($totalFilter),
    "data"              =>  $data
);

echo json_encode($json_data);
