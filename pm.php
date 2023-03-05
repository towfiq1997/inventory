<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("location:index.php");
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="img/logo/logo3.png" rel="icon">
    <title>Shebabari - DataTables</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/shebabari.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon">
                    <img src="img/logo/logo3.png">
                </div>
                <div class="sidebar-brand-text mx-3">ShebaBari</div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#products" aria-expanded="true" aria-controls="collapseBootstrap">
                    <i class="fas fa-capsules"></i>
                    <span>Products</span>
                </a>
                <div id="products" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Products</h6>
                        <a class="collapse-item" href="add_product.php">Add Products</a>
                        <a class="collapse-item" href="product_manage.php">Manage Products</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sale" aria-expanded="true" aria-controls="collapseForm">
                    <i class="fab fa-product-hunt"></i>
                    <span>Sale</span>
                </a>
                <div id="sale" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Sale</h6>
                        <a class="collapse-item" href="add_order.php">Add Sale</a>
                        <a class="collapse-item" href="full_invoice.php">Full Invoice</a>
                        <a class="collapse-item" href="single_invoice.php">Single Invoice</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#expense" aria-expanded="true" aria-controls="collapseTable">
                    <i class="fas fa-dollar-sign"></i>
                    <span>Expense</span>
                </a>
                <div id="expense" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Expense</h6>
                        <a class="collapse-item" href="add_expense.php">Add Expense</a>
                        <a class="collapse-item" href="view_expense.php">View Expensew</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#summery" aria-expanded="true" aria-controls="collapseTable">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>Summery</span>
                </a>
                <div id="summery" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Summery</h6>
                        <a class="collapse-item" href="summery.php">Summery</a>
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#reports" aria-expanded="true" aria-controls="collapseTable">
                    <i class="fas fa-file-invoice-dollar"></i>
                    <span>Reports</span>
                </a>
                <div id="reports" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Reports</h6>
                        <a class="collapse-item" href="daily_r.php">Daily Reports</a>
                        <a class="collapse-item" href="monthly_r.php">Monthly Reports</a>
                    </div>
                </div>
            </li>
        </ul>
        <!-- Sidebar -->
        <?php
        include_once('includes/helper.php');
        $helper = new helper();
        ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-1 small" placeholder="What do you want to look for?" aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link" href="product_alert.php" id="alertsDropdown" role="button">
                                <i class="fas fa-bell fa-fw"></i>
                                <span class="badge badge-danger badge-counter"><?php echo $helper->getstockCount(); ?></span>
                            </a>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link" href="expired_product.php" role="button">
                                <i class="fas fa-exclamation-triangle"></i>
                                <span class="badge badge-warning badge-counter"><?php echo $helper->getexpkCount(); ?></span>
                            </a>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                                <span class="ml-2 d-none d-lg-inline text-white small">Sheba Bari</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="logout.php">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Topbar -->
                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Medicine</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="./">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Medicine</li>
                        </ol>
                    </div>

                    <!-- Row -->
                    <div class="row">
                        <!-- Datatables -->
                        <div class="col-lg-12">
                            <div class="card mb-4">
                                <div class="table-responsive p-3">
                                    <table id="example" class="display table align-items-center table-flush" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Pid</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Cost</th>
                                                <th>Price</th>
                                                <th>Stock</th>
                                                <th>Expiry_D</th>
                                                <th>Status</th>
                                                <th>Block</th>
                                                <th>Alert</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Pid</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Cost</th>
                                                <th>Price</th>
                                                <th>Stock</th>
                                                <th>Expiry_D</th>
                                                <th>Status</th>
                                                <th>Block</th>
                                                <th>Alert</th>
                                                <th>Edit</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <!--create modal dialog for display detail info for edit on button cell click-->
                                    <div class="modal fade" id="myModal" role="dialog">
                                        <div class="modal-dialog">
                                            <div id="content-data"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- DataTable with Hover -->
                    </div>
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
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            var dataTable = $('#example').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url: "includes/testfetch.php",
                    type: "post"
                },
                "pageLength": 10
            });
        });
    </script>
    <!--script js for get edit data-->
    <script>
        $(document).on('click', '#getEdit', function(e) {
            e.preventDefault();
            var per_id = $(this).data('id');
            //alert(per_id);
            $('#content-data').html('');
            $.ajax({
                url: 'includes/editdata.php',
                type: 'POST',
                data: 'id=' + per_id,
                dataType: 'html'
            }).done(function(data) {
                $('#content-data').html('');
                $('#content-data').html(data);
            }).fial(function() {
                $('#content-data').html('<p>Error</p>');
            });
        });
    </script>
</body>

</html>