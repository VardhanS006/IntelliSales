<?php include 'header.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Brands</title>
    <style>
        img {
            height: 50px;
            width: 50px;
        }

        .aa {
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
                            <h1>Manage Brands</h1>
                        </div><!-- /.col -->
                    </div>
                </div>
                <a class="aa fa fa-tag fa fa-2x" onclick="addbrand()"></a>
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
                                    <input type="hidden" name="brand_id">
                                        <label>Name</label>
                                        <input type="text" class="form-control" id="brndadd" name="name" id="catname" onfocusout="Checkname(this)" required>
                                        <span id="error_msg" class="text-danger"></span>
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
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Brand Name</th>
                                <th>Category</th>
                                <th>Sub_category</th>
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
                        $sql = "select * from brand";
                        $query = mysqli_query($con, $sql);
                        while ($data = mysqli_fetch_assoc($query)) {
                            $sql2 = "select * from category where id = '".$data['parent_id']."'";
                            $query2 = mysqli_query($con, $sql2);
                            $subcat = mysqli_fetch_assoc($query2);

                            $sql1 = "select * from category where id = '".$subcat['parent_id']."'";
                            $query1 = mysqli_query($con, $sql1);
                            $cat = mysqli_fetch_assoc($query1);
                        ?>
                                <tr id="row_<?= $var ?>">
                                    <td><?= $var ?></td>
                                    <td class="name"><?= $data['name'] ?></td>
                                    <td class="cat" id="<?= $cat['id'] ?>"><?= $cat['name'] ?></td>
                                    <td class="subcat" id="<?= $subcat['id'] ?>"><?= $subcat['name'] ?></td>
                                    <td class="imge"><img src="brand_image/<?= $data['image'] ?>"></td>
                                
                                    <td id="rw_<?= $var ?>">
                                        <button id="category_delete_<?= $data['id'] ?>" class="btn text-success" onclick="CategoryUpdate('<?= $data['id'] ?>')"><i class="fa fa-edit"></i></button>
                                        <a class="btn text-danger" onclick="delcat('<?= base64_encode($data['id']) ?>')"><i class="fa fa-trash"></i></a>
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
    <!-- Update modal-->
    <div class="modal" tabindex="-1" id="categoryUpdateModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Brand</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="updatebrand.php" method="post" class="row" enctype="multipart/form-data">
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label>Select Category</label>
                            <select id="cat" class="form-control" name = "cat" onchange="checkcat(this)" required>
                                <option value="">Choose Category</option>
                            <?= SelectCat()?>
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label>Select Sub-Category</label>
                            <select id="subcat_updt" class="form-control" name = "subcat_add" required>
                                <option value="">Choose Sub-Category</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <input type="hidden" id="brand_id" name="brand_id">
                            <label>Name</label>
                            <input type="text" class="form-control" id="brndupdt" name="name" required>
                            <span id="error_msg2" class="text-danger"></span>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-12">
                            <label>Image</label>
                            <input type="file" class="form-control" name="file" required>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="cat_id">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>
    <script>
        function checkcat(cat,vall) {
            var cate = cat.value;
            if(cate==null){
                cate=cat;
            }
            if (cate != ""){
                $.ajax({
                    type:'post',
                    url:'subcatfetch.php',
                    data:{cate:cate},
                    success:function(data){
                        if(cat.id=='cat_add')
                        {
                            $('#subcat_add').html(data);
                        }
                        else
                        {
                            $('#subcat_updt').html(data);   
                            $('#subcat_updt').val(vall);
                        }
                    }
                });
            }
            else{
                if(cat.id!='cat_add')
                {
                    $('#subcat_updt').html('<option value="">Choose Sub-Category</option>');
                }
                else
                {
                    $('#subcat_add').html('<option value="">Choose Sub-Category</option>');
                }
            }   
        }
    
        function addbrand(brand_id) {
            $('#addbrandmodal').modal('show');
        }
        
        function delcat(id){
            
            $.confirm({
                title: 'Delete!',
                content: 'Are you sure you want to delete this item?',
                buttons: {
                    delete: function () {
                        window.location.href="deletebrand.php?delete="+id;
                    },
                    cancel: function () {
                        
                    }
                    
                }
            });
    
            
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
    
    ?>
    <script>
        function CategoryUpdate(brand_id) {
            var cat = $('#category_delete_' + brand_id).closest('tr').find('.cat').attr('id');
            var subcat = $('#category_delete_' + brand_id).closest('tr').find('.subcat').attr('id');
            checkcat(cat,subcat);
            var name = $('#category_delete_' + brand_id).closest('tr').find('.name').text();
            $('#cat').val(cat);
            $('#brndupdt').val(name);
            $('input[name="brand_id"]').val(brand_id);

            $('#categoryUpdateModal').modal('show');
        }
    </script>
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
                    data: {brand: nam},
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
    
</body>

</html>