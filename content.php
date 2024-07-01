<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user-friends"></i></span>

            <div class="info-box-content">
              <div class="container" id="customer-container">
              <span class="info-box-text">Customers:</span>
                <?php
                include "connection.php";
                $sql = "SELECT COUNT(*) as customer_count FROM customer";
                $query2 = mysqli_query($con, $sql);
                $data2 = mysqli_fetch_assoc($query2);
                if (mysqli_num_rows($query2) >= 1) {
                  $Ccount = $data2["customer_count"];
                  echo  $Ccount ;
                } else {
                  echo "No customers found.";
                }
                ?>
              </div>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-handshake"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Supplier:</span>
              <?php
                include "connection.php";
                $sql = "SELECT COUNT(*) as sale_count FROM supplier";
                $query2 = mysqli_query($con, $sql);
                $data2 = mysqli_fetch_assoc($query2);
                if (mysqli_num_rows($query2) >= 1) {
                  $Bcount = $data2["sale_count"];
                  echo $Bcount;
                } else {
                  echo "No Supplier found.";
                }
                ?>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <!-- <div class="clearfix hidden-md-up"></div> -->

        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales</span>
              <?php
                include "connection.php";
                $sql = "SELECT COUNT(*) as sale_count FROM sale";
                $query2 = mysqli_query($con, $sql);
                $data2 = mysqli_fetch_assoc($query2);
                if (mysqli_num_rows($query2) >= 1) {
                  $Scount = $data2["sale_count"];
                  echo $Scount;
                } else {
                  echo "No Sales found.";
                }
                ?>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Purchases:</span>
              <?php
                include "connection.php";
                $sql = "SELECT COUNT(*) as pur_count FROM purchase";
                $query2 = mysqli_query($con, $sql);
                $data2 = mysqli_fetch_assoc($query2);
                if (mysqli_num_rows($query2) >= 1) {
                  $Scount = $data2["pur_count"];
                  echo $Scount;
                } else {
                  echo "No Purchase found.";
                }
                ?>
            </div>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <div class="row mt-5">
        <div class="col-lg-4 mx-auto">
          <img src="superkart_assets/IS LOGO.png">
        </div>
      </div>
      
    </div><!--/. container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->