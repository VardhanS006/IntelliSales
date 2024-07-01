<?php include 'header.php';?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Product Data</title>
</head>

<body>

    <div class="content-wrapper">
        <div class="container-fluid p-3">
            <div class="card">
                <div class="card-header content-header">
                    <div class="row" style="border-bottom:2px solid black">
                        <div class="col-sm-6 col-lg-12 col-md-12">
                            <h1>Add New Product</h1>
                        </div><!-- /.col -->
                    </div>
                </div>

                <div class="card-body">
                    <form action="add_product.php" method="post" class="p-3 rounded rounded-lg" enctype="multipart/form-data">
                        
                        <div class="row">
                            <div class="form-group col-lg-3 col-md-3 col-sm-12">
                                <label>Name</label>
                                <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name" id="catname" onfocusout="Checkname(this)" required>
                                <span id="error_msg" class="text-danger"></span>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12">
                                <label>Select Category</label>
                                <select name="cat" id="cat" class="form-control"onchange="checkcat(this)" required>
                                    <option value="">Choose Category</option>
                                <?= SelectCat()?>
                                </select>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12">
                                <label>Select Sub-Category</label>
                                <select name="subcat" id="sub_cat" class="form-control"onchange="checkcat(this)" required>
                                    <option value="">Choose Sub-Category</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-2 col-md-2 col-sm-10">
                                <label>Select Brand</label>
                                <select name="brnd" id="brnd" class="form-control" required>
                                    <option value="">Choose Brand</option>
                                </select>
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-2 pl-0 mt-4">    
                                <button class="btn btn-danger col-12 mt-2" onclick="addbrand()">+Brand</button>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="form-group col-lg-3 col-md-3 col-sm-12">
                                <label>MRP</label>
                                <input type="number" class="form-control" name="cprice" placeholder="Enter Product MRP" id="cprice"onchange="dis()" required>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12">
                                <label>Discount Price</label>
                                <input type="number" class="form-control" name="dprice" placeholder="Enter Product Discount" id="dprice"onchange="dis()" required>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12">
                                <label>Product Discount (%)</label>
                                <input type="number" class="form-control" name="disc" id="disc" required readonly>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12">
                                <label>Selling Price</label>
                                <input type="number" class="form-control" name="sprice" id="sprice" required readonly>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="form-group col-lg-3 col-md-3 col-sm-12">
                                <label>Manufacturing Date</label>
                                <input type="date" class="form-control" name="mandate" required>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12">
                                <label>Stock</label>
                                <input type="number" class="form-control" placeholder="Enter Current Stock" name="stck" required>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12">
                                <label>Stock Alert Quantity</label>
                                <input type="number" class="form-control" name="stckalert" placeholder="Enter Quantity for Stock Alert" required>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12">
                                <label>Expiry Date</label>
                                <input type="date" class="form-control" name="expdate" required>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="form-group col-lg-3 col-md-3 col-sm-12">
                                <label>Select Warehouse</label>
                                <select name="wareh" id="wareh" class="form-control" required>
                                    <option value="">Choose Warehouse</option>
                                    <?=selectware()?>
                                </select>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12">
                                <label>Image</label>
                                <input type="file" class="form-control" name="file" required>
                            </div>
                            <div class="form-group col-lg-3 col-md-3 col-sm-12">
                                <label>Product Code</label>
                                <input type="number" class="form-control" name="product_code" required>
                            </div>
                        </div>


                        <button class="btn btn-outline-success form-control mt-2" type="submit" name="add_p" id="submit">Add Product</button>
                    </form>
                </div>
            </div>    
        </div>
    </div>
    <div class="modal" tabindex="-1" id="addbrandmodal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Brand</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="addbrand.php" method="post" class="row" enctype="multipart/form-data">
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label>Select Category</label>
                            <select id="cat_add" class="form-control" name = "cat" onchange="checkcat(this)" required>
                                <option value="">Choose Category</option>
                            <?= SelectCat()?>
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label>Select Sub-Category</label>
                            <select id="subcat_add" class="form-control" name = "subcat_add" required>
                                <option value="">Choose Sub-Category</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label>Name</label>
                            <input type="text" class="form-control" id="brndadd" name="name" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label>Image</label>
                            <input type="file" class="form-control" name="fileadd" required>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success" name="addbnd">Add Brand</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
         function Checkname(category_name) {
            var nam = category_name.value;

            if (nam == null) {
                nam = category_name;
            }

            if (nam != "") {
                $.ajax({
                    type: 'post',
                    url: 'Duplicate_verify.php',
                    data: {product: nam},
                    success: function(data) {
                        if (data == 1) {
                            $('#submit').attr('disabled', 'disabled');
                            $('#error_msg').text('Already exist');
                            $('#error_msg').removeClass('text-success').addClass('text-danger');
                            $('#catname').removeClass('is-valid').addClass('is-invalid');
                        } else {
                            $('#submit').removeAttr('disabled');
                            $('#error_msg').text('Valid Name');
                            $('#error_msg').removeClass('text-danger').addClass('text-success');
                            $('#catname').removeClass('is-invalid').addClass('is-valid');
                        }
                    }
                });
            }
        }
    </script>
    <?php include 'footer.php'; ?>
    
    <script type="text/javascript">
        function dis(){
            var cprice = $("#cprice").val();
            var dprice = $("#dprice").val();
            var disc = ((dprice*100)/cprice);
            $("#disc").val(disc);
            $("#sprice").val(cprice-dprice);
        }
    </script>

    <script>
        function checkcat(cat) {
            var cate = cat.value;
            if(cate==null){
                cate=cat;
            }
            if(cat.name=="cat"){
                if (cate != ""){
                    $.ajax({
                        type:'post',
                        url:'subcatfetch.php',
                        data:{cate:cate},
                        success:function(data){
                            if(cat.id=='cat')
                            {
                                $('#sub_cat').html(data);
                                $('#brnd').html('<option value="">Choose Brand</option>');
                            }
                            else
                            {
                                $('#subcat_add').html(data);
                                // $('#subcat_add').val(vall);
                            }
                        }
                    });
                }
                else{
                    if(cat.id=='cat')
                    {
                        $('#sub_cat').html('<option value="">Choose Sub-Category</option>');
                        $('#brnd').html('<option value="">Choose Brand</option>');
                    }
                    else
                    {
                        $('#subcat_add').html('<option value="">Choose Sub-Category</option>');
                    }
                }   
            }
            else if(cat.name=="subcat"){
                if (cate != ""){
                    $.ajax({
                        type:'post',
                        url:'subcatfetch.php',
                        data:{subcate:cate},
                        success:function(data){
                            $('#brnd').html(data);
                        }
                    });
                }
                else{
                    $('#brnd').html('<option value="">Choose Brand</option>');
                }   
            }
        }
    </script>

    <script>
        function addbrand(p_id) {
            $('#addbrandmodal').modal('show');
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
</body>

</html>