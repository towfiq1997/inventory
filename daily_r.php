<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("location:index.php");
}
include_once('templates/header.php');
include_once('includes/helper.php');
$get_r = new helper();
?>
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Current Reports</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">reports</li>
        </ol>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <p class="text-center">
                <?php $cur_date = date('Y-m-d');
                      echo $cur_date;
                ?>
            </p>
        </div>
    </div>
    <div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Net Total</th>
                <th scope="col">Discount</th>
                <th scope="col">Paid</th>
                <th scope="col">Due</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row"><?php 
                $tt = $get_r->getReports('net_total',$cur_date);
                echo bcdiv($tt, 1, 2);  ?></th>
                <th scope="row"><?php echo $get_r->getReports('discount',$cur_date); ?></th>
                <th scope="row"><?php echo bcdiv($get_r->getReports('paid',$cur_date), 1, 2) ?></th>
                <th scope="row"><?php echo $get_r->getReports('due',$cur_date); ?></th>
            </tr>
    
        </tbody>
    </table>
</div>
</div>
</div>
<?php include_once('templates/footer.php') ?>