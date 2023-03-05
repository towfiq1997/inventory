<?php

session_start();
if (!isset($_SESSION['name'])) {
    header("location:index.php");
}
$connect = mysqli_connect('localhost', 'shebabar_shebabari', 'mysql!8Dy()', 'shebabar_inv');

$query = '';

$output = array();

$query .= "
	SELECT categories.cat_name,medicine.* FROM medicine INNER JOIN categories ON medicine.cat_id = categories.cat_id WHERE 
";

if(isset($_POST["search"]["value"]))
{
	$query .= '(pid LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR product_name LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR cost LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR price LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR cat_name LIKE "%'.$_POST["search"]["value"].'%") ';
}

if(isset($_POST["order"]))
{
	$query .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY product_name DESC ';
}

if($_POST["length"] != -1)
{
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
$id = 1;
foreach($result as $row)
{
    $subdata = array();
    $subdata[] = $id++;
    $subdata[] = $row['product_name'];
    $subdata[] = $row['cat_name'];
    $subdata[] = $row['cost'];
    $subdata[] = $row['price'];
    $subdata[] = $row['stock'];
    $subdata[] = $row['expiry_date'];
    $status = '';
    if($row['status'] == 1){
        $status = '<button type="button" class="btn btn-success">Active</button>';
    }else{
        $status = '<button type="button" class="btn btn-warning">Inactive</button>';
    }
    $subdata[] = $status;
    $subdata[] = '<button type="button" class="btn btn-info">'.$row['block'].'</button>';
    $subdata[] = '<button type="button" class="btn btn-danger">'.$row['alert_qty'].'</button>';
    $subdata[] = '<a href="edit_medicine.php?id=' . $row["pid"] . '" style="margin-right:10px !important"><i class="fas fa-edit"></i></a><a href="delete_medicine.php?id=' . $row["pid"] . '"><i class="fas fa-trash-alt"></i></a>';
    $data[] = $subdata;
}

function get_total_all_records($connect)
{
	$statement = $connect->prepare("SELECT * FROM medicine");
	$statement->execute();
	return $statement->rowCount();
}

$output = array(
	"draw"    			=> 	intval($_POST["draw"]),
	"recordsTotal"  	=>  $filtered_rows,
	"recordsFiltered" 	=> 	get_total_all_records($connect),
	"data"    			=> 	$data
);	

echo json_encode($output);

?>

?>