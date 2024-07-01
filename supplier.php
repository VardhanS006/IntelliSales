<?php include 'header.php';?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Supplier Manager</title>
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
                            <h1>Manage Suppliers</h1>
                        </div><!-- /.col -->
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sr. No.</th>
                                <th>Supplier Name</th>
                                <th>Address</th>
                                <th>Contact Number</th>
                                <th>Image</th>
                                <th>Email-Id</th>
                                <th>
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'connection.php';
                            $var = 1;
                            $sql = "select * from supplier ";
                            $query = mysqli_query($con, $sql);
                            while ($data = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr id="row_<?= $var ?>">
                                    <td><?= $var ?></td>
                                    <td class="name"><?= $data['name'] ?></td>
                                    <td class="add"><?= $data['address'] ?></td>
                                    <td class="phno"><?= $data['phone'] ?></td>
                                    <td class="imge"><img src="supplier_image/<?= $data['image'] ?>"></td>
                                    <td class="mail"><?= $data['email'] ?></td>
                                    <td id="rw_<?= $var ?>">
                                        <button id="category_delete_<?= $data['id'] ?>" class="btn text-success" onclick="Supplierupdate('<?= $data['id'] ?>')"><i class="fa fa-edit"></i></button>
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
            <a class="aa fas fa-truck-loading fa fa-2x" onclick="supplieradd()"></a>
        </div>
    </div>
    <!-- Add supplier-->
    <div class="modal" tabindex="-1" id="supplierUpdateModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Supplier</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="add_supplier.php" method="post" class="" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" name="cus_id">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="supplier_name" id="catname" onfocusout="Checkname(this)">
                            <span id="error_msg" class="text-danger"></span>
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" class="form-control" name="add" placeholder="Address">
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="number" class="form-control" name="ph" placeholder="Phone Number">
                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" class="form-control" name="file">
                        </div>
                        <div class="form-group">
                            <label for="">E-mail</label>
                            <input type="email" class="form-control" name="email" placeholder="email">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-success form-control col-4" name="submit" type="submit" id="submit">Add Supplier</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update modal-->
    <div class="modal" tabindex="-1" id="categoryUpdateModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Supplier</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="editsupplier.php" method="post" class="" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" name="cus_id">
                            <label for="">Name</label>
                            <input type="text" class="form-control" name="supplier_name" id="cus_name_update">
                        </div>
                        <div class="form-group">
                            <label for="">Address</label>
                            <input type="text" class="form-control" name="add" placeholder="Address">
                        </div>
                        <div class="form-group">
                            <label for="">Phone</label>
                            <input type="number" class="form-control" name="pho" placeholder="Phone Number">
                        </div>
                        <div class="form-group">
                            <label for="">Image</label>
                            <input type="file" class="form-control" name="file">
                        </div>
                        <div class="form-group">
                            <label for="">E-mail</label>
                            <input type="email" class="form-control" name="email" placeholder="email">
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
    <?php include "footer.php" ?>

    <script>
        function supplieradd(cus_id) {
            $('#supplierUpdateModal').modal('show');
        }

        function Supplierupdate(cus_id) {

            var name = $('#category_delete_' + cus_id).closest('tr').find('.name').text();
            var address = $('#category_delete_' + cus_id).closest('tr').find('.add').text();
            var phone = $('#category_delete_' + cus_id).closest('tr').find('.phno').text();
            var email = $('#category_delete_' + cus_id).closest('tr').find('.mail').text();
            
            $('#cus_name_update').val(name);
            $('input[name="cus_id"]').val(cus_id);
            $('input[name="supplier_name"]').val(name);
            $('input[name="add"]').val(address);
            $('input[name="pho"]').val(phone);
            $('input[name="email"]').val(email);

            $('#categoryUpdateModal').modal('show');
        }
        
        function delcat(id){
            
            $.confirm({
                title: 'Delete!',
                content: 'Are you sure you want to delete this item?',
                buttons: {
                    delete: function () {
                        window.location.href="deletesupplier.php?delete="+id;
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
                    data: {supplier: nam},
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