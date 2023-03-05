<?php
session_start();
if (!isset($_SESSION['name_m'])) {
    header("location:index.php");
}
include_once('templates/header.php'); ?>
<div class="container-fluid" id="container-wrapper">
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card" style="box-shadow:0 0 25px 0 lightgrey;">
                <div class="card-header">
                    <h4>Order</h4>
                </div>
                <div class="card-body">
                    <form id="get_order_data" onsubmit="return false">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" align="right">Order Date</label>
                            <div class="col-sm-6">
                                <input type="text" id="order_date" name="order_date" readonly class="form-control form-control-sm" value="<?php echo date("Y-m-d"); ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label" align="right">Customer Name*</label>
                            <div class="col-sm-6">
                                <input type="text" id="cust_name" value="Walking Customer" name="cust_name" class="form-control form-control-sm" placeholder="Enter Customer Name" required />
                            </div>
                        </div>


                        <div class="card" style="box-shadow:0 0 15px 0 lightgrey;">
                            <div class="card-body">
                                <h3>Add Medicine</h3>
                                <table align="center" style="width:100%;">
                                    <thead>
                                        <tr>
                                            <th>*</th>
                                            <th style="text-align:center;">Item Name</th>
                                            <th style="text-align:center;">Total Quantity</th>
                                            <th style="text-align:center;">Quantity</th>
                                            <th style="text-align:center;">Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="invoice_item">
                                        <!--<tr>
		    <td><b id="number">1</b></td>
		    <td>
		        <select name="pid[]" class="form-control form-control-sm" required>
		            <option>Washing Machine</option>
		        </select>
		    </td>
		    <td><input name="tqty[]" readonly type="text" class="form-control form-control-sm"></td>   
		    <td><input name="qty[]" type="text" class="form-control form-control-sm" required></td>
		    <td><input name="price[]" type="text" class="form-control form-control-sm" readonly></td>
		    <td>Tk.1540</td>
		</tr>-->
                                    </tbody>
                                </table>
                                <!--Table Ends-->
                                <center style="padding:10px;">
                                    <button id="add" style="width:100px;" class="btn btn-primary"><i class="fas fa-plus"></i></button>
                                    <button id="remove" style="width:100px;" class="btn btn-danger"><i class="fas fa-minus"></i></button>
                                </center>
                            </div>
                            <!--Crad Body Ends-->
                        </div> <!-- Order List Crad Ends-->

                        <p></p>
                        <div class="form-group row">
                            <label for="sub_total" class="col-sm-3 col-form-label" align="right">Sub Total</label>
                            <div class="col-sm-6">
                                <input type="text" readonly name="sub_total" class="form-control form-control-sm" id="sub_total" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="discount" class="col-sm-3 col-form-label" align="right">Discount</label>
                            <div class="col-sm-6">
                                <input type="text" name="discount" class="form-control form-control-sm" id="discount" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="net_total" class="col-sm-3 col-form-label" align="right">Net Total</label>
                            <div class="col-sm-6">
                                <input type="text" readonly name="net_total" class="form-control form-control-sm" id="net_total" required />
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="paid" class="col-sm-3 col-form-label" align="right">Paid</label>
                            <div class="col-sm-6">
                                <input type="text" name="paid" class="form-control form-control-sm" id="paid" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="due" class="col-sm-3 col-form-label" align="right">Due</label>
                            <div class="col-sm-6">
                                <input type="text" name="due" class="form-control form-control-sm" id="due" />
                            </div>
                        </div>
                        <center>
                            <input type="submit" id="order_form" style="width:150px;" class="btn btn-primary" value="Order">
                            <input type="submit" id="print_invoice" style="width:150px;" class="btn btn-success d-none" value="Print Invoice">
                        </center>
                    </form>

                </div>
            </div>
        </div>
    </div>
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
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/order.js"></script>
</body>

</html>