<?php
session_start();
      if(!isset($_SESSION['name'])){
          header('location:index.php',true, 301 );
      }

include 'templates/header.php';
?>
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="./">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
    </ol>
  </div>

  <div class="row mb-3">
    <!-- Add Products -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <a href="add_product.php" class="wrapper-style">
                <div class="icon-style text-center">
                  <i class="fab fa-product-hunt fa-2x text-success"></i>
                </div>
                <div class="h5 mt-2 font-weight-bold text-gray-800 text-center">Add Products</div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Add Catagorie -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <a href="" class="wrapper-style" data-toggle="modal" data-target="#exampleModal">
                <div class="icon-style text-center">
                  <i class="fas fa-folder-plus fa-2x text-warning"></i>
                </div>
                <div class="h5 mt-2 font-weight-bold text-gray-800 text-center">Add Catagories</div>
              </a>
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Category</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="category_form" onsubmit="return false">
                        <div class="form-group">
                          <input type="text" class="form-control" name="category_name" id="category_name" aria-describedby="emailHelp" placeholder="Enter Category Name">
                          <small id="cat_error" class="form-text text-muted"></small>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Add Invoice -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <a href="add_order.php" class="wrapper-style">
                <div class="icon-style text-center">
                  <i class="fas fa-receipt fa-2x text-primary"></i>
                </div>
                <div class="h5 mt-2 font-weight-bold text-gray-800 text-center">Add Order</div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Add Expense -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <a href="add_expense.php" class="wrapper-style">
                <div class="icon-style text-center">
                  <i class="fas fa-dollar-sign fa-2x text-danger"></i>
                </div>
                <div class="h5 mt-2 font-weight-bold text-gray-800 text-center">Add Expenses</div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

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
<script src="js/main.js"></script>
</body>

</html>