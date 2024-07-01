<?php include 'header.php';?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products Manager</title>
    <style>
        img {
            height: 50px;
            width: 50px;
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
                            <h1>Product Details</h1>
                        </div><!-- /.col -->
                    </div>
                </div>

                <div class="card-body" >
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Category</th>
                                <th>Sub Category</th>
                                <th>Brand</th>
                                <th>Product Name</th>
                                <th>MRP</th>
                                <th>Selling Price</th>
                                <th>Manufacturing Date</th>
                                <th>Warehouse</th>
                                <th>Stock</th>
                                <th>Expiry Date</th>
                                <th>Image</th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'connection.php';
                            $var = 1;
                            $sql = "select * from product where status != 'disabled'";
                            $query = mysqli_query($con, $sql);
                            while ($data = mysqli_fetch_assoc($query)) {
                                $sql1 = "select * from category where id = '".$data['category']."'";
                                $query1 = mysqli_query($con, $sql1);
                                $cat = mysqli_fetch_assoc($query1);

                                $sql2 = "select * from category where id = '".$data['sub_category']."'";
                                $query2 = mysqli_query($con, $sql2);
                                $subcat = mysqli_fetch_assoc($query2);

                                $sql3 = "select * from warehouse where id = '".$data['warehouse']."'";
                                $query3 = mysqli_query($con, $sql3);
                                $ware = mysqli_fetch_assoc($query3);

                                $sql4 = "select * from brand where id = '".$data['brand']."'";
                                $query4 = mysqli_query($con, $sql4);
                                $brand = mysqli_fetch_assoc($query4);
                            ?>
                                <tr>
                                    <td><?= $var ?></td>
                                    
                                    <td class="cat" id="<?= $cat['id'] ?>"><?= $cat['name'] ?></td>
                                    <td class="subcat" id="<?= $subcat['id'] ?>"><?= $subcat['name'] ?></td>
                                    <td class="tbbrand" id="<?= $brand['id'] ?>"><?= $brand['name'] ?></td>
                                    <td class="name"><?= $data['name'] ?></td>
                                    <td class="cost"><?= $data['cost_price'] ?></td>
                                    <td class="sprice"><?= $data['selling_price'] ?></td>
                                    <td class="mand"><?= $data['manufacturing'] ?></td>
                                    <td class="whouse" id="<?= $ware['id'] ?>"><?= $ware['name'] ?></td>
                                    <td class="sto"><?= $data['stock'] ?></td>
                                    <td class="exp"><?= $data['expiry'] ?></td>
                                    <td><img src="product_images/<?= $data['image'] ?>"></td>
                                    <td>
                                            <button id="product_delete_<?= $data['product_id'] ?>" class="btn text-success" onclick="ProductUpdate('<?= $data['product_id'] ?>')"><i class="fa fa-edit"></i></button>
                                            <a class="btn text-danger"name="delete" onclick="delcat('<?= base64_encode($data['product_id']) ?>')"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php
                            $var++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="productUpdateModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Product</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="update_product.php" method="post" class="row" enctype="multipart/form-data">
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label for="">Category</label>
                            <select id="cat_updt" class="form-control" name = "cat"onchange="checkcat(this)">
                                <option value="">Choose Category</option>
                            <?= SelectCat()?>
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label for="">Sub Category</label>
                            <select id="subcat_updt" class="form-control" name = "subcat"onchange="checkcat(this)">
                                <option value="">Choose Sub-Category</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label>Brand</label>
                            <select name="brnd" id="brnd_updt" class="form-control">
                                <option value="">Choose Brand</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <input type="hidden" name="product_id">
                            <label for="">Product Name</label>
                            <input type="text" class="form-control" id="product_name_updt" name="name">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label for="">MRP</label>
                            <input type="number" class="form-control" id="product_cst_updt" name="cost"onchange="dis()">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label for="">Discount_Price</label>
                            <input type="number" class="form-control" id="product_disc_updt" name="disc"onchange="dis()">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label for="">Selling Price</label>
                            <input type="number" class="form-control" id="product_sp_updt" name="sp" readonly>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label for="">Manufacturing Date</label>
                            <input type="date" class="form-control" id="product_mfd_updt" name="mfd">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                        <label for="">Select Warehouse</label>
                        <select name="whouse" id="product_wh_updt" class="form-control" required>
                            <option value="">Choose Warehouse</option>
                            <?=selectware()?>
                        </select>
                    </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label for="">Stock</label>
                            <input type="number" class="form-control" id="product_sto_updt" name="sto">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label for="">Expiry Date</label>
                            <input type="date" class="form-control" id="expdt_updt" name="exp">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label for="">Image</label>
                            <input type="file" class="form-control" name="file">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        function ProductUpdate(p_id) {
            var name = $('#product_delete_' + p_id).closest('tr').find('.name').text();
            var cst = $('#product_delete_' + p_id).closest('tr').find('.cost').text();
            var disc = $('#product_delete_' + p_id).closest('tr').find('.dscnt').text();
            var cat = $('#product_delete_' + p_id).closest('tr').find('.cat').attr('id');
            var stoc = $('#product_delete_' + p_id).closest('tr').find('.sto').text();
            var mfdd = $('#product_delete_' + p_id).closest('tr').find('.mand').text();
            var exp = $('#product_delete_' + p_id).closest('tr').find('.exp').text();
            var spricee = $('#product_delete_' + p_id).closest('tr').find('.sprice').text();
            var subcat = $('#product_delete_' + p_id).closest('tr').find('.subcat').attr('id');
            var whousee = $('#product_delete_' + p_id).closest('tr').find('.whouse').attr('id');
            var brnd = $('#product_delete_' + p_id).closest('tr').find('.tbbrand').attr('id');
            $('#product_name_updt').val(name);
            $('#cat_updt').val(cat);
            
            checkcat(cat,subcat,"cat");
            checkcat(subcat,brnd,"subcat");
            $('#product_sto_updt').val(stoc);
            $('#product_cst_updt').val(cst);
            $('#product_sp_updt').val(spricee);
            $('#product_mfd_updt').val(mfdd);
            $('#product_wh_updt').val(whousee);
            $('#expdt_updt').val(exp);
            $('#product_disc_updt').val(disc);
            $('input[name="product_id"]').val(p_id);
            $('#productUpdateModal').modal('show');
        }
        
        function delcat(id){
            
            $.confirm({
                title: 'Delete!',
                content: 'Are you sure you want to delete this item?',
                buttons: {
                    delete: function () {
                        window.location.href="delete_product.php?delete="+id;
                    },
                    cancel: function () {
                        
                    }
                    
                }
            });
    
            
        }
    </script>

    <script type="text/javascript">
        function dis(){
            var cprice = $("#product_cst_updt").val();
            var dprice = $("#product_disc_updt").val();
            var disc = ((dprice*100)/cprice);
            $("#product_sp_updt").val(cprice-dprice);
        }
    </script>

    <script>
        function checkcat(cat,vall,nam) {
            var cate = cat.value;
            
            if(cate==null){
                cate=cat;
            }
            if(cat.name=="cat"||nam=="cat"){
                if (cate != ""){
                    $.ajax({
                        type:'post',
                        url:'subcatfetch.php',
                        data:{cate:cate},
                        success:function(data){
                            if(cat.name=="cat"){
                                $('#subcat_updt').html(data);
                            }
                            else{
                                $('#subcat_updt').html(data);
                                $('#subcat_updt').val(vall);
                            }
                        }
                    });
                }
                else{
                    $('#subcat_updt').html('<option value="">Choose Sub-Category</option>');
                }
                $('#brnd_updt').html('<option value="">Choose Brand</option>');
            }
            else if(cat.name=="subcat"||nam=="subcat"){
                if (cate != ""){
                    $.ajax({
                        type:'post',
                        url:'subcatfetch.php',
                        data:{subcate:cate},
                        success:function(data){
                            if(cat.name=="subcat"){
                                $('#brnd_updt').html(data);
                            }
                            else{
                                $('#brnd_updt').html(data);
                                $('#brnd_updt').val(vall);
                            }
                        }
                    });
                }
                else{
                    $('#brnd_updt').html('<option value="">Choose Brand</option>');
                }   
            }
        }
    </script>
    <?php
        function SelectCat()
        {
            include 'connection.php';
            $sql = "select * from category where parent_id = 0";
            $query = mysqli_query($con, $sql);
            $sub_cate = '';
            while ($data = mysqli_fetch_assoc($query)) {
                $sub_cate .= "<option value='" . $data['id'] . "'>" . $data['name'] . "</option>";
            }
            echo $sub_cate;
        }
        function SelectSubCat()
        {
            include 'connection.php';
            $sql = "select * from category where parent_id != 0";
            $query = mysqli_query($con, $sql);
            $sub_cate = '';
            while ($data = mysqli_fetch_assoc($query)) {
                $sub_cate .= "<option value='" . $data['id'] . "'>" . $data['name'] . "</option>";
            }
            echo $sub_cate;   
        }
        function selectware()
        {
            
            include 'connection.php';
            $sql = "select * from warehouse";
            $query = mysqli_query($con, $sql);
            $sub_cate = '';
            while ($data = mysqli_fetch_assoc($query)) {
                $sub_cate .= "<option value='" . $data['id'] . "'>" . $data['name'] . "</option>";
            }
            echo $sub_cate;
        }
    ?>
    <?php include"footer.php" ?>
</body>
</html>