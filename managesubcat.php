<?php include 'header.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sub-Category Manager</title>
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
                            <h1>Manage Sub-Category</h1>
                        </div><!-- /.col -->
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Name</th>
                                <th>Category</th>


                                <th>Image</th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // session_start();
                            include 'connection.php';
                            $var = 1;
                            $sql = "select * from category where parent_id != 0";
                            $query = mysqli_query($con, $sql);
                            
                            while ($data = mysqli_fetch_assoc($query)) {

                                $sql1 = "select * from category where id = '".$data['parent_id']."'";
                                $query1 = mysqli_query($con, $sql1);
                                $cat = mysqli_fetch_assoc($query1);
                            ?>
                                <tr>
                                    <td><?= $var ?></td>
                                    <td class="cat_name"><?= $data['name'] ?></td>
                                    <td class="catid" id="<?=$cat['id']?>"><?= $cat['name'] ?></td>
                                    <td><img src="sub_cat_image/<?= $data['image'] ?>"></td>
                                    <td>
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
    <div class="modal" tabindex="-1" id="categoryUpdateModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Sub-Category</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="update_sub_category.php" method="post" class="" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Category</label>
                            <select id="cat_updt" class="form-control" name = "cat">
                                <option value="">Choose Category</option>
                            <?= SelectCat()?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="cat_id">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="category_name" id="cat_name_update">
                        </div>
                        <div class="form-group">
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
        function CategoryUpdate(cat_id) {
            var name = $('#category_delete_' + cat_id).closest('tr').find('.cat_name').text();
            var cat = $('#category_delete_' + cat_id).closest('tr').find('.catid').attr('id');
            
            $('#cat_name_update').val(name);
            $('#cat_updt').val(cat);
            $('input[name="cat_id"]').val(cat_id);
            $('#categoryUpdateModal').modal('show');
        }
        
        function delcat(did) {
            
            $.confirm({
                title: 'Delete!',
                content: 'Are you sure you want to delete this item?',
                buttons: {
                    delete: function () {
                        window.location.href="delete_subcat.php?delete="+did;
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
    <?php include "footer.php"; ?>
</body>

</html>