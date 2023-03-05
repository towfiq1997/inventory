<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("location:index.php");
}
include 'templates/header.php';
include 'includes/DBOperation.php';
$DBop = new DBOperation();
$q_id = $_GET['id'];
if (isset($_POST['submit'])) {

    if ($_POST["m_name"] == "" || $_POST["g_name"] == "" || $_POST["category"] == "" || $_POST["m_price"] == "" || $_POST["m_cost"] == "" || $_POST["quantity"] == "" || $_POST["block"] == "" ||  $_POST["status"] == "" || $_POST["adding_date"] == "" || $_POST["expiry_date"] == "") {
        $msg = '<div class="alert alert-danger" role="alert">
           Input All The Fields
         </div>';
    } else {
        $m_name = $_POST["m_name"];
        $g_name = $_POST["g_name"];
        $catagory = $_POST["category"];
        $quantity = $_POST["quantity"];
        $cost = $_POST["m_cost"];
        $price = $_POST["m_price"];
        $adding_date =  $DBop->dateFormatter($_POST["adding_date"]);
        $expiry_date = $DBop->dateFormatter($_POST["expiry_date"]);
        $status = $_POST["status"];
        $block = $_POST["block"];
        $alert_qty = $_POST["alert_qty"];
        $res = $DBop->updatemedicine($m_name, $g_name, $catagory, $quantity, $cost, $price, $adding_date, $expiry_date, $status, $block, $alert_qty, $q_id);
    }
}
?>
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Update</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Products</li>

        </ol>
    </div>
    <form method="POST">
        <?php if (isset($res)) {
            echo $res;
        }
        $sql = "SELECT * FROM medicine  WHERE pid ='$q_id'";
        $query = $DBop->con->query($sql);
        if ($query->num_rows > 0) :
            while ($row = $query->fetch_assoc()) : ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputEmail4">Medicine</label>
                        <input type="text" class="form-control" value="<?php echo $row['product_name']; ?>" name="m_name" id="m_name" placeholder="Enter Medicine Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputPassword4">Generic</label>
                        <input type="text" class="form-control" value="<?php echo $row['generic']; ?>" name="g_name" id="g_name" placeholder="Enter Generic Name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputEmail4">Add Category</label>
                        <select class="form-control" name="category" id="category">
                            <?php
                            $cats = $DBop->getCat4edit($q_id);
                            $cur_date = date("Y-m-d");
                            echo $cats;
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputPassword4">Price</label>
                        <input type="number" value="<?php echo $row['price']; ?>" step="any" lang="nb" class="form-control" name="m_price" id="m_price" placeholder="Enter Selling Price">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputPassword4">Cost</label>
                        <input type="number" value="<?php echo $row['cost']; ?>" step="any" lang="nb" class="form-control" name="m_cost" id="m_cost" placeholder="Enter Purchasing Cost">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputCity">Quantity</label>
                        <input type="number" class="form-control" value="<?php echo $row['stock']; ?>" name="quantity" id="quantity" placeholder="Enter Quantity">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputZip">Block</label>
                        <input type="text" class="form-control" value="<?php echo $row['block']; ?>" name="block" id="block">

                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputState">Active Status</label>
                        <select id="status" name="status" class="form-control">
                            <option selected>1</option>
                            <option>0</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="simpleDataInput">Adding Date</label>
                        <div class="input-group date">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                            <input type="text" name="adding_date" class="form-control" value="<?php echo $row['added_date']; ?>" id="adding_date">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="simpleDataInput">Expiry Date</label>
                        <div class="input-group date">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            </div>
                            <input type="text" name="expiry_date" value="<?php echo $row['expiry_date']; ?>" class="form-control" value="2022-1-2" id="expiry_date">
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="simpleDataInput">Alert Quantity</label>
                        <div class="input-group date">
                            <input type="number" name="alert_qty" class="form-control" value="<?php echo $row['alert_qty']; ?>" id="alert_qty">
                        </div>
                    </div>
                </div>
                <input type="submit" name="submit" value="Update" class="btn btn-primary mb-3">
        <?php
            endwhile;
        endif;
        ?>
    </form>
    <!--Row-->
    <!-- Modal Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                    <a href="login.html" class="btn btn-primary">Logout</a>
                </div>
            </div>
        </div>
    </div>

</div>
<!---Container Fluid-->
</div>
<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Made With Love
                </script>By
                <b><a href="https://facebook.com/towfiq1997/" target="_blank">Towfiqul Islam</a></b>
            </span>
        </div>
    </div>
</footer>
<!-- Footer -->
</div>
</div>

<!-- Scroll to top -->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/ruang-admin.min.js"></script>
<script src="vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="js/main.js"></script>
<script>
    $(document).ready(function() {
        $('#adding_date').datepicker({
            format: 'yyyy/mm/dd',
            todayBtn: 'linked',
            todayHighlight: true,
            autoclose: true,
        });
        $('#expiry_date').datepicker({
            format: 'yyyy/mm/dd',
            todayBtn: 'linked',
            todayHighlight: true,
            autoclose: true,
        });
    })
</script>
</body>

</html>