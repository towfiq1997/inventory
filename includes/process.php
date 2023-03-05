<?php
include_once("user.php");
include_once("DBOperation.php");

if (isset($_POST["log_email"]) and isset($_POST["log_password"])) {
	$admin = new Admin();
	  $t = new mysqli("localhost","shebabar_shebabari","mysql!8Dy()","shebabar_inv");
  $username = $t->real_escape_string($_POST["log_email"]);
  $pass = $t->real_escape_string($_POST["log_password"]);
	$result = $admin->adminlogin($username,$pass);
	echo $result;
	exit();
}
if (isset($_POST["category_name"])) {
	$cat = new DBOperation();
	$result = $cat->addCategory($_POST["category_name"]);
	echo $result;
}
if (isset($_POST["getNewOrderItem"])) {
	$obj = new DBOperation();
	$rows = $obj->getAllRecord("medicine");
?>
	<tr>
		<td><b class="number">1</b></td>
		<td>
			<select name="pid[]" class="form-control form-control-sm pid" required>
				<option value="">Choose Product</option>
				<?php
				foreach ($rows as $row) {
				?><option value="<?php echo $row['pid']; ?>"><?php echo $row["product_name"]; ?></option><?php
																										}
																											?>
			</select>
		</td>
		<td><input name="tqty[]" readonly type="text" class="form-control form-control-sm tqty"></td>
		<td><input name="qty[]" type="text" class="form-control form-control-sm qty" required></td>
		<td><input name="price[]" type="text" class="form-control form-control-sm price" readonly></span>
			<span><input name="pro_name[]" type="hidden" class="form-control form-control-sm pro_name"></td>
		<td>Tk.<span class="amt">0</span></td>
	</tr>
<?php
	exit();
}
if (isset($_POST["getPriceAndQty"])) {
	$m = new DBOperation();
	$result = $m->getSingleRecord("medicine", "pid", $_POST["id"]);
	echo json_encode($result);
	exit();
}
if (isset($_POST["order_date"]) and isset($_POST["cust_name"])) {

	$orderdate = $_POST["order_date"];
	$cust_name = $_POST["cust_name"];
	$ar_tqty = $_POST["tqty"];
	$ar_qty = $_POST["qty"];
	$ar_price = $_POST["price"];
	$ar_pro_name = $_POST["pro_name"];
	$sub_total = $_POST["sub_total"];
	$discount = $_POST["discount"];
	$net_total = $_POST["net_total"];
	$paid = $_POST["paid"];
	$due = $_POST["due"];
	$m = new DBOperation();
	echo $result = $m->storeCustomerOrderInvoice($orderdate, $cust_name, $ar_tqty, $ar_qty, $ar_price, $ar_pro_name, $sub_total, $discount, $net_total, $paid, $due);
}
