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
        <h1 class="h3 mb-0 text-gray-800">Daily Datewised Reports</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">reports</li>
        </ol>
    </div>
    <div class="row mb-3">
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Net Total</th>
                <th scope="col">Discount</th>
                <th scope="col">Paid</th>
                <th scope="col">Due</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $sql = "SELECT DISTINCT order_date FROM invoice";
            if( $exeute = $get_r->con->query($sql)){
                while($row = $exeute->fetch_assoc()){ ?>
            <tr>
                <th scope="row"><?php echo $row['order_date']; ?></th>
                <th scope="row"><?php echo bcdiv($get_r->getReports('net_total',$row['order_date']), 1, 2); ?></th>
                <th scope="row"><?php echo bcdiv($get_r->getReports('discount',$row['order_date']), 1, 2); ?></th>
                <th scope="row"><?php echo bcdiv($get_r->getReports('paid',$row['order_date']), 1, 2); ?></th>
                <th scope="row"><?php echo bcdiv($get_r->getReports('due',$row['order_date']), 1, 2); ?></th>
            </tr>
               <?php }
            }
           
            
            
            
            ?>
           
        </tbody>
    </table>

</div>
</div>
<?php include_once('templates/footer.php') ?>