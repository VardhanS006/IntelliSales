<?php include 'header.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sales Data</title>

</head>

<body>
    <div class="content-wrapper">
        <div class="container-fluid p-3">
            <div class="card">
                <div class="card-header content-header">
                    <div class="row" style="border-bottom:2px solid black">
                        <div class="col-sm-6 col-lg-12 col-md-12">
                            <h1>All Sales</h1>
                        </div><!-- /.col -->
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Amount </th>
                                <th>Payment Mode</th>
                                <th>Payment Status</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'connection.php';
                            $sql = "select * from sale";
                            $query = mysqli_query($con, $sql);
                            while ($data = mysqli_fetch_assoc($query)) {
                                $sql2 = "select name from customer where id=".$data['customer'];
                                $query2 = mysqli_query($con, $sql2);
                                $data2=mysqli_fetch_assoc($query2);
                            ?>
                                <tr>
                                    <td><?=$data['date']?></td>
                                    <td><?=$data2['name']?></td>
                                    <td><?=$data['amount']?></td>
                                    <td><?=$data['payment_mode']?></td>
                                    <td ><span class="badge bg-warning"><?=$data['payment_status']?></span></td>
                                    <td><button class="btn btn-info" id="sale<?=$data['id']?>" onclick="Viewsale(<?=$data['id']?><?php $sl_id=$data['id']; ?>,<?=$data['customer']?>,'<?=$data['amount']?>','<?=$data['payment_mode']?>','<?=$data['payment_status']?>')">View</button></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal fade" id="confirmsale" tabindex="-1" aria-labelledby="Confirm Sale" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="orderdetails">Cart Checkout</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="confirmsale.php" method="post" id="saleform" enctype="multipart/form-data">
                                
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php include "footer.php"; ?>

    <script>
        function Viewsale(s_id,cst,amnt,pmode,pstatus) {
            
            var custr = cst;
            var t_id=s_id;
            var ctotal=amnt;
            var pmode=pmode;
            var pstatus=pstatus;

            $.ajax({
                type: 'post',
                url: 'viewsale.php',
                data: {cust:custr,t_id:t_id,ctotal:ctotal,pmode:pmode,pstatus:pstatus},
                success: function(data) {
                    
                    $('#saleform').html(data);
                    $('#orderdetails').html('Order Details');
                }
            });

            $('#confirmsale').modal('show');
        }
    </script>
</body>

</html>