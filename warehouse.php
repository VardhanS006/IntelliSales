<?php include 'header.php'; ?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Warehouse Manager</title>
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
    <div class=" content-wrapper">
        <div class="container-fluid p-3">
            <div class="card">
                <div class="card-header content-header">
                    <div class="row" style="border-bottom:2px solid black">
                        <div class="col-sm-6 col-lg-12 col-md-12">
                            <h1>Manage Warehouses</h1>
                        </div><!-- /.col -->
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Warehouse Name</th>
                                <th>Address</th>
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
                            $sql = "select * from warehouse ";
                            $query = mysqli_query($con, $sql);
                            while ($data = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr id="row_<?= $var ?>">
                                    <td><?= $var ?></td>
                                    <td class="nme"><?= $data['name'] ?></td>
                                    <td class="add"><?= $data['address'] ?></td>
                                    <td class="imge"><img src="warehouse_image/<?= $data['image'] ?>"></td>
                                    <td id="rw_<?= $var ?>">
                                        <button id="category_delete_<?= $data['id'] ?>" class="btn text-success" onclick="wareupdt('<?= $data['id'] ?>')"><i class="fa fa-edit"></i></button>
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
            <a class="aa fa fa-plus fa fa-2x" onclick="wareadd()"></a>
        </div>
    </div>
    <!-- Add Customer-->
    <div class="modal" tabindex="-1" id="customerAddModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Warehouse</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="add_warehouse.php" method="post" class="" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" name="cus_id">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="customer_name" id="catname" onfocusout="Checkname(this)">
                            <span id="error_msg" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" class="form-control" name="add" placeholder="Address">
                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" class="form-control" name="file">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-success form-control col-4" name="submit" type="submit" id="submit">Add Warehouse</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal" tabindex="-1" id="categoryUpdateModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Warehouse</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="updatewhouse.php" method="post" class="" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" name="cus_id">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="customer_name" id="cus_name_update">
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" class="form-control" name="add" placeholder="Address" id="add_updt">
                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" class="form-control" name="file">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="submit">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php include "footer.php" ?>
    <script>
        function wareadd(cus_id) {
            $('#customerAddModal').modal('show');
        }

        function wareupdt(cus_id) {
            var name = $('#category_delete_' + cus_id).closest('tr').find('.nme').text();
            var add = $('#category_delete_' + cus_id).closest('tr').find('.add').text();
            $('#cus_name_update').val(name);
            $('#add_updt').val(add);
            $('input[name="cus_id"]').val(cus_id);
            $('#categoryUpdateModal').modal('show');
        }
        
        function delcat(id){
            
            $.confirm({
                title: 'Delete!',
                content: 'Are you sure you want to delete this item?',
                buttons: {
                    delete: function () {
                        window.location.href="deletewarehouse.php?delete="+id;
                    },
                    cancel: function () {
                        
                    }
                    
                }
            });
    
            
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
                    data: {warehouse: nam},
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