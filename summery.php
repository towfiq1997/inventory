<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("location:index.php");
}
include 'templates/header.php';
include 'includes/accounts.php';
$rev = new Accounts();

?>
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Summery and Accounts</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">summery</li>
        </ol>
    </div>
    <div class="row mb-3">
        <div class="col-md-4 text-center mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="wrapper-style">
                                <div class="icon-style text-center">
                                    <i class="fas fa-dollar-sign fa-2x text-danger"></i>
                                </div>
                                <div class="h5 mt-2 font-weight-bold text-gray-800 text-center">Total Revenue</div>
                                <div class="h5 mt-2 font-weight-bold text-gray-800 text-center"><?php echo $rev->revenue(); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="wrapper-style">
                                <div class="icon-style text-center">
                                    <i class="fab fa-product-hunt fa-2x text-success"></i>
                                </div>
                                <div class="h5 mt-2 font-weight-bold text-gray-800 text-center">Total Product</div>
                                <div class="h5 mt-2 font-weight-bold text-gray-800 text-center"><?php echo $rev->getno('medicine', 'product_name'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="wrapper-style">
                                <div class="icon-style text-center">
                                    <i class="fas fa-receipt fa-2x text-primary"></i>
                                </div>
                                <div class="h5 mt-2 font-weight-bold text-gray-800 text-center">Total Sale</div>
                                <div class="h5 mt-2 font-weight-bold text-gray-800 text-center"><?php echo $rev->getno('invoice', 'invoice_no'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="wrapper-style">
                                <div class="icon-style text-center">
                                    <i class="fab fa-product-hunt fa-2x text-success"></i>
                                </div>
                                <div class="h5 mt-2 font-weight-bold text-gray-800 text-center">Total Product</div>
                                <div class="h5 mt-2 font-weight-bold text-gray-800 text-center"><?php echo $rev->getno('medicine', 'product_name'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="wrapper-style">
                                <div class="icon-style text-center">
                                    <i class="fab fa-product-hunt fa-2x text-success"></i>
                                </div>
                                <div class="h5 mt-2 font-weight-bold text-gray-800 text-center">Total Product</div>
                                <div class="h5 mt-2 font-weight-bold text-gray-800 text-center"><?php echo $rev->getno('medicine', 'product_name'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="wrapper-style">
                                <div class="icon-style text-center">
                                    <i class="fab fa-product-hunt fa-2x text-success"></i>
                                </div>
                                <div class="h5 mt-2 font-weight-bold text-gray-800 text-center">Total Product</div>
                                <div class="h5 mt-2 font-weight-bold text-gray-800 text-center"><?php echo $rev->getno('medicine', 'product_name'); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'templates/footer.php'; ?>