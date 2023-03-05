<?php
session_start();
if (!isset($_SESSION['name_m'])) {
    header("location:index.php");
}
include_once('templates/header.php');
include_once("includes/DBOperation.php");
$obj = new DBOperation();
$rows = $obj->getAllRecord2();
?>
<script src="vendor/jquery/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<div class="container-fluid" id="container-wrapper">
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card" style="box-shadow:0 0 25px 0 lightgrey;">
                <div class="card-header">
                    <h4>Order</h4>
                </div>
                <div class="card-body">
                    <form id="get_order_data" onsubmit="return false" class>
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
                                            <th style="text-align:center;">Serial Number</th>
                                            <th style="text-align:center;">Item Name</th>
                                            <th style="text-align:center;">Total Quantity</th>
                                            <th style="text-align:center;">Quantity</th>
                                            <th style="text-align:center;">Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody id="invoice_item">
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
<script>
    $(document).ready(function() {
        addNewRow();

        $("#add").click(function() {
            addNewRow();
        });

        function addNewRow() {
            var data = " ";
            data += '<tr>';
            data += '<td><b class="number">1</b></td>';
            data += '<td>';
            data += '<select class="form-control form-control-sm selectpicker pid" data-live-search="true" required>';
            data += '<option value="">Choose Product</option>';
            data += '<?php echo $rows; ?>';
            data += '</select>';
            data += '</>';
            data += '<td><input name="tqty[]" readonly type="text" class="form-control form-control-sm tqty"></td>';
            data += '<td><input name="qty[]" type="text" class="form-control form-control-sm qty" required></td>';
            data += '<td><input name="price[]" type="text" class="form-control form-control-sm price" readonly>';
            data += '</span>';
            data += '<span>';
            data += '<input name="pro_name[]" type="hidden" class="form-control form-control-sm pro_name">';
            data += '</td>';
            data += '<td>Tk.<span class="amt">0</span></td>';
            data += '</tr>';
            $("#invoice_item").append(data);
            $('.selectpicker').select2({
                placeholder: 'Chosse Medicine',
                width: "resolve"
            });
            var n = 0;
            $(".number").each(function() {
                $(this).html(++n);
            });
        }

        $("#remove").click(function() {
            $("#invoice_item").children("tr:last").remove();
            calculate(0, 0);
        });

        $("#invoice_item").delegate(".pid", "change", function() {
            var pid = $(this).val();
            var tr = $(this).parent().parent();
            $.ajax({
                url: "includes/process.php",
                method: "POST",
                dataType: "json",
                data: {
                    getPriceAndQty: 1,
                    id: pid,
                },
                success: function(data) {
                    tr.find(".tqty").val(data["stock"]);
                    tr.find(".pro_name").val(data["product_name"]);
                    tr.find(".qty").val(1);
                    tr.find(".price").val(data["price"]);
                    tr.find(".amt").html(tr.find(".qty").val() * tr.find(".price").val());
                    calculate(0, 0);
                },
            });
        });

        $("#invoice_item").delegate(".qty", "keyup", function() {
            var qty = $(this);
            var tr = $(this).parent().parent();
            if (isNaN(qty.val())) {
                alert("Please enter a valid quantity");
                qty.val(1);
            } else {
                if (qty.val() - 0 > tr.find(".tqty").val() - 0) {
                    alert("Sorry ! This much of quantity is not available");
                    aty.val(1);
                } else {
                    tr.find(".amt").html(qty.val() * tr.find(".price").val());
                    calculate(0, 0);
                }
            }
        });

        function calculate(dis, due) {
            var sub_total = 0;
            var gst = 0;
            var net_total = 0;
            var discount = dis;
            var due_amt = due;
            var paid = 0;
            $(".amt").each(function() {
                sub_total = sub_total + $(this).html() * 1;
            });

            net_total = gst + sub_total;
            net_total = net_total - discount;
            paid = net_total - due_amt;
            $("#sub_total").val(sub_total);

            $("#discount").val(discount);
            $("#net_total").val(net_total);
            //$("#paid")
            $("#paid").val(paid);
        }

        $("#discount").keyup(function() {
            var discount = $(this).val();
            calculate(discount, 0);
        });

        $("#due").keyup(function() {
            var due = $(this).val();
            var discount = $("#discount").val();
            calculate(discount, due);
        });

        /*Order Accepting*/

        $("#order_form").click(function() {
            var invoice = $("#get_order_data").serialize();
            if ($("#cust_name").val() === "") {
                alert("Plaese enter customer name");
            } else if ($("#paid").val() === "") {
                alert("Plaese eneter paid amount");
            } else {
                $.ajax({
                    url: "includes/process.php",
                    method: "POST",
                    data: $("#get_order_data").serialize(),
                    success: function(data) {
                        if (data < 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data,
                                confirmButtonText: '<a href="testorder.php" style="color:white;"><b>Try Again</b></a>',
                            })
                        } else {
                            $("#get_order_data").trigger("reset");
                            Swal.fire({
                                icon: 'success',
                                title: 'Yeeah',
                                text: 'Order Added Successfully',
                                confirmButtonText: '<a href="testorder.php" style="color:white;"><b>Add Another</b></a>',
                            })
                        }
                    },
                });
            }
        });
    });
</script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/ruang-admin.min.js"></script>

</body>

</html>