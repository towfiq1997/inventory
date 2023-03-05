<?php

/**
 * 
 */
class DBOperation
{

	public $con;


	function __construct()
	{
		include_once("db.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function getConnected()
	{
		return $this->con;
	}

	public function addCategory($cat)
	{
		$pre_stmt = $this->con->prepare("INSERT INTO `categories`(`cat_name`)
		 VALUES (?)");
		$pre_stmt->bind_param("s", $cat);
		$result = $pre_stmt->execute() or die($this->con->error);
		if ($result) {
			return "CATEGORY_ADDED";
		} else {
			return 0;
		}
	}
	public function getCat()
	{
		$pre_stmt = $this->con->prepare("SELECT * FROM `categories`");
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$cat = [];
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$cat_id = $row['cat_id'];
				$cat_name = $row['cat_name'];
				$cat[] = "<option value='" . $cat_id . "'>" . $cat_name . "</option>";
			}
			return $cat;
		}
	}
	public function addProduct($m_name, $g_name, $catagory, $quantity, $cost, $price, $adding_date, $expiry_date, $status, $block, $alert_qty)
	{
		$pre_stmt = $this->con->prepare("INSERT INTO `medicine`(`product_name`,`generic`,`cat_id`,`stock`,`cost`,`price`,`added_date`,`expiry_date`,`status`,`block`,`alert_qty`)
		 VALUES (?,?,?,?,?,?,?,?,?,?,?)");
		$pre_stmt->bind_param("ssiissssisi", $m_name, $g_name, $catagory, $quantity, $cost, $price, $adding_date, $expiry_date, $status, $block, $alert_qty);
		$result = $pre_stmt->execute() or die($this->con->error);
		if ($result) {
			return true;
		} else {
			return false;
		}
	}
	public function dateFormatter($date)
	{
		$formatter = str_replace('/', '-', $date);
		return date('Y-m-d', strtotime($formatter));
	}
	public function getP()
	{
		$pre_stmt = $this->con->prepare("SELECT * FROM `medicine`");
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) { ?>
				<tr>
					<td><?php echo $row['product_name']; ?></td>
					<td><?php echo $row['cost']; ?></td>
					<td><?php echo $row['price']; ?></td>
				</tr>
<?php }
		}
	}


	public function updatemedicine($m_name, $g_name, $catagory, $quantity, $cost, $price, $adding_date, $expiry_date, $status, $block, $alert_qty, $q_id)
	{
		$updatequery = "UPDATE medicine SET product_name='$m_name',generic='$g_name',cat_id='$catagory',stock='$quantity',cost='$cost',price='$price',added_date='$adding_date',expiry_date='$expiry_date',status='$status',block='$block',alert_qty='$alert_qty' WHERE pid='$q_id'";
		$m_up = $this->con->query($updatequery);
		if ($m_up) {
			$msg = '<div class="alert alert-success" role="alert">
			Data has been updated
		 </div>';
			return $msg;
		} else {
			$msg = '<div class="alert alert-danger" role="alert">
            Some Error Happened
		 </div>';
			return $msg;
		}
	}
	public function getAllRecord($table)
	{
		$pre_stmt = $this->con->prepare("SELECT * FROM  $table ORDER BY product_name");
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$rows[] = $row;
			}
			return $rows;
		}
		return "NO_DATA";
	}
	public function getAllRecord2()
	{

		$query = "SELECT * FROM medicine ORDER BY product_name";
		$result = $this->con->query($query);
		$output = '';
		while ($row = $result->fetch_assoc()) {
			$output .= '<option value="' . $row["pid"] . '">' . $row["product_name"] . '</option>';
		}
		return $output;
	}
	public function getSingleRecord($table, $pk, $id)
	{
		$pre_stmt = $this->con->prepare("SELECT * FROM " . $table . " WHERE " . $pk . "= ? LIMIT 1");
		$pre_stmt->bind_param("i", $id);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows == 1) {
			$row = $result->fetch_assoc();
		}
		return $row;
	}
	public function storeCustomerOrderInvoice($orderdate, $cust_name, $ar_tqty, $ar_qty, $ar_price, $ar_pro_name, $sub_total, $discount, $net_total, $paid, $due)
	{
		$pre_stmt = $this->con->prepare("INSERT INTO 
			`invoice`(`customer_name`,`order_date`,`sub_total`,`discount`,`net_total`,`paid`,`due`) VALUES (?,?,?,?,?,?,?)");
		$pre_stmt->bind_param("ssddddd", $cust_name, $orderdate, $sub_total, $discount, $net_total, $paid, $due);
		$pre_stmt->execute() or die($this->con->error);
		$invoice_no = $pre_stmt->insert_id;
		if ($invoice_no != null) {
			for ($i = 0; $i < count($ar_price); $i++) {

				//Here we are finding the remaing quantity after giving customer
				$rem_qty = $ar_tqty[$i] - $ar_qty[$i];
				if ($rem_qty < 0) {
					return "ORDER_FAIL_TO_COMPLETE";
				} else {
					//Update Product stock
					$sql = "UPDATE medicine SET stock = '$rem_qty' WHERE product_name = '" . $ar_pro_name[$i] . "'";
					$this->con->query($sql);
				}


				$insert_product = $this->con->prepare("INSERT INTO `invoice_details`(`invoice_no`, `product_name`, `price`, `qty`)
				 VALUES (?,?,?,?)");
				$insert_product->bind_param("isdd", $invoice_no, $ar_pro_name[$i], $ar_price[$i], $ar_qty[$i]);
				$insert_product->execute() or die($this->con->error);
			}

			return $invoice_no;
		}
	}
	public function revenue()
	{
		$cost = 0;
		$sql = "SELECT product_name,qty FROM invoice_details";
		if ($result = $this->con->query($sql)) {
			while ($row = $result->fetch_assoc()) {
				$pr_name = $row['product_name'];
				$sql2 = "SELECT cost FROM medicine WHERE product_name='$pr_name'";
				$q2 = $this->con->query($sql2);
				$row2 = $q2->fetch_assoc();
				$cost += $row2['cost'] * $row['qty'];
			}
			echo $cost;
		}
	}
	public function getstockCount()
	{
		$sql = "SELECT * FROM medicine WHERE alert_qty > stock";
		if ($result = $this->con->query($sql)) {
			$rowcount = $result->num_rows;
		}
		return $rowcount;
	}
}
