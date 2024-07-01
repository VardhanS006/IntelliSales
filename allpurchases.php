<?php include 'header.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Purchase Data</title>

    <style>
        .aa{
            position: fixed;
            right: 50px;
            bottom: 50px;
            
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        <div class="container-fluid p-3">
            <div class="card">
                <div class="card-header content-header">
                    <div class="row" style="border-bottom:2px solid black">
                        <div class="col-sm-6 col-lg-12 col-md-12">
                            <h1>Purchases</h1>
                        </div><!-- /.col -->
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>Purchase No.</th>
                                <th>Date</th>
                                <th>Supplier</th>
                                <th>Warehouse</th>
                                <th>Purchase Amount</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'connection.php';
                            $sql = "select * from purchase";
                            $query = mysqli_query($con, $sql);
                            
                            while ($data = mysqli_fetch_assoc($query)) {

                                $sql1 = "select * from supplier where id = '".$data['supplier']."'";
                                $query1 = mysqli_query($con, $sql1);
                                $sup = mysqli_fetch_assoc($query1);

                                $sql2 = "select * from warehouse where id = '".$data['warehouse']."'";
                                $query2 = mysqli_query($con, $sql1);
                                $ware = mysqli_fetch_assoc($query2);
                            ?>
                                <tr>
                                    <td><?=$data['p_id']?></td>
                                    <td class="pur_date"><?=$data['date']?></td>
                                    <td><?=$sup['name']?></td>
                                    <td><?=$ware['name']?></td>
                                    <td class="pur_amnt"><?=$data['amount']?></td>
                                    <td><button class="btn btn-info" id="purchase<?=$data['p_id']?>" onclick="ViewPurchase(<?=$data['p_id']?><?php $ps_id=$data['p_id']; ?>)">View</button></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal" tabindex="-1" id="PurchaseViewModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="title1"></h5>
                            <h6 class="modal-title" id="title2"></h6>
                        </div>
                        <div class="modal-body">
                        <table class="table table-bordered mt-2">
                            <thead>
                                <tr>
                                    <th>Sl. No.</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Per Unit Cost</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody id="prchs_itms" class="text-center">
                            </tbody>
                            <tr class="text-bold text-center">
                                <td colspan="3"></td>
                                <td>Total</td>
                                <td id="totlpamnt" class="text-right"></td>
                            </tr>
                        </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
                    
            <a class="aa fa fa-cart-plus fa fa-2x" href="purchase.php"></a>
        </div>
    </div>
    
    <?php include "footer.php"; ?>

    <script>
        function ViewPurchase(p_id) {
            
            var dt = $('#purchase' + p_id).closest('tr').find('.pur_date').text();
            var amt = $('#purchase' + p_id).closest('tr').find('.pur_amnt').text();

            $('#title1').html('Purchase No :- '+p_id);
            $('#title2').html('Date:- '+dt);

            $('#totlpamnt').html(amt);
            $('#prchs_itms').html("");
            <?php
            include 'connection.php';
            $var=1;
            $sql = "select * from purchase_items where id=".$ps_id;
            $query = mysqli_query($con, $sql);
            
            while ($data = mysqli_fetch_assoc($query)) {

                $sql1 = "select * from product where product_id = '".$data['product']."'";
                $query1 = mysqli_query($con, $sql1);
                $pdt = mysqli_fetch_assoc($query1);
            ?>
            $('#prchs_itms').append('<tr><td><?=$var?></td><td><?=$pdt['name']?></td><td><?=$data['quantity']?></td><td><?=$data['cost']?></td><td class="text-right"><?=$data['total_amount']?></td></tr>');
            <?php
            $var++;
            }
            ?>
            $('#PurchaseViewModal').modal('show');
        }
    </script>
</body>

</html>